<?php include "header.php"; ?>

<div class="d-flex justify-content-center mb-3">

    <h2 class="text-white">Cadastrar Promoção</h2>

</div>

<div class="d-flex justify-content-center mb-3">

    <form action="actionPromocoes.php"
          method="POST"
          class="was-validated"
          enctype="multipart/form-data">

        <!-- CAPA -->
        <div class="mt-3 mb-3">

            <label for="capaPromocoes"
                   class="form-label text-white">

                Capa do jogo

            </label>

            <input type="file"
                   name="capaPromocoes"
                   id="capaPromocoes"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <div class="invalid-feedback">

                Selecione a capa do jogo.

            </div>

        </div>


        <!-- GAMEPLAY 1 -->
        <div class="mt-3 mb-3">

            <label for="gameplay1Promocoes"
                   class="form-label text-white">

                Gameplay 1

            </label>

            <input type="file"
                   name="gameplay1Promocoes"
                   id="gameplay1Promocoes"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <div class="invalid-feedback">

                Selecione a primeira imagem de gameplay.

            </div>

        </div>


        <!-- GAMEPLAY 2 -->
        <div class="mt-3 mb-3">

            <label for="gameplay2Promocoes"
                   class="form-label text-white">

                Gameplay 2

            </label>

            <input type="file"
                   name="gameplay2Promocoes"
                   id="gameplay2Promocoes"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <div class="invalid-feedback">

                Selecione a segunda imagem de gameplay.

            </div>

        </div>


        <!-- GAMEPLAY 3 -->
        <div class="mt-3 mb-3">

            <label for="gameplay3Promocoes"
                   class="form-label text-white">

                Gameplay 3

            </label>

            <input type="file"
                   name="gameplay3Promocoes"
                   id="gameplay3Promocoes"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <div class="invalid-feedback">

                Selecione a terceira imagem de gameplay.

            </div>

        </div>


        <!-- NOME -->
        <div class="form-floating mt-3 mb-3">

            <input type="text"
                   name="nomePromocoes"
                   id="nomePromocoes"
                   placeholder="Nome do jogo"
                   class="form-control"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <label for="nomePromocoes"
                   style="color:white;">

                Nome do jogo

            </label>

            <div class="invalid-feedback">

                Informe o nome do jogo.

            </div>

        </div>


        <!-- DESCRIÇÃO -->
        <div class="form-floating mt-3 mb-3">

            <textarea name="descricaoPromocoes"
                      id="descricaoPromocoes"
                      placeholder="Descrição"
                      class="form-control"
                      required
                      style="height:120px;
                             background-color:#171a21;
                             color:white;
                             border:1px solid #2a475e;"></textarea>

            <label for="descricaoPromocoes"
                   style="color:white;">

                Descrição do jogo

            </label>

            <div class="invalid-feedback">

                Informe uma descrição.

            </div>

        </div>


        <!-- CATEGORIA -->
        <div class="form-floating mt-3 mb-3">

            <select name="categoriaPromocoes"
                    id="categoriaPromocoes"
                    class="form-select"
                    required
                    style="background-color:#171a21;
                           color:white;
                           border:1px solid #2a475e;">

                <option value=""
                        selected
                        disabled>

                    Selecione uma categoria

                </option>

                <option value="Ação">Ação</option>

                <option value="Aventura">Aventura</option>

                <option value="RPG">RPG</option>

                <option value="Estratégia">Estratégia</option>

                <option value="Corrida">Corrida</option>

                <option value="Terror">Terror</option>

                <option value="Sobrevivência">Sobrevivência</option>

                <option value="Sandbox">Sandbox</option>

            </select>

            <label for="categoriaPromocoes"
                   style="color:white;">

                Categoria

            </label>

            <div class="invalid-feedback">

                Selecione uma categoria.

            </div>

        </div>


        <!-- PREÇO ORIGINAL -->
        <div class="form-floating mt-3 mb-3">

            <input
                type="number"
                name="precoOriginalPromocoes"
                id="precoOriginalPromocoes"
                placeholder="Preço original"
                class="form-control"
                step="0.01"
                min="0"
                required
                style="
                    background-color:#171a21;
                    color:white;
                    border:1px solid #2a475e;
                "
            >

            <label for="precoOriginalPromocoes"
                   style="color:white;">

                Preço original (R$)

            </label>

            <div class="invalid-feedback">

                Informe o preço original.

            </div>

        </div>


        <!-- PREÇO PROMOCIONAL -->
        <div class="form-floating mt-3 mb-3">

            <input
                type="number"
                name="precoPromocoes"
                id="precoPromocoes"
                placeholder="Preço promocional"
                class="form-control"
                step="0.01"
                min="0"
                required
                style="
                    background-color:#171a21;
                    color:white;
                    border:1px solid #2a475e;
                "
            >

            <label for="precoPromocoes"
                   style="color:white;">

                Preço promocional (R$)

            </label>

            <div class="invalid-feedback">

                Informe o preço promocional.

            </div>

        </div>


        <!-- PÁGINA -->
        <div class="form-floating mt-3 mb-3">

            <input type="url"
                   name="paginaPromocoes"
                   id="paginaPromocoes"
                   placeholder="Página do jogo"
                   class="form-control"
                   required
                   style="background-color:#171a21;
                          color:white;
                          border:1px solid #2a475e;">

            <label for="paginaPromocoes"
                   style="color:white;">

                Página do jogo

            </label>

            <div class="invalid-feedback">

                Informe o link da página do jogo.

            </div>

        </div>


        <!-- BOTÃO -->
        <button type="submit"
                class="btn btn-dark px-4 py-2">

            Cadastrar Promoção

        </button>

    </form>

</div>

<?php include "footer.php"; ?>