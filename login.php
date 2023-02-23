<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirecionar para a página de login
    header('Location: index.php');
    exit();
}




// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se as credenciais de login são válidas
    $username = $_POST['username'];
    $password = $_POST['password'];



    if ($username === "wiuver" && $password === "123") {
        // Iniciar a sessão e redirecionar para a página carrinho.php
        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $username;
        header('Location: carrinho.php');
        exit();
    } else {
        // Exibir mensagem de erro
        $_SESSION['failed_login'] = "<div rule='alert' class='alert alert-danger'>Usuário E/OU Senha incorretos!</div>";
        header("Location:index.php");
        // exit;
    }
}
