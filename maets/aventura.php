<?php include "header.php"; ?>
<?php include "conexaoBD.php"; ?>

<div class="container py-5">

    <a href="index.php" class="btn btn-outline-secondary mb-4">
        ← Voltar para o início
    </a>

    <div class="text-center mb-5">
        <h2 class="fw-bold">Jogos de Aventura</h2>
        <p class="text-muted">
            Aventuras emocionantes e grandes descobertas.
        </p>
    </div>

    <?php
    $sql = "SELECT * FROM jogos
            WHERE categoriaJogo = 'Aventura'
            ORDER BY idJogo DESC";

    $resultado = mysqli_query($conn, $sql);

    if (!$resultado) {
        die("Erro ao consultar os jogos: " . mysqli_error($conn));
    }
    ?>

    <div class="row g-4">

        <?php if (mysqli_num_rows($resultado) > 0) { ?>

            <?php while ($jogo = mysqli_fetch_assoc($resultado)) { ?>

                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 shadow-sm">

                        <img
                            src="<?php echo htmlspecialchars($jogo['imagemJogo']); ?>"
                            class="card-img-top"
                            style="height: 280px; object-fit: cover;"
                            alt="<?php echo htmlspecialchars($jogo['nomeJogo']); ?>"
                        >

                        <div class="card-body">

                            <h5 class="card-title fw-bold">
                                <?php echo htmlspecialchars($jogo['nomeJogo']); ?>
                            </h5>

                            <p class="card-text text-muted">
                                <?php echo htmlspecialchars($jogo['descricaoJogo']); ?>
                            </p>

                            <span class="badge bg-secondary mb-3">
                                <?php echo htmlspecialchars($jogo['categoriaJogo']); ?>
                            </span>

                            <p class="fw-bold text-success fs-5">
                                R$
                                <?php echo number_format($jogo['precoJogo'], 2, ',', '.'); ?>
                            </p>

                            <a
                                href="visualizarJogo.php?id=<?php echo $jogo['idJogo']; ?>"
                                class="btn btn-primary w-100"
                            >
                                Ver Jogo
                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="col-12">
                <div class="alert alert-secondary text-center">
                    Nenhum jogo de Aventura cadastrado.
                </div>
            </div>

        <?php } ?>

    </div>

</div>

<?php include "footer.php"; ?>