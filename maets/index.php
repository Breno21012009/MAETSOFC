<?php include "header.php"; ?>
<?php include "conexaoBD.php"; ?>

<?php

// Consulta todos os jogos cadastrados
$sql = "SELECT * FROM jogos ORDER BY idJogo DESC";

$resultado = mysqli_query($conn, $sql);

// Verifica se a consulta deu erro
if (!$resultado) {
    die("Erro ao consultar os jogos: " . mysqli_error($conn));
}

?>

<div class="container py-5">

    <h2 class="mb-4">Categorias</h2>

    <div class="row">

        <div class="col-md-3 mb-4">
            <a href="acao.php" class="btn btn-light w-100 py-4 fs-4 categoria-btn">
                Ação
            </a>
        </div>

        <div class="col-md-3 mb-4">
            <a href="rpg.php" class="btn btn-light w-100 py-4 fs-4 categoria-btn">
                RPG
            </a>
        </div>

        <div class="col-md-3 mb-4">
            <a href="indie.php" class="btn btn-light w-100 py-4 fs-4 categoria-btn">
                Indie
            </a>
        </div>

        <div class="col-md-3 mb-4">
            <a href="aventura.php" class="btn btn-light w-100 py-4 fs-4 categoria-btn">
                Aventura
            </a>
        </div>

    </div>


    <h2 class="mb-4">Jogos em Destaque</h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

        <?php

        if (mysqli_num_rows($resultado) > 0) {

            while ($jogo = mysqli_fetch_assoc($resultado)) {

        ?>

                <!-- Card do jogo -->
                <div class="col">

                    <div class="card h-100 shadow-sm">

                        <!-- Imagem do jogo -->
                        <img
                            src="<?php echo htmlspecialchars($jogo['imagemJogo']); ?>"
                            class="card-img-top"
                            style="height: 280px; object-fit: cover; object-position: center;"
                            alt="<?php echo htmlspecialchars($jogo['nomeJogo']); ?>"
                        >

                        <div class="card-body d-flex flex-column justify-content-between">

                            <div>

                                <!-- Nome -->
                                <h5 class="card-title fw-bold">
                                    <?php echo htmlspecialchars($jogo['nomeJogo']); ?>
                                </h5>

                                <!-- Descrição -->
                                <p class="card-text text-muted small">
                                    <?php echo htmlspecialchars($jogo['descricaoJogo']); ?>
                                </p>

                                <!-- Categoria -->
                                <span class="badge bg-secondary mb-2">
                                    <?php echo htmlspecialchars($jogo['categoriaJogo']); ?>
                                </span>

                            </div>

                            <div>

                                <!-- Preço -->
                                <p class="fw-bold text-success fs-5 mb-2">
                                    R$
                                    <?php
                                    echo number_format(
                                        $jogo['precoJogo'],
                                        2,
                                        ',',
                                        '.'
                                    );
                                    ?>
                                </p>

                                <!-- Ver jogo -->
                                <a
                                    href="visualizarJogo.php?id=<?php echo $jogo['idJogo']; ?>"
                                    class="btn btn-primary w-100"
                                >
                                    Ver Jogo
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

        <?php

            }

        } else {

        ?>

            <div class="col-12">

                <div class="alert alert-secondary text-center">
                    Nenhum jogo cadastrado.
                </div>

            </div>

        <?php

        }

        ?>

    </div>

</div>

<?php include "footer.php"; ?>