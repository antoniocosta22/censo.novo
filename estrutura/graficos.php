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
<title>CENSO - Dashboard</title>

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
    
           <div class="cardbox">
                <!--Cards de conteudo-->
                <!-- positivos ano atual -->
                <?php
                            $cont = $pdo->prepare("SELECT * FROM obs WHERE func = $user AND tipo = 'p' AND YEAR(data_cad) = $ano");
                            $cont->execute();
                            $posi = $cont->rowCount($cont)
                        ?>
                        <!-- geral -->
                        <?php
                            $cont1 = $pdo->prepare("SELECT * FROM obs WHERE func = $user AND tipo = 'p'");
                            $cont1->execute();
                            $posi1 = $cont1->rowCount($cont1)
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
                            $nega3 = $pdo->prepare("SELECT * FROM obs WHERE func = $user AND tipo = 'n' AND YEAR(data_cad) = $anoantepassado");
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
                            $vendas1 = $pdo->prepare("SELECT * FROM vendas WHERE vend = $user");
                            $vendas1->execute();
                            $total_vendas1 = $vendas1->rowCount($vendas1)
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
                        <!-- SOLICITAÇÕES atual -->
                        <?php 
                        $caixa = $pdo->prepare("SELECT * FROM solicitacoes WHERE finalizador = $user AND status = 'EN' ");
                        $caixa->execute();
                        $gera = $caixa->rowCount($caixa)

                        ?>
                        <!-- ano atual -->
                        <?php 
                        $soli2 = $pdo->prepare("SELECT * FROM solicitacoes WHERE finalizador = $user AND status = 'EN' and YEAR(datacad) = '$ano'");
                        $soli2->execute();
                        $solic2 = $soli2->rowCount($soli2)

                        ?>
                        <!-- ano passado -->
                        <?php 
                        $soli3 = $pdo->prepare("SELECT * FROM solicitacoes WHERE finalizador = $user AND status = 'EN' and YEAR(datacad) = '$anopassado'");
                        $soli3->execute();
                        $solic3 = $soli3->rowCount($soli3)

                        ?>
                        <!-- ano passado -->
                        <?php 
                        $soli4 = $pdo->prepare("SELECT * FROM solicitacoes WHERE finalizador = $user AND status = 'EN' and YEAR(datacad) = '$anoantepassado'");
                        $soli4->execute();
                        $solic4 = $soli4->rowCount($soli4)

                        ?>
                <style>
                    .link {
                        text-decoration: none;
                        color: black;
                    }
                </style>
                 <a class="link" href="principal.php?p=usuario/meus_servicos.php">
                <div class="card">
                    <div>
                        
                        <div class="numbers"><?=$gera?></div>
                        <div class="cardname">Solicitações</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-people-arrows"></i>
                    </div>
                </div>
                </a>   
                <a class="link" href="principal.php?p=dados/vendas_gerais.php">    
                <div class="card">
                    <div>
                        <div class="numbers"><?=$total_vendas1?></div>
                        <div class="cardname">Vendas</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-tags"></i>
                    </div>
                </div>
                </a>   
                <a class="link" href="principal.php?p=dados/observacoes.php&tp=n"> 
                <div class="card">
                    <div>
                        <div class="numbers"><?=$neg1?></div>
                        <div class="cardname">Negativos</div>
                    </div>
                    <div class="iconbox">
                        <i class="far fa-thumbs-down"></i>
                    </div>
                </div>
                </a>
                <a class="link" href="principal.php?p=dados/observacoes.php&tp=p"> 
                <div class="card">
                    <div>
                        <div class="numbers"><?=$posi1?></div>
                        <div class="cardname">Positivos</div>
                    </div>
                    <div class="iconbox">
                        <i class="far fa-thumbs-up"></i>
                    </div>
                </div>
                </a>
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <h3>Ranking últimos 3 anos</h3>
                    <div class="cardheader">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <!-- data -->
                                
                                <td>
                                    <!-- php data -->
                                    <?php
                                   

                                    $positivos = array(
                                        array("label"=> "$anoantepassado", "y"=> $posiante),
                                        array("label"=> "$anopassado", "y"=> $posipas),
                                        array("label"=> "$ano", "y"=> $posi)
                                 
                                    );
                                    $negativos = array(
                                        array("label"=> "$anoantepassado", "y"=> $negante),
                                        array("label"=> "$anopassado", "y"=> $negpas),
                                        array("label"=> "$ano", "y"=> $neg)
                                     
                                    );
                                    $vendas1 = array(
                                        array("label"=> "$anoantepassado", "y"=> $total_vendas_ante),
                                        array("label"=> "$anopassado", "y"=> $total_vendas_pass),
                                        array("label"=> "$ano", "y"=> $total_vendas)
                                     
                                    );
                                    $soli = array(
                                        array("label"=> "$anoantepassado", "y"=> $solic4),
                                        array("label"=> "$anopassado", "y"=> $solic3),
                                        array("label"=> "$ano", "y"=> $solic2)
                                     
                                    );
                                        
                                    ?>
                                    <!-- php data -->
                                <div id="geral" style="height: 300px; width: 100%;"></div>
                                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="recentesinfos">
                <h3>Ranking atual</h3>
                    <div class="cardheader">
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <!-- php data -->
                                    <?php
 
                                    $dataPoints = array( 
                                        array("y" => $posi, "label" => "Positivos" ),
                                        array("y" => $neg, "label" => "Negativos" ),
                                        array("y" => $total_vendas, "label" => "Vendas" ),
                                        array("y" => $solic2, "label" => "Solicitações" )
                                    );
                                    
                                    ?>
                                    <!-- php data -->
                                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--fim detalhe-->
        </div>
    </div>
<?php 
   }
}
?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",

	data: [{
		type: "column",
        name: "Ano atual",
        showInLegend: true,
        indexLabel: "{y}",
		yValueFormatString: "#,##0.##",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
// variavel 2
var chart2 = new CanvasJS.Chart("geral", {
	animationEnabled: true,
	theme: "light2",
	
	axisY:{
		includeZero: true
	},
	legend:{
		cursor: "pointer",
		verticalAlign: "center",
		horizontalAlign: "right",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Positivos",
		indexLabel: "{y}",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($positivos, JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		name: "Negativos",
		indexLabel: "{y}",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($negativos, JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		name: "Vendas",
		indexLabel: "{y}",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($vendas1, JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		name: "Solicitações",
		indexLabel: "{y}",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($soli, JSON_NUMERIC_CHECK); ?>
	}]
});
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart2.render();
}

// fim da variavel 2
chart.render();
chart2.render();
}
</script>

<!-- geral -->


</body>
</html>