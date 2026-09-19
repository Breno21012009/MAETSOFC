<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "conexaoBD.php";


/* =========================
   VERIFICAR LOGIN
========================= */

if (!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true) {
    header("Location: formLogin.php");
    exit();
}


$idUsuario = intval($_SESSION["idUsuario"]);


/* =========================
   BUSCAR USUÁRIO
========================= */

$sql = "SELECT * FROM usuarios WHERE idUsuario = $idUsuario";

$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    echo "Usuário não encontrado.";
    exit();
}

$usuario = mysqli_fetch_assoc($resultado);


/* =========================
   DADOS ATUAIS
========================= */

$nomeAtual = $usuario["nomeUsuario"];
$emailAtual = $usuario["emailUsuario"];


/* =========================
   ATUALIZAR DADOS
========================= */

$mensagem = "";
$erro = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $novoNome = trim($_POST["nomeUsuario"]);
    $novoEmail = trim($_POST["emailUsuario"]);

    $senhaAtual = $_POST["senhaAtual"];
    $novaSenha = $_POST["novaSenha"];
    $confirmarSenha = $_POST["confirmarSenha"];


    /* =========================
       VERIFICAR NOME E E-MAIL
    ========================= */

    if ($novoNome == "" || $novoEmail == "") {

        $erro = "Preencha o nome e o e-mail.";

    } else {


        /* =========================
           VERIFICAR E-MAIL DUPLICADO
        ========================= */

        $emailSeguro = mysqli_real_escape_string($conn, $novoEmail);

        $sqlEmail = "SELECT idUsuario
                     FROM usuarios
                     WHERE emailUsuario = '$emailSeguro'
                     AND idUsuario != $idUsuario
                     LIMIT 1";

        $resultadoEmail = mysqli_query($conn, $sqlEmail);


        if ($resultadoEmail && mysqli_num_rows($resultadoEmail) > 0) {

            $erro = "Esse e-mail já está sendo usado por outro usuário.";

        } else {


            /* =========================
               ALTERAR NOME E E-MAIL
            ========================= */

            $nomeSeguro = mysqli_real_escape_string($conn, $novoNome);

            $sqlAtualizar = "UPDATE usuarios
                             SET nomeUsuario = '$nomeSeguro',
                                 emailUsuario = '$emailSeguro'
                             WHERE idUsuario = $idUsuario";

            $atualizou = mysqli_query($conn, $sqlAtualizar);


            if (!$atualizou) {

                $erro = "Não foi possível atualizar seus dados.";

            } else {

                /* Atualiza a sessão */

                $_SESSION["nomeUsuario"] = $novoNome;
                $_SESSION["emailUsuario"] = $novoEmail;


                /* =========================
                   ALTERAR SENHA
                ========================= */

                if ($novaSenha != "" || $confirmarSenha != "" || $senhaAtual != "") {

                    if ($senhaAtual == "") {

                        $erro = "Digite sua senha atual para alterar a senha.";

                    } else if ($novaSenha == "") {

                        $erro = "Digite a nova senha.";

                    } else if ($novaSenha != $confirmarSenha) {

                        $erro = "A confirmação da senha não confere.";

                    } else {


                        /* Busca senha atual */

                        $sqlSenha = "SELECT senhaUsuario
                                     FROM usuarios
                                     WHERE idUsuario = $idUsuario";

                        $resultadoSenha = mysqli_query($conn, $sqlSenha);

                        $dadosSenha = mysqli_fetch_assoc($resultadoSenha);

                        $senhaBanco = $dadosSenha["senhaUsuario"];


                        /* Verifica senha */

                        if ($senhaAtual != $senhaBanco) {

                            $erro = "A senha atual está incorreta.";

                        } else {

                            $novaSenhaSeguro = mysqli_real_escape_string($conn, $novaSenha);

                            $sqlNovaSenha = "UPDATE usuarios
                                             SET senhaUsuario = '$novaSenhaSeguro'
                                             WHERE idUsuario = $idUsuario";

                            if (mysqli_query($conn, $sqlNovaSenha)) {

                                $mensagem = "Dados e senha atualizados com sucesso!";

                            } else {

                                $erro = "Os dados foram atualizados, mas não foi possível alterar a senha.";
                            }
                        }
                    }

                } else {

                    $mensagem = "Dados atualizados com sucesso!";
                }
            }
        }
    }
}


include "header.php";

?>


<style>

body {
    background: #07111a;
    color: white;
}

.config-container {
    max-width: 850px;
    margin: 0 auto;
    padding: 40px 20px 60px;
}

.voltar {
    color: white;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 25px;
}

.voltar:hover {
    color: #b8d7e8;
}

.titulo {
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 8px;
}

.subtitulo {
    color: #aebbc4;
    margin-bottom: 30px;
}

.painel {
    background: #0f1922;
    border: 1px solid #2a475e;
    border-radius: 10px;
    padding: 30px;
    margin-bottom: 20px;
}

.painel h2 {
    font-size: 23px;
    margin-bottom: 20px;
}

.form-label {
    color: white;
    font-weight: bold;
}

.form-control {
    background: #17232d;
    border: 1px solid #2a475e;
    color: white;
}

.form-control:focus {
    background: #17232d;
    color: white;
    border-color: #4d7896;
    box-shadow: none;
}

.form-control::placeholder {
    color: #8796a1;
}

.btn-salvar {
    background: #2a475e;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 6px;
    font-weight: bold;
}

.btn-salvar:hover {
    background: #3b617d;
    color: white;
}

.alerta {
    background: #172531;
    border: 1px solid #2a475e;
    color: #dce8ee;
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 20px;
}

.erro {
    background: #321c20;
    border: 1px solid #75404a;
    color: #f0c4ca;
}

.separador {
    border: 0;
    border-top: 1px solid #2a475e;
    margin: 30px 0;
}

.info {
    color: #aebbc4;
    font-size: 14px;
    margin-top: 10px;
}

</style>


<div class="config-container">

    <a href="index.php" class="voltar">
        ← Voltar para o início
    </a>


    <div class="titulo">
        Configurações
    </div>

    <div class="subtitulo">
        Gerencie as informações da sua conta.
    </div>


    <?php if ($mensagem != "") { ?>

        <div class="alerta">
            ✓ <?php echo htmlspecialchars($mensagem); ?>
        </div>

    <?php } ?>


    <?php if ($erro != "") { ?>

        <div class="alerta erro">
            ⚠ <?php echo htmlspecialchars($erro); ?>
        </div>

    <?php } ?>


    <form method="POST" action="configuracoes.php">


        <!-- =========================
             INFORMAÇÕES DA CONTA
        ========================== -->

        <div class="painel">

            <h2>
                👤 Informações da conta
            </h2>


            <div class="mb-3">

                <label class="form-label">
                    Nome
                </label>

                <input
                    type="text"
                    name="nomeUsuario"
                    class="form-control"
                    value="<?php echo htmlspecialchars($nomeAtual); ?>"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    E-mail
                </label>

                <input
                    type="email"
                    name="emailUsuario"
                    class="form-control"
                    value="<?php echo htmlspecialchars($emailAtual); ?>"
                    required
                >

            </div>

        </div>


        <!-- =========================
             ALTERAR SENHA
        ========================== -->

        <div class="painel">

            <h2>
                🔑 Alterar senha
            </h2>


            <div class="mb-3">

                <label class="form-label">
                    Senha atual
                </label>

                <input
                    type="password"
                    name="senhaAtual"
                    class="form-control"
                    placeholder="Digite sua senha atual"
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Nova senha
                </label>

                <input
                    type="password"
                    name="novaSenha"
                    class="form-control"
                    placeholder="Digite a nova senha"
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Confirmar nova senha
                </label>

                <input
                    type="password"
                    name="confirmarSenha"
                    class="form-control"
                    placeholder="Digite novamente a nova senha"
                >

            </div>


            <div class="info">
                Deixe os campos de senha vazios caso não queira alterar sua senha.
            </div>

        </div>


        <!-- =========================
             BOTÃO
        ========================== -->

        <button
            type="submit"
            class="btn-salvar"
        >
            💾 Salvar alterações
        </button>


    </form>

</div>


<?php include "footer.php"; ?>