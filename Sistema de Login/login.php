<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/signin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
</head>
<body>
<div class="container">

<div class="form-signin" style="background-color:blue;">


    <h2 class="text-center">Área restrita</h2>
    <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if (isset($_SESSION['msgcad'])) {
            echo $_SESSION['msgcad'];
            unset($_SESSION['msgcad']);
        }
    ?>
    <form action="valida.php" method="post">
    <!-- <label>Usuário</label> -->
    <input type="text" class="form-control" name="usuario" placeholder="Digite seu usuário"><br>

    <!-- <label>Senha</label> -->
    <input type="password" class="form-control" name="senha" placeholder="Digite sua senha"><br>

    <input type="submit" name="btnLogin" class="btn btn-success btn-block" value="Acessar">

    <div class="text-center" style="margin-top: 50px;">
    <h4>Você ainda não possui uma conta?</h4>
    <a href="cadastrar.php">Crie grátis</a>        
    </div>
<!--         
        <script>
            Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
            )
        </script> -->

    </form>
    </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

</html>