<?php

$hostBD   = "localhost";
$userBD   = "root";
$senhaBD  = "";
$database = "maets";

// Conexão com o banco
$conn = mysqli_connect(
    $hostBD,
    $userBD,
    $senhaBD,
    $database
);

// Verifica a conexão
if (!$conn) {
    die(
        "Erro ao conectar ao banco de dados: "
        . mysqli_connect_error()
    );
}

// Define o padrão de caracteres
mysqli_set_charset($conn, "utf8mb4");

?>