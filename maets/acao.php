<?php include "header.php"; ?>
<?php include "conexaoBD.php"; ?>

<style>

    .btn-voltar {
        color: #8a9aaa;
        border: 1px solid #71808f;
        background: transparent;
        padding: 8px 14px;
        border-radius: 6px;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-voltar:hover {
        color: white;
        border-color: white;
        background: rgba(255,255,255,0.05);
    }

</style>

<div class="container py-5">

    <!-- Botão voltar -->
    <a href="index.php" class="btn-voltar mb-4 d-inline-block">
        ← Voltar para o início
    </a>

    <!-- Título -->
    <div class="text-center mb-5">

        <h1 class="text-white fw-bold">
            Jogos de Ação
        </h1>

        <p class="text-secondary">
            Aventuras intensas e grandes desafios.
        </p>

    </div>

    <?php

    // Busca somente os jogos da categoria Ação
    $sql = "SELECT * FROM jogos 
            WHERE categoriaJogo = 'Ação'
            ORDER BY idJogo DESC";

    $resultado = mysqli_query($conn, $sql);

    // Verifica se houve erro na consulta
    if (!$resultado) {
        die("Erro ao consultar os jogos: " . mysqli_error($conn));
    }

    ?>

    <!-- Jogos -->
    <div class="row g-4">

        <?php

        if (mysqli_num_rows($resultado) > 0) {

            while ($jogo = mysqli_fetch_assoc($resultado)) {

        ?>

                <div class="col-md-6 col-lg-3">

                    <div class="card h-100 shadow">

                        <!-- Imagem -->
                        <img
                            src="<?php echo htmlspecialchars($jogo['imagemJogo']); ?>"
                            class="card-img-top"
                            style="height:280px; object-fit:contain; background:#000;"
                            alt="<?php echo htmlspecialchars($jogo['nomeJogo']); ?>"
                        >

                        <div class="card-body">

                            <!-- Nome -->
                            <h5 class="card-title">
                                <?php echo htmlspecialchars($jogo['nomeJogo']); ?>
                            </h5>

                            <!-- Categoria -->
                            <p class="card-text">
                                <?php echo htmlspecialchars($jogo['categoriaJogo']); ?>
                            </p>

                            <!-- Preço -->
                            <p class="fw-bold text-success">
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

        <?php

            }

        } else {

        ?>

            <div class="col-12">

                <div class="alert alert-secondary text-center">
                    Nenhum jogo de Ação cadastrado.
                </div>

            </div>

        <?php

        }

        ?>

    </div>

</div>

<?php include "footer.php"; ?>