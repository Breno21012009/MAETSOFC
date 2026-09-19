<?php

// Inicia a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: formLogin.php");
    exit();
}

// ID do usuário logado
$idUsuario = intval($_SESSION['idUsuario']);

// Conexão com o banco
include "conexaoBD.php";

// Busca os jogos da biblioteca do usuário
$sql = "SELECT 
            Jogos.idJogo,
            Jogos.nomeJogo,
            Jogos.descricaoJogo,
            Jogos.categoriaJogo,
            Jogos.precoJogo,
            Jogos.capaJogo,
            Jogos.paginaJogo,
            Biblioteca.dataAdicao
        FROM Biblioteca
        INNER JOIN Jogos 
            ON Biblioteca.idJogo = Jogos.idJogo
        WHERE Biblioteca.idUsuario = $idUsuario
        ORDER BY Biblioteca.dataAdicao DESC";

$resultado = mysqli_query($conn, $sql);

// Verifica se a consulta funcionou
if (!$resultado) {

    die("
        <div style='
            background:#171a21;
            color:white;
            padding:30px;
            margin:30px;
            border:1px solid #2a475e;
            border-radius:10px;
        '>
            <h3>Erro ao carregar a biblioteca</h3>
            <p>" . htmlspecialchars(mysqli_error($conn)) . "</p>
        </div>
    ");

}

?>

<?php include "header.php"; ?>


<style>

body {
    background: #0f1922;
}

.biblioteca-container {
    padding-top: 50px;
    padding-bottom: 70px;
}


/* Cabeçalho */

.biblioteca-header {
    background: linear-gradient(
        135deg,
        #171a21,
        #101820
    );

    border: 1px solid #2a475e;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 35px;

    box-shadow: 0 5px 20px rgba(0,0,0,0.25);
}

.biblioteca-header h1 {
    color: white;
    font-weight: bold;
    margin-bottom: 8px;
}

.biblioteca-header p {
    color: #8a9aaa;
    margin-bottom: 0;
}

.biblioteca-icon {
    font-size: 45px;
    color: #66c0f4;
    margin-right: 18px;
}


/* Barra de pesquisa */

.pesquisa-biblioteca {
    background: #171a21;
    border: 1px solid #2a475e;
    color: white;

    padding: 13px 18px;
    border-radius: 8px;

    width: 100%;
    margin-bottom: 30px;
}

.pesquisa-biblioteca:focus {
    background: #171a21;
    color: white;

    border-color: #66c0f4;

    box-shadow:
        0 0 0 0.2rem
        rgba(102,192,244,0.15);
}

.pesquisa-biblioteca::placeholder {
    color: #71808f;
}


/* Cards */

.jogo-biblioteca {
    background: #171a21;

    border: 1px solid #2a475e;
    border-radius: 10px;

    overflow: hidden;

    height: 100%;

    transition: 0.25s;

    box-shadow:
        0 4px 12px
        rgba(0,0,0,0.2);
}

.jogo-biblioteca:hover {

    transform: translateY(-5px);

    border-color: #66c0f4;

    box-shadow:
        0 8px 25px
        rgba(0,0,0,0.35);
}


/* Imagem da capa */

.jogo-biblioteca img {

    width: 100%;
    height: 280px;

    object-fit: cover;
    object-position: center;

    background: #000;
}


/* Conteúdo */

.jogo-conteudo {

    padding: 20px;

    display: flex;
    flex-direction: column;

    height: calc(100% - 280px);
}

.jogo-nome {

    color: white;

    font-size: 20px;
    font-weight: bold;

    margin-bottom: 8px;
}

.jogo-categoria {

    color: #66c0f4;

    font-size: 14px;

    margin-bottom: 10px;
}

.jogo-descricao {

    color: #8a9aaa;

    font-size: 14px;

    line-height: 1.5;

    flex-grow: 1;

    margin-bottom: 15px;
}

.jogo-data {

    color: #71808f;

    font-size: 12px;

    margin-bottom: 15px;
}


/* Botão Ver Jogo */

.btn-ver-jogo {

    background: #66c0f4;

    color: #101820;

    border: none;

    font-weight: bold;

    padding: 10px;

    border-radius: 6px;

    text-decoration: none;

    text-align: center;

    transition: 0.2s;
}

.btn-ver-jogo:hover {

    background: #4da8d8;

    color: white;
}


/* Biblioteca vazia */

.biblioteca-vazia {

    background: #171a21;

    border: 1px solid #2a475e;

    border-radius: 12px;

    padding: 70px 30px;

    text-align: center;
}

.biblioteca-vazia i {

    font-size: 70px;

    color: #2a475e;

    margin-bottom: 20px;
}

.biblioteca-vazia h3 {

    color: white;

    margin-bottom: 10px;
}

.biblioteca-vazia p {

    color: #8a9aaa;

    margin-bottom: 25px;
}

.btn-explorar {

    background: #66c0f4;

    color: #101820;

    border: none;

    padding: 11px 25px;

    border-radius: 6px;

    text-decoration: none;

    font-weight: bold;

    transition: 0.2s;
}

.btn-explorar:hover {

    background: #4da8d8;

    color: white;
}


/* Resultado da pesquisa */

#nenhumJogo {

    display: none;

    text-align: center;

    padding: 50px;

    color: #8a9aaa;
}

</style>


<div class="container biblioteca-container">


    <!-- Cabeçalho -->

    <div class="biblioteca-header">

        <div class="d-flex align-items-center">

            <i class="bi bi-collection-play biblioteca-icon"></i>

            <div>

                <h1>
                    Minha Biblioteca
                </h1>

                <p>
                    Aqui estão os jogos que você adicionou à sua conta.
                </p>

            </div>

        </div>

    </div>


    <?php if (mysqli_num_rows($resultado) > 0): ?>


        <!-- Pesquisa -->

        <input
            type="text"
            id="pesquisaBiblioteca"
            class="pesquisa-biblioteca"
            placeholder="🔎 Pesquisar jogo na sua biblioteca..."
            onkeyup="pesquisarBiblioteca()"
        >


        <!-- Jogos -->

        <div
            class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4"
            id="listaJogos"
        >


            <?php while ($jogo = mysqli_fetch_assoc($resultado)): ?>


                <div
                    class="col jogo-item"
                    data-nome="<?php echo htmlspecialchars(strtolower($jogo['nomeJogo'])); ?>"
                >

                    <div class="jogo-biblioteca">


                        <!-- Imagem da capa -->

                        <img
                            src="<?php echo htmlspecialchars($jogo['capaJogo']); ?>"
                            alt="<?php echo htmlspecialchars($jogo['nomeJogo']); ?>"
                            onerror="this.onerror=null; this.src='assets/img/capa-padrao.jpg';"
                        >


                        <!-- Conteúdo -->

                        <div class="jogo-conteudo">


                            <h3 class="jogo-nome">

                                <?php
                                echo htmlspecialchars(
                                    $jogo['nomeJogo']
                                );
                                ?>

                            </h3>


                            <div class="jogo-categoria">

                                <i class="bi bi-controller"></i>

                                <?php
                                echo htmlspecialchars(
                                    $jogo['categoriaJogo']
                                );
                                ?>

                            </div>


                            <p class="jogo-descricao">

                                <?php
                                echo htmlspecialchars(
                                    $jogo['descricaoJogo']
                                );
                                ?>

                            </p>


                            <div class="jogo-data">

                                <i class="bi bi-calendar3"></i>

                                Adicionado em:

                                <?php

                                echo date(
                                    "d/m/Y",
                                    strtotime($jogo['dataAdicao'])
                                );

                                ?>

                            </div>


                            <!-- Botão Ver Jogo -->

                            <a
                                href="visualizarJogo.php?id=<?php echo $jogo['idJogo']; ?>"
                                class="btn-ver-jogo"
                            >

                                <i class="bi bi-eye"></i>

                                Ver Jogo

                            </a>


                        </div>

                    </div>

                </div>


            <?php endwhile; ?>


        </div>


        <!-- Nenhum resultado -->

        <div id="nenhumJogo">

            <i
                class="bi bi-search"
                style="font-size:40px;"
            ></i>

            <h4>
                Nenhum jogo encontrado
            </h4>

            <p>
                Tente pesquisar por outro nome.
            </p>

        </div>


    <?php else: ?>


        <!-- Biblioteca vazia -->

        <div class="biblioteca-vazia">

            <i class="bi bi-controller"></i>

            <h3>
                Sua biblioteca está vazia
            </h3>

            <p>
                Você ainda não adicionou nenhum jogo à sua biblioteca.
            </p>

            <a
                href="loja.php"
                class="btn-explorar"
            >

                <i class="bi bi-shop"></i>

                Explorar jogos

            </a>

        </div>


    <?php endif; ?>


</div>


<script>

function pesquisarBiblioteca() {

    let pesquisa = document
        .getElementById("pesquisaBiblioteca")
        .value
        .toLowerCase()
        .trim();

    let jogos = document.querySelectorAll(".jogo-item");

    let encontrados = 0;


    jogos.forEach(function(jogo) {

        let nome = jogo.getAttribute("data-nome");

        if (nome.includes(pesquisa)) {

            jogo.style.display = "";

            encontrados++;

        } else {

            jogo.style.display = "none";

        }

    });


    let mensagem =
        document.getElementById("nenhumJogo");


    if (encontrados === 0) {

        mensagem.style.display = "block";

    } else {

        mensagem.style.display = "none";

    }

}

</script>


<?php include "footer.php"; ?>