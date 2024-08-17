<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "livraria";
$port = 3307;

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Checar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
