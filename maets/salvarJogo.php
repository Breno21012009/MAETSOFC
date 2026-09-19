<?php

session_start();

include "conexaoBD.php";

// Verifica se está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: formLogin.php");
    exit();
}

$idUsuario = intval($_SESSION['idUsuario']);
$idJogo = intval($_GET['id'] ?? 0);


// Verifica se o jogo existe
$sqlJogo = "SELECT idJogo FROM jogos WHERE idJogo = $idJogo";
$resultadoJogo = mysqli_query($conn, $sqlJogo);

if (!$resultadoJogo || mysqli_num_rows($resultadoJogo) == 0) {
    die("Jogo não encontrado.");
}


// Verifica se já está salvo
$sqlVerifica = "SELECT idJogoSalvo
                FROM jogos_salvos
                WHERE idUsuario = $idUsuario
                AND idJogo = $idJogo";

$resultadoVerifica = mysqli_query($conn, $sqlVerifica);


if (mysqli_num_rows($resultadoVerifica) == 0) {

    $sqlSalvar = "INSERT INTO jogos_salvos (idUsuario, idJogo)
                  VALUES ($idUsuario, $idJogo)";

    mysqli_query($conn, $sqlSalvar);
}


// Volta para a página do jogo
header("Location: visualizarJogo.php?id=$idJogo&salvo=sim");
exit();

?>