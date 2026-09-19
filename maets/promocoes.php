<?php include "header.php"; ?>

<?php

// ======================================
// CONEXÃO COM O BANCO DE DADOS
// ======================================

include "conexaoBD.php";


// ======================================
// BUSCAR AS PROMOÇÕES DO BANCO
// ======================================

$sql = "SELECT 
            id_Promocoes,
            nomePromocoes,
            descricaoPromocoes,
            categoriaPromocoes,
            precoPromocoes,
            precoOriginalPromocoes,
            capaPromocoes,
            paginaPromocoes
        FROM promocoes
        ORDER BY id_Promocoes DESC";

$resultado = mysqli_query($conn, $sql);


// ======================================
// VERIFICAR ERRO NA CONSULTA
// ======================================

if (!$resultado) {
    die("Erro ao buscar promoções: " . mysqli_error($conn));
}

?>

<div class="container my-5">

    <!-- TÍTULO -->
    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Jogos em Promoção
        </h2>

        <p class="text-muted">
            Aproveite nossas ofertas e economize na compra dos seus jogos favoritos.
        </p>

    </div>


    <!-- JOGOS -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

        <?php if (mysqli_num_rows($resultado) > 0): ?>

            <?php while ($jogo = mysqli_fetch_assoc($resultado)): ?>

                <?php

                // ======================================
                // CALCULAR DESCONTO
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


                <!-- CARD DO JOGO -->
                <div class="col">

                    <div class="card h-100 shadow-sm">


                        <!-- CAPA -->
                        <img
                            src="<?php echo htmlspecialchars($jogo["capaPromocoes"]); ?>"
                            class="card-img-top"
                            style="
                                height: 280px;
                                object-fit: cover;
                                object-position: center;
                            "
                            alt="<?php echo htmlspecialchars($jogo["nomePromocoes"]); ?>"
                        >


                        <!-- CONTEÚDO -->
                        <div class="card-body d-flex flex-column justify-content-between">

                            <div>

                                <!-- NOME -->
                                <h5 class="card-title fw-bold">

                                    <?php
                                    echo htmlspecialchars(
                                        $jogo["nomePromocoes"]
                                    );
                                    ?>

                                </h5>


                                <!-- DESCRIÇÃO -->
                                <p class="card-text text-muted small">

                                    <?php
                                    echo htmlspecialchars(
                                        $jogo["descricaoPromocoes"]
                                    );
                                    ?>

                                </p>

                            </div>


                            <div>

                                <!-- PREÇOS -->
                                <div class="mb-3">

                                    <?php if (
                                        !empty($jogo["precoOriginalPromocoes"]) &&
                                        $jogo["precoOriginalPromocoes"] > $jogo["precoPromocoes"]
                                    ): ?>

                                        <!-- PREÇO ORIGINAL -->
                                        <span class="text-muted text-decoration-line-through me-2">

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

                                    <?php endif; ?>


                                    <!-- PREÇO PROMOCIONAL -->
                                    <span class="fw-bold text-success fs-5">

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


                                <!-- DESCONTO -->
                                <?php if ($desconto > 0): ?>

                                    <span class="badge bg-danger mb-3">

                                        <?php
                                        echo round($desconto);
                                        ?>% OFF

                                    </span>

                                <?php endif; ?>


                                <!-- BOTÃO -->
                          <a
                                href="visualizarPromocao.php?id=<?php echo $jogo['id_Promocoes']; ?>"
                                class="btn btn-dark w-100"
                            >
                                Ver jogo
                          </a>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endwhile; ?>


        <?php else: ?>

            <!-- CASO NÃO TENHA PROMOÇÕES -->

            <div class="col-12">

                <div class="alert alert-secondary text-center">

                    Nenhum jogo em promoção no momento.

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>


<?php include "footer.php"; ?>