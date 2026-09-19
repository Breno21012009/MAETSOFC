<?php

include "conexaoBD.php"; // Inclui a conexão com o banco
session_start(); // Inicia a sessão

$emailUsuario = mysqli_real_escape_string($conn, $_POST['emailUsuario']);
$senhaUsuario = mysqli_real_escape_string($conn, $_POST['senhaUsuario']);

// QUERY para buscar os dados do login
$buscarLogin = "SELECT *
                FROM usuarios
                WHERE emailUsuario = '$emailUsuario'
                AND senhaUsuario = md5('$senhaUsuario')";

// Executa a QUERY
$efetuarLogin = mysqli_query($conn, $buscarLogin);

// Verifica se encontrou o usuário
if($registro = mysqli_fetch_assoc($efetuarLogin)){

    // Cria as variáveis de sessão
    $_SESSION['idUsuario']    = $registro['id_maets'];
    $_SESSION['nomeUsuario']  = $registro['nomeUsuario'];
    $_SESSION['emailUsuario'] = $registro['emailUsuario'];
    $_SESSION['nivelUsuario'] = $registro['nivelUsuario'];
    $_SESSION['logado']       = true;

    // Redireciona para a página inicial
    header("Location: index.php");
    exit();

}
else{

    // Redireciona para o formulário de login
    header("Location: formLogin.php?erroLogin=dadosInvalidos");
    exit();

}

?>