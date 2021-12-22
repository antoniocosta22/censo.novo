<?php
    include'./classes/conexao_ixc.php';

    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }

    $user = $_SESSION["id_user"];
    $mes = date('m');
    $ano = date('Y');

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
    $stmt->execute();
        while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
            $central = $dados['central'];
}
           
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="refresh" content="15">
<title>CENSO - Monitoramento</title>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

           <div class="cardbox">
                <!--Cards de conteudo-->
                <?php 
                // Suporte técnico
                $sup_tecnico = $pdo_ixc->prepare("SELECT id FROM `su_oss_chamado` WHERE id_assunto = '14' AND status <> 'F'");
                $sup_tecnico->execute();
                $cont_sup = $sup_tecnico->rowCount($sup_tecnico)
                
                ?>
                <div class="card" style="min-height: auto;">  
                    <div>
                        <div class="numbers"><?=$cont_sup?></div>
                        <div class="cardname">Suporte Técnico</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-business-time"></i>
                    </div>
                </div>
                <?php 
                // entrega de carnê rádio
                $entre_c_r = $pdo_ixc->prepare("SELECT id FROM `su_oss_chamado` WHERE id_assunto = '106' AND status <> 'F'");
                $entre_c_r->execute();
                $cont_ent_r = $entre_c_r->rowCount($entre_c_r)
                
                ?>
                <?php 
                // entrega de carnê fibra
                $entre_c_f = $pdo_ixc->prepare("SELECT id FROM `su_oss_chamado` WHERE id_assunto = '107' AND status <> 'F'");
                $entre_c_f->execute();
                $cont_e_f = $entre_c_f->rowCount($entre_c_f)
                
                
                ?>
                <!-- soma dos valores -->
                <?php
                    $contagem_geral = $cont_ent_r + $cont_e_f
                ?>
                <div class="card" style="min-height: auto;">
                        
                    <div>
                        <div class="numbers"><?=$contagem_geral?></div>
                        <div class="cardname">Entrega de Carnê</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
                <?php 
                // Resgate
                $resgate = $pdo_ixc->prepare("SELECT id FROM `su_oss_chamado` WHERE id_assunto = '95' AND status <> 'F'");
                $resgate->execute();
                $cont_resgate = $resgate->rowCount($resgate)
                
                ?>
                <div class="card" style="min-height: auto;">
                    <div>
                        <div class="numbers"><?=$cont_resgate?></div>
                        <div class="cardname">Resgate</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                </div>
                <?php 
                // Ajuste de sinal
                $ajuste = $pdo_ixc->prepare("SELECT id FROM `su_oss_chamado` WHERE id_assunto = '13' AND status <> 'F'");
                $ajuste->execute();
                $cont_ajuste = $ajuste->rowCount($ajuste)
                
                ?>
                <div class="card" style="min-height: auto;">
                    <div>
                        <div class="numbers"><?=$cont_ajuste?></div>
                        <div class="cardname">Ajuste de sinal</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-hammer"></i>
                    </div>
                </div>
                <!--fim dos cards-->
                <?php 
                // Instalação rádio
                $inst_radio = $pdo_ixc->prepare("SELECT id FROM `su_oss_chamado` WHERE id_assunto = '105' AND status <> 'F'");
                $inst_radio->execute();
                $cont_inst_radio = $inst_radio->rowCount($inst_radio)
                
                ?>
                <div class="card" style="min-height: auto;">
                        
                    <div>
                        <div class="numbers"><?=$cont_inst_radio?></div>
                        <div class="cardname">Instalação Rádio</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-broadcast-tower"></i>
                    </div>
                </div>
                <?php 
                // upgrade de plano
                $upgrade = $pdo_ixc->prepare("SELECT id FROM `su_oss_chamado` WHERE id_assunto = '102' AND status <> 'F'");
                $upgrade->execute();
                $cont_upgrade = $upgrade->rowCount($upgrade)
                
                ?>
                <div class="card" style="min-height: auto;">
                        
                    <div>
                        <div class="numbers"><?=$cont_upgrade?></div>
                        <div class="cardname">Upgrade de plano</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-arrow-alt-circle-up"></i>
                    </div>
                </div>
                <?php 
                // Instalação fibra
                $inst_fibra = $pdo_ixc->prepare("SELECT id FROM `su_oss_chamado` WHERE id_assunto = '104' AND status <> 'F'");
                $inst_fibra->execute();
                $cont_inst_fibra = $inst_fibra->rowCount($inst_fibra)
                
                ?>
                <div class="card" style="min-height: auto;">
                    <div>
                        <div class="numbers"><?=$cont_inst_fibra?></div>
                        <div class="cardname">Instalação fibra</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-network-wired"></i>
                    </div>
                </div>
                <?php 
                // retirada
                $retirada = $pdo_ixc->prepare("SELECT id FROM `su_oss_chamado` WHERE id_assunto = '33' AND status <> 'F'");
                $retirada->execute();
                $cont_retirada = $retirada->rowCount($retirada)
                
                ?>
                <div class="card" style="min-height: auto;">
                    <div>
                        <div class="numbers"><?=$cont_retirada?></div>
                        <div class="cardname">Retirada</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-level-up-alt"></i>
                    </div>
                </div>
            </div>
            <!--detalhe-->
            <div class="detalhes" style=" grid-template-columns: 1fr; ">
                <div class="recentesobs">
                <?php 
                // retirada
                $offline = $pdo_ixc->prepare("SELECT id FROM `su_oss_chamado` WHERE id_assunto = '3' AND status <> 'F'");
                $offline->execute();
                $cont_offline = $offline->rowCount($offline)
                
               
                ?>
                    <div class="cardheader">
                        <?php
                            if ($cont_offline == '0'){
                                $result_off = 'Nenhum cliente Offline!';
                                $cals = 'a';
                            }elseif ($cont_offline == '1') {
                                $result_off = $cont_offline. " Cliente sem internet!";
                                $cals = 'mig_t';
                            }else {
                                $result_off = $cont_offline. " Clientes sem internet!";
                                $cals = 'mig_t';
                            }
                        ?>
                        <h2><span class="status <?=$cals?>" style="font-size: 16px; color: white;"><?=$result_off?></span></h2>
                    </div>
                   
                    <table class="filas">
                        <thead>
                            <tr>
                                <td >ID</td> 
                                <td >Data</td>
                                <td >Prazo</td>
                                <td >Cidade</td>
                                <td >Cliente</td>
                                <td >Atendente</td>
                                <td >Técnico</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php 
                        $clientes_off = $pdo_ixc->prepare("SELECT * FROM `su_oss_chamado` WHERE id_assunto = '3' AND status <> 'F' ORDER BY id");
                        $clientes_off->execute();
                        if($clientes_off->rowCount() > 0){
                        while($cont_clientes_off = $clientes_off->fetch(PDO::FETCH_ASSOC)){
                        ?>
                            <tr>
                                <td ><span class="status n"><?=$cont_clientes_off['id']?></span><span class="status n" style="margin-left: 4px; cursor: pointer;" title="<?=$cont_clientes_off['mensagem']?>"><i class="fas fa-info-circle"></i></span></td>
                                <td >
                                    <?php
                                        // Formatacão de data de cadastro da solicitação
                                        $data_abertura = $cont_clientes_off["data_abertura"];		 
                                        list( $date, $time ) = explode( ' ', $data_abertura );  
                                        $d1 = explode ('-', $date);
                                        $data_abertura = $d1[2]."/".$d1[1]."/".$d1[0];		 
                                        echo $data_abertura,' as ', $time; 
                                    ?>
                                </td>
                                <td >
                                   <?php
                                   $prazo = $pdo_ixc->prepare("SELECT id, DATEDIFF(CURDATE(), data_abertura) AS 'prazo' FROM su_oss_chamado WHERE id = $cont_clientes_off[id]");
                                   $prazo->execute();
                                   while($cont_prazo = $prazo->fetch(PDO::FETCH_ASSOC)){
                                    $dias1 = $cont_prazo['prazo'];

                                    if ($dias1 < 1){
                                        $data = 'a';
                                    }elseif ($dias1 == 1){
                                        $data = 'pendente';
                                    }elseif ($dias1 > 1){
                                        $data = 'i';
                                    }
                                   }
                                   ?>
                                   <span class="status <?=$data?>"><?=$dias1?> dias</span>
                                </td>
                                <td >
                                <?php
                                // seleciona a cidade
                                   $cidade = $pdo_ixc->prepare("SELECT nome FROM cidade WHERE id = $cont_clientes_off[id_cidade]");
                                   $cidade->execute();
                                   while($cont_cidade = $cidade->fetch(PDO::FETCH_ASSOC)){
                                    echo $cont_cidade['nome'];
                                   }
                                    ?>
                                </td>
                                <td >
                                <?php
                                // seleciona o cliente
                                   $cidade = $pdo_ixc->prepare("SELECT razao FROM cliente WHERE id = $cont_clientes_off[id_cliente]");
                                   $cidade->execute();
                                   while($cont_cidade = $cidade->fetch(PDO::FETCH_ASSOC)){
                                    echo $cont_cidade['razao'];
                                   }
                                    ?>
                                </td>
                                <td >
                                <?php
	   
                                $nome = $cont_clientes_off["id_atendente"];
                                $atendente = explode(" ", $nome);
                                //SELECIONA O PRIMEIRO E ULTIMO NOME DA PESSOA
                                
                                echo current($atendente);
                                echo " ";
                                echo end ($atendente);
	                                ?>
                                </td>
                                <td >
                                <?php
                                // seleciona o tecnico
                                   $cidade = $pdo_ixc->prepare("SELECT funcionario FROM funcionarios WHERE id = $cont_clientes_off[id_tecnico]");
                                   $cidade->execute();
                                   while($cont_cidade = $cidade->fetch(PDO::FETCH_ASSOC)){
                                    $tecnico = $cont_cidade['funcionario'];
                                    $tecnico1 = explode(" ", $tecnico);
                                    echo current($tecnico1);
                                    echo " ";
                                    echo end($tecnico1);
                                   }
                                    ?>
                                </td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table> 
                </div>
                
        </div>
    </div>
<!-- variaveis -->

<style>
.alinhar{
    text-align: left;
}
.link_venda:hover{
    color: white;
}
.linkar {
    display: inline-flex;
    color: white;
    padding: 5px;
    background: black;
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
.card {
    min-height: auto;
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