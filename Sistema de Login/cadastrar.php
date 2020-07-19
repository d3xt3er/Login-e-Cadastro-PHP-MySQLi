<?php
session_start();
ob_start();
$btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
if($btnCadUsuario){
    include_once "conexao.php";
    $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $erro = false;

    $dados_st = array_map('strip_tags', $dados_rc);
    $dados = array_map('trim', $dados_st);

    if(in_array('',$dados)){
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>Nescessário preencher todos os campos!</div>";
    }
    elseif(strlen($dados['senha']) < 6){
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>A senha deve ter no mínimo seis caracteres!</div>";
    }
    elseif(stristr($dados['senha'], "'")){
        $erro = true;
        $_SESSION['msg'] = "<div class='alert alert-danger'>Caracter ( ' ) utilizado na senha invalido!</div>";
    }
    else{
        $result_usuario = "SELECT id FROM usuarios WHERE usuario='".$dados['usuario']."'";

        $resultado_usuario = mysqli_query($conexao, $result_usuario);
        
        if (($resultado_usuario) AND ($resultado_usuario->num_rows)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='alert alert-danger'>Este usuário ja está sendo utilizado!</div>";
        }

        $result_usuario = "SELECT id FROM usuarios WHERE email='".$dados['email']."'";

        $resultado_usuario = mysqli_query($conexao, $result_usuario);
        
        if (($resultado_usuario) AND ($resultado_usuario->num_rows)) {
            $erro = true;
            $_SESSION['msg'] = "<div class='alert alert-danger'>Este email ja está sendo utilizado!</div>";
        }
    }

    // var_dump($dados);
    if(!$erro){

        $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);

        $result_usuario = "INSERT INTO usuarios (nome, email, usuario, senha) VALUES (
            '".$dados['nome']."',
            '".$dados['email']."',
            '".$dados['usuario']."',
            '".$dados['senha']."'
            )";
    
            $resultado_usuario = mysqli_query($conexao, $result_usuario);
            if(mysqli_insert_id($conexao)){
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
                header("Location: login.php");
            }
            else{
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao cadastrar o usuário</div>";
            }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/signin.css">
</head>
<body>
    <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
    <div class="container">

    <div class="form-signin" style="background-color:blue;">
       
    <h2>Cadastrar Usuário</h2>

    <form action="" method="post" >
        
        <input type="text" class="form-control"  name="nome" placeholder="Digite seu nome e o sobrenome"><br>
               
        <input type="text" class="form-control"  name="email" placeholder="Digite seu e-mail"><br>
        
        <input type="text" class="form-control"  name="usuario" placeholder="Digite seu usuario"><br>

        <input type="password" class="form-control"  name="senha" placeholder="Digite sua senha"><br>

        <input type="submit" value="Cadastrar" class="btn btn-success" name="btnCadUsuario"><br>
       
        <div class="text-center" style="margin-top: 50px;">
        Lembrou? <a href="login.php">Clique aqui</a> para logar
        </div>
    </form>

    </div>

    </div> 
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>