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
   ADICIONAR AMIGO
========================= */

if (isset($_GET["adicionar"]) && is_numeric($_GET["adicionar"])) {

    $idAmigo = intval($_GET["adicionar"]);

    // Não pode adicionar a si mesmo
    if ($idAmigo != $idUsuario) {

        // Verifica se o usuário existe
        $sqlUsuario = "SELECT idUsuario
                       FROM usuarios
                       WHERE idUsuario = $idAmigo
                       LIMIT 1";

        $resultadoUsuario = mysqli_query($conn, $sqlUsuario);

        if ($resultadoUsuario && mysqli_num_rows($resultadoUsuario) > 0) {

            // Verifica se já existe amizade
            $sqlVerifica = "SELECT idAmizade
                            FROM amigos
                            WHERE idUsuario = $idUsuario
                            AND idAmigo = $idAmigo
                            LIMIT 1";

            $resultadoVerifica = mysqli_query($conn, $sqlVerifica);

            if ($resultadoVerifica && mysqli_num_rows($resultadoVerifica) == 0) {

                $sqlAdicionar = "INSERT INTO amigos
                                 (idUsuario, idAmigo)
                                 VALUES
                                 ($idUsuario, $idAmigo)";

                mysqli_query($conn, $sqlAdicionar);
            }
        }
    }

    header("Location: amigos.php");
    exit();
}


/* =========================
   REMOVER AMIGO
========================= */

if (isset($_GET["remover"]) && is_numeric($_GET["remover"])) {

    $idAmigo = intval($_GET["remover"]);

    $sqlRemover = "DELETE FROM amigos
                   WHERE idUsuario = $idUsuario
                   AND idAmigo = $idAmigo";

    mysqli_query($conn, $sqlRemover);

    header("Location: amigos.php");
    exit();
}


/* =========================
   BUSCA
========================= */

$busca = "";

if (isset($_GET["busca"])) {
    $busca = trim($_GET["busca"]);
}


/* =========================
   LISTA DE AMIGOS
========================= */

$sqlAmigos = "SELECT 
                usuarios.idUsuario,
                usuarios.nomeUsuario,
                usuarios.emailUsuario
              FROM amigos
              INNER JOIN usuarios
                  ON amigos.idAmigo = usuarios.idUsuario
              WHERE amigos.idUsuario = $idUsuario
              ORDER BY usuarios.nomeUsuario ASC";

$resultadoAmigos = mysqli_query($conn, $sqlAmigos);


/* =========================
   PESQUISA DE USUÁRIOS
========================= */

$resultadoBusca = false;

if ($busca != "") {

    $buscaSegura = mysqli_real_escape_string($conn, $busca);

    $sqlBusca = "SELECT
                    idUsuario,
                    nomeUsuario,
                    emailUsuario
                 FROM usuarios
                 WHERE idUsuario != $idUsuario
                 AND (
                     nomeUsuario LIKE '%$buscaSegura%'
                     OR emailUsuario LIKE '%$buscaSegura%'
                 )
                 ORDER BY nomeUsuario ASC";

    $resultadoBusca = mysqli_query($conn, $sqlBusca);
}

include "header.php";

?>

<style>

body {
    background: #07111a;
    color: white;
}

.amigos-container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 50px 20px;
}

.titulo-amigos {
    text-align: center;
    margin-bottom: 10px;
    font-size: 36px;
    font-weight: bold;
}

.subtitulo-amigos {
    text-align: center;
    color: #b8c7d1;
    margin-bottom: 35px;
}

.caixa-busca {
    background: #0f1922;
    border: 1px solid #2a475e;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 35px;
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
    padding: 12px 15px;
    border-radius: 6px;
}

.caixa-busca input::placeholder {
    color: #9aaab5;
}

.btn-buscar {
    background: #2a475e;
    color: white;
    border: none;
    padding: 12px 22px;
    border-radius: 6px;
    cursor: pointer;
}

.btn-buscar:hover {
    background: #3b617d;
}

.secao-titulo {
    font-size: 25px;
    margin-bottom: 20px;
}

.lista-usuarios {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}

.card-usuario {
    background: #0f1922;
    border: 1px solid #2a475e;
    border-radius: 10px;
    padding: 20px;
}

.usuario-icon {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: #2a475e;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
    margin-bottom: 15px;
}

.nome-usuario {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 6px;
}

.email-usuario {
    color: #aebbc4;
    font-size: 14px;
    margin-bottom: 18px;
}

.btn-amigo {
    display: inline-block;
    text-decoration: none;
    padding: 9px 15px;
    border-radius: 6px;
    font-size: 14px;
}

.btn-adicionar {
    background: #2a475e;
    color: white;
}

.btn-adicionar:hover {
    background: #3b617d;
    color: white;
}

.btn-remover {
    background: #333d44;
    color: white;
}

.btn-remover:hover {
    background: #46525a;
    color: white;
}

.mensagem-vazia {
    background: #0f1922;
    border: 1px solid #2a475e;
    border-radius: 10px;
    padding: 30px;
    text-align: center;
    color: #aebbc4;
}

.resultado-busca {
    margin-bottom: 35px;
}

.voltar {
    display: inline-block;
    margin-bottom: 25px;
    color: white;
    text-decoration: none;
}

.voltar:hover {
    color: #b8d7e8;
}

@media (max-width: 600px) {

    .titulo-amigos {
        font-size: 28px;
    }

    .caixa-busca form {
        flex-direction: column;
    }

    .btn-buscar {
        width: 100%;
    }

}

</style>


<div class="amigos-container">

    <a href="index.php" class="voltar">
        ← Voltar para o início
    </a>

    <h1 class="titulo-amigos">
        👥 Meus Amigos
    </h1>

    <p class="subtitulo-amigos">
        Encontre outros jogadores e adicione seus amigos na MAETS.
    </p>


    <!-- =========================
         PESQUISA
    ========================== -->

    <div class="caixa-busca">

        <form method="GET" action="amigos.php">

            <input
                type="text"
                name="busca"
                placeholder="Pesquisar usuário..."
                value="<?php echo htmlspecialchars($busca); ?>"
            >

            <button type="submit" class="btn-buscar">
                🔎 Buscar
            </button>

        </form>

    </div>


    <!-- =========================
         RESULTADOS DA BUSCA
    ========================== -->

    <?php if ($busca != "") { ?>

        <div class="resultado-busca">

            <h2 class="secao-titulo">
                Resultados da pesquisa
            </h2>

            <?php if ($resultadoBusca && mysqli_num_rows($resultadoBusca) > 0) { ?>

                <div class="lista-usuarios">

                    <?php while ($usuario = mysqli_fetch_assoc($resultadoBusca)) { ?>

                        <?php

                        $idEncontrado = intval($usuario["idUsuario"]);

                        $sqlJaAmigo = "SELECT idAmizade
                                       FROM amigos
                                       WHERE idUsuario = $idUsuario
                                       AND idAmigo = $idEncontrado
                                       LIMIT 1";

                        $resultadoJaAmigo = mysqli_query($conn, $sqlJaAmigo);

                        $jaAmigo = false;

                        if ($resultadoJaAmigo && mysqli_num_rows($resultadoJaAmigo) > 0) {
                            $jaAmigo = true;
                        }

                        ?>

                        <div class="card-usuario">

                            <div class="usuario-icon">
                                👤
                            </div>

                            <div class="nome-usuario">
                                <?php echo htmlspecialchars($usuario["nomeUsuario"]); ?>
                            </div>

                            <div class="email-usuario">
                                <?php echo htmlspecialchars($usuario["emailUsuario"]); ?>
                            </div>

                            <?php if ($jaAmigo) { ?>

                                <span class="btn-amigo btn-remover">
                                    ✓ Já é seu amigo
                                </span>

                            <?php } else { ?>

                                <a
                                    href="amigos.php?adicionar=<?php echo $idEncontrado; ?>"
                                    class="btn-amigo btn-adicionar"
                                >
                                    ➕ Adicionar amigo
                                </a>

                            <?php } ?>

                        </div>

                    <?php } ?>

                </div>

            <?php } else { ?>

                <div class="mensagem-vazia">
                    Nenhum usuário encontrado.
                </div>

            <?php } ?>

        </div>

    <?php } ?>


    <!-- =========================
         MEUS AMIGOS
    ========================== -->

    <h2 class="secao-titulo">
        Meus amigos
    </h2>


    <?php if ($resultadoAmigos && mysqli_num_rows($resultadoAmigos) > 0) { ?>

        <div class="lista-usuarios">

            <?php while ($amigo = mysqli_fetch_assoc($resultadoAmigos)) { ?>

                <div class="card-usuario">

                    <div class="usuario-icon">
                        👤
                    </div>

                    <div class="nome-usuario">
                        <?php echo htmlspecialchars($amigo["nomeUsuario"]); ?>
                    </div>

                    <div class="email-usuario">
                        <?php echo htmlspecialchars($amigo["emailUsuario"]); ?>
                    </div>

                    <a
                        href="amigos.php?remover=<?php echo intval($amigo["idUsuario"]); ?>"
                        class="btn-amigo btn-remover"
                        onclick="return confirm('Tem certeza que deseja remover este amigo?');"
                    >
                        ❌ Remover amigo
                    </a>

                </div>

            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="mensagem-vazia">

            <h3>Você ainda não possui amigos.</h3>

            <p>
                Pesquise por outros usuários acima para começar a adicionar amigos.
            </p>

        </div>

    <?php } ?>

</div>


<?php include "footer.php"; ?>