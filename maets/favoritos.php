<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true) {
    header("Location: formLogin.php");
    exit();
}

include "conexaoBD.php";

$idUsuario = intval($_SESSION["idUsuario"]);


/* =========================
   REMOVER DOS FAVORITOS
========================= */

if (isset($_GET["remover"]) && is_numeric($_GET["remover"])) {

    $idJogo = intval($_GET["remover"]);

    $sqlRemover = "DELETE FROM favoritos
                   WHERE idUsuario = $idUsuario
                   AND idJogo = $idJogo";

    mysqli_query($conn, $sqlRemover);

    header("Location: favoritos.php");
    exit();
}


/* =========================
   PESQUISA
========================= */

$busca = "";

if (isset($_GET["busca"])) {
    $busca = trim($_GET["busca"]);
}

$buscaSegura = mysqli_real_escape_string($conn, $busca);


/* =========================
   BUSCAR FAVORITOS
========================= */

$sql = "SELECT
            favoritos.idFavorito,
            favoritos.dataFavorito,

            jogos.idJogo,
            jogos.nomeJogo,
            jogos.descricaoJogo,
            jogos.categoriaJogo,
            jogos.precoJogo,
            jogos.imagemJogo

        FROM favoritos

        INNER JOIN jogos
            ON favoritos.idJogo = jogos.idJogo

        WHERE favoritos.idUsuario = $idUsuario";


if ($busca != "") {

    $sql .= " AND (
                jogos.nomeJogo LIKE '%$buscaSegura%'
                OR jogos.categoriaJogo LIKE '%$buscaSegura%'
              )";
}


$sql .= " ORDER BY favoritos.dataFavorito DESC";


$resultado = mysqli_query($conn, $sql);

?>


<?php include "header.php"; ?>


<style>

body {
    background: #07111a;
    color: white;
}

.favoritos-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 50px 20px;
}


/* =========================
   TÍTULO
========================= */

.titulo-favoritos {
    text-align: center;
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 10px;
}

.subtitulo-favoritos {
    text-align: center;
    color: #b8c7d1;
    margin-bottom: 35px;
}


/* =========================
   PESQUISA
========================= */

.caixa-busca {
    max-width: 700px;
    margin: 0 auto 40px;
}

.caixa-busca form {
    display: flex;
    gap: 10px;
}

.caixa-busca input {
    flex: 1;
    background: #172531;
    border: 1px solid #2a475e;
    color: white;
    padding: 13px 15px;
    border-radius: 6px;
}

.caixa-busca input::placeholder {
    color: #9aaab5;
}

.btn-buscar {
    background: #2a475e;
    color: white;
    border: none;
    padding: 13px 22px;
    border-radius: 6px;
    cursor: pointer;
}

.btn-buscar:hover {
    background: #3b617d;
}


/* =========================
   GRID
========================= */

.lista-favoritos {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}


/* =========================
   CARD
========================= */

.card-favorito {
    background: #0f1922;
    border: 1px solid #2a475e;
    border-radius: 10px;
    overflow: hidden;
    transition: 0.2s;
}

.card-favorito:hover {
    transform: translateY(-4px);
    border-color: #3b617d;
}

.imagem-jogo {
    width: 100%;
    height: 220px;
    object-fit: contain;
    background: #000;
    display: block;
}

.info-favorito {
    padding: 20px;
}

.nome-jogo {
    font-size: 21px;
    font-weight: bold;
    margin-bottom: 8px;
}

.categoria {
    display: inline-block;
    background: #2a475e;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 13px;
    margin-bottom: 12px;
}

.descricao {
    color: #b8c7d1;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 15px;
}

.preco {
    border-top: 1px solid #263746;
    padding-top: 12px;
    margin-bottom: 15px;
    color: white;
    font-weight: bold;
}


/* =========================
   BOTÕES
========================= */

.botoes {
    display: flex;
    gap: 10px;
}

.btn-jogo {
    flex: 1;
    text-align: center;
    text-decoration: none;
    padding: 10px;
    border-radius: 6px;
    background: #2a475e;
    color: white;
}

.btn-jogo:hover {
    background: #3b617d;
    color: white;
}

.btn-remover {
    flex: 1;
    text-align: center;
    text-decoration: none;
    padding: 10px;
    border-radius: 6px;
    background: #333d44;
    color: white;
}

.btn-remover:hover {
    background: #46525a;
    color: white;
}


/* =========================
   VAZIO
========================= */

.mensagem-vazia {
    max-width: 700px;
    margin: 30px auto;
    text-align: center;
    background: #0f1922;
    border: 1px solid #2a475e;
    border-radius: 10px;
    padding: 40px 20px;
}

.mensagem-vazia h3 {
    margin-bottom: 10px;
}

.mensagem-vazia p {
    color: #aebbc4;
}


/* =========================
   VOLTAR
========================= */

.voltar {
    display: inline-block;
    margin-bottom: 25px;
    color: white;
    text-decoration: none;
}

.voltar:hover {
    color: #b8d7e8;
}


/* =========================
   RESPONSIVO
========================= */

@media (max-width: 600px) {

    .titulo-favoritos {
        font-size: 28px;
    }

    .caixa-busca form {
        flex-direction: column;
    }

    .btn-buscar {
        width: 100%;
    }

    .botoes {
        flex-direction: column;
    }

}

</style>


<div class="favoritos-container">

    <a href="index.php" class="voltar">
        ← Voltar para o início
    </a>


    <h1 class="titulo-favoritos">
        ⭐ Meus Favoritos
    </h1>

    <p class="subtitulo-favoritos">
        Aqui estão os jogos que você marcou como favoritos.
    </p>


    <!-- =========================
         PESQUISA
    ========================== -->

    <div class="caixa-busca">

        <form method="GET" action="favoritos.php">

            <input
                type="text"
                name="busca"
                placeholder="Pesquisar jogo..."
                value="<?php echo htmlspecialchars($busca); ?>"
            >

            <button type="submit" class="btn-buscar">
                🔎 Buscar
            </button>

        </form>

    </div>


    <!-- =========================
         FAVORITOS
    ========================== -->

    <?php if ($resultado && mysqli_num_rows($resultado) > 0) { ?>

        <div class="lista-favoritos">

            <?php while ($jogo = mysqli_fetch_assoc($resultado)) { ?>

                <div class="card-favorito">

                    <img
                        src="<?php echo htmlspecialchars($jogo["imagemJogo"]); ?>"
                        alt="<?php echo htmlspecialchars($jogo["nomeJogo"]); ?>"
                        class="imagem-jogo"
                    >


                    <div class="info-favorito">

                        <div class="nome-jogo">
                            <?php echo htmlspecialchars($jogo["nomeJogo"]); ?>
                        </div>


                        <span class="categoria">
                            <?php echo htmlspecialchars($jogo["categoriaJogo"]); ?>
                        </span>


                        <div class="descricao">
                            <?php echo htmlspecialchars($jogo["descricaoJogo"]); ?>
                        </div>


                        <div class="preco">

                            💰 R$

                            <?php
                            echo number_format(
                                $jogo["precoJogo"],
                                2,
                                ",",
                                "."
                            );
                            ?>

                        </div>


                        <div class="botoes">

                            <a
                                href="visualizarJogo.php?id=<?php echo intval($jogo["idJogo"]); ?>"
                                class="btn-jogo"
                            >
                                🎮 Ver Jogo
                            </a>


                            <a
                                href="favoritos.php?remover=<?php echo intval($jogo["idJogo"]); ?>"
                                class="btn-remover"
                                onclick="return confirm('Tem certeza que deseja remover este jogo dos favoritos?');"
                            >
                                ❌ Remover
                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="mensagem-vazia">

            <h3>
                ⭐ Você ainda não possui favoritos.
            </h3>

            <p>
                Quando você favoritar um jogo, ele aparecerá aqui.
            </p>

            <a
                href="loja.php"
                class="btn-jogo"
                style="display:inline-block; margin-top:15px; max-width:180px;"
            >
                🎮 Ir para a Loja
            </a>

        </div>

    <?php } ?>

</div>


<?php include "footer.php"; ?>