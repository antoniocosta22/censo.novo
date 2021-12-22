<table >
<thead>
    <tr>
        <th >Nº</th>
        <th >Nome</th>
        <th >Bairro</th>
        <th >Plano</th>
        <th >Data</th>
        <th >Registrador por</th>
        <th >Vendedor</th>
        <th >Ações</th>
    </tr>
</thead>
    <?php 
    if($gvend == 'S' OR $supervend == 'S'){
        $vendas_nins = $pdo->prepare("SELECT * FROM `vendas` WHERE consolidada = 'n' AND instalada = 's'  AND cidade = '$cid_sigla' ORDER BY data_cad asc");

    }else {
        $vendas_nins = $pdo->prepare("SELECT * FROM `vendas` WHERE consolidada = 'n' AND instalada = 's' and vend = $user  AND cidade = '$cid_sigla' ORDER BY data_cad asc");
        
    }
    $vendas_nins->execute();
    if($vendas_nins->rowCount() > 0){
        while($vend_paga_n = $vendas_nins->fetch(PDO::FETCH_ASSOC)){
            $id_venda = $vend_paga_n[id];
        if ($vend_paga_n['equip'] == 'KP') {
            $class_t = 'kit_p';
        }elseif ($vend_paga_n['equip'] == 'MG') {
            $class_t = 'mig_t';
        }elseif ($vend_paga_n['equip'] == 'MP') {
            $class_t = 'mig_p';
        }else {
            $class_t = 'a';
        }

            // define se a venda é juridica ou física
            $tipo_venda = $vend_paga_n['tipo'];
            if ($tipo_venda == 'pf'){
                $redireciona = 'fisica';
            }elseif ($tipo_venda == 'pj'){
                $redireciona = 'juridica';
            }
    ?>
    
    <tbody>
        <tr style="border-bottom: 1px solid blue; font-weight: bold; text-align: center;">
            <td ><span class="status inst" style="border-radius: 5px 0px 0px 5px;"><?=$vend_paga_n['id'];?></span><span class="status <?=$class_t?>" style="border-radius: 0px 5px 5px 0px;"></span></td>
            <td style="text-align: center;" id="text"><?=$vend_paga_n['nome'];?> 
        
            <!-- se for indicação, coloca um marcador ao lado -->
            <?php
                if ($vend_paga_n['indicacao'] == 's') { ?>
                    <span class="status indi" style="padding: 1px 8px; cursor: pointer;" title="<?=$vend_paga_n['indicador_nome'];?>"> i </span>
               <?php  }
            ?>
            </td>
            <td ><?=$vend_paga_n['bairro'];?></td>
            <td ><?=$vend_paga_n['plano'];?></td>
            <td >
            <?php
                $filtar_data = $pdo->prepare("SELECT id, DATEDIFF(CURDATE(), data_cad) AS 'prazo' FROM vendas WHERE id = $vend_paga_n[id] ");
                $filtar_data->execute();
                    while($data_prazo = $filtar_data->fetch(PDO::FETCH_ASSOC)){
                        $prazo = $data_prazo['prazo'];
                    }

                    if($prazo < 5){
                        $status = 'a';
                    }elseif ($prazo == 5){
                        $status = 'pendente';
                    }elseif ($prazo > 5){
                        $status = 'i';
                    }
            ?>
            <?php
                    $dtmov = $vend_paga_n['data_cad'];	 
                    $d1 = explode ('-', $dtmov);
                    $dtmov = $d1[2]."/".$d1[1]."/".$d1[0];		 
            ?>
            <?php
                    $data_inst = $vend_paga_n['data_instal'];	 
                    $d2 = explode ('-', $data_inst);
                    $data_inst = $d2[2]."/".$d2[1]."/".$d2[0];		 
            ?>
            <span class="status <?=$status?>" style="font-size: 11px; cursor: pointer;" title="Instalação solicitada dia <?=$dtmov?> e realizada dia <?=$data_inst?>">	 
                    <?=$dtmov?>
             
            </span>
            </td>
            <td >
                <?php
                $user_cad = $pdo->prepare("SELECT nome FROM `usuarios` WHERE id = $vend_paga_n[cadastradopor] ");
                $user_cad->execute();
                    while($cad_user = $user_cad->fetch(PDO::FETCH_ASSOC)){
                        $res = $cad_user['nome'];
                    }

                    $primeironome = explode(" ", $res);
                                //SELECIONA O PRIMEIRO E ULTIMO NOME DA PESSOA
                                
                            echo current($primeironome);
                            echo " ";
                            echo end($primeironome);
                ?>
            </td>
            <td >
            <?php
                $user_vend = $pdo->prepare("SELECT nome FROM `usuarios` WHERE id = $vend_paga_n[vend] ");
                $user_vend->execute();
                    while($vend_user = $user_vend->fetch(PDO::FETCH_ASSOC)){
                        $vend_usr = $vend_user['nome'];
                    }
                    if ($vend_paga_n[vend] == 9){
                        echo $vend_usr;
                    }
                    elseif($vend_paga_n[vend] == 0){
                        echo 'INDICAÇÃO';
                    }
                    else {
                        $vende_name = explode(" ", $vend_usr);
                        //SELECIONA O PRIMEIRO E ULTIMO NOME DA PESSOA
                        
                            echo current($vende_name);
                            echo " ";
                            echo end($vende_name);
                    }
                    
                ?>
            </td>
            <td style="text-align: center;">
                <div class="dropdown">
                    <button href="#" class="dropbtn" style="padding: 2px 15px; border-radius: 5px; background: gold;">Ações</button>
                    <div class="listar_acoes" style="border-radius: 5px;">
                    <!-- detalhes da venda -->
                    <a href="principal.php?p=vendas/detalhes_venda.php&cliente=<?=$vend_paga_n['id']?>&c=<?=$cid_sigla?>&pg=instaladas.php" target="_blank">Detalhes</a>
                    <!-- <a href="#">Recibo</a> -->
                    <!-- desinstalar venda -->
                    <a href="principal.php?p=vendas/instalar.php&venda=<?=$vend_paga_n['id']?>&c=<?=$cid_sigla?>">Desinstalar</a>
                    <!-- editar venda -->
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
                    $stmt->execute();
                        while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $adm = $dados['adm'];
                            $gvend = $dados['gvend'];
                            $supervend = $dados['supervend'];
                            $vend = $dados['vend']; 
                            $id = $dados['id'];
                            $venda_meta = $dados['venda_meta'];
                            $os_meta = $dados['os_meta'];
                            $cid_sigla = $_GET['x!'];
                        }
                            
                    if ($gvend == 'S'){?> 
                          <a href='principal.php?p=vendas/editar_<?=$redireciona?>.php&cliente=<?=$vend_paga_n['id']?>&c=<?=$cid_sigla?>&pg=instaladas.php'>Editar</a>
                          <a  href="" onClick="javascript:window.open ('estrutura/vendas/cancelar.php?id=<?php print $vend_paga_n[id];?>&sigla=<?=$cid_sigla?>', '', 'toolbar=yes,scrollbars=yes,resizable=yes,top=170,left=250,width=882,height=400')">Cancelar</a>
                            <!-- consolidar venda -->
                            <a href="" onClick="javascript:window.open ('estrutura/vendas/consolidar.php?id=<?php print $vend_paga_n[id];?>&sigla=<?=$cid_sigla?>', '', 'toolbar=yes,scrollbars=yes,resizable=yes,top=170,left=250,width=882,height=400')">Consolidar</a>
                        <?php }?>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
    <?php  }} else{
        echo 
        "<tbody>
        <tr>
        <td colspan='8' style='text-align: center; font-size: 13px;'>
        Nenhuma instalação para consolidar!
        </td>
        </tr>
        </tbody>";

    } ?> 
                       
</table> 

<style>
    
    .detalhes_frota .recentesobs_frota table tr td {
    padding: 4px 1px;
    font-size: 11px;
}
</style>