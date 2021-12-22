<?php
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }
    $nome_fun = $_GET['pg'];
    $user = $_SESSION["id_user"];
    $mes = date('m');
    $ano = date('Y');

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
    $stmt->execute();
        while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
            $adm = $dados['adm'];
            $gvend = $dados['gvend'];
            $supervend = $dados['supervend'];
            $vend = $dados['vend']; 
            $id = $dados['id'];
            $venda_meta = $dados['venda_meta'];
            $os_meta = $dados['os_meta'];}
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CENSO - Dashboard</title>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>

<script src="js/cdn_data.js"></script>
<link rel="preload" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<style>
    .form {
    margin: 10px 0 0 0;
    background: white;
    border: 1px solid black;
    border-radius: 5px;
    outline: none;
    padding: 5px;
    width: 100%;
}
.cardheade {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
}
h3 {
    padding: 5px 15px;
}
#att {
    position: relative;
    padding: 5px 10px;
    background: cornflowerblue;
    color: white;
    cursor: pointer;
    text-decoration: none;
    margin-left: 5px;
}
input[type="submit"]{
    display: none;
}
</style>
<?php
$filas = $pdo->prepare("SELECT * FROM cidades WHERE sigla = '$cid_sigla'");
$filas->execute();
    while($fila_ass = $filas->fetch(PDO::FETCH_ASSOC)){
        $nome_cidade = $fila_ass['cidade'];
    }
    
?>


            <!--detalhe-->
            <div class="detalhes" style=" grid-template-columns: 1fr; ">
                <div class="recentesobs">
                    <div class="cardheade" >
                        <h3>Vendas <?=$nome_fun?></h3>
                        <form action="" method="POST">
                            <div class="cardheade">
                                <h3>CPF:</h3>
                                <input class="form" type="text" name="cpf">
                                <label id="att" for="attu" class="botao" value="button">Buscar</label>
                                <input type="submit" id="attu" value="Pesquisar" name="Pesquisar">
                                </div>
                        </form>
                    </div>
                   
                   
                </div>
                
            </div>

            <!--detalhe-->
            <div class="detalhes_frota" >
                <div class="recentesobs_frota" >
                   
                    <?php 
                                $pagina = $_GET["v"];
                                include "$pagina"; 
                    ?>
                </div>
                
            </div>


<style>
.dropbtn {
    color: black;
    padding: 5px 15px;
    font-size: 14px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}
.botao_ops {
    background: turquoise;
}

.listar_acoes {
  display: none;
  position: absolute;
  min-width: 160px;
  width: max-content;
  border-radius: 10px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 3;
}
.listar_acoes a:active {
    border-radius: 5px;
}

.listar_acoes a {
    text-align: left;
    background-color: rgb(13, 127, 233);
    color: white;
    border-radius: 10px;
    padding: 2px 7px;
    font-size: small;
    text-decoration: none;
    display: block;
}
.listar_acoes a:hover {
    color: black;
}
.dropdown:hover .listar_acoes {
  display: block;
  background-color: rgb(13, 127, 233);
  right: 0;
  border-radius: 10px;
}
.filas {
    min-width: 1000px;
    border: none;
    margin-top: 10px;
}
.alinhar{
    text-align: left;
}
.link_venda:hover{
    color: white;
}
.detalhes .recentesobs{
    margin-top: 20px;
    min-height: auto;
    overflow: auto;
}
.detalhes_frota .recentesobs_frota {
    margin-top: 20px;
    min-height: auto;
}
.detalhes .recentesobs table tr td {
    text-align: center;
    padding: 2px 2px;
}
.detalhes .recentesobs table thead tr td:nth-child(2), .detalhes .recentesobs table tbody tr td:nth-child(2) { 
    text-align: center}
</style>
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
<script src="../js/scripts.js"></script>
</body>
</html>