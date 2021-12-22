<?php
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }
    $cid_sigla = $_GET['x!'];
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

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
                    <div class="cardheader">
                        <h2>FILA DE <?=$nome_cidade?></h2>
                        
                    </div>
                   
                    <table class="filas">
                        
                      
                            <?php 
                            // total de clientes

                            if($gvend == 'S' OR $supervend == 'S'){
                                $aguardando_pg = $pdo->prepare("SELECT id FROM `vendas` WHERE consolidada = 'n' AND cidade = '$cid_sigla'");

                            }else {
                                $aguardando_pg = $pdo->prepare("SELECT id FROM `vendas` WHERE consolidada = 'n' AND vend = $id AND cidade = '$cid_sigla'");
                                
                            }
                            $aguardando_pg->execute();
                            $total_vendas = $aguardando_pg->rowCount($aguardando_pg)
                            
                            ?>
                            <?php 
                            // total pago
                            if($gvend == 'S' OR $supervend == 'S'){
                                $vendas_pago = $pdo->prepare("SELECT id FROM `vendas` WHERE consolidada = 'n' AND instalada = 'n' AND confirmada ='s' AND equip != 'KP' AND cidade = '$cid_sigla'");
                            }else {
                                $vendas_pago = $pdo->prepare("SELECT id FROM `vendas` WHERE consolidada = 'n' AND instalada = 'n' AND confirmada ='s' AND equip != 'KP' AND vend = $id AND cidade = '$cid_sigla'");  
                            }
                            $vendas_pago->execute();
                            $pago_vd = $vendas_pago->rowCount($vendas_pago)
                            ?>
                            <?php 
                            // kit proprio
                            if($gvend == 'S' OR $supervend == 'S'){
                                $kit_proprio = $pdo->prepare("SELECT id FROM `vendas` WHERE consolidada = 'n' AND instalada = 'n' AND equip ='KP' AND cidade = '$cid_sigla'");
                            }else {
                                $kit_proprio = $pdo->prepare("SELECT id FROM `vendas` WHERE consolidada = 'n' AND instalada = 'n' AND equip ='KP' AND vend = $id AND cidade = '$cid_sigla'");  
                            }
                            $kit_proprio->execute();
                            $kt_proprio = $kit_proprio->rowCount($kit_proprio)
                            ?>
                            <?php 
                            // migração de tecnologia
                            if($gvend == 'S' OR $supervend == 'S'){
                                $migracao_tec = $pdo->prepare("SELECT id FROM `vendas` WHERE consolidada = 'n' AND instalada = 'n' AND equip ='MG' AND cidade = '$cid_sigla'");
                            }else {
                                $migracao_tec = $pdo->prepare("SELECT id FROM `vendas` WHERE consolidada = 'n' AND instalada = 'n' AND equip ='MG' AND vend = $id AND cidade = '$cid_sigla'");  
                            }
                            $migracao_tec->execute();
                            $tec_migracao = $migracao_tec->rowCount($migracao_tec)
                            ?>
                            <?php 
                            // migração de plano
                            if($gvend == 'S' OR $supervend == 'S'){
                                $migracao_pl = $pdo->prepare("SELECT id FROM `vendas` WHERE consolidada = 'n' AND instalada = 'n' AND equip ='MP' AND cidade = '$cid_sigla'");
                            }else {
                                $migracao_pl = $pdo->prepare("SELECT id FROM `vendas` WHERE consolidada = 'n' AND instalada = 'n' AND equip ='MP' AND vend = $id AND cidade = '$cid_sigla'");  
                            }
                            $migracao_pl->execute();
                            $pl_migracao = $migracao_pl->rowCount($migracao_pl)
                            ?>
                            <?php 
                            // instalada
                            if($gvend == 'S' OR $supervend == 'S'){
                                $instalada = $pdo->prepare("SELECT id FROM `vendas` WHERE instalada = 's' AND consolidada = 'n' AND cidade = '$cid_sigla'");
                            }else {
                                $instalada = $pdo->prepare("SELECT id FROM `vendas` WHERE instalada = 's' AND vend = $id AND consolidada = 'n' AND cidade = '$cid_sigla'");  
                            }
                            $instalada->execute();
                            $vd_instalada = $instalada->rowCount($instalada)
                            ?>
                            <?php
                            
                            $urgente = $tec_migracao + $pl_migracao + $pago_vd + $kt_proprio - $vd_instalada;
                            $total = $total_vendas - $vd_instalada;
                            $aguard_pag = $total - $tec_migracao - $pl_migracao - $pago_vd - $kt_proprio;
                            ?>
                            
                            <thead>
                                <tr>
                                    <td ><span class="status">A. pagamento <span class="status tag"><?=$aguard_pag?></span></span></td>
                                    <td > <span class="status a">Pago <span class="status tag"><?=$pago_vd?></span></span></td>
                                    <td ><span class="status kit_p">Kit próprio <span class="status tag"><?=$kt_proprio?></span></span></td>
                                    <td ><span class="status mig_t">M. Tecnologia <span class="status tag"><?=$tec_migracao?></span></span></td>
                                    <td ><span class="status mig_p">M. Plano <span class="status tag"><?=$pl_migracao?></span></span></td>
                                    <td ><span class="status inst">Instalada <span class="status tag"><?=$vd_instalada?></span></span></td>
                                    <td ><span class="status i">Urgente <span class="status tag"><?=$urgente?></span></span></td>
                                    <td ><span class="status total_v">Total <span class="status tag"><?=$total?></span></span></td>
                                </tr>
                            </thead>
                           
                       
                    </table> 
                </div>
                
            </div>

            <!--detalhe-->
            <div class="detalhes_frota" >
                <div class="recentesobs_frota" >
                    <div class="cardheader_frota">
                        <h3>
                        <?php
                        $state = $_GET['v'];
                                if($state == 'nao_instaladas.php'){
                                    $state = 'VENDAS CONFIRMADAS';
                                    
                                }elseif($state == 'instaladas.php'){
                                    $state = 'INSTALADAS';

                                }elseif($state == 'migracao.php'){
                                    $state = 'MIGRAÇÃO DE TECNOLOGIA';
                                }
                                elseif($state == 'mig_plano.php'){
                                    $state = 'MIGRAÇÃO DE PLANO';
                                }
                                elseif($state == 'kit_proprio.php'){
                                    $state = 'KIT PRÓPRIO';
                                }
                                elseif($state == 'indicadas.php'){
                                    $state = 'VENDAS POR INDICAÇÃO';
                                }
                                elseif($state == 'nao_confirmadas.php'){
                                    $state = 'NÃO CONFIRMADAS';
                                }
                                echo $state;
                            ?>
                            
                        </h3>
                        <div class="dropdown">
                                    <button href="#" class="dropbtn" style="padding: 5px 15px; border-radius: 5px; background: gold;">Alternar</button>
                                    <div class="listar_acoes" style="border-radius: 5px;">
                                    <!-- pendente -->
                                    <a href="principal.php?p=vendas/fila_vendas.php&x!=<?=$cid_sigla?>&v=nao_confirmadas.php">Não Confirmadas</a>
                                    <!-- feito -->
                                    <a href="principal.php?p=vendas/fila_vendas.php&x!=<?=$cid_sigla?>&v=nao_instaladas.php">Vendas Confirmadas</a>
                                    <!-- pendente -->
                                    <a href="principal.php?p=vendas/fila_vendas.php&x!=<?=$cid_sigla?>&v=kit_proprio.php">Kit Próprio</a>
                                    <!-- feito -->
                                    <a href="principal.php?p=vendas/fila_vendas.php&x!=<?=$cid_sigla?>&v=migracao.php">Migração de tecnologia</a>
                                    <!-- pendente -->
                                    <a href="principal.php?p=vendas/fila_vendas.php&x!=<?=$cid_sigla?>&v=mig_plano.php">Migração de plano</a>
                                    <!-- feito -->
                                    <a href="principal.php?p=vendas/fila_vendas.php&x!=<?=$cid_sigla?>&v=instaladas.php">Instaladas</a>
                                    <!-- pendente -->
                                    <a href="principal.php?p=vendas/fila_vendas.php&x!=<?=$cid_sigla?>&v=indicadas.php">Vendas por indicação</a>

                                    </div>
                        </div>
                    </div>
                   
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