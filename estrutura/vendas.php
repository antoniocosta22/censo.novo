<?php
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }

    $user = $_SESSION["id_user"];
    $mes = date("m");
    $ano = date("Y");

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
<meta http-equiv="refresh" content="15">
<title>CENSO - Vendas</title>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<style>
    /* classe para remover a decoração dos links */
    .remove {
        text-decoration: none;
        color: black;
    }
    
</style>
<body>

           <div class="cardbox">
                <!--Cards de conteudo-->
                <a class="remove" href="principal.php?p=../classes/cadastro_juridica.php">
                <div class="card juridica">
                        
                    <div>
                        <div class="numbers">Cadastrar</div>
                        <div class="cardname">Pessoa jurídica</div>
                    </div>
                    <div class="iconbox">
                        <i class="far fa-building"></i>
                    </div>
                </div>
                </a>
                
                <a class="remove" href="principal.php?p=../classes/cadastro_fisica.php">
                <div class="card fisica">
                        
                    <div>
                        <div class="numbers">Cadastrar</div>
                        <div class="cardname">Pessoa física</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-user-tag"></i>
                    </div>
                </div>
                </a>
                
                <?php
                if($gvend == 'S' OR $supervend == 'S'){
                    $grid = 'repeat(4, 1fr );';
                    $grid_m = '1fr;';
                    echo '
                    <a class="remove" href="principal.php?p=vendas/fila_alt.php&v=consolidadas.php&pg=consolidadas">
                    <div class="card">
                    <div>
                        <div class="numbers">Vendas</div>
                        <div class="cardname">consolidadas</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-check-double"></i>
                    </div>
                </div>
                </a>
                <a class="remove" href="principal.php?p=vendas/fila_alt.php&v=canceladas.php&pg=canceladas">
                <div class="card">
                    <div>
                        <div class="numbers">Vendas</div>
                        <div class="cardname">canceladas</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-window-close"></i>
                    </div>
                </div>
                </a>
               
                ';
                
                }else{
                    $grid = 'repeat(2, 1fr );';
                }?>
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes" style=" grid-template-columns: 1fr; ">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Filas de Instalações</h2>
                        
                    </div>
                   
                    <table class="filas">
                        <thead>
                            <tr>
                                <td style="padding: 9px;background: rgb(19, 103, 182);color: white;border-radius: 10px 10px 0 0;">Cidades</td> 
                                <td style="text-align: center;">A. pagamento</td>
                                <td style="text-align: center;">Pago</td>
                                <td style="text-align: center;">Kit próprio</td>
                                <td style="text-align: center;">M. tecnologia</td>
                                <td style="text-align: center;">M. Plano</td>
                                <td style="text-align: center;">Instaladas</td>
                                <td style="text-align: center;">Urgente</td>
                                <td style="text-align: center;">Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                $cidades = $pdo->prepare("SELECT id_cidade, sigla, cidade FROM cidades WHERE status = 'a'");
                                $cidades->execute();
                                while($nome_cidades = $cidades->fetch(PDO::FETCH_ASSOC)){
                                    $cid_sigla = $nome_cidades['sigla'];
	                                $cid = $nome_cidades['cidade'];
                               
                            ?>
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
                            
                            $total = $total_vendas - $vd_instalada;
                            
                            $aguard_pag = $total - $tec_migracao - $pl_migracao - $pago_vd - $kt_proprio;
                            $conts = $aguard_pag + $tec_migracao + $pl_migracao + $pago_vd + $kt_proprio;
                            $urgente = $total - $conts;
                            ?>
                            <tr>
                                <td >
                                    <div class="alinhar">
                                    <a href="principal.php?p=vendas/fila_vendas.php&x!=<?=$cid_sigla?>&v=nao_instaladas.php" target="_blank" class="linkar"><?=$cid?></a>
                                    </div>
                                </td>
                                <td style="text-align: center;"><?=$aguard_pag?></td>
                                <td style="text-align: center;"><?=$pago_vd?></td>
                                <td style="text-align: center;"><?=$kt_proprio?></td>
                                <td style="text-align: center;"><?=$tec_migracao?></td>
                                <td style="text-align: center;"><?=$pl_migracao?></td>
                                <td style="text-align: center;"><?=$vd_instalada?></td>
                                <td style="text-align: center;"><?=$total?></td>
                                <td style="text-align: center;"><?=$total_vendas?></td>
                            </tr>
                            <?php  } ?>
                        </tbody>
                    </table> 
                </div>
                
        </div>
    </div>

<style>
.cardbox {
    grid-template-columns: <?=$grid?>;
}

.alinhar{
    text-align: left;
}
.link_venda:hover{
    color: white;
}
.linkar {
    width: 100%;
    display: inline-flex;
    background-color: white;
    color: black;
    font-weight: bold;
    text-decoration: none;
    padding: 5px;
    justify-content: center;
    margin-right: 5px;
    border-radius: 5px;
}
.cardheader {
    justify-content: center;

}
  
.detalhes .recentesobs table tr td {
    text-align: center;
    padding: 2px 2px;
}
.detalhes .recentesobs table thead tr td:nth-child(2), .detalhes .recentesobs table tbody tr td:nth-child(2) { 
    text-align: center}
    @media (max-width: 480px) 
{
    .cardbox {
    grid-template-columns: <?=$grid_m?>;
}
}
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