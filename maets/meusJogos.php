<?php

session_start();

include "conexaoBD.php";

// Verifica se está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: formLogin.php");
    exit();
}

$idUsuario = intval($_SESSION['idUsuario']);


// Busca os jogos salvos pelo usuário
$sql = "SELECT jogos.*
        FROM jogos_salvos
        INNER JOIN jogos
        ON jogos_salvos.idJogo = jogos.idJogo
        WHERE jogos_salvos.idUsuario = $idUsuario
        ORDER BY jogos_salvos.dataSalvo DESC";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    die("Erro ao buscar seus jogos: " . mysqli_error($conn));
}

?>

<?php include "header.php"; ?>


<div class="container py-5">

    <a href="index.php" class="btn btn-outline-secondary mb-4">
        ← Voltar para o início
    </a>


    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Meus Jogos
        </h2>

        <p class="text-muted">
            Jogos que você salvou no MAETS.
        </p>

    </div>


    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

        <?php if (mysqli_num_rows($resultado) > 0) { ?>

            <?php while ($jogo = mysqli_fetch_assoc($resultado)) { ?>

                <div class="col">

                    <div class="card h-100 shadow-sm">

                        <img
                            src="<?php echo htmlspecialchars($jogo['imagemJogo']); ?>"
                            class="card-img-top"
                            style="height: 280px; object-fit: cover; object-position: center;"
                            alt="<?php echo htmlspecialchars($jogo['nomeJogo']); ?>"
                        >


                        <div class="card-body d-flex flex-column justify-content-between">

                            <div>

                                <h5 class="card-title fw-bold">
                                    <?php echo htmlspecialchars($jogo['nomeJogo']); ?>
                                </h5>


                                <p class="card-text text-muted small">
                                    <?php echo htmlspecialchars($jogo['descricaoJogo']); ?>
                                </p>


                                <span class="badge bg-secondary mb-2">
                                    <?php echo htmlspecialchars($jogo['categoriaJogo']); ?>
                                </span>

                            </div>


                            <div>

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

            <?php } ?>

        <?php } else { ?>

            <div class="col-12">

                <div class="alert alert-secondary text-center">

                    Você ainda não salvou nenhum jogo.

                </div>

            </div>

        <?php } ?>

    </div>

</div>


<?php include "footer.php"; ?>