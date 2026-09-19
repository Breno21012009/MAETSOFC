<?php
include "header.php";
include "conexaoBD.php";

if (!isset($_GET["id"])) {
    die("Promoção não encontrada.");
}

$id = intval($_GET["id"]);

$sql = "SELECT * FROM promocoes WHERE id_Promocoes = $id";
$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    die("Promoção não encontrada.");
}

$jogo = mysqli_fetch_assoc($resultado);


/* =========================
   DADOS DO JOGO
========================= */

$nome = $jogo["nomePromocoes"];
$descricao = $jogo["descricaoPromocoes"];
$categoria = $jogo["categoriaPromocoes"];

$preco = $jogo["precoPromocoes"];
$precoOriginal = $jogo["precoOriginalPromocoes"];

$capa = $jogo["capaPromocoes"];

$gameplay1 = $jogo["gameplay1Promocoes"];
$gameplay2 = $jogo["gameplay2Promocoes"];
$gameplay3 = $jogo["gameplay3Promocoes"];

$pagina = $jogo["paginaPromocoes"];


/* =========================
   DESCONTO
========================= */

$desconto = 0;

if (!empty($precoOriginal) && $precoOriginal > $preco) {

    $desconto = round(
        (($precoOriginal - $preco) / $precoOriginal) * 100
    );

}

?>

<div class="container my-4 text-white">

    <!-- =========================
         BOTÃO VOLTAR
    ========================= -->

    <a href="promocoes.php"
       class="btn btn-outline-secondary mb-3">

        &leftarrow; Voltar para as Promoções

    </a>


    <!-- =========================
         CAIXA PRINCIPAL
    ========================= -->

    <div class="row p-4 rounded shadow-lg"
         style="
            background-color: #0f1922;
            border: 1px solid #2a475e;
         ">


        <!-- ================================================= -->
        <!-- LADO ESQUERDO - IMAGENS -->
        <!-- ================================================= -->

        <div class="col-md-7 mb-3 mb-md-0">


            <!-- =========================
                 CARROSSEL
            ========================= -->

            <div id="carouselPromocao"
                 class="carousel slide rounded overflow-hidden shadow mb-2"
                 data-bs-ride="false">

                <div class="carousel-inner">


                    <!-- GAMEPLAY 1 -->

                    <div class="carousel-item active">

                        <img src="<?php echo htmlspecialchars($gameplay1); ?>"
                             class="d-block w-100"
                             style="
                                height: 380px;
                                object-fit: cover;
                             "
                             alt="Gameplay 1">

                    </div>


                    <!-- GAMEPLAY 2 -->

                    <div class="carousel-item">

                        <img src="<?php echo htmlspecialchars($gameplay2); ?>"
                             class="d-block w-100"
                             style="
                                height: 380px;
                                object-fit: cover;
                             "
                             alt="Gameplay 2">

                    </div>


                    <!-- GAMEPLAY 3 -->

                    <div class="carousel-item">

                        <img src="<?php echo htmlspecialchars($gameplay3); ?>"
                             class="d-block w-100"
                             style="
                                height: 380px;
                                object-fit: cover;
                             "
                             alt="Gameplay 3">

                    </div>

                </div>


                <!-- =========================
                     SETA ESQUERDA
                ========================= -->

                <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#carouselPromocao"
                        data-bs-slide="prev">

                    <span class="carousel-control-prev-icon"></span>

                    <span class="visually-hidden">
                        Anterior
                    </span>

                </button>


                <!-- =========================
                     SETA DIREITA
                ========================= -->

                <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#carouselPromocao"
                        data-bs-slide="next">

                    <span class="carousel-control-next-icon"></span>

                    <span class="visually-hidden">
                        Próximo
                    </span>

                </button>

            </div>


            <!-- =========================
                 MINIATURAS
            ========================= -->

            <div class="d-flex gap-2">


                <!-- MINIATURA 1 -->

                <button type="button"
                        data-bs-target="#carouselPromocao"
                        data-bs-slide-to="0"
                        style="
                            width: 32%;
                            height: 75px;
                            padding: 2px;
                            background: none;
                            border: 2px solid #6c757d;
                            border-radius: 5px;
                            overflow: hidden;
                        ">

                    <img src="<?php echo htmlspecialchars($gameplay1); ?>"
                         style="
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                         "
                         alt="Gameplay 1">

                </button>


                <!-- MINIATURA 2 -->

                <button type="button"
                        data-bs-target="#carouselPromocao"
                        data-bs-slide-to="1"
                        style="
                            width: 32%;
                            height: 75px;
                            padding: 2px;
                            background: none;
                            border: 2px solid #6c757d;
                            border-radius: 5px;
                            overflow: hidden;
                        ">

                    <img src="<?php echo htmlspecialchars($gameplay2); ?>"
                         style="
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                         "
                         alt="Gameplay 2">

                </button>


                <!-- MINIATURA 3 -->

                <button type="button"
                        data-bs-target="#carouselPromocao"
                        data-bs-slide-to="2"
                        style="
                            width: 32%;
                            height: 75px;
                            padding: 2px;
                            background: none;
                            border: 2px solid #6c757d;
                            border-radius: 5px;
                            overflow: hidden;
                        ">

                    <img src="<?php echo htmlspecialchars($gameplay3); ?>"
                         style="
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                         "
                         alt="Gameplay 3">

                </button>

            </div>

        </div>


        <!-- ================================================= -->
        <!-- LADO DIREITO - INFORMAÇÕES -->
        <!-- ================================================= -->

        <div class="col-md-5">


            <!-- NOME -->

            <h1 class="fw-bold mb-2">

                <?php echo htmlspecialchars($nome); ?>

            </h1>


            <!-- CATEGORIA -->

            <span class="badge bg-secondary mb-4">

                <?php echo htmlspecialchars($categoria); ?>

            </span>


            <!-- DESCRIÇÃO -->

            <p class="text-secondary"
               style="
                    font-size: 16px;
                    line-height: 1.6;
               ">

                <?php echo nl2br(htmlspecialchars($descricao)); ?>

            </p>


            <!-- =========================
                 CAIXA DE INFORMAÇÕES
            ========================= -->

            <div class="p-3 rounded mb-4"
                 style="
                    background-color: #101820;
                    border: 1px solid #2a475e;
                 ">


                <!-- CATEGORIA -->

                <div class="d-flex justify-content-between mb-3">

                    <span class="text-secondary">

                        Categoria:

                    </span>

                    <strong class="text-info">

                        <?php echo htmlspecialchars($categoria); ?>

                    </strong>

                </div>


                <!-- ID -->

                <div class="d-flex justify-content-between">

                    <span class="text-secondary">

                        ID da promoção:

                    </span>

                    <strong>

                        <?php echo $id; ?>

                    </strong>

                </div>

            </div>


            <!-- =========================
                 PREÇO
            ========================= -->

            <div class="p-3 rounded d-flex justify-content-between align-items-center"
                 style="
                    background-color: #000;
                    border: 1px solid #2a475e;
                 ">


                <div>


                    <!-- PREÇO ORIGINAL -->

                    <?php if ($precoOriginal > 0): ?>

                        <div class="text-secondary text-decoration-line-through">

                            R$
                            <?php echo number_format(
                                $precoOriginal,
                                2,
                                ",",
                                "."
                            ); ?>

                        </div>

                    <?php endif; ?>


                    <!-- PREÇO PROMOCIONAL -->

                    <div class="fs-4 fw-bold text-success">

                        R$
                        <?php echo number_format(
                            $preco,
                            2,
                            ",",
                            "."
                        ); ?>

                    </div>


                    <!-- DESCONTO -->

                    <?php if ($desconto > 0): ?>

                        <span class="badge bg-success">

                            <?php echo $desconto; ?>% OFF

                        </span>

                    <?php endif; ?>

                </div>


                <!-- BOTÃO -->

                <?php if (!empty($pagina)): ?>

                    <a href="<?php echo htmlspecialchars($pagina); ?>"
                       target="_blank"
                       class="btn btn-success fw-bold px-4 py-3">

                        Comprar Agora

                    </a>

                <?php endif; ?>

            </div>

        </div>


        <!-- ================================================= -->
        <!-- SOBRE O JOGO -->
        <!-- ================================================= -->

        <div class="col-12 mt-4">


            <hr style="border-color: #2a475e;">


            <h2 class="fw-bold mt-3 mb-3">

                Sobre este jogo

            </h2>


            <p style="
                font-size: 16px;
                line-height: 1.7;
            ">

                <?php echo nl2br(htmlspecialchars($descricao)); ?>

            </p>

        </div>


        <!-- ================================================= -->
        <!-- CAPA DO JOGO -->
        <!-- ================================================= -->

        <div class="col-12 mt-3">


            <hr style="border-color: #2a475e;">


            <h2 class="fw-bold mt-3 mb-3">

                Capa do jogo

            </h2>


            <?php if (!empty($capa)): ?>

                <img src="<?php echo htmlspecialchars($capa); ?>"
                     class="rounded shadow"
                     style="
                        width: 300px;
                        max-height: 450px;
                        object-fit: cover;
                     "
                     alt="Capa de <?php echo htmlspecialchars($nome); ?>">

            <?php endif; ?>

        </div>

    </div>

</div>


<?php include "footer.php"; ?>