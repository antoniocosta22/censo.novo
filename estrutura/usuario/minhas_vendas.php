<?php
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

           <div class="cardbox">
                
            </div>
            <!--detalhe-->
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h2>Minhas vendas</h2>
                        <a style="position: relative;
                                    padding: 3px 10px;
                                    background: rgb(19, 103, 182);
                                    color: white;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    text-decoration: none;" 
                        class="voltar" href="principal.php?p=perfil.php">Voltar</a>
                    </div>
                    <!--Tabela de veiculos-->
                    <table id="vendas">
                        <thead>
                            <tr>
                                <td>Nº</td>
                                <td style="text-align: center;">NOME</td>
                                <td>CIDADE</td> 
                                <td>CADASTRADA</td>
                                <td>CONSOLIDADA</td>

                            </tr>
                        </thead>
                        
                        <tbody>
                            <!-- seleciona as vendas -->
                        <?php 
                        $frota = $pdo->prepare("SELECT * FROM vendas WHERE vend = $user order by data_cad desc");
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
                     
                               
                            </tr>
                            <?php }?>
                        </tbody>
                    
                    </table>
                    
                </div>
                
            </div>
            <!--fim detalhe-->
        </div>
    </div>


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