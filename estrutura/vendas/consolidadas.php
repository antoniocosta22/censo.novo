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
            $('#consolidadas').DataTable({
                "language": {
                    "url": "json/Portuguese-Brasil.json"
                }
            });
        } );
</script>
<?php
if ($_POST[Pesquisar] == "Pesquisar") {

    $cpf = $_POST['cpf'];
$html .="
<table id='consolidadas'>
    <thead>
            <th>Nº</th>
            <th>Nome</th>
            <th>Bairro</th>
            <th>Plano</th>
            <th>Cadastro</th>
            <th>Vendedor</th>
            <th>CPF</th>
            <th>Ações</th>
    </thead>
    <tbody>";

    $filter_vend = $pdo->prepare("SELECT * FROM `vendas` WHERE cpf = '$cpf' AND consolidada = 's' ");
    $filter_vend->execute();
        while($vendas_filt = $filter_vend->fetch(PDO::FETCH_ASSOC)){
     // define se a venda é juridica ou física
        $html .="<tr style='border-bottom: 1px solid blue; font-weight: bold; text-align: center;'>
            <td> $vendas_filt[id] </td>
            <td> $vendas_filt[nome]";
            if ($vendas_filt['indicacao'] == 's') {
                $html .="<span class='status indi' style='padding: 1px 8px; cursor: pointer;' title=<?=$vendas_filt[indicador_nome]'> i </span> </td>";
            }$html .="
            <td> $vendas_filt[bairro] </td>
            <td> $vendas_filt[plano] </td>
            <td>";
                    $dtmov = $vendas_filt['data_cad'];	 
                    $d1 = explode ('-', $dtmov);
                    $dtmov = $d1[2].'/'.$d1[1].'/'.$d1[0];	
                    
            $html .="$dtmov</td>
            <td>";
                $user_cad = $pdo->prepare("SELECT nome FROM `usuarios` WHERE id = $vendas_filt[vend]");
                $user_cad->execute();
                while($cad_user = $user_cad->fetch(PDO::FETCH_ASSOC)){
                    $res = $cad_user['nome'];
                }

                $primeironome = explode(" ", $res);
                            //SELECIONA O PRIMEIRO E ULTIMO NOME DA PESSOA
                            
                $fist =  current($primeironome);
                $meio = " ";
                $last = end($primeironome);
            $html .="$fist $meio $last</td>
            <td> $vendas_filt[cpf] </td>
            <td style='text-align: center;'>
            <a class='linkar' href='principal.php?p=vendas/detalhes_canc.php&cliente=$vendas_filt[id]&pg=consolidadas.php' target='_blank'>Detalhes</a>
            </td>
            </tr>";
        }
    $html .="</tbody>
</table>
";
echo $html;

}else{?>
<table id="consolidadas">
    <thead>
            <th >Nº</th>
            <th >Nome</th>
            <th >Bairro</th>
            <th >Plano</th>
            <th >Cadastro</th>
            <th >Vendedor</th>
            <th >CPF</th>
            <th >Ações</th>
    </thead>
    
    <tbody>
    <?php 
   
    if($gvend == 'S' OR $supervend == 'S'){
        $vendas_nins = $pdo->prepare("SELECT * FROM `vendas` WHERE consolidada = 's' order by id desc LIMIT 2000 ");

    }else {
        $vendas_nins = $pdo->prepare("SELECT * FROM `vendas` WHERE consolidada = 's' AND vend = $user order by id desc LIMIT 2000 ");
        
    }
    $vendas_nins->execute();
        while($vend_paga_n = $vendas_nins->fetch(PDO::FETCH_ASSOC)){
     // define se a venda é juridica ou física
   
        
    ?>
        <tr style="border-bottom: 1px solid blue; font-weight: bold; text-align: center;">
            <td ><?=$vend_paga_n['id']?></td>
            <td style="text-align: center;"><?=$vend_paga_n['nome']?>
            <?php
                if ($vend_paga_n['indicacao'] == 's') { ?>
                    <span class="status indi" style="padding: 1px 8px; cursor: pointer;" title="<?=$vend_paga_n['indicador_nome']?>"> i </span>
               <?php  }
            ?>
            </td>
            <td ><?=$vend_paga_n['bairro']?></td>
            <td ><?=$vend_paga_n['plano']?></td>
            <td >
            <?php
                    $dtmov = $vend_paga_n['data_cad'];	 
                    $d1 = explode ('-', $dtmov);
                    $dtmov = $d1[2]."/".$d1[1]."/".$d1[0];	
                    
                    echo $dtmov;
            ?>	 
            </td>
          
            <td >
                <?php
                $user_cad = $pdo->prepare("SELECT nome FROM `usuarios` WHERE id = $vend_paga_n[vend]");
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
            <td ><?=$vend_paga_n['cpf']?></td>
            <td style="text-align: center;">
            <a class="linkar" href="principal.php?p=vendas/detalhes_canc.php&cliente=<?=$vend_paga_n['id']?>&pg=consolidadas.php" target="_blank">Detalhes</a>
            </td>
        </tr>
        <?php  }  ?>  
    </tbody>
            
</table> 
<?php
}
?>
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
