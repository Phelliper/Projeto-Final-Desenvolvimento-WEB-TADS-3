<?php include "header.php"; ?>
<?php include "validarSessao.php"?>

<div class="container px-5 my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="fw-light my-4">Editar Serviço</h3>
                </div>
                <div class="card-body p-4">
                    <?php
                        if(isset($_GET['idServico'])){
                            $idServico = $_GET['idServico'];

                            // session_start(); // Removido, pois já é chamado em header.php
                            $idUsuario = $_SESSION['idUsuario']; // Pega da sessão já iniciada

                            include("conexaoBD.php");
                            $buscarServico = "SELECT * FROM servicos WHERE idServico = $idServico";
                            $res = mysqli_query($conn, $buscarServico); //Executa a query
                            $totalServicos = mysqli_num_rows($res);

                            if($totalServicos > 0){
                                if($registro = mysqli_fetch_assoc($res)){
                                    $idServico             = $registro['idServico'];
                                    $fotoServico           = $registro['fotoServico'];
                                    $nomeServico           = $registro['nomeServico'];
                                    $descricaoServico      = $registro['descricaoServico'];
                                    $valorServico          = $registro['valorServico'];
                                }
                            } else {
                                echo "<div class='alert alert-danger text-center'>Serviço não encontrado!</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger text-center'>Não foi possível carregar o Serviço! ID não fornecido.</div>";
                        }
                    ?>
                    
                    <form action="editarServico.php" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="idServico" name="idServico" value="<?php echo htmlspecialchars($idServico ?? ''); ?>" required readonly>
                            <label for="idServico">ID do Serviço</label>
                        </div>
                        <div class="mb-3 text-center">
                            <label for="fotoProduto" class="form-label">Foto Atual:</label><br>
                            <img src="<?php echo htmlspecialchars($fotoServico ?? ''); ?>" width="150" class="img-thumbnail mb-3" alt="Foto do Serviço"><br>
                            <input type="hidden" id="fotoAtual" name="fotoAtual" value="<?php echo htmlspecialchars($fotoServico ?? ''); ?>" required>
                            <label for="fotoProduto" class="form-label">Alterar Foto:</label>
                            <input type="file" class="form-control" id="fotoProduto" name="fotoProduto">
                            <div class="form-text">Deixe em branco para manter a foto atual.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nomeServico" placeholder="Nome" name="nomeServico" value="<?php echo htmlspecialchars($nomeServico ?? ''); ?>" required>
                            <label for="nomeServico">Nome do Serviço</label>
                            <div class="invalid-feedback">Por favor, insira o nome do serviço.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="descricaoServico" placeholder="Informe uma breve descrição sobre o Serviço" name="descricaoServico" style="height: 100px" required><?php echo htmlspecialchars($descricaoServico ?? ''); ?></textarea>
                            <label for="descricaoServico">Descrição do Serviço</label>
                            <div class="invalid-feedback">Por favor, insira a descrição do serviço.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="valorServico" placeholder="Valor do Serviço" name="valorServico" value="<?php echo htmlspecialchars($valorServico ?? ''); ?>" required>
                            <label for="valorServico">Valor do Serviço (R$):</label>
                            <div class="invalid-feedback">Por favor, insira o valor do serviço.</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Salvar alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>

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
