<?php include "header.php"; ?>
<?php include "validarSessao.php"?>

<div class="container px-5 my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="fw-light my-4">Cadastrar Serviços</h3>
                </div>
                <div class="card-body p-4">
                    <form action="actionServico.php" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="mb-3">
                            <label for="fotoServico" class="form-label">Foto do Serviço</label>
                            <input type="file" class="form-control" id="fotoServico" name="fotoServico" required>
                            <div class="invalid-feedback">Por favor, selecione uma foto para o serviço.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nomeServico" placeholder="Nome do Serviço" name="nomeServico" required>
                            <label for="nomeServico">Nome do Serviço</label>
                            <div class="invalid-feedback">Por favor, insira o nome do serviço.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="descricaoServico" placeholder="Informe uma breve descrição sobre o Serviço" name="descricaoServico" style="height: 100px" required></textarea>
                            <label for="descricaoServico">Descrição do Serviço</label>
                            <div class="invalid-feedback">Por favor, insira uma descrição para o serviço.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="valorServico" placeholder="Valor do Serviço" name="valorServico" required>
                            <label for="valorServico">Valor do Serviço (R$):</label>
                            <div class="invalid-feedback">Por favor, insira o valor do serviço.</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Cadastrar Serviço</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>
