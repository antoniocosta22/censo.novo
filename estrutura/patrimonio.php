<?php
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
<title>CENSO - Patrimônio</title>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php 
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
    $stmt->execute();
    if($stmt->rowCount() > 0){
        while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
            // echo "{$dados['nome']}";
            $ano = date('Y');
            $anopassado = $ano - 1;
            $anoantepassado = $ano - 2;
?>
 <?php
    $cont = $pdo->prepare("SELECT * FROM obs WHERE func = $user AND tipo = 'p' AND YEAR(data_cad) = $ano");
    $cont->execute();
    $posi = $cont->rowCount($cont)
?>
<!-- geral -->
<?php
    $cont1 = $pdo->prepare("SELECT * FROM usuarios WHERE status = 'A' AND func_mes = 'S'");
    $cont1->execute();
    $almox = $cont1->rowCount($cont1)
?>
<!-- positivos ano passado -->
<?php
    $posi2 = $pdo->prepare("SELECT * FROM obs WHERE func = $user AND tipo = 'p' AND YEAR(data_cad) = $anopassado");
    $posi2->execute();
    $posipas = $posi2->rowCount($posi2)
?>
<!-- positivos 2 anos atras -->
<?php
    $posi3 = $pdo->prepare("SELECT * FROM obs WHERE func = $user AND tipo = 'p' AND YEAR(data_cad) = $anoantepassado");
    $posi3->execute();
    $posiante = $posi3->rowCount($posi3)
?>
<!-- ----------------- -->
<!-- negativas ano atual -->
<?php
    $nega = $pdo->prepare("SELECT * FROM obs WHERE func = $user AND tipo = 'n' AND YEAR(data_cad) = $ano");
    $nega->execute();
    $neg = $nega->rowCount($nega)
?>
<!-- negativas ano total -->
<?php
    $nega1 = $pdo->prepare("SELECT * FROM obs WHERE func = $user AND tipo = 'n'");
    $nega1->execute();
    $neg1 = $nega1->rowCount($nega1)
?>
<!-- negativas ano passado -->
<?php
    $nega2 = $pdo->prepare("SELECT * FROM obs WHERE func = $user AND tipo = 'n' AND YEAR(data_cad) = $anopassado");
    $nega2->execute();
    $negpas = $nega2->rowCount($nega2)
?>
<!-- negativos 2 anos atras -->
<?php
    $nega3 = $pdo->prepare("SELECT * FROM obs WHERE func = $user AND tipo = 'n' AND YEAR(data_cad) = $anopassado");
    $nega3->execute();
    $negante = $nega3->rowCount($nega3)
?>
<!-- vendas atuais -->
<?php
    $vendas = $pdo->prepare("SELECT * FROM vendas WHERE vend = $user AND YEAR(data_cad) = $ano");
    $vendas->execute();
    $total_vendas = $vendas->rowCount($vendas)
?>
<!-- vendas geral -->
<?php
    $vendas1 = $pdo->prepare("SELECT * FROM ferramenta_cadastro");
    $vendas1->execute();
    $total_ferrametas = $vendas1->rowCount($vendas1)
?>
<!-- ano passado -->
<?php
    $vendas2 = $pdo->prepare("SELECT * FROM vendas WHERE vend = $user AND YEAR(data_cad) = $anopassado");
    $vendas2->execute();
    $total_vendas_pass = $vendas2->rowCount($vendas2)
?>
<!-- 2 anos atras -->
<?php
    $vendas3 = $pdo->prepare("SELECT * FROM vendas WHERE vend = $user AND YEAR(data_cad) = $anoantepassado");
    $vendas3->execute();
    $total_vendas_ante = $vendas3->rowCount($vendas3)
?> 
<!-- chaves -->
<?php
    $chaves = $pdo->prepare("SELECT * FROM chave_chaveiros");
    $chaves->execute();
    $total_chaveiros = $chaves->rowCount($chaves)
?> 
<style>
.link {
    text-decoration: none;
    color: black;
}
</style>  
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
  border-radius: 5px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.listar_acoes a {
  color: black;
  text-align: center;
  background-color: rgb(13, 127, 233);
  color: white;
  padding: 5px 16px;
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
.detalhes_frota .recentesobs_frota table tr td {
    padding: 0px 0px;
    font-size: small;
}
.new {
    position: absolute;
    right: 0;
    color: white;
    padding: 5px 1pc;
    background-color: rgb(19, 103, 182);
    bottom: 0;
    border-radius: 10px 0px 15px 0px;
}
    

</style>
           <div class="cardbox">
                <!--Cards de conteudo-->
                <a class="link" href="principal.php?p=automoveis.php">
                <div class="card">
                    <!-- positivos ano atual -->
                        
                    <div>
                        <?php 
                        $caixa = $pdo->prepare("SELECT * FROM frota_automovel ");
                        $caixa->execute();
                        $gera = $caixa->rowCount($caixa)

                        ?>
                        <div class="numbers"><?=$gera?></div>
                        <div class="cardname">Frota </div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-car"></i>
                    </div>
                    <!-- link -->
          
                    
                </div>
                </a>
                <a class="link" href="principal.php?p=buscar_ferramenta.php">
                <div class="card">
                    <div>
                        <div class="numbers"><?=$total_ferrametas?></div>
                        <div class="cardname">Ferramentas</div>
                    </div>
                    <div class="iconbox">
                            <i class="fas fa-toolbox"></i>
                    </div>
             
                </div>
                </a>
                <a class="link" href="principal.php?p=chaveiro/chaveiros.php">
                <div class="card">
                    <div>
                        <div class="numbers"><?=$total_chaveiros?></div>
                        <div class="cardname">Chaveiros</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-key"></i>
                    </div>
                     <!-- link -->
                    
                
                </div>
                </a>
                
                <a class="link" href="#">
                <div class="card">
                    <div>
                        <div class="numbers"><?=$almox?></div>
                        <div class="cardname">EPIs</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-male"></i>
                    </div>
                     <!-- link -->
              
                </div>
                </a>
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes" style="grid-template-columns: 1fr;">
                <div class="recentesobs">
                    
                    <div class="cardheader">
                    <h3>Dados Gerais</h3>
                    <div class="dropdown">
                                    <button href="#" class="dropbtn" style="padding: 5px 15px; border-radius: 5px; background: gold;">Alternar</button>
                                    <div class="listar_acoes" style="border-radius: 5px;">
                                    <a href="#">Ferramentas</a>
                                    <a href="#">Manutenções</a>
                                    </div>
                    </div>
    
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <!-- data -->
                                <!--fim detalhe-->
                                <?php 
                                $pagina = $_GET["c"];
                                include "graficos/$pagina"; 
                                ?>
                                <!--fim detalhe-->
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            <!--fim detalhe-->
        </div>
    </div>
<?php 
   }
}
?>

<!-- geral -->


</body>
</html>