<?php 
ini_set('display_errors','Off');
session_start();

if ($_SESSION['logged_in'] == true) {
    //Redirecionar para a página de login
    header('Location: carrinho.php');
   
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sistema de Login</title>
    <!-- Importa o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <?php
        if (isset($_SESSION['failed_login'])) {
            echo $_SESSION['failed_login'];
            unset($_SESSION['failed_login']);
            $_SESSION['failed_login']  = '';
        }
        ?>

        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="username" class="form-label">Usuário:</label>
                <input type="text" name="username" class="form-control" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" name="password" class="form-control" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>

    <!-- Importa o JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>