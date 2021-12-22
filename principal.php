<?php
//$acao = 'recuperar';
//require '../cadastrogeral/tarefa_controller.php';
include'classes/conexao.php';
require_once 'classes/usuarios.php';

    session_start();
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }
    $user = $_SESSION["id_user"];
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Antonio Costa dos Santos">
    <title>CENSO - Central de Solicitações</title>
    <link rel="shortcut icon" href="favicon.ico">

    <!-- preload dos css -->
    <link rel="preload" href="css/style.css" as="style">
    <link rel="preload" href="css/principal.css" as="style">
    <!-- css preload fim -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/principal.css">
</head>
<body>
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .loader{
            display: block;
            height: 36px;
            background-image: url("imgs/preload.gif");
            width: 275px;
            background-repeat: no-repeat;
            background-size: cover;
            margin-left: 13px;
        }
        .ajuste {
            display: block;
            text-align: center;
        }
        /* .loader::after{
            content: "";
            display: block;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            border: 6px solid #fff;
            border-color: #fff transparent #fff transparent;
            margin: 0px;
            animation: spin 1.2s ease infinite;
        } */
        /* @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        } */
    </style>
    
    <div class="overlay">
        <div class="ajuste">
        <class class="loader"></class>
        <h3>Carregando...</h3>
        </div>
        
    </div>
    <script type="">
        //preloader
        const overlay = document.querySelector(".overlay");
        // quando a pagina for carregada, o overlay será desabilitado
        window.addEventListener("load", function(){
            setTimeout(function(){
                overlay.style.display = "none";
            }, 300);
            
        })
    </script>
    <main>

    <?php 
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
                
        $permissao_ADM = $dados['adm'];
        $permissao_AMX = $dados['patrimonio_adm'];
        $perm_gestor = $dados['gvend'];
        $nome = $dados['nome'];
        
    ?>
    <div class="container">
        <div class="navegacao">
            <ul>
                <li>
                    <a href="#" title="CENSO - Central de Solicitações">
                    <img src="imgs/CENSO.png" id="logo">
                
                    </a>
                </li>
                <li>
                    <a href="principal.php?p=conteudo.php"  title="Dashboard" >
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="title">
                            Dashboard 
                        </span>
                    </a>
                </li>
                <script>
                    function abrir(){
                        janela =  window.open("estrutura/buscar_ferramenta.php", "", "location=0,menubar=0,status=no,scrollbars=0,width=800,height=400,left="  + (document.documentElement.clientWidth - 800) / 2 + ",top=" + (document.documentElement.clientHeight - 600) / 2);
                    }
                   
                </script>
                <li>
                    <a href="principal.php?p=perfil.php" title="Meus dados" >
                        <span class="icon"><i class="fas fa-id-card"></i></span>
                        <span class="title" >
                            Meus dados
                        </span>
                    </a>
                 
                </li>
                <li>
                    <a href="principal.php?p=graficos.php" title="Meus dados">
                        <span class="icon"><i class="fas fa-chart-line"></i></span>
                        <span class="title" >
                            Ranking
                        </span>
                    </a>
                </li>
                <li>
                    <a href="principal.php?p=metas/quadro_atual.php" title="Metas gerais">
                        <span class="icon"><i class="fas fa-calendar-check"></i></span>
                        <span class="title" >
                            Metas
                        </span>
                    </a>
                </li>
                <!-- menu vendas -->
                <li>
                    <a href="principal.php?p=vendas.php" title="Vendas" >
                        <span class="icon"><i class="fas fa-tags"></i></span>
                        <span class="title" >
                            Vendas
                        </span>
                    </a>
                 
                </li>
                <!-- solicitações -->
                <li>
                    <a href="principal.php?p=solicitacoes.php" title="Solicitações">
                    <span class="icon"><i class="fas fa-people-arrows"></i></span>
                    <span class="title">
                        Solicitações
                    </span>
                    </a>
                </li>
                <!-- observações -->
                <li>
                    <a href="principal.php?p=metas/observacoes.php" title="Observações">
                    <span class="icon"><i class="fas fa-eye"></i></span>
                    <span class="title">
                        Observações
                    </span>
                    </a>
                </li>
                <!-- menu monitoramento -->
                <li>
                    <a href="principal.php?p=monitoramento.php" title="Monitoramento" >
                        <span class="icon"><i class="fas fa-bullseye"></i></span>
                        <span class="title" >
                            Monitoramento
                        </span>
                    </a>
                </li>
                <?php
                //menus chaveiro
                if ($permissao_AMX == "S") {
                echo 
                "<li>
                    <a href='principal.php?p=patrimonio.php&c=patrimonio_chart.php' title='Patrimônio'>
                    <span class='icon'><i class='fas fa-balance-scale-left'></i></span>
                        <span class='title'>
                            Patrimônio  
                        </span>
                    </a>
                </li>";
                }
                ?>
                <!-- <span class='atention'>Atenção</span> -->
                <?php
                if ($permissao_ADM == "S" AND $permissao_AMX == "S") {
                echo 
                "<li>
                    <a href='principal.php?p=administracao.php&c=adm_chart.php' title='Administração'>
                    <span class='icon'><i class='fas fa-user-cog'></i></span>
                        <span class='title'>
                            Administração
                        </span>
                    </a>
                </li>";
                }
                ?>
                <li>
                    <a href='principal.php?p=treinamentos/aulas.php' title='Treinamentos'>
                    <span class='icon'><i class="fas fa-graduation-cap"></i></span>
                        <span class='title'>
                            Treinamentos
                        </span>
                    </a>
                </li>
                <?php
                if ($permissao_ADM == 'S'){
                    echo "<li>
                    <a href='principal.php?p=relatorios/relatorios.php' title='Relatórios'>
                    <span class='icon'><i class='fas fa-clipboard-list'></i></span>
                        <span class='title'>
                            Relatórios
                        </span>
                    </a>
                </li>";
                }
                ?>
                <li>
                    <a href="estrutura/sair.php" title="Sair">
                    <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="title">
                        Sair 
                    </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main">
            <div class="topbar">
                <div class="toggle" onclick="menufecha();"></div>
                <div class="buscar">

                    <!-- fim buscar -->
                    <label for="">
                        
                        <div class="dropdown">
                            <div id="myDropdown" class="dropdown-content">
                                <input type="text" placeholder="Buscar opção .." id="myInput" onkeyup="filterFunction()">
                                    <a href="principal.php?p=solicitacoes.php">Solicitações</a>
                                    <a href="principal.php?p=vendas.php">Filas</a>
                                    <a href="https://site.cas.net.br/adm.php" target="_blank">IXC soft</a>
                                    <a href="principal.php?p=chaveiro/chaveiros.php">Chaveiro</a>
                                    <a href="principal.php?p=../classes/cadastro_fisica.php">Cadastrar Cliente - Física</a>
                                    <a href="principal.php?p=../classes/cadastro_fisica.php">Cadastrar Cliente - Jurídica</a>
                                    <a href="principal.php?p=solicitacoes/solicitar.php">Solicitar serviço</a>
                                    <?php
                                    if ($permissao_AMX == "S") {
                                    echo '
                                    <a href="principal.php?p=buscar_ferramenta.php">Ferramentas</a>
                                    <a href="principal.php?p=automoveis.php">Frota</a>
                                    ';}
                                    ?>
                                    
                                    <a href="https://www.site.cas.net.br/central_assinante_web/login" target="_blank">Central do assinante</a>
                            </div>
                        </div>
                        <label style="color: white;" for=""><?=$nome?></label>
                    </label>
                    
                </div>
                <div class="user">
                    <a href="#" onclick="myFunction()" ><img id="format_img" src="imgs/LUPA.png"></a>
                </div>
            </div>
            <!--fim detalhe-->
            <?php 
            $pagina = $_GET["p"];
            include "estrutura/$pagina"; 
            ?>
            <!--fim detalhe-->
        </div>

    </div>
<?php 
   }
}
?>
<!-- schip do menu pesquisar -->


<script>
    // funcção do drop das vendas
// function myAccFunc() {
//     var x = document.getElementById("demoAcc");
//     if (x.className.indexOf("w3-show") == -1) {
//         x.className += " w3-show";
//         x.previousElementSibling.className += " w3-green";
//     } else { 
//         x.className = x.className.replace(" w3-show", "");
//         x.previousElementSibling.className = 
//         x.previousElementSibling.className.replace(" w3-green", "");
//     }
//     }
//     // função do drop dos dados
//     function mDados() {
//     var x = document.getElementById("mDados");
//     if (x.className.indexOf("w3-show") == -1) {
//         x.className += " w3-show";
//         x.previousElementSibling.className += " w3-green";
//     } else { 
//         x.className = x.className.replace(" w3-show", "");
//         x.previousElementSibling.className = 
//         x.previousElementSibling.className.replace(" w3-green", "");
//     }
//     }
    
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
</script>

<!-- <style>
        
        .w3-light-grey, .w3-hover-light-grey:hover, .w3-light-gray, .w3-hover-light-gray:hover {
            color: #000!important;
            background-color: #f1f1f1!important;
        }
        .w3-card, .w3-card-2 {
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }
        .w3-sidebar {
            height: 100%;
            width: 200px;
            background-color: #fff;
            position: fixed!important;
            z-index: 1;
            overflow: auto;
        }
        .w3-hide{
            display:none!important
        }
        .w3-show-block,.w3-show{
            display:block!important
        }
        .w3-show-inline-block{
            display:inline-block!important
        }
        .w3-bar-block .w3-bar-item {
            width: 100%;
            display: block;
            padding: 5px 16px;
            text-align: left;
            border: none;
            white-space: normal;
            float: none;
            outline: 0;
        }
        .w3-block {
            display: block;
            width: 100%;
        }
        .w3-left-align {
            text-align: left!important;
        }
        .w3-btn, .w3-button {
            border: none;
            border-top: 1px solid white;
            display: inline-block;
            padding: 5px 16px;
            vertical-align: middle;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            background-color: dodgerblue;
            text-align: center;
            cursor: pointer;
            white-space: nowrap;
        }
        .w3-button:hover {
            background-color: white;
            color: black;
        }
    </style> -->

<script src="js/scripts.js"></script>

    <script>
        function menufecha() {
            var toggle = document.querySelector('.toggle');
            var navegacao = document.querySelector('.navegacao');
            var main = document.querySelector('.main');
            toggle.classList.toggle('active');
            navegacao.classList.toggle('active');
            main.classList.toggle('active');

        }
    </script>
    </main>
</body>
</html>