<?php

include "header.php";
include "conexaoBD.php";


// =========================================================
// VERIFICA SE O ID DO JOGO FOI INFORMADO
// =========================================================

if(!isset($_GET["id"]) || !is_numeric($_GET["id"])){

    echo "
    <div class='container my-4'>
        <div class='alert alert-warning text-center'>
            Jogo não encontrado!
        </div>
    </div>
    ";

    include "footer.php";
    exit;
}


// =========================================================
// PEGA O ID DO JOGO
// =========================================================

$idJogo = intval($_GET["id"]);


// =========================================================
// BUSCA O JOGO NO BANCO
// =========================================================

$consultaJogo = "
    SELECT *
    FROM jogos
    WHERE idJogo = $idJogo
";

$resultadoJogo = mysqli_query($conn, $consultaJogo);


// =========================================================
// VERIFICA SE ENCONTROU
// =========================================================

if(!$resultadoJogo || mysqli_num_rows($resultadoJogo) == 0){

    echo "
    <div class='container my-4'>
        <div class='alert alert-warning text-center'>
            O jogo solicitado não foi encontrado!
        </div>
    </div>
    ";

    include "footer.php";
    exit;
}


// =========================================================
// PEGA OS DADOS
// =========================================================

$jogo = mysqli_fetch_assoc($resultadoJogo);

$nomeJogo      = $jogo["nomeJogo"];
$descricaoJogo = $jogo["descricaoJogo"];
$categoriaJogo = $jogo["categoriaJogo"];
$precoJogo     = $jogo["precoJogo"];

$capaJogo      = $jogo["capaJogo"];
$gameplay1Jogo = $jogo["gameplay1Jogo"];
$gameplay2Jogo = $jogo["gameplay2Jogo"];
$gameplay3Jogo = $jogo["gameplay3Jogo"];

$paginaJogo    = $jogo["paginaJogo"];

?>



<div class="container my-4 text-white">


    <!-- ================================================= -->
    <!-- BOTÃO VOLTAR -->
    <!-- ================================================= -->

    <a href="index.php"
       class="btn btn-outline-secondary mb-3">

        &leftarrow; Voltar para os Jogos em Destaque

    </a>



    <!-- ================================================= -->
    <!-- CAIXA PRINCIPAL -->
    <!-- ================================================= -->

    <div class="row p-4 rounded shadow-lg"
         style="
            background-color:#0f1922;
            border:1px solid #2a475e;
         ">


        <!-- ================================================= -->
        <!-- LADO ESQUERDO -->
        <!-- ================================================= -->

        <div class="col-md-7 mb-3 mb-md-0">


            <!-- ================================================= -->
            <!-- CARROSSEL -->
            <!-- ================================================= -->

            <div id="carouselJogo"
                 class="carousel slide rounded overflow-hidden shadow mb-2"
                 data-bs-ride="false">


                <div class="carousel-inner">


                    <!-- GAMEPLAY 1 -->

                    <div class="carousel-item active">

                        <img
                            src="<?php echo htmlspecialchars($gameplay1Jogo); ?>"
                            class="d-block w-100"
                            style="
                                height:380px;
                                object-fit:cover;
                            "
                            alt="<?php echo htmlspecialchars($nomeJogo); ?> - Gameplay 1"
                        >

                    </div>



                    <!-- GAMEPLAY 2 -->

                    <div class="carousel-item">

                        <img
                            src="<?php echo htmlspecialchars($gameplay2Jogo); ?>"
                            class="d-block w-100"
                            style="
                                height:380px;
                                object-fit:cover;
                            "
                            alt="<?php echo htmlspecialchars($nomeJogo); ?> - Gameplay 2"
                        >

                    </div>



                    <!-- GAMEPLAY 3 -->

                    <div class="carousel-item">

                        <img
                            src="<?php echo htmlspecialchars($gameplay3Jogo); ?>"
                            class="d-block w-100"
                            style="
                                height:380px;
                                object-fit:cover;
                            "
                            alt="<?php echo htmlspecialchars($nomeJogo); ?> - Gameplay 3"
                        >

                    </div>


                </div>



                <!-- SETA ESQUERDA -->

                <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#carouselJogo"
                        data-bs-slide="prev">

                    <span class="carousel-control-prev-icon"></span>

                    <span class="visually-hidden">
                        Anterior
                    </span>

                </button>



                <!-- SETA DIREITA -->

                <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#carouselJogo"
                        data-bs-slide="next">

                    <span class="carousel-control-next-icon"></span>

                    <span class="visually-hidden">
                        Próximo
                    </span>

                </button>


            </div>



            <!-- ================================================= -->
            <!-- MINIATURAS -->
            <!-- ================================================= -->

            <div class="d-flex gap-2">


                <!-- GAMEPLAY 1 -->

                <button
                    type="button"
                    data-bs-target="#carouselJogo"
                    data-bs-slide-to="0"
                    style="
                        width:32%;
                        height:75px;
                        padding:2px;
                        background:none;
                        border:2px solid #ffffff;
                        border-radius:5px;
                        overflow:hidden;
                    "
                >

                    <img
                        src="<?php echo htmlspecialchars($gameplay1Jogo); ?>"
                        style="
                            width:100%;
                            height:100%;
                            object-fit:cover;
                        "
                        alt="Gameplay 1"
                    >

                </button>



                <!-- GAMEPLAY 2 -->

                <button
                    type="button"
                    data-bs-target="#carouselJogo"
                    data-bs-slide-to="1"
                    style="
                        width:32%;
                        height:75px;
                        padding:2px;
                        background:none;
                        border:2px solid #526777;
                        border-radius:5px;
                        overflow:hidden;
                    "
                >

                    <img
                        src="<?php echo htmlspecialchars($gameplay2Jogo); ?>"
                        style="
                            width:100%;
                            height:100%;
                            object-fit:cover;
                        "
                        alt="Gameplay 2"
                    >

                </button>



                <!-- GAMEPLAY 3 -->

                <button
                    type="button"
                    data-bs-target="#carouselJogo"
                    data-bs-slide-to="2"
                    style="
                        width:32%;
                        height:75px;
                        padding:2px;
                        background:none;
                        border:2px solid #526777;
                        border-radius:5px;
                        overflow:hidden;
                    "
                >

                    <img
                        src="<?php echo htmlspecialchars($gameplay3Jogo); ?>"
                        style="
                            width:100%;
                            height:100%;
                            object-fit:cover;
                        "
                        alt="Gameplay 3"
                    >

                </button>


            </div>


        </div>



        <!-- ================================================= -->
        <!-- LADO DIREITO -->
        <!-- ================================================= -->

        <div class="col-md-5 d-flex flex-column justify-content-between">


            <div>


                <!-- NOME -->

                <h1 class="fw-bold text-white mb-2">

                    <?php echo htmlspecialchars($nomeJogo); ?>

                </h1>



                <!-- CATEGORIA -->

                <span class="badge bg-secondary mb-3">

                    <?php echo htmlspecialchars($categoriaJogo); ?>

                </span>



                <!-- DESCRIÇÃO -->

                <p class="text-secondary mt-1 mb-3">

                    <?php echo nl2br(htmlspecialchars($descricaoJogo)); ?>

                </p>



                <!-- FICHA TÉCNICA -->

                <div
                    class="p-3 rounded my-3"
                    style="
                        background-color:#121e2b;
                        border:1px solid #1e3548;
                        font-size:0.9rem;
                    "
                >

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-secondary">
                            Categoria:
                        </span>

                        <span class="text-info fw-bold">

                            <?php echo htmlspecialchars($categoriaJogo); ?>

                        </span>

                    </div>


                    <div class="d-flex justify-content-between">

                        <span class="text-secondary">
                            ID do jogo:
                        </span>

                        <span class="text-light">

                            <?php echo $idJogo; ?>

                        </span>

                    </div>

                </div>


            </div>



            <!-- ================================================= -->
            <!-- PREÇO -->
            <!-- ================================================= -->

            <div
                class="p-3 rounded d-flex justify-content-between align-items-center"
                style="
                    background-color:#000000;
                    border:1px solid #364653;
                "
            >

                <span class="fs-4 text-success fw-bold">

                    R$
                    <?php
                        echo number_format(
                            $precoJogo,
                            2,
                            ",",
                            "."
                        );
                    ?>

                </span>


                <?php if(!empty($paginaJogo)): ?>

                    <a
                        href="<?php echo htmlspecialchars($paginaJogo); ?>"
                        target="_blank"
                        class="btn btn-success fw-bold px-4 py-2"
                    >

                        Comprar Agora

                    </a>

                <?php endif; ?>


            </div>


        </div>



        <!-- ================================================= -->
        <!-- SOBRE O JOGO -->
        <!-- ================================================= -->

        <div class="col-12 mt-4 pt-3"
             style="border-top:1px solid #364653;">

            <h4 class="text-white fw-bold mb-3">

                Sobre este jogo

            </h4>


            <p
                class="text-light fs-6"
                style="line-height:1.6;"
            >

                <?php echo nl2br(htmlspecialchars($descricaoJogo)); ?>

            </p>

        </div>



        <!-- ================================================= -->
        <!-- CAPA -->
        <!-- ================================================= -->

        <div class="col-12 mt-4 pt-3"
             style="border-top:1px solid #364653;">

            <h4 class="text-white fw-bold mb-3">

                Capa do jogo

            </h4>


            <?php if(!empty($capaJogo)): ?>

                <img
                    src="<?php echo htmlspecialchars($capaJogo); ?>"
                    class="img-fluid rounded shadow"
                    style="max-width:300px;"
                    alt="Capa de <?php echo htmlspecialchars($nomeJogo); ?>"
                >

            <?php endif; ?>

        </div>



        <!-- ================================================= -->
        <!-- FOTOS DAS GAMEPLAYS -->
        <!-- ================================================= -->

        <div class="col-12 mt-4 pt-3"
             style="border-top:1px solid #364653;">

            <h4 class="text-white fw-bold mb-3">

                Imagens da Gameplay

            </h4>


            <div class="row">


                <!-- GAMEPLAY 1 -->

                <div class="col-md-4 mb-3">

                    <?php if(!empty($gameplay1Jogo)): ?>

                        <img
                            src="<?php echo htmlspecialchars($gameplay1Jogo); ?>"
                            class="img-fluid rounded shadow"
                            style="
                                width:100%;
                                height:220px;
                                object-fit:cover;
                            "
                            alt="<?php echo htmlspecialchars($nomeJogo); ?> Gameplay 1"
                        >

                    <?php endif; ?>

                </div>



                <!-- GAMEPLAY 2 -->

                <div class="col-md-4 mb-3">

                    <?php if(!empty($gameplay2Jogo)): ?>

                        <img
                            src="<?php echo htmlspecialchars($gameplay2Jogo); ?>"
                            class="img-fluid rounded shadow"
                            style="
                                width:100%;
                                height:220px;
                                object-fit:cover;
                            "
                            alt="<?php echo htmlspecialchars($nomeJogo); ?> Gameplay 2"
                        >

                    <?php endif; ?>

                </div>



                <!-- GAMEPLAY 3 -->

                <div class="col-md-4 mb-3">

                    <?php if(!empty($gameplay3Jogo)): ?>

                        <img
                            src="<?php echo htmlspecialchars($gameplay3Jogo); ?>"
                            class="img-fluid rounded shadow"
                            style="
                                width:100%;
                                height:220px;
                                object-fit:cover;
                            "
                            alt="<?php echo htmlspecialchars($nomeJogo); ?> Gameplay 3"
                        >

                    <?php endif; ?>

                </div>


            </div>

        </div>


    </div>

</div>



<?php include "footer.php"; ?>