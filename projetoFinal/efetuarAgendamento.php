<?php include ("header.php")?>

<div class='container px-5 my-5'>

    <?php
        // session_start(); // Removido, pois já é chamado em header.php

        if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){

            if (isset($_POST['idServico']) && isset($_POST['idBarbeiro'])){
                // Captura os dados do formulário
                $idUsuario = $_SESSION['idUsuario']; // Pega o idUsuario da sessão
                $idServico = $_POST['idServico'];
                $idBarbeiro = $_POST['idBarbeiro'];
                $nomeServico = $_POST['nomeServico'];
                $valorServico = $_POST['valorServico'];
                $dataAgendamento = $_POST['dataAgendamento']; // Data selecionada pelo usuário
                $horaAgendamento = $_POST['horaAgendamento']; // Hora selecionada pelo usuário

                // Inclui o arquivo de conexão com banco de dados
                include("conexaoBD.php");

                // Query para inserir o agendamento na tabela agenda
                $efetuarAgendamento = "INSERT INTO agenda 
                    (idUsuario, idBarbeiro, idServico, dataAgendamento, horaAgendamento, valorTotal, statusAgenda) 
                    VALUES 
                    ($idUsuario, $idBarbeiro, $idServico, '$dataAgendamento', '$horaAgendamento', $valorServico, 'agendado')";

                if (mysqli_query($conn, $efetuarAgendamento)){
                    echo "
                        <div class='alert alert-success text-center py-4'>
                            <h4 class='alert-heading'>Agendamento Realizado com Sucesso!</h4>
                            <p>Você agendou <strong>" . htmlspecialchars($nomeServico) . "</strong> com sucesso para <strong>" . date('d/m/Y', strtotime($dataAgendamento)) . "</strong> às <strong>" . htmlspecialchars($horaAgendamento) . "</strong>!</p>
                            <hr>
                            <p class='mb-0'>Aguardamos você!</p>
                            <i class='bi bi-emoji-smile fs-3 mt-2'></i>
                            <br><br>
                            <a href='visualizarAgenda.php' class='btn btn-primary btn-lg mt-3'>Ver meus agendamentos</a>
                        </div>
                    ";
                }
                else {
                    echo "
                        <div class='alert alert-danger text-center py-4'>
                            <h4 class='alert-heading'>Erro ao Agendar o Serviço!</h4>
                            <p>Ocorreu um erro ao tentar agendar o serviço: " . mysqli_error($conn) . "</p>
                            <hr>
                            <p class='mb-0'>Por favor, tente novamente mais tarde.</p>
                            <i class='bi bi-emoji-frown fs-3 mt-2'></i>
                            <br><br>
                            <a href='index.php' class='btn btn-secondary btn-lg mt-3'>Voltar para serviços</a>
                        </div>
                    ";
                }
            }
            else {
                echo "
                    <div class='alert alert-warning text-center py-4'>
                        <h4 class='alert-heading'>Dados Incompletos!</h4>
                        <p>Dados incompletos para realizar o agendamento.</p>
                        <hr>
                        <p class='mb-0'>Por favor, retorne e preencha todos os campos necessários.</p>
                        <i class='bi bi-exclamation-triangle fs-3 mt-2'></i>
                        <br><br>
                        <a href='index.php' class='btn btn-primary btn-lg mt-3'>Voltar para serviços</a>
                    </div>
                ";
            }
        }
        else {
            // Se o usuário não estiver logado, redireciona para a página inicial ou de login
            header('location:index.php');
            exit();
        }
    ?>

</div>

<?php include("footer.php")?>
