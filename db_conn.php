<?php
// Conexão
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "todolist";
$charset = "utf8mb4";

$conn = new mysqli($servername, $username, $password, $db_name);
$conn->set_charset($charset);

if($conn->connect_error){
    die("Erro na conexão: " . $conn->connect_error);
}
?>