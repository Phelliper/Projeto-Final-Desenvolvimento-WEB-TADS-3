<?php
include "validarSessao.php";
include "header.php";

    //Verifica o método de requiseção do servidor
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Bloco para declaração de variáveis
        $fotoServico = $nomeServico = $descricaoServico = $valorServico = "";
        $erroPreenchimento = false;

        //Validação do campo nomeServico
        //Utiliza a função empty para verificar se o campo está vazio 
        if(empty($_POST["nomeServico"])){
            echo "<div class='alert alert-warning text-center'>
                O campo <strong>NOME DO SERVIÇO</strong> é obrigatório!
            </div>";
            $erroPreenchimento = true;


        }
        else{
            //Armazena o valor na variável
            $nomeServico = testar_entrada($_POST["nomeServico"]);
            //Usa a função preg_match para verificar o padrão de caracteres
        }

         //Validação do campo descricaoServico
        //Utiliza a função empty para verificar se o campo está vazio 
        if(empty($_POST["descricaoServico"])){
            echo "<div class='alert alert-warning text-center'>
                O campo <strong>DESCRIÇÃO DO SERVIÇO</strong> é obrigatório!
            </div>";
            $erroPreenchimento = true;


        }
        else{
            //Armazena o valor na variável
            $descricaoServico = testar_entrada($_POST["descricaoServico"]);
        }

         //Validação do campo valorServico
        //Utiliza a função empty para verificar se o campo está vazio 
        if(empty($_POST["valorServico"])){
            echo "<div class='alert alert-warning text-center'>
                O campo <strong>VALOR DO SERVIÇO</strong> é obrigatório!
            </div>";
            $erroPreenchimento = true;


        }
        else{
            //Armazena o valor na variável
            $valorServico = testar_entrada($_POST["valorServico"]);
        }

        //Início da validação do campo FOTO
        $diretorio    = "img/"; //Define para qual diretório do sistema as imagens serão movidas
        $fotoServico  = $diretorio . basename($_FILES["fotoServico"]["name"]); 
        $erroUpload   = false; //variável para verificar erros no upload
        $tipoDaImagem = strtolower(pathinfo($fotoServico, PATHINFO_EXTENSION));
        //Converter para minúsculo e adquirir a extensão do arquivo

        //Verificar se o tamanho do arquivo é maior do que zero 
        if ($_FILES['fotoServico']['size'] != 0){
            
            //Verificar se o tamanho do arquivo é maior do que 5MB (Em Byter)

            if ($_FILES['fotoServico']['size'] > 5000000){
                echo "<div class='alert alert-warning text-center'>
               A <strong>FOTO</strong> não deve possuir mais do que 5MB!
            </div>";
            $erroUpload = true;
            }

            //Verificar o tipo do arquivo (pela extensão)
            if ($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp"){
                echo "<div class='alert alert-warning text-center'>
                A <strong>FOTO</strong> deve estar no formato JPG, JPEG, PNG ou WEBP!
            </div>";
            $erroUpload = true;
            }

           //Verifica se houve algum erro no upload
           if ($erroUpload){
            echo "<div class='alert alert-warning text-center'>
                Erro ao tentar fazer o upload da <strong>FOTO</strong>!
            </div>";
            $erroUpload = true;
           }
           else {
                //Usa a função move_uploaded_file para mover o arquivo para o diretório img
                if(!move_uploaded_file($_FILES['fotoServico']['tmp_name'], $fotoServico)){
                    echo "<div class='alert alert-warning text-center'>
                    Erro ao tentar mover a <strong>FOTO</strong> para o diretório $diretorio!
                </div>";
            $erroUpload = true;

            }

           }
        }
        // Se não houver erro de preenchimento ou erro de upload
        if(!$erroPreenchimento && !$erroUpload){

            // Criar uma QUERY responsável por realizar a inserção dos dados do Banco de Dados
            $inserirServico = "INSERT INTO servicos (fotoServico, nomeServico, descricaoServico, valorServico, statusServico) 
                                VALUES ('$fotoServico', '$nomeServico', '$descricaoServico', '$valorServico', 'disponivel') ";

            // Inclui o arquivo de conexão com o Banco de Dados
            include "conexaoBD.php";

            // Se a query for executada com sucesso, exibe mensagem e tabela
            if(mysqli_query($conn, $inserirServico)){

                echo "<div class='alert alert-success text-center'>
               Serviço cadastrado com sucesso!
            </div>";

            echo"<div class='container mt-3'>
                    <div class='mt-3 text-center'>
                        <img src='$fotoServico' style= 'width:200px' title = 'Foto de $nomeServico'>
                    </div>
                    <div class='table-responsive'>
                        <table class='table'>
                            <tr>
                                <th>NOME</th>
                                <td>$nomeServico</td>
                            </tr>
                            <tr>
                                <th>DESCRIÇÃO</th>
                                <td>$descricaoServico</td>
                            </tr>
                            <tr>
                                <th>VALOR</th>
                                <td>$valorServico</td>
                            </tr>
                           
                    </div>
                </div>";

            } 
            // Se não conseguir inserir dados do Usuário na base de dados, emite alerta dnager 
            else {
                echo "<div class='alert alert-danger text-center'>
               Erro ao tentar inserir dados do Servico na base de dados!
            </div>";
            }
        }

        
    }
    else{
        //Redireciona para a página formServicos.php
        header("location:formServico.php");

    }

    function testar_entrada($dado){
        $dado = trim($dado); //TRIM - Remove espaços desnecessários
        $dado = stripcslashes($dado); //Remove barras invertidas
        $dado = htmlspecialchars($dado); //Converte caracteres especiais 

        return($dado); //Retorna a variável filtrada
    }
include "footer.php";
?>