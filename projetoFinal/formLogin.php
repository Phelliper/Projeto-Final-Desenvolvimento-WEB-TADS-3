<?php include "header.php"; ?>

<div class="container px-5 my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="fw-light my-4">Acessar o Sistema</h3>
                </div>
                <div class="card-body p-4">
                    <?php
                        if(isset($_GET['erroLogin'])){
                            $erroLogin = $_GET['erroLogin'];

                            if($erroLogin == 'dadosInvalidos'){
                                echo "<div class='alert alert-warning text-center'><strong>USUÁRIO ou SENHA </strong>inválidos!</div>";
                            }
                            if($erroLogin == 'naoLogado'){
                                echo "<div class='alert alert-warning text-center'><strong>USUÁRIO</strong> não logado!</div>";
                            }
                            if($erroLogin == 'acessoProibido'){
                                //Redireciona para a página index.php
                                header('location:index.php');
                                exit(); // Adicionado exit() para garantir que o script pare após o redirecionamento
                            }
                        }
                    ?>

                    <form action="actionLogin.php" method="POST" class="needs-validation" novalidate>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="emailUsuario" placeholder="name@example.com" name="emailUsuario" required>
                            <label for="emailUsuario">Email</label>
                            <div class="invalid-feedback">Por favor, insira seu email.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="senhaUsuario" placeholder="Senha" name="senhaUsuario" required>
                            <label for="senhaUsuario">Senha</label>
                            <div class="invalid-feedback">Por favor, insira sua senha.</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small">
                        Ainda não possui cadastro? <a href="formUsuario.php" title="Cadastrar-se">Clique aqui!</a>&nbsp<i class="bi bi-emoji-smile"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>
