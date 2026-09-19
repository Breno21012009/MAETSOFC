<?php

session_start();

include "conexaoBD.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: formLogin.php");
    exit();
}

$idUsuario = intval($_SESSION['idUsuario']);


// ======================================================
// SALVAR ALTERAÇÕES
// ======================================================

if (isset($_POST['salvar'])) {

    $nomeUsuario = mysqli_real_escape_string(
        $conn,
        $_POST['nomeUsuario']
    );

    $emailUsuario = mysqli_real_escape_string(
        $conn,
        $_POST['emailUsuario']
    );

    $fotoUsuario = mysqli_real_escape_string(
        $conn,
        $_POST['fotoUsuario']
    );


    // Atualiza os dados no banco
    $sql = "UPDATE usuarios SET
                nomeUsuario = '$nomeUsuario',
                emailUsuario = '$emailUsuario',
                fotoUsuario = '$fotoUsuario'
            WHERE idUsuario = $idUsuario";


    if (mysqli_query($conn, $sql)) {

        // Atualiza os dados da sessão
        $_SESSION['nomeUsuario'] = $nomeUsuario;
        $_SESSION['emailUsuario'] = $emailUsuario;

        // Volta para o perfil
        header("Location: perfil.php?alterado=sim");
        exit();

    } else {

        $erro = "Erro ao atualizar o perfil: " . mysqli_error($conn);

    }
}


// ======================================================
// BUSCAR DADOS DO USUÁRIO
// ======================================================

$sqlUsuario = "SELECT *
               FROM usuarios
               WHERE idUsuario = $idUsuario";


$resultado = mysqli_query($conn, $sqlUsuario);


if (!$resultado || mysqli_num_rows($resultado) == 0) {

    die("Usuário não encontrado.");

}


$usuario = mysqli_fetch_assoc($resultado);

$nomeUsuario = $usuario['nomeUsuario'];
$emailUsuario = $usuario['emailUsuario'];
$fotoUsuario = $usuario['fotoUsuario'];

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Editar Perfil - MAETS</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">


    <style>

        body {
            background: #0f1922;
            color: white;
        }


        .editar-container {
            max-width: 750px;
            margin: 60px auto;
        }


        .editar-card {
            background: #171a21;
            border: 1px solid #2a475e;
            border-radius: 12px;
            padding: 35px;

            box-shadow:
                0 10px 30px rgba(0,0,0,0.3);
        }


        .titulo {
            color: white;
            font-weight: bold;
            margin-bottom: 30px;
        }


        .form-label {
            color: #c7d5e0;
            font-weight: bold;
        }


        .form-control {
            background: #0f1922;
            border: 1px solid #2a475e;
            color: white;
        }


        .form-control:focus {
            background: #0f1922;
            color: white;
            border-color: #66c0f4;

            box-shadow:
                0 0 0 0.2rem rgba(102,192,244,0.15);
        }


        .form-control::placeholder {
            color: #71808f;
        }


        .foto-atual {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #2a475e;
            margin-bottom: 20px;
        }


        .btn-salvar {
            background: #66c0f4;
            color: #171a21;
            border: none;
            font-weight: bold;
            padding: 10px 25px;
            border-radius: 6px;
        }


        .btn-salvar:hover {
            background: #4da8d8;
            color: white;
        }


        .btn-cancelar {
            color: #8a9aaa;
            border: 1px solid #71808f;
            background: transparent;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
        }


        .btn-cancelar:hover {
            color: white;
            border-color: white;
        }

    </style>

</head>


<body>


<div class="container editar-container">

    <div class="editar-card">


        <h2 class="titulo text-center">

            <i class="bi bi-person-gear"></i>

            Editar Perfil

        </h2>


        <?php if (isset($erro)) { ?>

            <div class="alert alert-danger">

                <?php echo $erro; ?>

            </div>

        <?php } ?>


        <!-- Foto atual -->

        <div class="text-center mb-4">

            <?php if (!empty($fotoUsuario)) { ?>

                <img
                    src="<?php echo htmlspecialchars($fotoUsuario); ?>"
                    class="foto-atual"
                    alt="Foto do usuário">

            <?php } else { ?>

                <div
                    class="foto-atual d-inline-flex align-items-center justify-content-center"
                    style="background:#0f1922;">

                    <i
                        class="bi bi-person"
                        style="font-size:60px;color:#71808f;">
                    </i>

                </div>

            <?php } ?>

        </div>


        <!-- Formulário -->

        <form method="POST">


            <!-- Nome -->

            <div class="mb-4">

                <label class="form-label">
                    Nome
                </label>

                <input
                    type="text"
                    name="nomeUsuario"
                    class="form-control form-control-lg"
                    value="<?php echo htmlspecialchars($nomeUsuario); ?>"
                    required>

            </div>


            <!-- E-mail -->

            <div class="mb-4">

                <label class="form-label">
                    E-mail
                </label>

                <input
                    type="email"
                    name="emailUsuario"
                    class="form-control form-control-lg"
                    value="<?php echo htmlspecialchars($emailUsuario); ?>"
                    required>

            </div>


            <!-- Foto -->

            <div class="mb-4">

                <label class="form-label">
                    URL da foto
                </label>

                <input
                    type="text"
                    name="fotoUsuario"
                    class="form-control"
                    value="<?php echo htmlspecialchars($fotoUsuario); ?>"
                    placeholder="Ex: img/perfil.jpg">

                <small class="text-secondary">
                    Informe o caminho da imagem que deseja usar.
                </small>

            </div>


            <!-- Botões -->

            <div class="d-flex justify-content-between mt-4">

                <a
                    href="perfil.php"
                    class="btn-cancelar">

                    ← Cancelar

                </a>


                <button
                    type="submit"
                    name="salvar"
                    class="btn-salvar">

                    <i class="bi bi-check-lg"></i>

                    Salvar alterações

                </button>

            </div>


        </form>

    </div>

</div>


</body>

</html>