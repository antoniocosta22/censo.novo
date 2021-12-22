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
<title>CENSO - Administração</title>

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
    $cont = $pdo->prepare("SELECT * FROM usuarios WHERE YEAR(datacad) = $ano");
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
    $posi2 = $pdo->prepare("SELECT * FROM usuarios WHERE YEAR(datacad) = $anopassado");
    $posi2->execute();
    $posipas = $posi2->rowCount($posi2)
?>
<!-- positivos 2 anos atras -->
<?php
    $posi3 = $pdo->prepare("SELECT * FROM usuarios WHERE YEAR(datacad) = $anoantepassado");
    $posi3->execute();
    $posiante = $posi3->rowCount($posi3)
?>
<!-- ----------------- -->
<!-- negativas ano atual -->
<?php
    $nega = $pdo->prepare("SELECT * FROM frota_automovel WHERE YEAR(data_cad) = $ano");
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
    $nega2 = $pdo->prepare("SELECT * FROM frota_automovel WHERE YEAR(data_cad) = $anopassado");
    $nega2->execute();
    $negpas = $nega2->rowCount($nega2)
?>
<!-- negativos 2 anos atras -->
<?php
    $nega3 = $pdo->prepare("SELECT * FROM frota_automovel WHERE YEAR(data_cad) = $anopassado");
    $nega3->execute();
    $negante = $nega3->rowCount($nega3)
?>
<!-- vendas atuais -->
<?php
    $vendas = $pdo->prepare("SELECT * FROM ferramenta_cadastro WHERE YEAR(data_cad) = $ano");
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
    $vendas2 = $pdo->prepare("SELECT * FROM ferramenta_cadastro WHERE YEAR(data_cad) = $anopassado");
    $vendas2->execute();
    $total_vendas_pass = $vendas2->rowCount($vendas2)
?>
<!-- 2 anos atras -->
<?php
    $vendas3 = $pdo->prepare("SELECT * FROM ferramenta_cadastro WHERE YEAR(data_cad) = $anoantepassado");
    $vendas3->execute();
    $total_vendas_ante = $vendas3->rowCount($vendas3)
?> 
<!-- chaves -->
<?php
    $chave = $pdo->prepare("SELECT * FROM chave_chaveiros");
    $chave->execute();
    $total_k = $chave->rowCount($chave)
?>
<!-- ano passado -->
<?php
    $chave1 = $pdo->prepare("SELECT * FROM chave_chaveiros WHERE YEAR(data_cad) = $anopassado");
    $chave1->execute();
    $total_k_1 = $chave1->rowCount($chave1)
?>
<!-- 2 anos atras -->
<?php
    $chave2 = $pdo->prepare("SELECT * FROM chave_chaveiros WHERE YEAR(data_cad) = $anoantepassado");
    $chave2->execute();
    $total_k_2 = $chave2->rowCount($chave2)
?> 
                                <td>
                                    <!-- php data -->
                                    <?php
                                   
                                    $frota = array(
                                        array("label"=> "$anoantepassado", "y"=> $negante),
                                        array("label"=> "$anopassado", "y"=> $negpas),
                                        array("label"=> "$ano", "y"=> $neg)
                                     
                                    );
                                    $ferramentas = array(
                                        array("label"=> "$anoantepassado", "y"=> $total_vendas_ante),
                                        array("label"=> "$anopassado", "y"=> $total_vendas_pass),
                                        array("label"=> "$ano", "y"=> $total_vendas)
                                     
                                    );
                                    $chaves = array(
                                        array("label"=> "$anoantepassado", "y"=> $total_k_2),
                                        array("label"=> "$anopassado", "y"=> $total_k_1),
                                        array("label"=> "$ano", "y"=> $total_k)
                                     
                                    );
                                        
                                    ?>
                                    <!-- php data -->
                                <div id="geral" style="height: 300px; width: 100%;"></div>
                                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                                </td>
                   
<?php 
   }
}
?>
<script>
window.onload = function () {
 
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
		name: "Frota",
		indexLabel: "{y}",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($frota, JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		name: "Ferramentas",
		indexLabel: "{y}",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($ferramentas, JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		name: "Chaveiros",
		indexLabel: "{y}",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($chaves, JSON_NUMERIC_CHECK); ?>
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
chart2.render();
}
</script>

<!-- geral -->


</body>
</html>