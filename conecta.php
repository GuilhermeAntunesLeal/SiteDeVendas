<?php
$conexao = mysqli_connect('localhost', 'root', '', 'inf261', 3306);

if (!$conexao) {
    die('Erro ao conectar com o banco de dados.');
}

mysqli_set_charset($conexao, 'utf8mb4');
