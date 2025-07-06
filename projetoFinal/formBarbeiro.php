<?php
include "header.php";
?>

<div class="container px-5 my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="fw-light my-4">Cadastrar Novo Barbeiro</h3>
                </div>
                <div class="card-body p-4">
                    <form action="actionBarbeiro.php" method="post" class="needs-validation" novalidate>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nomeBarbeiro" name="nomeBarbeiro" placeholder="Nome do Barbeiro" required>
                            <label for="nomeBarbeiro">Nome:</label>
                            <div class="invalid-feedback">
                                Por favor, insira o nome do barbeiro.
                            </div>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="especialidadeBarbeiro" name="especialidadeBarbeiro" placeholder="Especialidade" required>
                            <label for="especialidadeBarbeiro">Especialidade:</label>
                            <div class="invalid-feedback">
                                Por favor, insira a especialidade do barbeiro.
                            </div>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="dataDisponivelBarbeiro" name="dataDisponivelBarbeiro" required>
                            <label for="dataDisponivelBarbeiro">Data Disponível:</label>
                            <div class="invalid-feedback">
                                Por favor, selecione uma data disponível.
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Cadastrar Barbeiro</button>
                            <a href="visualizarBarbeiros.php" class="btn btn-secondary btn-lg">Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validação do formulário (mantido do seu código original)
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

<?php
include "footer.php";
?>
