<?php

include "conexaoBD.php";
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: formLogin.php?erroLogin=naoLogado");
    exit();
}

// Verifica se recebeu o ID do jogo
if (!isset($_GET['idJogo'])) {
    header("Location: loja.php");
    exit();
}

$idUsuario = $_SESSION['idUsuario'];
$idJogo = intval($_GET['idJogo']);

// Verifica se o jogo já está na biblioteca
$verificar = "SELECT * 
              FROM Biblioteca 
              WHERE idUsuario = '$idUsuario'
              AND idJogo = '$idJogo'";

$resultado = mysqli_query($conn, $verificar);

if (mysqli_num_rows($resultado) > 0) {

    // Já existe
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?biblioteca=jaExiste");
    exit();

}

// Adiciona o jogo
$sql = "INSERT INTO Biblioteca 
        (idUsuario, idJogo)
        VALUES
        ('$idUsuario', '$idJogo')";

if (mysqli_query($conn, $sql)) {

    header("Location: " . $_SERVER['HTTP_REFERER'] . "?biblioteca=adicionado");
    exit();

} else {

    echo "Erro ao adicionar o jogo à biblioteca: " . mysqli_error($conn);

}

?>