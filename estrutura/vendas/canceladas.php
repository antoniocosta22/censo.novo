<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CENSO</title>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/cdn_data.js"></script>
    <link rel="preload" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<script>
        $(document).ready(function() {
            $('#canceladas').DataTable({
                "language": {
                    "url": "json/Portuguese-Brasil.json"
                }
            });
        } );
</script>

<table id="canceladas">
    <thead>
            <th >Nº</th>
            <th >Nome</th>
            <th >Bairro</th>
            <th >Plano</th>
            <th >Data</th>
            <th >Registrador por</th>
            <th >Vendedor</th>
            <th >Ações</th>
    </thead>
    
    <tbody>
    <?php 
    if($gvend == 'S' OR $supervend == 'S'){
        $vendas_nins = $pdo->prepare("SELECT * FROM `vendas` WHERE consolidada = 'c'");

    }else {
        $vendas_nins = $pdo->prepare("SELECT * FROM `vendas` WHERE consolidada = 'c' AND vend = $user");
        
    }
    $vendas_nins->execute();
        if($vendas_nins->rowCount() > 0){
        while($vend_paga_n = $vendas_nins->fetch(PDO::FETCH_ASSOC)){
     // define se a venda é juridica ou física
     $tipo_venda = $vend_paga_n['tipo'];
     
     if ($tipo_venda == 'pf'){
         $redireciona = 'fisica';
     }elseif ($tipo_venda == 'pj'){
         $redireciona = 'juridica';
     }
        
    ?>
        <tr style="border-bottom: 1px solid blue; font-weight: bold; text-align: center;">
            <td ><span class="status pendente"><?=$vend_paga_n['id'];?></span></td>
            <td style="text-align: center;"><?=$vend_paga_n['nome'];?>
        
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
            <span class="status <?=$status?>" style="font-size: 11px; cursor: pointer;" title="Venda solicitada dia <?=$dtmov?> completando hoje <?=$prazo?>">	 
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
                    if ($vend_paga_n["vend"] == 9){
                        echo $vend_usr;
                    }
                    elseif($vend_paga_n["vend"] == 0){
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
            <a class="linkar" href="principal.php?p=vendas/detalhes_canc.php&cliente=<?=$vend_paga_n['id']?>&pg=canceladas.php" target="_blank">Detalhes</a>
            </td>
        </tr>
        <?php  } } else{
        echo 
        "<tbody>
        <tr>
        <td colspan='8' style='text-align: center; font-size: 13px;'>
        Todas as vendas foram confirmadas!
        </td>
        </tr>
        </tbody>";

    } ?>  
    </tbody>
            
</table> 
<style>
    .linkar {
        padding: 3px 5px;
        background-color: grey;
        color: white;
        border-radius: 5px;
        text-decoration: none;
    }
    .detalhes_frota .recentesobs_frota table tr td {
    padding: 4px 1px;
    font-size: 11px;
}
</style>
</body>
</html>
