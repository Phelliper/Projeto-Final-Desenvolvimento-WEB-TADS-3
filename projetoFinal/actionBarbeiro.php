<?php
include "header.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeBarbeiro = $especialidadeBarbeiro = $dataDisponivelBarbeiro = "";
    $erroPreenchimento = false;

    // Validação do nome
    if(empty($_POST["nomeBarbeiro"])) {
        echo "<div class='alert alert-warning text-center'>
                O campo <strong>NOME</strong> é obrigatório!
            </div>";
        $erroPreenchimento = true;
    } else {
        $nomeBarbeiro = testar_entrada($_POST["nomeBarbeiro"]);
    }

    // Validação da especialidade
    if(empty($_POST["especialidadeBarbeiro"])) {
        echo "<div class='alert alert-warning text-center'>
                O campo <strong>ESPECIALIDADE</strong> é obrigatório!
            </div>";
        $erroPreenchimento = true;
    } else {
        $especialidadeBarbeiro = testar_entrada($_POST["especialidadeBarbeiro"]);
    }

    // Validação da data
    if(empty($_POST["dataDisponivelBarbeiro"])) {
        echo "<div class='alert alert-warning text-center'>
                O campo <strong>DATA DISPONÍVEL</strong> é obrigatório!
            </div>";
        $erroPreenchimento = true;
    } else {
        $dataDisponivelBarbeiro = testar_entrada($_POST["dataDisponivelBarbeiro"]);
        // Verifica se a data é válida
        $data = DateTime::createFromFormat('Y-m-d', $dataDisponivelBarbeiro);
        if(!$data || $data->format('Y-m-d') !== $dataDisponivelBarbeiro) {
            echo "<div class='alert alert-warning text-center'>
                    <strong>DATA INVÁLIDA</strong>!
                </div>";
            $erroPreenchimento = true;
        }
    }

    if(!$erroPreenchimento) {
        // Inserção no banco de dados
        $inserirBarbeiro = "INSERT INTO barbeiros (nomeBarbeiro, especialidadeBarbeiro, dataDisponivelBarbeiro) 
                            VALUES ('$nomeBarbeiro', '$especialidadeBarbeiro', '$dataDisponivelBarbeiro')";

        include "conexaoBD.php";

        if(mysqli_query($conn, $inserirBarbeiro)) {
            echo "<div class='alert alert-success text-center'>
                    Barbeiro cadastrado com sucesso!
                </div>";

            // Exibe os dados cadastrados
            echo "<div class='container mt-3'>
                    <div class='table-responsive'>
                        <table class='table'>
                            <tr>
                                <th>NOME</th>
                                <td>$nomeBarbeiro</td>
                            </tr>
                            <tr>
                                <th>ESPECIALIDADE</th>
                                <td>$especialidadeBarbeiro</td>
                            </tr>
                            <tr>
                                <th>DATA DISPONÍVEL</th>
                                <td>" . date('d/m/Y', strtotime($dataDisponivelBarbeiro)) . "</td>
                            </tr>
                        </table>
                    </div>
                </div>";
        } else {
            echo "<div class='alert alert-danger text-center'>
                    Erro ao tentar cadastrar o barbeiro!
                </div>";
        }
    }
} else {
    header("location:formBarbeiro.php");
}

function testar_entrada($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}

include "footer.php";
?>