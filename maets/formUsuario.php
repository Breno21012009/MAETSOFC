<?php include "header.php" ?>

<div class="d-flex justify-content-center mb-3">
    <h2 class="text-white">Bem Vindo!</h2>
</div>

<div class="d-flex justify-content-center mb-3">

    <form action="actionUsuario.php"
          method="POST"
          class="was-validated"
          enctype="multipart/form-data">

        <div class="mt-3 mb-3">

            <label for="fotoUsuario"
                class="form-label text-white">
                Foto do usuário
            </label>

            <input type="file"
                name="fotoUsuario"
                id="fotoUsuario"
                class="form-control"
                style="background-color:#171a21;
                        color:white;
                        border:1px solid #2a475e;">

            <div class="valid-feedback"></div>
            <div class="invalid-feedback"></div>

        </div>


        <!-- Nome -->
        <div class="form-floating mt-3 mb-3">

            <input type="text"
                   name="nomeUsuario"
                   id="nomeUsuario"
                   placeholder="Nome Completo"
                   class="form-control"
                   style="background-color:#171a21; color:white; border:1px solid #2a475e;">

            <label for="nomeUsuario" style="color:white;">
                Nome
            </label>

            <div class="valid-feedback"></div>
            <div class="invalid-feedback"></div>

        </div>


        <!-- Data de nascimento -->
        <div class="form-floating mt-3 mb-3">

            <input type="date"
                   name="dataNascimentoUsuario"
                   id="dataNascimentoUsuario"
                   placeholder="Data de Nascimento"
                   class="form-control"
                   style="background-color:#171a21; color:white; border:1px solid #2a475e;">

            <label for="dataNascimentoUsuario" style="color:white;">
                Data de Nascimento
            </label>

            <div class="valid-feedback"></div>
            <div class="invalid-feedback"></div>

        </div>


        <!-- Email -->
        <div class="form-floating mt-3 mb-3">

            <input type="email"
                   name="emailUsuario"
                   id="emailUsuario"
                   placeholder="Email"
                   class="form-control"
                   style="background-color:#171a21; color:white; border:1px solid #2a475e;">

            <label for="emailUsuario" style="color:white;">
                Email
            </label>

            <div class="valid-feedback"></div>
            <div class="invalid-feedback"></div>

        </div>


        <!-- Senha -->
        <div class="form-floating mt-3 mb-3">

            <input type="password"
                   name="senhaUsuario"
                   id="senhaUsuario"
                   placeholder="Senha"
                   class="form-control"
                   minlength="3"
                   maxlength="8"
                   style="background-color:#171a21; color:white; border:1px solid #2a475e;">

            <label for="senhaUsuario" style="color:white;">
                Senha
            </label>

            <div class="valid-feedback"></div>
            <div class="invalid-feedback"></div>

        </div>


        <!-- Confirmar senha -->
        <div class="form-floating mt-3 mb-3">

            <input type="password"
                   name="confirmarSenhaUsuario"
                   id="confirmarSenhaUsuario"
                   placeholder="Confirme a Senha"
                   class="form-control"
                   minlength="3"
                   maxlength="8"
                   style="background-color:#171a21; color:white; border:1px solid #2a475e;">

            <label for="confirmarSenhaUsuario" style="color:white;">
                Confirme a Senha
            </label>

            <div class="valid-feedback"></div>
            <div class="invalid-feedback"></div>

        </div>


        <!-- Botão -->
        <button type="submit" class="btn btn-dark px-4 py-2">
            Cadastrar
        </button>

    </form>

</div>

<?php include "footer.php" ?>