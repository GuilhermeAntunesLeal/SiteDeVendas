<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['usuario']['tipo'] == 'administrador') {
    header('Location: admin/index.php');
    exit;
}

header('Location: loja.php');
exit;
