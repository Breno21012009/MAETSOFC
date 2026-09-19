<?php include "header.php"; ?>

<style>

    .explorar-pagina{
        background: #0f1922;
        min-height: 100vh;
        padding: 40px 0;
    }

    .titulo-explorar{
        font-family: "Audiowide", sans-serif;
        color: white;
        text-align: center;
        margin-bottom: 10px;
    }

    .subtitulo-explorar{
        color: #c7d5e0;
        text-align: center;
        margin-bottom: 35px;
    }


    /* JOGO EM DESTAQUE */

    .destaque-box{
        background: #171a21;
        border: 1px solid #2a475e;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 30px;
        transition: 0.3s;
    }

    .destaque-box:hover{
        border-color: #66c0f4;
        box-shadow: 0 10px 30px rgba(0,0,0,0.6);
    }

    .imagem-destaque{
        width: 100%;
        height: 350px;
        object-fit: cover;
    }

    .titulo-destaque{
        font-family: "Audiowide", sans-serif;
        color: #66c0f4;
    }

    .texto-destaque{
        color: #c7d5e0;
        font-size: 16px;
    }

    .badge-destaque{
        background: #75b022;
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 10px;
    }


    /* PESQUISA */

    .area-pesquisa{
        background: #171a21;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #2a475e;
        margin-bottom: 25px;
    }

    .pesquisa-input{
        background: #0f1922;
        color: white;
        border: 1px solid #2a475e;
    }

    .pesquisa-input:focus{
        background: #0f1922;
        color: white;
        border-color: #66c0f4;
        box-shadow: 0 0 8px rgba(102,192,244,0.4);
    }

    .pesquisa-input::placeholder{
        color: #8f98a0;
    }


    /* FILTROS */

    .categoria-filtro{
        background: #171a21;
        color: white;
        border: 1px solid #2a475e;
        margin: 4px;
        transition: 0.2s;
    }

    .categoria-filtro:hover{
        background: #2a475e;
        color: white;
    }

    .categoria-filtro.ativo{
        background: #66c0f4;
        color: black;
        font-weight: bold;
    }


    /* JOGOS */

    .card-jogo{
        background: #171a21;
        border: 1px solid #2a475e;
        color: white;
        height: 100%;
        transition: 0.3s;
        overflow: hidden;
    }

    .card-jogo:hover{
        transform: translateY(-8px);
        border-color: #66c0f4;
        box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    }

    .imagem-jogo{
        width: 100%;
        height: 230px;
        object-fit: cover;
    }

    .card-jogo .card-body{
        display: flex;
        flex-direction: column;
    }

    .descricao-jogo{
        color: #c7d5e0;
        font-size: 14px;
    }

    .avaliacao{
        color: #f5c518;
        font-size: 18px;
    }

    .preco-jogo{
        color: #75b022;
        font-size: 20px;
        font-weight: bold;
    }


    /* BOTÕES */

    .btn-ver-jogo{
        background: #2a475e;
        color: white;
        border: none;
    }

    .btn-ver-jogo:hover{
        background: #66c0f4;
        color: black;
    }

    .btn-curtir{
        background: transparent;
        border: 1px solid #2a475e;
        color: white;
    }

    .btn-curtir:hover{
        background: #2a475e;
        color: white;
    }


    /* COMENTÁRIOS */

    .comentarios{
        margin-top: 15px;
        border-top: 1px solid #2a475e;
        padding-top: 12px;
    }

    .comentario{
        background: #0f1922;
        padding: 8px;
        border-radius: 6px;
        margin-bottom: 8px;
        font-size: 13px;
        color: #c7d5e0;
    }

    .nome-comentario{
        color: #66c0f4;
        font-weight: bold;
    }

    .input-comentario{
        background: #0f1922;
        color: white;
        border: 1px solid #2a475e;
        font-size: 13px;
    }

    .input-comentario:focus{
        background: #0f1922;
        color: white;
        border-color: #66c0f4;
    }


    /* CHAT */

    .chat-box{
        background: #171a21;
        border: 1px solid #2a475e;
        border-radius: 12px;
        padding: 15px;
        position: sticky;
        top: 20px;
    }

    .chat-titulo{
        color: white;
        font-family: "Audiowide", sans-serif;
        text-align: center;
        padding-bottom: 12px;
        border-bottom: 1px solid #2a475e;
    }

    .mensagens-chat{
        height: 500px;
        overflow-y: auto;
        padding: 10px 0;
    }

    .mensagem-chat{
        background: #0f1922;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 8px;
        color: #c7d5e0;
        font-size: 14px;
    }

    .nome-chat{
        color: #66c0f4;
        font-weight: bold;
        font-size: 13px;
    }

    .input-chat{
        background: #0f1922;
        color: white;
        border: 1px solid #2a475e;
    }

    .input-chat:focus{
        background: #0f1922;
        color: white;
        border-color: #66c0f4;
    }


    /* ALEATÓRIO */

    .btn-aleatorio{
        background: #75b022;
        color: white;
        border: none;
        font-weight: bold;
    }

    .btn-aleatorio:hover{
        background: #8bc42d;
        color: white;
    }


    /* NOTÍCIAS */

    .secao-noticias{
        margin-top: 50px;
    }

    .card-noticia{
        background: #171a21;
        border: 1px solid #2a475e;
        color: white;
        height: 100%;
        transition: 0.3s;
    }

    .card-noticia:hover{
        transform: translateY(-5px);
        border-color: #66c0f4;
    }

    .data-noticia{
        color: #66c0f4;
        font-size: 13px;
    }

    .texto-noticia{
        color: #c7d5e0;
        font-size: 14px;
    }


    #semResultados{
        display: none;
        color: #c7d5e0;
        text-align: center;
        font-size: 20px;
        margin-top: 30px;
    }

</style>


<div class="explorar-pagina">

<div class="container">

    <h1 class="titulo-explorar">
        EXPLORAR JOGOS
    </h1>

    <p class="subtitulo-explorar">
        Descubra novos mundos, encontre seu próximo jogo favorito e compartilhe sua opinião com outros jogadores.
    </p>


    <!-- JOGO EM DESTAQUE -->

    <div class="destaque-box">

        <div class="row g-0">

            <div class="col-lg-7">

                <img src="img/cyberpunk.jpg"
                     class="imagem-destaque"
                     alt="Cyberpunk 2077">

            </div>

            <div class="col-lg-5 p-4 d-flex flex-column justify-content-center">

                <span class="badge-destaque">
                    ⭐ JOGO EM DESTAQUE
                </span>

                <h2 class="titulo-destaque">
                    Cyberpunk 2077
                </h2>

                <p class="texto-destaque">
                    Entre em Night City e explore um enorme mundo futurista cheio
                    de ação, tecnologia, escolhas e aventuras.
                </p>

                <div class="avaliacao mb-3">
                    ★★★★★
                </div>

                <a href="cyberpunk.php"
                   class="btn btn-ver-jogo w-100">
                    Explorar Jogo
                </a>

            </div>

        </div>

    </div>


    <!-- PESQUISA -->

    <div class="area-pesquisa">

        <div class="row g-2">

            <div class="col-md-9">

                <input
                    type="text"
                    id="pesquisa"
                    class="form-control pesquisa-input"
                    placeholder="🔎 Pesquise por um jogo..."
                    onkeyup="pesquisarJogos()"
                >

            </div>

            <div class="col-md-3">

                <button
                    class="btn btn-aleatorio w-100"
                    onclick="jogoAleatorio()">

                    🎲 Jogo Aleatório

                </button>

            </div>

        </div>


        <div class="text-center mt-3">

            <button class="btn categoria-filtro ativo"
                    onclick="filtrarJogos('todos', this)">
                Todos
            </button>

            <button class="btn categoria-filtro"
                    onclick="filtrarJogos('acao', this)">
                Ação
            </button>

            <button class="btn categoria-filtro"
                    onclick="filtrarJogos('rpg', this)">
                RPG
            </button>

            <button class="btn categoria-filtro"
                    onclick="filtrarJogos('indie', this)">
                Indie
            </button>

            <button class="btn categoria-filtro"
                    onclick="filtrarJogos('esporte', this)">
                Esportes
            </button>

            <button class="btn categoria-filtro"
                    onclick="filtrarJogos('aventura', this)">
                Aventura
            </button>

        </div>

    </div>


    <div class="row">

        <!-- LISTA DE JOGOS -->

        <div class="col-lg-9">

            <div class="row g-4" id="listaJogos">


                <!-- 1 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="acao">

                    <div class="card card-jogo">

                        <img src="img/reddead.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Red Dead Redemption 2</h5>

                            <span class="badge bg-secondary mb-2">Ação</span>

                            <p class="descricao-jogo">
                                Viva uma aventura no Velho Oeste em um enorme mundo aberto.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 299,90</p>

                            <div class="d-flex gap-2">

                                <a href="#"
                                   class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir"
                                        onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="comentario">
                                    <span class="nome-comentario">
                                        Lucas:
                                    </span>
                                    Um dos melhores jogos que já joguei!
                                </div>

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 2 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="acao">

                    <div class="card card-jogo">

                        <img src="img/gtaV.jpeg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Grand Theft Auto V</h5>

                            <span class="badge bg-secondary mb-2">Ação</span>

                            <p class="descricao-jogo">
                                Explore Los Santos e viva grandes aventuras.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 99,90</p>

                            <div class="d-flex gap-2">

                                <a href="gta.php"
                                   class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir"
                                        onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="comentario">
                                    <span class="nome-comentario">
                                        Pedro:
                                    </span>
                                    Clássico!
                                </div>

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 3 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="rpg">

                    <div class="card card-jogo">

                        <img src="img/witcher.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>The Witcher 3</h5>

                            <span class="badge bg-secondary mb-2">RPG</span>

                            <p class="descricao-jogo">
                                Explore um mundo de fantasia cheio de monstros e escolhas.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 129,90</p>

                            <div class="d-flex gap-2">

                                <a href="#"
                                   class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir"
                                        onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 4 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="indie">

                    <div class="card card-jogo">

                        <img src="img/hollowknight.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Hollow Knight</h5>

                            <span class="badge bg-secondary mb-2">Indie</span>

                            <p class="descricao-jogo">
                                Explore um misterioso reino subterrâneo.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 46,99</p>

                            <div class="d-flex gap-2">

                                <a href="#"
                                   class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir"
                                        onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 5 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="esporte">

                    <div class="card card-jogo">

                        <img src="img/fifa.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>EA Sports FC</h5>

                            <span class="badge bg-secondary mb-2">Esportes</span>

                            <p class="descricao-jogo">
                                Viva a experiência do futebol virtual.
                            </p>

                            <div class="avaliacao">★★★★☆</div>

                            <p class="preco-jogo mt-2">R$ 299,90</p>

                            <div class="d-flex gap-2">

                                <a href="#"
                                   class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir"
                                        onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 6 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="aventura">

                    <div class="card card-jogo">

                        <img src="img/zelda.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>The Legend of Zelda</h5>

                            <span class="badge bg-secondary mb-2">Aventura</span>

                            <p class="descricao-jogo">
                                Explore um enorme mundo cheio de mistérios.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 349,90</p>

                            <div class="d-flex gap-2">

                                <a href="#"
                                   class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir"
                                        onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 7 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="acao">

                    <div class="card card-jogo">

                        <img src="img/spiderman.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Marvel's Spider-Man</h5>

                            <span class="badge bg-secondary mb-2">Ação</span>

                            <p class="descricao-jogo">
                                Proteja Nova York e viva como o Homem-Aranha.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 249,90</p>

                            <div class="d-flex gap-2">

                                <a href="#"
                                   class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir"
                                        onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 8 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="rpg">

                    <div class="card card-jogo">

                        <img src="img/eldenring.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Elden Ring</h5>

                            <span class="badge bg-secondary mb-2">RPG</span>

                            <p class="descricao-jogo">
                                Enfrente desafios em um gigantesco mundo de fantasia.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 249,90</p>

                            <div class="d-flex gap-2">

                                <a href="#"
                                   class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir"
                                        onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 9 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="indie">

                    <div class="card card-jogo">

                        <img src="img/stardew.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Stardew Valley</h5>

                            <span class="badge bg-secondary mb-2">Indie</span>

                            <p class="descricao-jogo">
                                Construa sua fazenda e aproveite uma vida tranquila.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 24,99</p>

                            <div class="d-flex gap-2">

                                <a href="#"
                                   class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir"
                                        onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 10 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="acao">

                    <div class="card card-jogo">

                        <img src="img/cyberpunk.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Cyberpunk 2077</h5>

                            <span class="badge bg-secondary mb-2">Ação</span>

                            <p class="descricao-jogo">
                                Explore Night City em uma aventura futurista.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 199,90</p>

                            <div class="d-flex gap-2">

                                <a href="cyberpunk.php"
                                   class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir"
                                        onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 11 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="acao">

                    <div class="card card-jogo">

                        <img src="img/godofwar.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>God of War</h5>

                            <span class="badge bg-secondary mb-2">Ação</span>

                            <p class="descricao-jogo">
                                Uma aventura épica inspirada na mitologia nórdica.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 199,90</p>

                            <div class="d-flex gap-2">

                                <a href="#" class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir" onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">
                                    <input type="text" class="form-control input-comentario" placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 12 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="rpg">

                    <div class="card card-jogo">

                        <img src="img/skyrim.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Skyrim</h5>

                            <span class="badge bg-secondary mb-2">RPG</span>

                            <p class="descricao-jogo">
                                Viva aventuras em uma gigantesca terra de fantasia.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 149,90</p>

                            <div class="d-flex gap-2">

                                <a href="#" class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir" onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 13 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="indie">

                    <div class="card card-jogo">

                        <img src="img/celeste.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Celeste</h5>

                            <span class="badge bg-secondary mb-2">Indie</span>

                            <p class="descricao-jogo">
                                Supere desafios e escale uma montanha cheia de obstáculos.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 36,99</p>

                            <div class="d-flex gap-2">

                                <a href="#" class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir" onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 14 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="esporte">

                    <div class="card card-jogo">

                        <img src="img/nba.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>NBA 2K</h5>

                            <span class="badge bg-secondary mb-2">Esportes</span>

                            <p class="descricao-jogo">
                                Viva a experiência completa do basquete.
                            </p>

                            <div class="avaliacao">★★★★☆</div>

                            <p class="preco-jogo mt-2">R$ 299,90</p>

                            <div class="d-flex gap-2">

                                <a href="#" class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir" onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 15 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="aventura">

                    <div class="card card-jogo">

                        <img src="img/minecraft.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Minecraft</h5>

                            <span class="badge bg-secondary mb-2">Aventura</span>

                            <p class="descricao-jogo">
                                Construa, explore e sobreviva em mundos infinitos.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 99,90</p>

                            <div class="d-flex gap-2">

                                <a href="minecraft.php"
                                   class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir" onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 16 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="aventura">

                    <div class="card card-jogo">

                        <img src="img/lastofus.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>The Last of Us</h5>

                            <span class="badge bg-secondary mb-2">Aventura</span>

                            <p class="descricao-jogo">
                                Uma emocionante jornada em um mundo destruído.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 249,90</p>

                            <div class="d-flex gap-2">

                                <a href="#" class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir" onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 17 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="indie">

                    <div class="card card-jogo">

                        <img src="img/cuphead.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Cuphead</h5>

                            <span class="badge bg-secondary mb-2">Indie</span>

                            <p class="descricao-jogo">
                                Enfrente chefes desafiadores em um visual clássico.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 59,90</p>

                            <div class="d-flex gap-2">

                                <a href="#" class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir" onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 18 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="esporte">

                    <div class="card card-jogo">

                        <img src="img/forza.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Forza Horizon</h5>

                            <span class="badge bg-secondary mb-2">Esportes</span>

                            <p class="descricao-jogo">
                                Corra por paisagens incríveis em carros de alta velocidade.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 249,90</p>

                            <div class="d-flex gap-2">

                                <a href="#" class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir" onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 19 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="rpg">

                    <div class="card card-jogo">

                        <img src="img/baldurs.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Baldur's Gate 3</h5>

                            <span class="badge bg-secondary mb-2">RPG</span>

                            <p class="descricao-jogo">
                                Escolhas, batalhas e aventuras em um mundo fantástico.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 199,90</p>

                            <div class="d-flex gap-2">

                                <a href="#" class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir" onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- 20 -->

                <div class="col-md-6 col-xl-4 jogo" data-categoria="acao">

                    <div class="card card-jogo">

                        <img src="img/ghost.jpg" class="imagem-jogo">

                        <div class="card-body">

                            <h5>Ghost of Tsushima</h5>

                            <span class="badge bg-secondary mb-2">Ação</span>

                            <p class="descricao-jogo">
                                Defenda sua terra em uma grande aventura de samurai.
                            </p>

                            <div class="avaliacao">★★★★★</div>

                            <p class="preco-jogo mt-2">R$ 249,90</p>

                            <div class="d-flex gap-2">

                                <a href="#" class="btn btn-ver-jogo flex-fill">
                                    Ver Jogo
                                </a>

                                <button class="btn btn-curtir" onclick="curtir(this)">
                                    ❤️ <span>0</span>
                                </button>

                            </div>

                            <div class="comentarios">

                                <div class="input-group">

                                    <input type="text"
                                           class="form-control input-comentario"
                                           placeholder="Comente...">

                                    <button class="btn btn-ver-jogo"
                                            onclick="adicionarComentario(this)">
                                        💬
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div id="semResultados">
                😕 Nenhum jogo encontrado.
            </div>

        </div>


        <!-- CHAT -->

        <div class="col-lg-3 mt-4 mt-lg-0">

            <div class="chat-box">

                <h5 class="chat-titulo">
                    💬 COMUNIDADE
                </h5>

                <div class="mensagens-chat" id="mensagensChat">

                    <div class="mensagem-chat">

                        <span class="nome-chat">
                            Lucas:
                        </span>

                        Alguém já jogou o novo jogo em destaque?

                    </div>


                    <div class="mensagem-chat">

                        <span class="nome-chat">
                            Ana:
                        </span>

                        Estou procurando um RPG novo para jogar!

                    </div>


                    <div class="mensagem-chat">

                        <span class="nome-chat">
                            Pedro:
                        </span>

                        Red Dead Redemption 2 continua sendo meu favorito.

                    </div>

                </div>


                <div class="input-group">

                    <input type="text"
                           id="inputChat"
                           class="form-control input-chat"
                           placeholder="Escreva uma mensagem..."
                           onkeypress="verificarEnter(event)">

                    <button class="btn btn-ver-jogo"
                            onclick="enviarMensagem()">
                        Enviar
                    </button>

                </div>

            </div>

        </div>

    </div>


    <!-- NOTÍCIAS -->

    <div class="secao-noticias">

        <h2 class="titulo-explorar mb-4">
            📰 INFORMAÇÕES E ATUALIZAÇÕES
        </h2>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="card card-noticia">

                    <div class="card-body">

                        <span class="data-noticia">
                            ATUALIZAÇÃO
                        </span>

                        <h5 class="mt-2">
                            Novos jogos chegaram ao MAETS
                        </h5>

                        <p class="texto-noticia">
                            Explore novos títulos adicionados à plataforma e descubra
                            diferentes mundos e estilos de jogos.
                        </p>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="card card-noticia">

                    <div class="card-body">

                        <span class="data-noticia">
                            COMUNIDADE
                        </span>

                        <h5 class="mt-2">
                            Compartilhe suas opiniões
                        </h5>

                        <p class="texto-noticia">
                            Agora você pode comentar nos jogos, deixar curtidas e
                            conversar com outros jogadores no chat da comunidade.
                        </p>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="card card-noticia">

                    <div class="card-body">

                        <span class="data-noticia">
                            DESTAQUE
                        </span>

                        <h5 class="mt-2">
                            Encontre seu próximo jogo favorito
                        </h5>

                        <p class="texto-noticia">
                            Utilize os filtros de categoria, a pesquisa e o botão
                            de jogo aleatório para descobrir algo novo.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


</div>

</div>


<script>

    let categoriaAtual = "todos";


    /* FILTRAR JOGOS */

    function filtrarJogos(categoria, botao){

        categoriaAtual = categoria;

        document.querySelectorAll(".categoria-filtro").forEach(function(btn){

            btn.classList.remove("ativo");

        });

        botao.classList.add("ativo");

        aplicarFiltros();

    }


    /* PESQUISAR */

    function pesquisarJogos(){

        aplicarFiltros();

    }


    function aplicarFiltros(){

        let pesquisa = document.getElementById("pesquisa").value.toLowerCase();

        let jogos = document.querySelectorAll(".jogo");

        let quantidadeVisivel = 0;


        jogos.forEach(function(jogo){

            let nome = jogo.querySelector("h5").innerText.toLowerCase();

            let categoria = jogo.dataset.categoria;


            let correspondePesquisa = nome.includes(pesquisa);

            let correspondeCategoria =
                categoriaAtual === "todos" ||
                categoria === categoriaAtual;


            if(correspondePesquisa && correspondeCategoria){

                jogo.style.display = "";

                quantidadeVisivel++;

            }else{

                jogo.style.display = "none";

            }

        });


        if(quantidadeVisivel === 0){

            document.getElementById("semResultados").style.display = "block";

        }else{

            document.getElementById("semResultados").style.display = "none";

        }

    }


    /* JOGO ALEATÓRIO */

    function jogoAleatorio(){

        let jogos = Array.from(document.querySelectorAll(".jogo"));

        let jogoVisivel = jogos.filter(function(jogo){

            return jogo.style.display !== "none";

        });


        if(jogoVisivel.length === 0){

            jogoVisivel = jogos;

        }


        let numero = Math.floor(Math.random() * jogoVisivel.length);

        let jogoEscolhido = jogoVisivel[numero];


        jogoEscolhido.scrollIntoView({

            behavior: "smooth",
            block: "center"

        });


        jogoEscolhido.querySelector(".card-jogo").style.borderColor = "#75b022";


        setTimeout(function(){

            jogoEscolhido.querySelector(".card-jogo").style.borderColor = "";

        }, 2000);

    }


    /* CURTIR */

    function curtir(botao){

        let numero = botao.querySelector("span");

        let curtidas = parseInt(numero.innerText);

        curtidas++;

        numero.innerText = curtidas;

    }


    /* ADICIONAR COMENTÁRIO */

    function adicionarComentario(botao){

        let grupo = botao.parentElement;

        let input = grupo.querySelector("input");

        let texto = input.value.trim();


        if(texto !== ""){

            let comentarios = grupo.parentElement;


            let novoComentario = document.createElement("div");

            novoComentario.classList.add("comentario");


            novoComentario.innerHTML =

                '<span class="nome-comentario">Você: </span>' +

                texto;


            comentarios.insertBefore(novoComentario, grupo);


            input.value = "";

        }

    }


    /* CHAT */

    function enviarMensagem(){

        let input = document.getElementById("inputChat");

        let texto = input.value.trim();


        if(texto !== ""){

            let mensagens = document.getElementById("mensagensChat");

            let novaMensagem = document.createElement("div");

            novaMensagem.classList.add("mensagem-chat");


            novaMensagem.innerHTML =

                '<span class="nome-chat">Você: </span>' +

                texto;


            mensagens.appendChild(novaMensagem);


            input.value = "";


            mensagens.scrollTop = mensagens.scrollHeight;

        }

    }


    /* ENTER NO CHAT */

    function verificarEnter(event){

        if(event.key === "Enter"){

            enviarMensagem();

        }

    }


    /* ENTER NOS COMENTÁRIOS */

    document.querySelectorAll(".input-comentario").forEach(function(input){

        input.addEventListener("keypress", function(event){

            if(event.key === "Enter"){

                let botao =
                    input.parentElement.querySelector("button");

                adicionarComentario(botao);

            }

        });

    });

</script>


<?php include "footer.php"; ?>