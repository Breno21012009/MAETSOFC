<?php

    error_reporting(0);
    session_start();

    date_default_timezone_set('America/Sao_Paulo');

    if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){

        $idUsuario = $_SESSION['idUsuario'];
        $nomeUsuario = $_SESSION['nomeUsuario'];
        $emailUsuario = $_SESSION['emailUsuario'];
        $nivelUsuario = $_SESSION['nivelUsuario'];

        $nomeCompleto = explode(' ', $nomeUsuario);
        $primeiroNome = $nomeCompleto[0];
    }

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MAETS - Plataforma Digital de Compra de Jogos</title>

    <link rel="icon"
          type="image/x-icon"
          href="assets/favicon.ico">

    <link href="css/styles.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap"
          rel="stylesheet">


<style>

    /* FUNDO DO SITE */

    body{

        background:#0f1922;
        color:white;

    }


    /* NAVBAR */

    .navbar{

        background:#171a21;

    }


    .navbar-brand,
    .nav-link{

        color:white !important;

    }


    .nav-link:hover{

        color:#66c0f4 !important;

    }


    /* BANNER */

    .banner{

        background-image:

            linear-gradient(

                rgba(0, 0, 0, 0.60),
                rgba(0, 0, 0, 0.75)

            ),

            url("assets/img/inide.jpg");

        background-repeat:no-repeat;

        background-size:cover;

        background-position:center top;

        min-height:500px;

        color:white;

        display:flex;

        align-items:center;

        justify-content:center;

        text-align:center;

    }


    /* CONTEÚDO DO BANNER */

    .banner .container{

        transform:translateY(55px);

    }


    /* FONTE */

    .audiowide{

        font-family:"Audiowide", sans-serif;

    }


    /* TÍTULO */

    .titulo-maets{

        font-family:"Audiowide", sans-serif;

        font-size:60px;

        font-weight:bold;

        letter-spacing:4px;

        margin-top:15px;

        margin-bottom:15px;

        text-shadow:

            0 0 10px rgba(0,0,0,0.8);

    }


    /* SUBTÍTULO */

    .subtitulo-maets{

        font-size:21px;

        color:#dcdcdc;

        margin-top:10px;

        margin-bottom:30px;

    }


    /* BOTÃO EXPLORAR */

    .btn-explorar{

        display:inline-block;

        background:#1b2838;

        color:white;

        padding:14px 35px;

        border:1px solid #66c0f4;

        border-radius:6px;

        text-decoration:none;

        transition:0.3s;

    }


    .btn-explorar:hover{

        background:#66c0f4;

        color:black;

    }


    /* CARDS */

    .card{

        background:#171a21;

        color:white;

        border:1px solid #2a475e;

    }


    .card-title{

        color:white;

    }


    .card-text{

        color:#c7d5e0;

    }


    /* BOTÃO LIGHT */

    .btn-light{

        background:#171a21;

        color:white;

        border:1px solid #2a475e;

    }


    .btn-light:hover{

        background:#2a475e;

        color:white;

    }


</style>

</head>


<body>


<!-- ========================= -->
<!-- NAVBAR -->
<!-- ========================= -->

<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container">


        <!-- LOGO -->

        <a class="navbar-brand audiowide"
           href="index.php">

            MAETS

        </a>


        <!-- BOTÃO MOBILE -->

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">

            <span class="navbar-toggler-icon"></span>

        </button>


        <!-- MENU -->

        <div class="collapse navbar-collapse"
             id="navbarSupportedContent">


            <!-- ========================= -->
            <!-- MENU PRINCIPAL -->
            <!-- ========================= -->

            <ul class="navbar-nav me-auto">


                <!-- LOJA -->

                <li class="nav-item">

                    <a class="nav-link"
                       href="index.php">

                        Loja

                    </a>

                </li>


                <!-- PROMOÇÕES -->

                <li class="nav-item">

                    <a class="nav-link"
                       href="promocoes.php">

                        Promoções

                    </a>

                </li>


                <!-- SOBRE -->

                <li class="nav-item">

                    <a class="nav-link"
                       href="sobre.php">

                        Sobre

                    </a>

                </li>


            </ul>


            <!-- ========================= -->
            <!-- USUÁRIO -->
            <!-- ========================= -->

            <ul class="navbar-nav">


                <?php

                /*
                ==========================================
                USUÁRIO LOGADO
                ==========================================
                */

                if(isset($_SESSION['logado']) &&
                   $_SESSION['logado'] === true){

                ?>


                    <!-- MENU DO USUÁRIO -->

                    <li class="nav-item dropdown">


                        <a class="nav-link dropdown-toggle"
                           href="#"
                           data-bs-toggle="dropdown">


                            <i class="bi bi-person-circle"></i>


                            <?php

                                echo htmlspecialchars($primeiroNome);

                            ?>


                        </a>


                        <ul class="dropdown-menu dropdown-menu-end">


                            <!-- MEU PERFIL -->

                            <li>

                                <a class="dropdown-item"
                                   href="perfil.php">

                                    <i class="bi bi-person"></i>

                                    Meu Perfil

                                </a>

                            </li>


                            <!-- MEUS JOGOS -->

                            <li>

                                <a class="dropdown-item"
                                   href="meusJogos.php">

                                    <i class="bi bi-controller"></i>

                                    Meus Jogos

                                </a>

                            </li>


                            <!-- MINHA BIBLIOTECA -->

                            <li>

                                <a class="dropdown-item"
                                   href="biblioteca.php">

                                    <i class="bi bi-book"></i>

                                    Minha Biblioteca

                                </a>

                            </li>


                            <!-- MEUS AMIGOS -->

                            <li>

                                <a class="dropdown-item"
                                   href="amigos.php">

                                    <i class="bi bi-people"></i>

                                    Meus Amigos

                                </a>

                            </li>


                            <!-- MINHAS COMPRAS -->

                            <li>

                                <a class="dropdown-item"
                                   href="minhasCompras.php">

                                    <i class="bi bi-handbag"></i>

                                    Minhas Compras

                                </a>

                            </li>


                            <!-- FAVORITOS -->

                            <li>

                                <a class="dropdown-item"
                                   href="favoritos.php">

                                    <i class="bi bi-heart"></i>

                                    Favoritos

                                </a>

                            </li>


                            <!-- CONFIGURAÇÕES -->

                            <li>

                                <a class="dropdown-item"
                                   href="configuracoes.php">

                                    <i class="bi bi-gear"></i>

                                    Configurações

                                </a>

                            </li>


                            <?php

                            /*
                            ==========================================
                            SOMENTE ADMINISTRADOR
                            ==========================================
                            */

                            if($nivelUsuario == "administrador"){

                            ?>


                                <li>

                                    <hr class="dropdown-divider">

                                </li>


                                <!-- GERENCIAR USUÁRIOS -->

                                <li>

                                    <a class="dropdown-item"
                                       href="listarUsuarios.php">

                                        <i class="bi bi-people"></i>

                                        Gerenciar Usuários

                                    </a>

                                </li>


                                <!-- CADASTRAR JOGO -->

                                <li>

                                    <a class="dropdown-item"
                                       href="formJogo.php">

                                        <i class="bi bi-controller"></i>

                                        Cadastrar Jogo

                                    </a>

                                </li>


                                <!-- CADASTRAR PROMOÇÃO -->

                                <li>

                                    <a class="dropdown-item"
                                       href="formPromocoes.php">

                                        <i class="bi bi-tag"></i>

                                        Cadastrar Promoção

                                    </a>

                                </li>


                            <?php

                            }

                            ?>


                            <!-- SEPARADOR -->

                            <li>

                                <hr class="dropdown-divider">

                            </li>


                            <!-- SAIR -->

                            <li>

                                <a class="dropdown-item"
                                   href="logout.php">

                                    <i class="bi bi-box-arrow-right"></i>

                                    Sair

                                </a>

                            </li>


                        </ul>

                    </li>


                <?php

                }

                else{

                ?>


                    <!-- ========================= -->
                    <!-- USUÁRIO NÃO LOGADO -->
                    <!-- ========================= -->

                    <li class="nav-item">

                        <a class="nav-link"
                           href="formLogin.php">

                            Login

                        </a>

                    </li>


                <?php

                }

                ?>


            </ul>

        </div>

    </div>

</nav>



<!-- ========================= -->
<!-- BANNER -->
<!-- ========================= -->

<header class="banner">


    <div class="container text-center">


        <!-- LOGO -->

        <img src="assets/img/maetslogo.png"
             width="100"
             alt="Logo MAETS">


        <!-- TÍTULO -->

        <h1 class="titulo-maets">

            MAETS

        </h1>


        <!-- SUBTÍTULO -->

        <p class="subtitulo-maets">

            Plataforma Digital de Compra de Jogos Digitais

        </p>


    </div>

</header>



<!-- ========================= -->
<!-- CONTEÚDO DAS PÁGINAS -->
<!-- ========================= -->

<section class="py-5">

    <div class="container">