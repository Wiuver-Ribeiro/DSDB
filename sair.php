<?php

session_start();
session_unset();
session_destroy();
setcookie('carrinho', '', time() - 3600);
header('Location: index.php');
exit;
