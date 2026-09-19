<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "conexaoBD.php";


/* =========================
   VERIFICAR ID DO JOGO
========================= */

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: loja.php");
    exit();
}

$idJogo = intval($_GET["id"]);


/* =========================
   BUSCAR JOGO
========================= */

$sql = "SELECT * FROM jogos WHERE idJogo = $idJogo";

$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    header("Location: loja.php");
    exit();
}

$jogo = mysqli_fetch_assoc($resultado);


/* =========================
   DADOS DO JOGO
========================= */

$nomeJogo = $jogo["nomeJogo"];
$descricaoJogo = $jogo["descricaoJogo"];
$categoriaJogo = $jogo["categoriaJogo"];
$precoJogo = $jogo["precoJogo"];

$imagemJogo = $jogo["imagemJogo"];

$gameplay1Jogo = $jogo["gameplay1Jogo"];
$gameplay2Jogo = $jogo["gameplay2Jogo"];
$gameplay3Jogo = $jogo["gameplay3Jogo"];


/* =========================
   LOGIN
========================= */

$logado = isset($_SESSION["logado"]) && $_SESSION["logado"] === true;

$idUsuario = 0;

if ($logado && isset($_SESSION["idUsuario"])) {
    $idUsuario = intval($_SESSION["idUsuario"]);
}


/* =========================
   COMPRAR JOGO
========================= */

if (isset($_GET["comprar"]) && $_GET["comprar"] == "1") {

    if (!$logado) {
        header("Location: formLogin.php");
        exit();
    }


    /* Verifica se já está na biblioteca */

    $sqlVerificaBiblioteca = "SELECT idBiblioteca
                              FROM biblioteca
                              WHERE idUsuario = $idUsuario
                              AND idJogo = $idJogo
                              LIMIT 1";

    $resultadoBiblioteca = mysqli_query($conn, $sqlVerificaBiblioteca);


    /* Se não estiver, adiciona */

    if ($resultadoBiblioteca && mysqli_num_rows($resultadoBiblioteca) == 0) {

        $sqlAdicionarBiblioteca = "INSERT INTO biblioteca
                                   (idJogo, idUsuario, dataAdicao)
                                   VALUES
                                   ($idJogo, $idUsuario, NOW())";

        mysqli_query($conn, $sqlAdicionarBiblioteca);
    }


    header("Location: visualizarJogo.php?id=" . $idJogo . "&comprado=sim");
    exit();
}


/* =========================
   SALVAR EM MEUS JOGOS
========================= */

if (isset($_GET["salvar"]) && $_GET["salvar"] == "1") {

    if (!$logado) {
        header("Location: formLogin.php");
        exit();
    }


    $sqlVerificaSalvo = "SELECT idJogoSalvo
                         FROM jogos_salvos
                         WHERE idUsuario = $idUsuario
                         AND idJogo = $idJogo
                         LIMIT 1";

    $resultadoSalvo = mysqli_query($conn, $sqlVerificaSalvo);


    if ($resultadoSalvo && mysqli_num_rows($resultadoSalvo) == 0) {

        $sqlSalvar = "INSERT INTO jogos_salvos
                      (idUsuario, idJogo)
                      VALUES
                      ($idUsuario, $idJogo)";

        mysqli_query($conn, $sqlSalvar);
    }


    header("Location: visualizarJogo.php?id=" . $idJogo . "&salvo=sim");
    exit();
}


/* =========================
   ADICIONAR AOS FAVORITOS
========================= */

if (isset($_GET["favoritar"]) && $_GET["favoritar"] == "1") {

    if (!$logado) {
        header("Location: formLogin.php");
        exit();
    }


    $sqlVerificaFavorito = "SELECT idFavorito
                            FROM favoritos
                            WHERE idUsuario = $idUsuario
                            AND idJogo = $idJogo
                            LIMIT 1";

    $resultadoFavorito = mysqli_query($conn, $sqlVerificaFavorito);


    if ($resultadoFavorito && mysqli_num_rows($resultadoFavorito) == 0) {

        $sqlFavoritar = "INSERT INTO favoritos
                         (idUsuario, idJogo)
                         VALUES
                         ($idUsuario, $idJogo)";

        mysqli_query($conn, $sqlFavoritar);
    }


    header("Location: visualizarJogo.php?id=" . $idJogo . "&favoritado=sim");
    exit();
}


/* =========================
   REMOVER DOS FAVORITOS
========================= */

if (isset($_GET["desfavoritar"]) && $_GET["desfavoritar"] == "1") {

    if (!$logado) {
        header("Location: formLogin.php");
        exit();
    }


    $sqlDesfavoritar = "DELETE FROM favoritos
                        WHERE idUsuario = $idUsuario
                        AND idJogo = $idJogo";

    mysqli_query($conn, $sqlDesfavoritar);


    header("Location: visualizarJogo.php?id=" . $idJogo);
    exit();
}


/* =========================
   VERIFICAR JOGO SALVO
========================= */

$jogoSalvo = false;

if ($logado) {

    $sqlSalvo = "SELECT idJogoSalvo
                 FROM jogos_salvos
                 WHERE idUsuario = $idUsuario
                 AND idJogo = $idJogo
                 LIMIT 1";

    $resultadoSalvo = mysqli_query($conn, $sqlSalvo);


    if ($resultadoSalvo && mysqli_num_rows($resultadoSalvo) > 0) {
        $jogoSalvo = true;
    }
}


/* =========================
   VERIFICAR FAVORITO
========================= */

$jogoFavorito = false;

if ($logado) {

    $sqlFavorito = "SELECT idFavorito
                    FROM favoritos
                    WHERE idUsuario = $idUsuario
                    AND idJogo = $idJogo
                    LIMIT 1";

    $resultadoFavorito = mysqli_query($conn, $sqlFavorito);


    if ($resultadoFavorito && mysqli_num_rows($resultadoFavorito) > 0) {
        $jogoFavorito = true;
    }
}


/* =========================
   VERIFICAR BIBLIOTECA
========================= */

$jogoNaBiblioteca = false;

if ($logado) {

    $sqlBiblioteca = "SELECT idBiblioteca
                      FROM biblioteca
                      WHERE idUsuario = $idUsuario
                      AND idJogo = $idJogo
                      LIMIT 1";

    $resultadoBiblioteca = mysqli_query($conn, $sqlBiblioteca);


    if ($resultadoBiblioteca && mysqli_num_rows($resultadoBiblioteca) > 0) {
        $jogoNaBiblioteca = true;
    }
}


include "header.php";

?>


<style>

body {
    background: #07111a;
    color: white;
}

.detalhe-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}


/* =========================
   VOLTAR
========================= */

.voltar {
    color: white;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 25px;
}

.voltar:hover {
    color: #b8d7e8;
}


/* =========================
   PAINEL PRINCIPAL
========================= */

.painel-jogo {
    background: #0f1922;
    border: 1px solid #2a475e;
    border-radius: 10px;
    padding: 30px;
}


/* =========================
   GRID
========================= */

.jogo-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 35px;
}


/* =========================
   IMAGEM
========================= */

.imagem-principal {
    width: 100%;
    height: 400px;
    object-fit: contain;
    background: #000;
    border-radius: 8px;
}


/* =========================
   INFORMAÇÕES
========================= */

.nome-jogo {
    font-size: 38px;
    font-weight: bold;
    margin-bottom: 12px;
}

.categoria {
    display: inline-block;
    background: #2a475e;
    color: white;
    padding: 6px 12px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.descricao {
    color: #c3ced5;
    line-height: 1.7;
    font-size: 16px;
    margin-bottom: 25px;
}

.preco {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 20px;
}


/* =========================
   BOTÕES
========================= */

.botoes-jogo {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.btn-jogo {
    display: block;
    width: 100%;
    text-align: center;
    text-decoration: none;
    padding: 13px;
    border-radius: 6px;
    font-weight: bold;
}

.btn-comprar {
    background: #2a475e;
    color: white;
}

.btn-comprar:hover {
    background: #3b617d;
    color: white;
}

.btn-salvar {
    background: #333d44;
    color: white;
}

.btn-salvar:hover {
    background: #46525a;
    color: white;
}

.btn-favorito {
    background: #333d44;
    color: white;
}

.btn-favorito:hover {
    background: #46525a;
    color: white;
}

.btn-desfavoritar {
    background: #2a475e;
    color: white;
}

.btn-desfavoritar:hover {
    background: #3b617d;
    color: white;
}

.btn-biblioteca {
    background: #1d3545;
    color: #d9e7ef;
    cursor: default;
}


/* =========================
   MENSAGEM
========================= */

.mensagem {
    background: #172531;
    border: 1px solid #2a475e;
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 20px;
    text-align: center;
    color: #dce8ee;
}


/* =========================
   SEÇÃO
========================= */

.secao {
    margin-top: 40px;
}

.secao h2 {
    font-size: 25px;
    margin-bottom: 15px;
}

.secao p {
    color: #c3ced5;
    line-height: 1.7;
}


/* =========================
   GAMEPLAY
========================= */

.galeria-gameplay {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.galeria-gameplay img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
    background: #000;
}


/* =========================
   RESPONSIVO
========================= */

@media (max-width: 800px) {

    .jogo-grid {
        grid-template-columns: 1fr;
    }

    .nome-jogo {
        font-size: 30px;
    }

    .imagem-principal {
        height: 300px;
    }

    .galeria-gameplay {
        grid-template-columns: 1fr;
    }

}

</style>


<div class="detalhe-container">

    <a href="loja.php" class="voltar">
        ← Voltar para a loja
    </a>


    <?php if (isset($_GET["comprado"])) { ?>

        <div class="mensagem">
            ✓ Jogo adicionado à sua biblioteca!
        </div>

    <?php } ?>


    <?php if (isset($_GET["salvo"])) { ?>

        <div class="mensagem">
            ✓ Jogo salvo em Meus Jogos!
        </div>

    <?php } ?>


    <?php if (isset($_GET["favoritado"])) { ?>

        <div class="mensagem">
            ⭐ Jogo adicionado aos seus favoritos!
        </div>

    <?php } ?>


    <div class="painel-jogo">

        <div class="jogo-grid">


            <!-- =========================
                 IMAGEM
            ========================== -->

            <div>

                <img
                    src="<?php echo htmlspecialchars($imagemJogo); ?>"
                    alt="<?php echo htmlspecialchars($nomeJogo); ?>"
                    class="imagem-principal"
                >

            </div>


            <!-- =========================
                 INFORMAÇÕES
            ========================== -->

            <div>

                <div class="nome-jogo">
                    <?php echo htmlspecialchars($nomeJogo); ?>
                </div>


                <span class="categoria">
                    <?php echo htmlspecialchars($categoriaJogo); ?>
                </span>


                <div class="descricao">

                    <?php echo nl2br(htmlspecialchars($descricaoJogo)); ?>

                </div>


                <div class="preco">

                    R$
                    <?php
                    echo number_format(
                        $precoJogo,
                        2,
                        ",",
                        "."
                    );
                    ?>

                </div>


                <div class="botoes-jogo">


                    <!-- =========================
                         COMPRAR
                    ========================== -->

                    <?php if ($jogoNaBiblioteca) { ?>

                        <div class="btn-jogo btn-biblioteca">
                            ✓ Jogo na sua Biblioteca
                        </div>

                    <?php } else if ($logado) { ?>

                        <a
                            href="visualizarJogo.php?id=<?php echo $idJogo; ?>&comprar=1"
                            class="btn-jogo btn-comprar"
                        >
                            🛒 Comprar Agora
                        </a>

                    <?php } else { ?>

                        <a
                            href="formLogin.php"
                            class="btn-jogo btn-comprar"
                        >
                            🔐 Entrar para comprar
                        </a>

                    <?php } ?>


                    <!-- =========================
                         MEUS JOGOS
                    ========================== -->

                    <?php if ($jogoSalvo) { ?>

                        <div class="btn-jogo btn-biblioteca">
                            ✓ Jogo salvo em Meus Jogos
                        </div>

                    <?php } else if ($logado) { ?>

                        <a
                            href="visualizarJogo.php?id=<?php echo $idJogo; ?>&salvar=1"
                            class="btn-jogo btn-salvar"
                        >
                            💾 Salvar em Meus Jogos
                        </a>

                    <?php } else { ?>

                        <a
                            href="formLogin.php"
                            class="btn-jogo btn-salvar"
                        >
                            🔐 Entrar para salvar
                        </a>

                    <?php } ?>


                    <!-- =========================
                         FAVORITOS
                    ========================== -->

                    <?php if ($jogoFavorito) { ?>

                        <a
                            href="visualizarJogo.php?id=<?php echo $idJogo; ?>&desfavoritar=1"
                            class="btn-jogo btn-desfavoritar"
                        >
                            ⭐ Remover dos Favoritos
                        </a>

                    <?php } else if ($logado) { ?>

                        <a
                            href="visualizarJogo.php?id=<?php echo $idJogo; ?>&favoritar=1"
                            class="btn-jogo btn-favorito"
                        >
                            ☆ Adicionar aos Favoritos
                        </a>

                    <?php } else { ?>

                        <a
                            href="formLogin.php"
                            class="btn-jogo btn-favorito"
                        >
                            🔐 Entrar para favoritar
                        </a>

                    <?php } ?>


                </div>

            </div>

        </div>


        <!-- =========================
             SOBRE O JOGO
        ========================== -->

        <div class="secao">

            <h2>
                Sobre este jogo
            </h2>

            <p>
                <?php echo nl2br(htmlspecialchars($descricaoJogo)); ?>
            </p>

        </div>


        <!-- =========================
             GAMEPLAYS
        ========================== -->

        <?php

        $temGameplay = false;

        if (!empty($gameplay1Jogo) ||
            !empty($gameplay2Jogo) ||
            !empty($gameplay3Jogo)) {

            $temGameplay = true;
        }

        ?>


        <?php if ($temGameplay) { ?>

            <div class="secao">

                <h2>
                    Imagens do jogo
                </h2>


                <div class="galeria-gameplay">


                    <?php if (!empty($gameplay1Jogo)) { ?>

                        <img
                            src="<?php echo htmlspecialchars($gameplay1Jogo); ?>"
                            alt="Imagem do jogo"
                        >

                    <?php } ?>


                    <?php if (!empty($gameplay2Jogo)) { ?>

                        <img
                            src="<?php echo htmlspecialchars($gameplay2Jogo); ?>"
                            alt="Imagem do jogo"
                        >

                    <?php } ?>


                    <?php if (!empty($gameplay3Jogo)) { ?>

                        <img
                            src="<?php echo htmlspecialchars($gameplay3Jogo); ?>"
                            alt="Imagem do jogo"
                        >

                    <?php } ?>


                </div>

            </div>

        <?php } ?>


        <!-- =========================
             INFORMAÇÕES TÉCNICAS
        ========================== -->

        <div class="secao">

            <h2>
                Informações do jogo
            </h2>

            <p>
                <strong>Nome:</strong>
                <?php echo htmlspecialchars($nomeJogo); ?>
            </p>

            <p>
                <strong>Categoria:</strong>
                <?php echo htmlspecialchars($categoriaJogo); ?>
            </p>

            <p>
                <strong>Preço:</strong>
                R$
                <?php
                echo number_format(
                    $precoJogo,
                    2,
                    ",",
                    "."
                );
                ?>
            </p>

        </div>

    </div>

</div>


<?php include "footer.php"; ?>