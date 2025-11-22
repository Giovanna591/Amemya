<?php
// banco.php

$host = "www.thyagoquintas.com.br:3306"; // Endereço do servidor do banco de dados
$username = "engenharia_25";             // Nome de usuário para o banco de dados
$password = "caranguejoraposa";          // Senha para o banco de dados
$dbname = "engenharia_25";               // Nome do banco de dados

$conn = new mysqli($host, $username, $password, $dbname);

?>