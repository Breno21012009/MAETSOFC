<?php include "header.php" ?>

<div class="d-flex justify-content-center mb-3">
    <h2 class="text-white">Cadastrar Jogo</h2>
</div>

<div class="d-flex justify-content-center mb-3">

    <form action="actionJogo.php"
          method="POST"
          class="was-validated"
          enctype="multipart/form-data">

        <!-- CAPA DO JOGO -->
        <div class="mt-3 mb-3">

            <label for="capaJogo"
                   class="form-label text-white">
                Capa do jogo
            </label>

            <input type="file"
                   name="capaJogo"
                   id="capaJogo"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <div class="valid-feedback">
                Capa selecionada!
            </div>

            <div class="invalid-feedback">
                Selecione a capa do jogo.
            </div>

        </div>


        <!-- GAMEPLAY 1 -->
        <div class="mt-3 mb-3">

            <label for="gameplay1Jogo"
                   class="form-label text-white">
                Foto da gameplay 1
            </label>

            <input type="file"
                   name="gameplay1Jogo"
                   id="gameplay1Jogo"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <div class="valid-feedback">
                Imagem selecionada!
            </div>

            <div class="invalid-feedback">
                Selecione a primeira foto da gameplay.
            </div>

        </div>


        <!-- GAMEPLAY 2 -->
        <div class="mt-3 mb-3">

            <label for="gameplay2Jogo"
                   class="form-label text-white">
                Foto da gameplay 2
            </label>

            <input type="file"
                   name="gameplay2Jogo"
                   id="gameplay2Jogo"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <div class="valid-feedback">
                Imagem selecionada!
            </div>

            <div class="invalid-feedback">
                Selecione a segunda foto da gameplay.
            </div>

        </div>


        <!-- GAMEPLAY 3 -->
        <div class="mt-3 mb-3">

            <label for="gameplay3Jogo"
                   class="form-label text-white">
                Foto da gameplay 3
            </label>

            <input type="file"
                   name="gameplay3Jogo"
                   id="gameplay3Jogo"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <div class="valid-feedback">
                Imagem selecionada!
            </div>

            <div class="invalid-feedback">
                Selecione a terceira foto da gameplay.
            </div>

        </div>


        <!-- NOME -->
        <div class="form-floating mt-3 mb-3">

            <input type="text"
                   name="nomeJogo"
                   id="nomeJogo"
                   placeholder="Nome do Jogo"
                   class="form-control"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <label for="nomeJogo" style="color:white;">
                Nome do jogo
            </label>

            <div class="invalid-feedback">
                Informe o nome do jogo.
            </div>

        </div>


        <!-- DESCRIÇÃO -->
        <div class="form-floating mt-3 mb-3">

            <textarea name="descricaoJogo"
                      id="descricaoJogo"
                      placeholder="Descrição do Jogo"
                      class="form-control"
                      required
                      style="height:120px;
                             background-color:#171a21;
                             color:white;
                             border:1px solid #2a475e;"></textarea>

            <label for="descricaoJogo" style="color:white;">
                Descrição do jogo
            </label>

            <div class="invalid-feedback">
                Informe uma descrição para o jogo.
            </div>

        </div>


        <!-- CATEGORIA -->
        <div class="form-floating mt-3 mb-3">

            <select name="categoriaJogo"
                    id="categoriaJogo"
                    class="form-select"
                    required
                    style="background-color:#171a21;
                           color:white;
                           border:1px solid #2a475e;">

                <option value="" selected disabled>
                    Selecione uma categoria
                </option>

                <option value="Ação">Ação</option>
                <option value="Aventura">Aventura</option>
                <option value="RPG">RPG</option>
                <option value="Estratégia">Estratégia</option>
                <option value="Esportes">Esportes</option>
                <option value="Corrida">Corrida</option>
                <option value="Terror">Terror</option>
                <option value="Sobrevivência">Sobrevivência</option>
                <option value="Sandbox">Sandbox</option>

            </select>

            <label for="categoriaJogo" style="color:white;">
                Categoria
            </label>

            <div class="invalid-feedback">
                Selecione uma categoria.
            </div>

        </div>


        <!-- PREÇO -->
        <div class="form-floating mt-3 mb-3">

            <input type="number"
                   name="precoJogo"
                   id="precoJogo"
                   placeholder="Preço"
                   class="form-control"
                   step="0.01"
                   min="0"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <label for="precoJogo" style="color:white;">
                Preço (R$)
            </label>

            <div class="invalid-feedback">
                Informe o preço do jogo.
            </div>

        </div>


        <!-- PÁGINA DO JOGO -->
        <div class="form-floating mt-3 mb-3">

            <input type="url"
                   name="paginaJogo"
                   id="paginaJogo"
                   placeholder="Página do Jogo"
                   class="form-control"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <label for="paginaJogo" style="color:white;">
                Página do jogo
            </label>

            <div class="invalid-feedback">
                Informe o link da página do jogo.
            </div>

        </div>


        <!-- BOTÃO -->
        <button type="submit"
                class="btn btn-dark px-4 py-2">
            Cadastrar Jogo
        </button>

    </form>

</div>

<?php include "footer.php" ?>