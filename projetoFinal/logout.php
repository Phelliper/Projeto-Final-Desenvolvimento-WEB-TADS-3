<?php
    session_start(); // Inicia a sessão
    session_unset(); // Remove todas as variáveis de sessão
    session_destroy(); // Destrói a sessão

    // Redireciona o usuário para a página de login após o logout
    header('location:formLogin.php?pagina=formLogin');
    exit(); // Garante que o script pare de executar após o redirecionamento
?>
