<?php include "header.php"; ?>

<?php

include "conexaoBD.php";


// ======================================
// PEGAR ID DA PROMOÇÃO
// ======================================

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: promocoes.php");
    exit;

}

$id = intval($_GET["id"]);


// ======================================
// BUSCAR PROMOÇÃO
// ======================================

$sql = "SELECT *
        FROM promocoes
        WHERE id_Promocoes = $id
        LIMIT 1";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {

    die("Erro ao buscar promoção: " . mysqli_error($conn));

}


if (mysqli_num_rows($resultado) == 0) {

    echo "
        <div class='container my-5'>
            <div class='alert alert-danger text-center'>
                Promoção não encontrada.
            </div>
        </div>
    ";

    include "footer.php";
    exit;

}


$jogo = mysqli_fetch_assoc($resultado);


// ======================================
// DESCONTO
// ======================================

$desconto = 0;

if (
    !empty($jogo["precoOriginalPromocoes"]) &&
    $jogo["precoOriginalPromocoes"] > 0 &&
    $jogo["precoPromocoes"] < $jogo["precoOriginalPromocoes"]
) {

    $desconto = (
        (
            $jogo["precoOriginalPromocoes"]
            -
            $jogo["precoPromocoes"]
        )
        /
        $jogo["precoOriginalPromocoes"]
    ) * 100;

}

?>

<div class="container my-4 text-white">

    <!-- VOLTAR -->
    <a
        href="promocoes.php"
        class="btn btn-outline-secondary mb-3"
    >
        &leftarrow; Voltar para as Promoções
    </a>


    <!-- CONTEÚDO -->
    <div
        class="row p-4 rounded shadow-lg"
        style="
            background-color:#0f1922;
            border:1px solid #2a475e;
        "
    >


        <!-- IMAGENS -->
        <div class="col-md-7 mb-3 mb-md-0">


            <!-- CAROUSEL -->
            <div
                id="carouselPromocao"
                class="carousel slide rounded overflow-hidden shadow mb-2"
                data-bs-ride="carousel"
            >

                <div class="carousel-inner">


                    <!-- CAPA -->
                    <div class="carousel-item active">

                        <img
                            src="<?php echo htmlspecialchars($jogo["capaPromocoes"]); ?>"
                            class="d-block w-100"
                            style="
                                height:380px;
                                object-fit:cover;
                            "
                            alt="Capa do jogo"
                        >

                    </div>


                    <!-- GAMEPLAY 1 -->
                    <div class="carousel-item">

                        <img
                            src="<?php echo htmlspecialchars($jogo["gameplay1Promocoes"]); ?>"
                            class="d-block w-100"
                            style="
                                height:380px;
                                object-fit:cover;
                            "
                            alt="Gameplay 1"
                        >

                    </div>


                    <!-- GAMEPLAY 2 -->
                    <div class="carousel-item">

                        <img
                            src="<?php echo htmlspecialchars($jogo["gameplay2Promocoes"]); ?>"
                            class="d-block w-100"
                            style="
                                height:380px;
                                object-fit:cover;
                            "
                            alt="Gameplay 2"
                        >

                    </div>


                    <!-- GAMEPLAY 3 -->
                    <div class="carousel-item">

                        <img
                            src="<?php echo htmlspecialchars($jogo["gameplay3Promocoes"]); ?>"
                            class="d-block w-100"
                            style="
                                height:380px;
                                object-fit:cover;
                            "
                            alt="Gameplay 3"
                        >

                    </div>

                </div>


                <!-- ANTERIOR -->
                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carouselPromocao"
                    data-bs-slide="prev"
                >

                    <span class="carousel-control-prev-icon"></span>

                    <span class="visually-hidden">
                        Anterior
                    </span>

                </button>


                <!-- PRÓXIMO -->
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#carouselPromocao"
                    data-bs-slide="next"
                >

                    <span class="carousel-control-next-icon"></span>

                    <span class="visually-hidden">
                        Próximo
                    </span>

                </button>

            </div>

        </div>


        <!-- INFORMAÇÕES -->
        <div class="col-md-5">

            <!-- NOME -->
            <h1 class="fw-bold">

                <?php
                echo htmlspecialchars(
                    $jogo["nomePromocoes"]
                );
                ?>

            </h1>


            <!-- CATEGORIA -->
            <span class="badge bg-secondary mb-3">

                <?php
                echo htmlspecialchars(
                    $jogo["categoriaPromocoes"]
                );
                ?>

            </span>


            <!-- DESCRIÇÃO -->
            <p class="text-white">

                <?php
                echo nl2br(
                    htmlspecialchars(
                        $jogo["descricaoPromocoes"]
                    )
                );
                ?>

            </p>


            <hr>


            <!-- PREÇOS -->
            <div class="mb-3">

                <?php if (
                    !empty($jogo["precoOriginalPromocoes"]) &&
                    $jogo["precoOriginalPromocoes"] > $jogo["precoPromocoes"]
                ): ?>

                    <div>

                        <span class="text-muted text-decoration-line-through">

                            R$

                            <?php
                            echo number_format(
                                $jogo["precoOriginalPromocoes"],
                                2,
                                ",",
                                "."
                            );
                            ?>

                        </span>

                    </div>

                <?php endif; ?>


                <div>

                    <span class="text-success fw-bold fs-2">

                        R$

                        <?php
                        echo number_format(
                            $jogo["precoPromocoes"],
                            2,
                            ",",
                            "."
                        );
                        ?>

                    </span>

                </div>


                <?php if ($desconto > 0): ?>

                    <span class="badge bg-danger">

                        <?php echo round($desconto); ?>% OFF

                    </span>

                <?php endif; ?>

            </div>


            <!-- COMPRAR -->
            <a
                href="<?php echo htmlspecialchars($jogo["paginaPromocoes"]); ?>"
                target="_blank"
                class="btn btn-success w-100 mb-3"
            >
                Comprar jogo
            </a>


        </div>

    </div>

</div>


<?php include "footer.php"; ?>