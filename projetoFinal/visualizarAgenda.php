<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styleBarbearia.css">
</head>
<body>
<?php include("header.php");?>

<div class='container px-5 my-5'>

    <h2 class="text-center mb-4">Meus Agendamentos</h2>

    <?php
        // session_start(); // Removido, pois já é chamado em header.php

        // Processar cancelamento se houver requisição POST
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancelar_agendamento'])) {
            include("conexaoBD.php");
            $idAgendamento = $_POST['idAgendamento'];
            
            // Atualizar status para 'cancelado' em vez de deletar (melhor para histórico)
            $cancelarQuery = "UPDATE agenda SET statusAgenda = 'cancelado' WHERE idAgendamento = $idAgendamento AND idUsuario = {$_SESSION['idUsuario']}";
            
            if(mysqli_query($conn, $cancelarQuery)) {
                echo "<div class='alert alert-success text-center'>Agendamento cancelado com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Erro ao cancelar agendamento: ".mysqli_error($conn)."</div>";
            }
        }

        //Verifica se há sessão iniciada
        if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
            $idUsuario   = $_SESSION['idUsuario'];
            $tipoUsuario = $_SESSION['tipoUsuario'];
            
            if($tipoUsuario == 'cliente'){
                //Query para listar TODOS os registros da tabela agenda onde possuir o id do usuario logado
                $mostrarAgenda = "
                    SELECT
                        agenda.idAgendamento,
                        agenda.dataAgendamento,
                        agenda.horaAgendamento,
                        agenda.valorTotal,
                        agenda.statusAgenda,
                        servicos.nomeServico,
                        servicos.descricaoServico,
                        servicos.fotoServico,
                        barbeiros.nomeBarbeiro
                    FROM agenda 
                    INNER JOIN servicos ON agenda.idServico = servicos.idServico
                    INNER JOIN barbeiros ON agenda.idBarbeiro = barbeiros.idBarbeiro
                    WHERE agenda.idUsuario = $idUsuario AND agenda.statusAgenda != 'cancelado'
                    ORDER BY agenda.dataAgendamento DESC, agenda.horaAgendamento DESC;
                ";

                include("conexaoBD.php");
                $res = mysqli_query($conn, $mostrarAgenda) or die("Erro ao tentar mostrar agenda");
                $totalAgenda = mysqli_num_rows($res); //Captura o total de registros retornados pela query

                echo "<div class='alert alert-info text-center'> Você possui <strong>$totalAgenda</strong> agendamentos!</div>";

                if($totalAgenda > 0){
                    //Montar o cabeçalho da tabela para exibir os registros 
                    echo"
                        <div class='table-responsive'>
                            <table class='table table-striped table-hover'>
                                <thead class='table-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>SERVIÇO</th>
                                        <th>BARBEIRO</th>
                                        <th>DATA</th>
                                        <th>HORA</th>
                                        <th>VALOR</th>
                                        <th>STATUS</th>
                                        <th>AÇÃO</th>
                                    </tr>
                                </thead>
                                <tbody>
                    ";
                    
                    //Enquanto houver registros, executa a função para armazenar nas variáveis
                    while($registro = mysqli_fetch_assoc($res)){
                        //Formatando a data para exibição
                        $dataFormatada = date('d/m/Y', strtotime($registro['dataAgendamento']));
                        $horaFormatada = date('H:i', strtotime($registro['horaAgendamento']));
                        
                        //Determinando a cor do status
                        $statusClass = '';
                        switch(strtolower($registro['statusAgenda'])){
                            case 'agendado': $statusClass = 'text-primary'; break;
                            case 'confirmado': $statusClass = 'text-success'; break;
                            case 'cancelado': $statusClass = 'text-danger'; break;
                            case 'concluído': $statusClass = 'text-secondary'; break;
                            default: $statusClass = 'text-dark';
                        }

                        //exibe no corpo da tabela os valores armazenados nas variáveis 
                        echo "
                            <tr>
                                <td>" . htmlspecialchars($registro['idAgendamento']) . "</td>
                                <td>
                                    <img src='" . htmlspecialchars($registro['fotoServico']) . "' title='" . htmlspecialchars($registro['nomeServico']) . "' style='width:50px; height:50px; object-fit:cover; border-radius:50%;' class='me-2'>
                                    " . htmlspecialchars($registro['nomeServico']) . "
                                </td>
                                <td>" . htmlspecialchars($registro['nomeBarbeiro']) . "</td>
                                <td>" . htmlspecialchars($dataFormatada) . "</td>
                                <td>" . htmlspecialchars($horaFormatada) . "</td>
                                <td>R$ " . number_format($registro['valorTotal'], 2, ',', '.') . "</td>
                                <td class='$statusClass'><strong>" . htmlspecialchars($registro['statusAgenda']) . "</strong></td>
                                <td>
                                    <form method='POST' action='visualizarAgenda.php' onsubmit='return confirm(\"Tem certeza que deseja cancelar este agendamento?\");'>
                                        <input type='hidden' name='idAgendamento' value='" . htmlspecialchars($registro['idAgendamento']) . "'>
                                        <button type='submit' name='cancelar_agendamento' class='btn btn-danger btn-sm' " . ($registro['statusAgenda'] == 'cancelado' ? 'disabled' : '') . ">
                                            <i class='bi bi-x-circle'></i> Cancelar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        ";
                    }
                    
                    echo "
                                </tbody>
                            </table>
                        </div>
                    ";
                } else {
                    echo "<div class='alert alert-warning text-center'>Nenhum agendamento encontrado.</div>";
                }
            } else {
                // Se não for cliente, redireciona para a página inicial
                header('location:index.php');
                exit();
            }
        } else {
            // Se não estiver logado, redireciona para a página inicial
            header('location:index.php');
            exit();
        }
    ?>

</div>

<?php include("footer.php");?>
</body>
</html>
