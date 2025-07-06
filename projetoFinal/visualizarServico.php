<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styleBarbearia.css">
</head>
<body>
<?php include "header.php"; ?>

<div class="container px-5 my-5">

    <?php
        if(isset($_GET['idServico'])){
            $idServico = $_GET['idServico'];

            include ("conexaoBD.php");

            $exibirServico = "SELECT * FROM servicos WHERE idServico = $idServico";
            $res = mysqli_query($conn, $exibirServico);
            $totalServicos = mysqli_num_rows($res);

            if($totalServicos > 0){
                if($registro = mysqli_fetch_assoc($res)){
                    $idServico = $registro["idServico"];
                    $fotoServico = $registro["fotoServico"];
                    $nomeServico = $registro["nomeServico"];
                    $descricaoServico = $registro["descricaoServico"];
                    $valorServico = $registro["valorServico"];
                    $statusServico = $registro["statusServico"];
                
                    // Consulta para obter os barbeiros disponíveis
                    $barbeirosQuery = "SELECT * FROM barbeiros";
                    $barbeirosResult = mysqli_query($conn, $barbeirosQuery);
                    ?>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-lg border-0 rounded-lg">
                                <div class="card-body p-4">
                                    <h2 class="card-title text-center mb-4"><?php echo htmlspecialchars($nomeServico); ?></h2>
                                    
                                    <?php if ($statusServico == 'esgotado'): ?>
                                        <div class="alert alert-danger text-center mb-4">
                                            <strong>Serviço Indisponível!</strong>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Carousel -->
                                    <div id="servicoCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#servicoCarousel" data-bs-slide-to="0" class="active"></button>
                                            <button type="button" data-bs-target="#servicoCarousel" data-bs-slide-to="1"></button>
                                            <button type="button" data-bs-target="#servicoCarousel" data-bs-slide-to="2"></button>
                                        </div>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="<?php echo htmlspecialchars($fotoServico); ?>" class="d-block w-100" alt="Imagem do Serviço" <?php if ($statusServico == 'esgotado') {echo "style='filter:grayscale(100%);'";} ?>>
                                            </div>
                                            <div class="carousel-item">
                                                <img src="<?php echo htmlspecialchars($fotoServico); ?>" class="d-block w-100" alt="Imagem do Serviço" <?php if ($statusServico == 'esgotado') {echo "style='filter:grayscale(100%);'";} ?>>
                                            </div>
                                            <div class="carousel-item">
                                                <img src="<?php echo htmlspecialchars($fotoServico); ?>" class="d-block w-100" alt="Imagem do Serviço" <?php if ($statusServico == 'esgotado') {echo "style='filter:grayscale(100%);'";} ?>>
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#servicoCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#servicoCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    
                                    <p class="lead"><?php echo htmlspecialchars($descricaoServico); ?></p>
                                    <p class="fs-4 fw-bold">Valor: R$ <?php echo number_format($valorServico, 2, ',', '.'); ?></p>

                                    <hr class="my-4">

                                    <?php
                                        if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
                                            if($_SESSION['tipoUsuario'] == 'cliente'){
                                                if($statusServico == 'disponivel'){
                                                    echo "
                                                        <h4 class='mb-3'>Agendar este Serviço:</h4>
                                                        <form action='efetuarAgendamento.php' method='POST' class='needs-validation' novalidate>
                                                            <input type='hidden' name='idServico' value='" . htmlspecialchars($idServico) . "'>
                                                            <input type='hidden' name='fotoServico' value='" . htmlspecialchars($fotoServico) . "'>
                                                            <input type='hidden' name='nomeServico' value='" . htmlspecialchars($nomeServico) . "'>
                                                            <input type='hidden' name='valorServico' value='" . htmlspecialchars($valorServico) . "'>
                                                            
                                                            <div class='form-floating mb-3'>
                                                                <select class='form-select' id='idBarbeiro' name='idBarbeiro' required>
                                                                    <option value=''>Selecione um barbeiro</option>";
                                                                    while($barbeiro = mysqli_fetch_assoc($barbeirosResult)) {
                                                                        echo "<option value='" . htmlspecialchars($barbeiro['idBarbeiro']) . "'>" . htmlspecialchars($barbeiro['nomeBarbeiro']) . "</option>";
                                                                    }
                                                    echo "      </select>
                                                                <label for='idBarbeiro'>Barbeiro:</label>
                                                                <div class='invalid-feedback'>Por favor, selecione um barbeiro.</div>
                                                            </div>
                                                            
                                                            <div class='form-floating mb-3'>
                                                                <input type='date' class='form-control' id='dataAgendamento' name='dataAgendamento' required min='" . date('Y-m-d') . "'>
                                                                <label for='dataAgendamento'>Data:</label>
                                                                <div class='invalid-feedback'>Por favor, selecione uma data.</div>
                                                            </div>
                                                            
                                                            <div class='form-floating mb-3'>
                                                                <input type='time' class='form-control' id='horaAgendamento' name='horaAgendamento' required>
                                                                <label for='horaAgendamento'>Hora:</label>
                                                                <div class='invalid-feedback'>Por favor, selecione um horário.</div>
                                                            </div>
                                                            
                                                            <div class='d-grid'>
                                                                <button type='submit' class='btn btn-primary btn-lg'>
                                                                    <i class='bi bi-calendar-plus'></i> Efetuar Agendamento
                                                                </button>
                                                            </div>
                                                        </form>
                                                    ";
                                                } else {
                                                    echo "
                                                        <div class='alert alert-secondary text-center'>
                                                            Serviço indisponível para agendamento no momento. <i class='bi bi-emoji-frown'></i>
                                                        </div>
                                                    ";
                                                }
                                            } else { // Se for administrador
                                                echo "
                                                    <div class='d-grid'>
                                                        <a href='formEditarServico.php?idServico=" . htmlspecialchars($idServico) . "' class='btn btn-outline-primary btn-lg'>
                                                            <i class='bi bi-pencil-square'></i> Editar Serviço
                                                        </a>
                                                    </div>
                                                ";
                                            }
                                        } else { // Se não estiver logado
                                            echo "
                                                <div class='alert alert-info text-center'>
                                                    <p class='mb-0'>Acesse o sistema para poder realizar seu agendamento.</p>
                                                    <a href='formLogin.php' class='alert-link'>
                                                        <i class='bi bi-person'></i> Fazer Login
                                                    </a>
                                                </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo("<div class='alert alert-danger text-center'>Serviço não localizado!</div>");
            }
        } else {
            echo("<div class='alert alert-danger text-center'>Não foi possível carregar o Serviço! ID não fornecido.</div>");
        }
    ?>

</div>

<?php include "footer.php" ?>
</body>
</html>
