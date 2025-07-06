<?php

    // Servidor de Banco de Dados
    $host = "localhost";
    // Usuário do Banco de Dados
    $user = "root";
    // Senha do Banco de Dados 
    $senhaBD = "";
    // Nome da Base de dados 
    $database = "projeto_barbearia";

    // Função do PHP para estabelecer conexão com o Banco de Dados
    $conn = mysqli_connect($host, $user, $senhaBD, $database);

    if(!$conn){
        echo "<p>Erro ao tentar conectar à Base de Dados <strong>$dataBase</strong>!</p>";
    }


?>