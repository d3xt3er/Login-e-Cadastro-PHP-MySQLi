<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>

<?php

session_start();
include_once("conexao.php");

$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
if ($btnLogin) {
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    // echo "$usuario - $senha";
    if ((!empty($usuario)) AND (!empty($senha))) {
        // echo password_hash($senha, PASSWORD_DEFAULT);
        $result_usuario = "SELECT id, nome, email, senha FROM usuarios WHERE usuario='$usuario' LIMIT 1";
        $resultado_usuario = mysqli_query($conexao, $result_usuario);

        if ($resultado_usuario) {
            $row_usuario = mysqli_fetch_assoc($resultado_usuario);
            if (password_verify($senha,$row_usuario['senha'])) {
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['email'] = $row_usuario['email'];

                header("Location: administrativo.php");
            }
            else{
                $_SESSION['msg'] = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";
                // $_SESSION['msg'] = "<script>Swal.fire({
                //     icon: 'error',
                //     title: 'Oops...',
                //     text: 'Login ou senha incorreto!',
                //     footer: '<a href>Why do I have this issue?</a>'
                //   })</script>";
                header("Location: login.php");
            }
        }
    }
    else{
        $_SESSION['msg'] = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";
        // $_SESSION['msg'] = "<script>Swal.fire({
        //     icon: 'error',
        //     title: 'Oops...',
        //     text: 'Login ou senha incorreto!',
        //     footer: '<a href>Why do I have this issue?</a>'
        //   })</script>";
        header("Location: login.php");
    }
}
else{
    $_SESSION['msg'] = "<div class='alert alert-danger'>Página não encontrada</div>";
    header("Location: login.php");
}