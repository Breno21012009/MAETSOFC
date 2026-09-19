<?php

include "conexaoBD.php";


// =========================================================
// VERIFICAR SE O FORMULÁRIO FOI ENVIADO
// =========================================================

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: formPromocoes.php");
    exit;

}


// =========================================================
// DADOS DO FORMULÁRIO
// =========================================================

$nomePromocoes = $_POST["nomePromocoes"];
$descricaoPromocoes = $_POST["descricaoPromocoes"];
$categoriaPromocoes = $_POST["categoriaPromocoes"];

$precoOriginalPromocoes = $_POST["precoOriginalPromocoes"];
$precoPromocoes = $_POST["precoPromocoes"];

$paginaPromocoes = $_POST["paginaPromocoes"];


// =========================================================
// PASTA DAS IMAGENS
// =========================================================

$pasta = "assets/img/";


// =========================================================
// CRIAR PASTA CASO NÃO EXISTA
// =========================================================

if (!is_dir($pasta)) {

    mkdir($pasta, 0777, true);

}


// =========================================================
// FUNÇÃO PARA SALVAR IMAGEM
// =========================================================

function salvarImagemPromocao($arquivo, $pasta)
{

    // Verifica se o arquivo foi enviado corretamente

    if (
        !isset($arquivo) ||
        $arquivo["error"] != UPLOAD_ERR_OK
    ) {

        return "";

    }


    // Pega a extensão

    $extensao = strtolower(
        pathinfo(
            $arquivo["name"],
            PATHINFO_EXTENSION
        )
    );


    // Extensões permitidas

    $extensoesPermitidas = [
        "jpg",
        "jpeg",
        "png",
        "webp"
    ];


    if (!in_array($extensao, $extensoesPermitidas)) {

        return "";

    }


    // Verifica se é realmente uma imagem

    if (getimagesize($arquivo["tmp_name"]) === false) {

        return "";

    }


    // Cria nome único

    $nomeArquivo =
        uniqid("promocao_", true)
        . "."
        . $extensao;


    // Caminho completo

    $caminho = $pasta . $nomeArquivo;


    // Move o arquivo

    if (
        move_uploaded_file(
            $arquivo["tmp_name"],
            $caminho
        )
    ) {

        return $caminho;

    }


    return "";

}


// =========================================================
// SALVAR AS 4 IMAGENS
// =========================================================

// CAPA

$capaPromocoes = salvarImagemPromocao(
    $_FILES["capaPromocoes"],
    $pasta
);


// GAMEPLAY 1

$gameplay1Promocoes = salvarImagemPromocao(
    $_FILES["gameplay1Promocoes"],
    $pasta
);


// GAMEPLAY 2

$gameplay2Promocoes = salvarImagemPromocao(
    $_FILES["gameplay2Promocoes"],
    $pasta
);


// GAMEPLAY 3

$gameplay3Promocoes = salvarImagemPromocao(
    $_FILES["gameplay3Promocoes"],
    $pasta
);


// =========================================================
// VERIFICAR SE TODAS AS IMAGENS FORAM SALVAS
// =========================================================

if (
    $capaPromocoes == "" ||
    $gameplay1Promocoes == "" ||
    $gameplay2Promocoes == "" ||
    $gameplay3Promocoes == ""
) {

    echo "
        <script>
            alert('Erro ao salvar uma ou mais imagens da promoção.');
            history.back();
        </script>
    ";

    exit;

}


// =========================================================
// CADASTRAR NO BANCO
// =========================================================

$sql = "INSERT INTO promocoes (

    nomePromocoes,
    descricaoPromocoes,
    categoriaPromocoes,
    precoOriginalPromocoes,
    precoPromocoes,
    capaPromocoes,
    paginaPromocoes,
    gameplay1Promocoes,
    gameplay2Promocoes,
    gameplay3Promocoes

) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = mysqli_prepare($conn, $sql);


if (!$stmt) {

    echo "
        <script>
            alert('Erro ao preparar o cadastro da promoção.');
            history.back();
        </script>
    ";

    exit;

}


// =========================================================
// VINCULAR DADOS
// =========================================================

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssss",
    $nomePromocoes,
    $descricaoPromocoes,
    $categoriaPromocoes,
    $precoOriginalPromocoes,
    $precoPromocoes,
    $capaPromocoes,
    $paginaPromocoes,
    $gameplay1Promocoes,
    $gameplay2Promocoes,
    $gameplay3Promocoes
);


// =========================================================
// EXECUTAR
// =========================================================

if (mysqli_stmt_execute($stmt)) {

    echo "
        <script>
            alert('Promoção cadastrada com sucesso!');
            window.location.href = 'promocoes.php';
        </script>
    ";

} else {

    // Se der erro no banco,
    // remove as imagens recém-enviadas

    if (file_exists($capaPromocoes)) {
        unlink($capaPromocoes);
    }

    if (file_exists($gameplay1Promocoes)) {
        unlink($gameplay1Promocoes);
    }

    if (file_exists($gameplay2Promocoes)) {
        unlink($gameplay2Promocoes);
    }

    if (file_exists($gameplay3Promocoes)) {
        unlink($gameplay3Promocoes);
    }


    echo "
        <script>
            alert('Erro ao cadastrar a promoção no banco de dados.');
            history.back();
        </script>
    ";

}


mysqli_stmt_close($stmt);
mysqli_close($conn);

?>