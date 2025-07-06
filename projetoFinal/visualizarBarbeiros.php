<?php
include "conexaoBD.php";
include "header.php";

// Consulta para buscar todos os barbeiros cadastrados
$buscarBarbeiros = "SELECT * FROM barbeiros ORDER BY nomeBarbeiro";
$resultado = mysqli_query($conn, $buscarBarbeiros);

?>

<div class="container px-5 my-5">
    <h2 class="text-center mb-4">Barbeiros Cadastrados</h2>
    
    <?php
    // Verifica se existem barbeiros cadastrados
    if(mysqli_num_rows($resultado) > 0) {
    ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Especialidade</th>
                        <th>Data Disponível</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop para exibir cada barbeiro
                    while($barbeiro = mysqli_fetch_assoc($resultado)) {
                        // Formata a data para o padrão brasileiro
                        $dataFormatada = date('d/m/Y', strtotime($barbeiro['dataDisponivelBarbeiro']));
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($barbeiro['idBarbeiro']); ?></td>
                            <td><?php echo htmlspecialchars($barbeiro['nomeBarbeiro']); ?></td>
                            <td><?php echo htmlspecialchars($barbeiro['especialidadeBarbeiro']); ?></td>
                            <td><?php echo htmlspecialchars($dataFormatada); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {
        // Mensagem caso não existam barbeiros cadastrados
        echo '<div class="alert alert-info text-center">Nenhum barbeiro cadastrado no momento.</div>';
    }
    ?>
    
    <div class="text-center mt-4">
        <a href="formBarbeiro.php" class="btn btn-primary btn-lg">Cadastrar Novo Barbeiro</a>
    </div>
</div>

<?php
include "footer.php";
?>
