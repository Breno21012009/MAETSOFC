<?php

include "conexaoBD.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // =========================
    // DADOS DO JOGO
    // =========================

    $nome = $_POST["nomeJogo"];
    $descricao = $_POST["descricaoJogo"];
    $categoria = $_POST["categoriaJogo"];
    $preco = $_POST["precoJogo"];
    $pagina = $_POST["paginaJogo"];


    // =========================
    // PASTA DAS IMAGENS
    // =========================

    $pasta = "assets/img/";

    // Cria a pasta caso ela não exista
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }


    // =========================
    // FUNÇÃO PARA SALVAR IMAGEM
    // =========================

    function salvarImagem($arquivo, $pasta)
    {
        // Verifica se houve erro no upload
        if (!isset($arquivo) || $arquivo["error"] != UPLOAD_ERR_OK) {
            return "";
        }

        // Extensão original
        $extensao = strtolower(
            pathinfo($arquivo["name"], PATHINFO_EXTENSION)
        );

        // Extensões permitidas
        $extensoesPermitidas = ["jpg", "jpeg", "png", "webp"];

        if (!in_array($extensao, $extensoesPermitidas)) {
            return "";
        }

        // Verifica se é realmente uma imagem
        $tipoImagem = getimagesize($arquivo["tmp_name"]);

        if ($tipoImagem === false) {
            return "";
        }

        // Nome único para evitar sobrescrever imagens
        $nomeArquivo = uniqid("jogo_", true) . "." . $extensao;

        // Caminho completo
        $caminhoCompleto = $pasta . $nomeArquivo;

        // Move a imagem para a pasta
        if (move_uploaded_file(
            $arquivo["tmp_name"],
            $caminhoCompleto
        )) {
            // Retorna o caminho que será salvo no banco
            return $caminhoCompleto;
        }

        return "";
    }


    // =========================
    // SALVAR AS 4 IMAGENS
    // =========================

    // 1 - CAPA
    $capa = salvarImagem(
        $_FILES["capaJogo"],
        $pasta
    );


    // 2 - GAMEPLAY 1
    $gameplay1 = salvarImagem(
        $_FILES["gameplay1Jogo"],
        $pasta
    );


    // 3 - GAMEPLAY 2
    $gameplay2 = salvarImagem(
        $_FILES["gameplay2Jogo"],
        $pasta
    );


    // 4 - GAMEPLAY 3
    $gameplay3 = salvarImagem(
        $_FILES["gameplay3Jogo"],
        $pasta
    );


    // =========================
    // VERIFICAR SE AS IMAGENS
    // FORAM SALVAS
    // =========================

    if (
        $capa == "" ||
        $gameplay1 == "" ||
        $gameplay2 == "" ||
        $gameplay3 == ""
    ) {

        echo "<script>
                alert('Erro ao salvar uma ou mais imagens.');
                history.back();
              </script>";

        exit;
    }


    // =========================
    // CADASTRAR NO BANCO
    // =========================

    $sql = "INSERT INTO jogos (
                capaJogo,
                nomeJogo,
                descricaoJogo,
                categoriaJogo,
                precoJogo,
                paginaJogo,
                gameplay1Jogo,
                gameplay2Jogo,
                gameplay3Jogo
            ) VALUES (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            )";


    $stmt = mysqli_prepare($conn, $sql);


    if (!$stmt) {

        echo "<script>
                alert('Erro ao preparar o cadastro do jogo.');
                history.back();
              </script>";

        exit;
    }


    // =========================
    // VINCULAR OS DADOS
    // =========================

    mysqli_stmt_bind_param(
        $stmt,
        "sssssssss",
        $capa,
        $nome,
        $descricao,
        $categoria,
        $preco,
        $pagina,
        $gameplay1,
        $gameplay2,
        $gameplay3
    );


    // =========================
    // EXECUTAR
    // =========================

    if (mysqli_stmt_execute($stmt)) {

        echo "<script>
                alert('Jogo cadastrado com sucesso!');
                window.location.href = 'loja.php';
              </script>";

    } else {

        // Se o banco der erro, remove as imagens que acabaram
        // de ser enviadas para não deixar arquivos órfãos

        if (file_exists($capa)) {
            unlink($capa);
        }

        if (file_exists($gameplay1)) {
            unlink($gameplay1);
        }

        if (file_exists($gameplay2)) {
            unlink($gameplay2);
        }

        if (file_exists($gameplay3)) {
            unlink($gameplay3);
        }


        echo "<script>
                alert('Erro ao cadastrar o jogo no banco de dados.');
                history.back();
              </script>";
    }


    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>