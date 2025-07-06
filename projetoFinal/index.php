<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styleBarbearia.css">
</head>
<body>
<?php include "header.php"; ?>

        <!-- Conteúdo principal da página -->
        <section class="py-5">
            <div class="container px-5 my-5">

                <?php
                    //Inclui o arquivo de conexão com o banco de Dados
                    include("conexaoBD.php");

                    $listarServicos = "SELECT * FROM servicos"; // Query para selecionar todos os campos da tabela
                    
                    //PHP para trabalhar o filtro 
                    if (isset($_GET["filtroServico"])){
                        $filtroServico = $_GET["filtroServico"];

                        if ($filtroServico != "todos"){
                            $listarServicos = $listarServicos . " WHERE statusServico LIKE '$filtroServico'";
                        }

                        switch($filtroServico){
                            case "todos" : $mensagemFiltro = "no total";
                            break;

                            case "disponivel" : $mensagemFiltro = "disponíveis";
                            break;

                            case "esgotado" : $mensagemFiltro = "esgotados";
                            break;
                        }
                    }
                    else{
                        $mensagemFiltro = "no total";
                    }

                    $res = mysqli_query($conn, $listarServicos); // Executa a query
                    $totalServicos = mysqli_num_rows($res); // Retorna a quantidade de registros 

                    if ($totalServicos > 0 ){
                        if ($totalServicos == 1 ){
                            echo "<div class ='alert alert-info text-center'> Há <strong>$totalServicos</strong> serviço $mensagemFiltro!</div>";
                        }
                        else {
                            echo "<div class ='alert alert-info text-center'> Há <strong>$totalServicos</strong> serviços $mensagemFiltro!</div>";
                        }
                    }
                    else {
                        echo "<div class ='alert alert-info text-center'> Não há serviços cadastrados nesse sistema!</div>";
                    }

                    echo "
                    <form name='formFiltro' action='index.php' method='GET' class='mb-4'>
                        <div class='form-floating mb-3'>
                            <select class='form-select' name='filtroServico' id='filtroServico' required>
                                <option value='todos'"; if(isset($filtroServico) && $filtroServico == 'todos'){echo "selected";}; echo ">Visualizar todos os Serviços</option>
                                <option value='disponivel'"; if (isset($filtroServico) && $filtroServico == 'disponivel'){echo "selected";}; echo ">Visualizar apenas Serviços disponíveis</option>
                                <option value='esgotado'"; if (isset($filtroServico) && $filtroServico == 'esgotado'){echo "selected";}; echo ">Visualizar apenas Serviços indisponíveis</option>
                            </select>
                            <label for='filtroServico'>Selecione um Filtro</label>
                        </div>
                        <button type='submit' class='btn btn-primary float-end'><i class='bi bi-funnel'></i> Filtrar Serviços</button>
                        <div class='clearfix'></div> <!-- Para limpar o float -->
                    </form>
                    ";
                ?>
                <hr class="my-4">

                <div class="row gx-5">
                    <?php
                        //Aqui ficará o loop para listar os registros 
                        while($registro = mysqli_fetch_assoc($res)){
                            $idServico = $registro["idServico"];
                            $fotoServico = $registro["fotoServico"];
                            $nomeServico = $registro["nomeServico"];
                            $descricaoServico = $registro["descricaoServico"];
                            $valorServico = $registro["valorServico"];
                            $statusServico = $registro["statusServico"];

                            echo"
                                <div class='col-lg-4 col-md-6 mb-5'>
                                    <div class='card h-100 shadow border-0'>
                                        <a href='visualizarServico.php?idServico=$idServico' style='text-decoration:none;' title='Visualizar Serviço $nomeServico'>
                                            <img class='card-img-top' src='$fotoServico' alt='Foto de $nomeServico' "; 
                                            if ($statusServico == 'esgotado'){echo "style='filter:grayscale(100%);'";} 
                                            echo ">
                                        </a>
                                        <div class='card-body p-4'>
                                            <h5 class='card-title mb-3'>$nomeServico</h5>
                                            <p class='card-text mb-0'>Valor: <b>R$ " . number_format($valorServico, 2, ',', '.') . "</b></p>
                                            <p class='card-text text-muted small'>$descricaoServico</p>
                                        </div>
                                        <div class='card-footer p-4 pt-0 bg-transparent border-top-0'>
                                            <div class='d-grid'>
                                                <a class='btn btn-primary' href='visualizarServico.php?idServico=$idServico' style='text-decoration:none;' title='Visualizar $nomeServico'>
                                                    Visualizar Serviço
                                                </a>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                    ?>
                </div>
            </div>
        </section>

<?php include "footer.php" ?>
</body>
</html>
