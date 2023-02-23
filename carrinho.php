<?php
ini_set('display_errors','Off');

session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirecionar para a página de login
    header('Location: index.php');
    exit();
}


// Verifica se o carrinho já existe no cookie
if (isset($_COOKIE['carrinho'])) {
    $carrinho = json_decode($_COOKIE['carrinho'], true);
} else {
    $carrinho = array();
}

// Verifica se foram enviados dados pelo formulário
if (isset($_POST['item']) && isset($_POST['quantidade']) && isset($_POST['valor'])) {
    $item = $_POST['item'];
    $quantidade = (int)$_POST['quantidade'];
    $valor = (int)$_POST['valor'];

    // Verifica se o item já existe no carrinho
    if (isset($carrinho[$item])) {
        $carrinho[$item] += $quantidade;
        // $carrinho[$valor] = $valor;
    } else {
        $carrinho[$item] = $quantidade;
        // $carrinho[$valor] = $valor *= $quantidade;
    }

    // Armazena o carrinho no cookie
    setcookie('carrinho', json_encode($carrinho), time() + 72 * 3600);
}


// //Armazenando o carrinho no cookie
// setcookie('carrinho', json_encode($carrinho), time() + 72 * 3600);


?>


<!DOCTYPE html>
<html>

<head>
    <title>Carrinho</title>
    <!-- Importa o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container p-3">
        <h1>Carrinho de Compras</h1>
        <p rule="alert" class="alert alert-success">Bem-vindo, <strong><?php echo ucfirst($_SESSION['name']); ?></strong>!
            <a class="btn btn-danger" href="sair.php">Sair</a>
        </p>

        <form method="post" action="carrinho.php">
            <div class="mb-3">
                <label for="item" class="form-label">Item:</label>
                <input type="text" name="item" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade:</label>
                <input type="number" name="quantidade" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor:</label>
                <input type="number" name="valor" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantidade</th>
                    <th>Valor Unidade</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exibe os itens do carrinho
                foreach ($carrinho as $item => $quantidade) {
                    echo '<tr>';
                    echo '<td>' . $item . '</td>';
                    echo '<td>' . $quantidade . '</td>';
                    echo '<td> R$' . $valor . '</td>';
                    echo '<td> R$' . $valor * $quantidade . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

    </div>

    <!-- Importa o JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>