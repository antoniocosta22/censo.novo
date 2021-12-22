<?php
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }
    $user = $_SESSION["id_user"];
    $vender = $_GET['user'];
    $ano = $_GET['ano'];
    $mes = $_GET['mes'];
    $tp = $_GET['tp'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CENSO - Vendas gerais</title>
<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-3.5.1.js"></script>
<script src="js/cdn_data.js"></script>
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/style.css">

</head>
<body>
<script>
        $(document).ready(function() {
            $('#vendas').DataTable({
                "language": {
                    "url": "json/Portuguese-Brasil.json"
                }
            });
        } );
</script>
<style>
    .direct {
    display: flex;
    text-decoration: none;
    justify-content: center;
    padding: 5px 6px;
    background: gray;
    color: white;
    border-radius: 5px;
}
</style>
           <div class="cardbox">
                
            </div>
<?php
if ($tp == 'vd'){?>        
            <!--detalhe-->
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h3>Vendas registradas no mês <?=$mes?>/<?=$ano?></h3>
                        <h4>
                            <?php
 $usersa = $pdo->prepare("SELECT nome FROM usuarios WHERE id = $vender");
 $usersa->execute();
 while($s_user = $usersa->fetch(PDO::FETCH_ASSOC)){
     echo $s_user['nome'];
 }
                            ?>
                        </h4>
                    </div>
                    <table id="vendas">
                        <thead>
                            <tr>
                                <td>Nº</td>
                                <td style="text-align: center;">NOME</td>
                                <td>CIDADE</td> 
                                <td>CADASTRADA</td>
                                <td>SITUAÇÃO</td>
                                <td>DETALHES</td>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <!-- seleciona as vendas -->
                        <?php 

                        $frota = $pdo->prepare("SELECT * FROM vendas WHERE vend = $vender and MONTH(data_cad)=$mes and YEAR(data_cad) = $ano ");
                        $frota->execute();

                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                            $id_venda = $carros['id'];
                            $nome_venda = $carros['nome'];
                            $id_cons = $carros["usr_consol"];
                        ?>
                        <!-- formata o nome da cidade -->
                        <?php
                                if ($carros['cidade'] == 'aal') { $cidade = " Alto Alegre do Maranhão"; } 
                                elseif ($carros['cidade'] == 'smt') { $cidade = " São Mateus do Maranhão"; }  		   
                                elseif ($carros['cidade'] == 'bac') { $cidade = " Bacabal"; } 
                                elseif ($carros['cidade'] == 'cth') { $cidade = " Cantanhede"; } 
                                elseif ($carros['cidade'] == 'slg') { $cidade = " São Luis Gonzaga"; } 
                                elseif ($carros['cidade'] == 'mir') { $cidade = " Miranda"; } 
                                elseif ($carros['cidade'] == 'mat') { $cidade = " Matões"; } 
                        ?>
                        <?php
                                $data_cad = $carros['data_cad'];		 
                                $d1 = explode( '-', $data_cad );  
                                $data_cad = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        ?> 
                        <?php
                                $data_consol = $carros['data_consol'];		 
                                $d1 = explode( '-', $data_consol );  
                                $data_consol = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        ?>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td><?=$id_venda?></td>
                                <td style="text-align: center;"><?=$nome_venda?></td>
                                <td><?=$cidade?></td>
                                <td><?=$data_cad?></td>
                                <?php
                                if ($carros['consolidada'] == 'n') { 
                                    $status = "NÃO"; 
                                    $class = "indi";
                                } 
                                elseif ($carros['consolidada'] == 's') { 
                                    $status = "SIM"; 
                                    $class = "a";
                                }  		   
                                elseif ($carros['consolidada'] == 'c') { 
                                    $status = "CANCELADA"; 
                                    $class = "i";
                                } 
                                ?>
                                <td><span class="status <?=$class?>" title="<?=$data_consol?>"><?=$status?></span></td>
                                <td><a href="principal.php?p=./vendas/detalhes_venda.php&cliente=<?=$id_venda?>" class="direct" target="_blank">Detalhes</a></td>
                               
                            </tr>
                            <?php }?>
                        </tbody>
                    
                    </table>
                    
                </div>
                
            </div>
            <!--fim detalhe-->
            <?php
                    }elseif ($tp == 'cl'){?>
<div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h3>Vendas consolidadas <?=$mes?>/<?=$ano?></h3>
                        <h4>
                            <?php
 $usersa = $pdo->prepare("SELECT nome FROM usuarios WHERE id = $vender");
 $usersa->execute();
 while($s_user = $usersa->fetch(PDO::FETCH_ASSOC)){
     echo $s_user['nome'];
 }
                            ?>
                        </h4>
                    </div>
                    <table id="vendas">
                        <thead>
                            <tr>
                                <td>Nº</td>
                                <td style="text-align: center;">NOME</td>
                                <td>CIDADE</td> 
                                <td>CADASTRO</td>
                                <td>CONSOLIDADA</td>
                                <td>SITUAÇÃO</td>
                                <td>DETALHES</td>

                            </tr>
                        </thead>
                        
                        <tbody>
                            <!-- seleciona as vendas -->
                        <?php 

                        $frota = $pdo->prepare("SELECT * FROM vendas WHERE vend = $vender and MONTH(data_consol)=$mes and YEAR(data_consol) = $ano AND consolidada != 'c' AND equip != 'MG'");
                        $frota->execute();

                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                            $id_venda = $carros['id'];
                            $nome_venda = $carros['nome'];
                            $id_cons = $carros["usr_consol"];
                        ?>
                        <!-- formata o nome da cidade -->
                        <?php
                                if ($carros['cidade'] == 'aal') { $cidade = " Alto Alegre do Maranhão"; } 
                                elseif ($carros['cidade'] == 'smt') { $cidade = " São Mateus do Maranhão"; }  		   
                                elseif ($carros['cidade'] == 'bac') { $cidade = " Bacabal"; } 
                                elseif ($carros['cidade'] == 'cth') { $cidade = " Cantanhede"; } 
                                elseif ($carros['cidade'] == 'slg') { $cidade = " São Luis Gonzaga"; } 
                                elseif ($carros['cidade'] == 'mir') { $cidade = " Miranda"; } 
                                elseif ($carros['cidade'] == 'mat') { $cidade = " Matões"; } 
                        ?>
                        <?php
                                $data_cad = $carros['data_cad'];		 
                                $d1 = explode( '-', $data_cad );  
                                $data_cad = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        ?> 
                        <?php
                                $data_consol = $carros['data_consol'];		 
                                $d1 = explode( '-', $data_consol );  
                                $data_consol = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        ?>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td><?=$id_venda?></td>
                                <td style="text-align: center;"><?=$nome_venda?></td>
                                <td><?=$cidade?></td>
                                <td><?=$data_cad?></td>
                                <td><?=$data_consol?></td>
                                <?php
                                if ($carros['consolidada'] == 'n') { 
                                    $status = "NÃO"; 
                                    $class = "indi";
                                } 
                                elseif ($carros['consolidada'] == 's') { 
                                    $status = "SIM"; 
                                    $class = "a";
                                }  		   
                                elseif ($carros['consolidada'] == 'c') { 
                                    $status = "CANCELADA"; 
                                    $class = "i";
                                } 
                                ?>
                                <td><span class="status <?=$class?>" title="<?=$data_consol?>"><?=$status?></span></td>
                                <td><a href="principal.php?p=./vendas/detalhes_venda.php&cliente=<?=$id_venda?>" class="direct" target="_blank">Detalhes</a></td>
                               
                            </tr>
                            <?php }?>
                        </tbody>
                    
                    </table>
                    
                </div>
                
            </div>

            <?php } else{?>
                <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h3>Migrações consolidadas <?=$mes?>/<?=$ano?></h3>
                        <h4>
                            <?php
 $usersa = $pdo->prepare("SELECT nome FROM usuarios WHERE id = $vender");
 $usersa->execute();
 while($s_user = $usersa->fetch(PDO::FETCH_ASSOC)){
     echo $s_user['nome'];
 }
                            ?>
                        </h4>
                    </div>
                    <table id="vendas">
                        <thead>
                            <tr>
                                <td>Nº</td>
                                <td style="text-align: center;">NOME</td>
                                <td>CIDADE</td> 
                                <td>CADASTRO</td>
                                <td>CONSOLIDADA</td>
                                <td>SITUAÇÃO</td>
                                <td>DETALHES</td>

                            </tr>
                        </thead>
                        
                        <tbody>
                            <!-- seleciona as vendas -->
                        <?php 

                        $frota = $pdo->prepare("SELECT * FROM vendas WHERE vend = $vender and MONTH(data_consol)=$mes and YEAR(data_consol) = $ano AND consolidada != 'c' AND equip = 'MG'");
                        $frota->execute();

                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                            $id_venda = $carros['id'];
                            $nome_venda = $carros['nome'];
                            $id_cons = $carros["usr_consol"];
                        ?>
                        <!-- formata o nome da cidade -->
                        <?php
                                if ($carros['cidade'] == 'aal') { $cidade = " Alto Alegre do Maranhão"; } 
                                elseif ($carros['cidade'] == 'smt') { $cidade = " São Mateus do Maranhão"; }  		   
                                elseif ($carros['cidade'] == 'bac') { $cidade = " Bacabal"; } 
                                elseif ($carros['cidade'] == 'cth') { $cidade = " Cantanhede"; } 
                                elseif ($carros['cidade'] == 'slg') { $cidade = " São Luis Gonzaga"; } 
                                elseif ($carros['cidade'] == 'mir') { $cidade = " Miranda"; } 
                                elseif ($carros['cidade'] == 'mat') { $cidade = " Matões"; } 
                        ?>
                        <?php
                                $data_cad = $carros['data_cad'];		 
                                $d1 = explode( '-', $data_cad );  
                                $data_cad = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        ?> 
                        <?php
                                $data_consol = $carros['data_consol'];		 
                                $d1 = explode( '-', $data_consol );  
                                $data_consol = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        ?>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td><?=$id_venda?></td>
                                <td style="text-align: center;"><?=$nome_venda?></td>
                                <td><?=$cidade?></td>
                                <td><?=$data_cad?></td>
                                <td><?=$data_consol?></td>
                                <?php
                                if ($carros['consolidada'] == 'n') { 
                                    $status = "NÃO"; 
                                    $class = "indi";
                                } 
                                elseif ($carros['consolidada'] == 's') { 
                                    $status = "SIM"; 
                                    $class = "a";
                                }  		   
                                elseif ($carros['consolidada'] == 'c') { 
                                    $status = "CANCELADA"; 
                                    $class = "i";
                                } 
                                ?>
                                <td><span class="status <?=$class?>" title="<?=$data_consol?>"><?=$status?></span></td>
                                <td><a href="principal.php?p=./vendas/detalhes_venda.php&cliente=<?=$id_venda?>" class="direct" target="_blank">Detalhes</a></td>
                               
                            </tr>
                            <?php }?>
                        </tbody>
                    
                    </table>
                    
                </div>
                
            </div>

           <?php } ?> 



<style>
.detalhes_frota .recentesobs_frota table tr td {
    padding: 6px;
    text-align: center;
    font-size: 11px;
    font-weight: bold;

}
.detalhes_frota .recentesobs_frota {
    min-height: auto;
    border-radius: 5px;
}

.detalhes_frota .recentesobs_frota table thead tr td:last-child, .detalhes_frota .recentesobs_frota table tbody tr td:last-child {
    text-align: center;
}
.detalhes_frota .recentesobs_frota table thead tr td:nth-child(2), .detalhes_frota .recentesobs_frota table tbody tr td:nth-child(2) {
    text-align: center;
}

.dropdown {
  position: relative;
  display: inline-block;
}
.botao_ops {
    background: turquoise;
}
.status {
    padding: 5px 10px;
    font-size: 11px;
}


</style>
</body>
</html>