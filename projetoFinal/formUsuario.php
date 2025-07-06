<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styleBarbearia.css">
</head>
<body>
<?php include "header.php"; ?>

<div class="container px-5 my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="fw-light my-4">Cadastro de Usuário</h3>
                </div>
                <div class="card-body p-4">
                    <form action="actionUsuario.php?pagina=formUsuario" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        
                        <div class="mb-3">
                            <label for="fotoUsuario" class="form-label">Foto de Perfil</label>
                            <input type="file" class="form-control" id="fotoUsuario" name="fotoUsuario" required>
                            <div class="invalid-feedback">Por favor, selecione uma foto.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nomeUsuario" placeholder="Nome Completo" name="nomeUsuario" required>
                            <label for="nomeUsuario">Nome Completo</label>
                            <div class="invalid-feedback">Por favor, insira seu nome completo.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="dataNascimentoUsuario" placeholder="Data de Nascimento" name="dataNascimentoUsuario" required>
                            <label for="dataNascimentoUsuario">Data de Nascimento</label>
                            <div class="invalid-feedback">Por favor, insira sua data de nascimento.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="cidadeUsuario" name="cidadeUsuario" required>
                                <option value="">Selecione sua Cidade</option>
                                <option value="curiuva">Curiúva</option>
                                <option value="imbau">Imbaú</option>
                                <option value="ortigueira">Ortigueira</option>
                                <option value="reserva">Reserva</option>
                                <option value="telemacoBorba" selected>Telêmaco Borba</option>
                                <option value="tibagi">Tibagi</option>
                            </select>
                            <label for="cidadeUsuario">Cidade</label>
                            <div class="invalid-feedback">Por favor, selecione sua cidade.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="telefoneUsuario" placeholder="(00) 00000-0000" name="telefoneUsuario" required>
                            <label for="telefoneUsuario">Telefone</label>
                            <div class="invalid-feedback">Por favor, insira seu telefone.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="emailUsuario" placeholder="name@example.com" name="emailUsuario" required>
                            <label for="emailUsuario">Email</label>
                            <div class="invalid-feedback">Por favor, insira um email válido.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="senhaUsuario" placeholder="Senha" name="senhaUsuario" required>
                            <label for="senhaUsuario">Senha</label>
                            <div class="invalid-feedback">Por favor, insira sua senha.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="confirmarSenhaUsuario" placeholder="Confirme a Senha" name="confirmarSenhaUsuario" required>
                            <label for="confirmarSenhaUsuario">Confirme a Senha</label>
                            <div class="invalid-feedback">Por favor, confirme sua senha.</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>

<script>
// Validação do formulário (mantido do seu código original, mas com classes Bootstrap)
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
</body>
</html>
