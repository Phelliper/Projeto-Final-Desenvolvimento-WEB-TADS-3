<!DOCTYPE html>
<html lang="pt-br">
    <?php
        //Configura o fuso horário para América/São Paulo
        date_default_timezone_set('America/Sao_Paulo');
    ?>
    <head>
        <title>Barbearia IFPR</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        
        <!-- Bootstrap CSS (já estava no seu projeto) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Core theme CSS (do template Small Business) -->
        <!-- Este arquivo 'styles.css' deve estar na pasta 'css/' do seu projeto,
             e é o CSS principal do template Small Business. -->
        <link href="css/styles.css" rel="stylesheet" /> 
        
        <!-- Seu CSS personalizado (mantido para estilos específicos) -->
        <link href="styleBarbearia.css" rel="stylesheet">

        <!-- CDNs para Máscaras JQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- CDN para Ícones do Bootrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        
        <!-- Script para máscara do telefone -->
        <script>
            $(document).ready(function(){
                $("#telefoneUsuario").mask("(00) 00000-0000");
            });
        </script>

    </head>
    <body>

        <?php
            error_reporting(0); //Desabilita reportagens de erros de execução
            session_start(); //Inicia sessão

            if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){ //Verifica se há sessão ativa
                $idUsuario    = $_SESSION['idUsuario'];
                $tipoUsuario  = $_SESSION['tipoUsuario'];
                $nomeUsuario  = $_SESSION['nomeUsuario'];
                $emailUsuario = $_SESSION['emailUsuario'];

                $nomeCompleto = explode(' ', $nomeUsuario); //Usa a função explode para segmentar a string onde houverem espaços ' '
                $primeiroNome = $nomeCompleto[0]; //Armazena a primeira string antes do espaço (primeiro nome)

            }
        ?>

        <!-- Responsive navbar (do template Small Business) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo.jpeg" alt="Logotipo" style='width: 40px; margin-right: 10px; border-radius: 50%;'>
                    Barbearia IFPR
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Início</a></li>
                        <?php
                            //Verifica se o tipo do usuário é 'administrador'
                            if($tipoUsuario == 'administrador'){
                                echo "
                                    <li class='nav-item'>
                                        <a class='nav-link' href='formServico.php'>Cadastrar Serviço</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='formBarbeiro.php'>Cadastrar Barbeiro</a>
                                    </li>
                                ";
                            }
                            //Verifica se o tipo do usuário é 'cliente'
                            if($tipoUsuario == 'cliente'){
                                echo "
                                    <li class='nav-item'>
                                        <a class='nav-link' href='visualizarAgenda.php'>Visualizar Agenda</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='visualizarBarbeiros.php'>Visualizar Barbeiros</a>
                                    </li>
                                ";
                            }
                            if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){ //Verifica se há sessão ativa
                                echo "
                                    <li class='nav-item'>
                                        <a class='nav-link' href='logout.php?pagina=formLogin'>Sair</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' style='color:lightblue'>Olá, <strong>$primeiroNome</strong>! <i class='bi bi-emoji-smile'></i></a>
                                    </li>
                                ";
                            }
                            else{
                                 echo "
                                    <li class='nav-item'>
                                        <a class='nav-link' href='formLogin.php?pagina=formLogin'>Login</a>
                                    </li>
                                ";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Conteúdo principal começa aqui. O template Small Business usa uma seção 'py-5' para o conteúdo. -->
        <!-- O 'container mt-5 mb-5' do seu projeto será mantido para envolver o conteúdo. -->
        <div class='container py-5'> 
