<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: formLogin.php");
    exit();
}

include "conexaoBD.php";


// Dados da sessão
$emailSessao = $_SESSION['emailUsuario'];

$emailSessao = mysqli_real_escape_string($conn, $emailSessao);


// Dados recebidos do formulário
$nomeUsuario = trim($_POST['nomeUsuario']);
$dataNascimentoUsuario = $_POST['dataNascimentoUsuario'];
$novoEmailUsuario = trim($_POST['emailUsuario']);


// Filtra os dados
$nomeUsuario = mysqli_real_escape_string($conn, $nomeUsuario);
$dataNascimentoUsuario = mysqli_real_escape_string($conn, $dataNascimentoUsuario);
$novoEmailUsuario = mysqli_real_escape_string($conn, $novoEmailUsuario);


// Verifica nome
if (empty($nomeUsuario)) {
    header("Location: editarPerfil.php?erro=nome");
    exit();
}


// Verifica e-mail
if (empty($novoEmailUsuario) || !filter_var($novoEmailUsuario, FILTER_VALIDATE_EMAIL)) {
    header("Location: editarPerfil.php?erro=email");
    exit();
}


// Verifica se outro usuário já usa esse e-mail
$verificarEmail = "SELECT *
                   FROM usuarios
                   WHERE emailUsuario = '$novoEmailUsuario'
                   AND emailUsuario != '$emailSessao'";

$resultadoEmail = mysqli_query($conn, $verificarEmail);

if (mysqli_num_rows($resultadoEmail) > 0) {

    header("Location: editarPerfil.php?erro=emailExiste");
    exit();

}


// Mantém a foto atual
$fotoUsuario = "";


// Verifica se foi enviada uma nova foto
if (isset($_FILES['fotoUsuario']) && $_FILES['fotoUsuario']['size'] > 0) {

    $diretorio = "assets/img/";

    $nomeArquivo = basename($_FILES['fotoUsuario']['name']);

    $fotoUsuario = $diretorio . $nomeArquivo;

    $tipoDaImagem = strtolower(
        pathinfo($fotoUsuario, PATHINFO_EXTENSION)
    );


    // Verifica tamanho
    if ($_FILES['fotoUsuario']['size'] > 5000000) {

        header("Location: editarPerfil.php?erro=fotoGrande");
        exit();

    }


    // Verifica extensão
    if (
        $tipoDaImagem != "jpg" &&
        $tipoDaImagem != "jpeg" &&
        $tipoDaImagem != "png" &&
        $tipoDaImagem != "webp"
    ) {

        header("Location: editarPerfil.php?erro=fotoFormato");
        exit();

    }


    // Move a nova foto
    if (!move_uploaded_file(
        $_FILES['fotoUsuario']['tmp_name'],
        $fotoUsuario
    )) {

        header("Location: editarPerfil.php?erro=fotoUpload");
        exit();

    }


    // Atualiza com nova foto
    $atualizarUsuario = "UPDATE usuarios
                         SET
                         fotoUsuario = '$fotoUsuario',
                         nomeUsuario = '$nomeUsuario',
                         dataNascimentoUsuario = '$dataNascimentoUsuario',
                         emailUsuario = '$novoEmailUsuario'
                         WHERE emailUsuario = '$emailSessao'";

}
else {

    // Atualiza sem alterar a foto
    $atualizarUsuario = "UPDATE usuarios
                         SET
                         nomeUsuario = '$nomeUsuario',
                         dataNascimentoUsuario = '$dataNascimentoUsuario',
                         emailUsuario = '$novoEmailUsuario'
                         WHERE emailUsuario = '$emailSessao'";

}


// Executa a atualização
if (mysqli_query($conn, $atualizarUsuario)) {


    // Atualiza os dados da sessão
    $_SESSION['nomeUsuario'] = $nomeUsuario;
    $_SESSION['emailUsuario'] = $novoEmailUsuario;


    // Volta para o perfil
    header("Location: perfil.php?alterado=sucesso");
    exit();

}
else {

    echo "
    <div style='
        background:#0f1922;
        color:white;
        padding:50px;
        text-align:center;
        font-family:Arial;
    '>

        <h2>Erro ao atualizar o perfil.</h2>

        <p>" . mysqli_error($conn) . "</p>

        <a href='editarPerfil.php'
           style='color:#66c0f4;'>
            Voltar
        </a>

    </div>
    ";

}

?>