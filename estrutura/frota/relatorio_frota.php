<?php 

$id_carro = $_GET['f'];
$frota = $pdo->prepare(" SELECT * FROM frota_automovel where id_automovel = $id_carro ORDER BY id_automovel");
$frota->execute();
if($frota->rowCount() > 0){
while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
    $desc = $carros['descr'];
    $id_fab = $carros['marca'];
    $id_resp = $carros['responsavel'];
    $id_cad = $carros['usr_cad'];
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CENSO - Metas</title>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/mascaras.js"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<style>
.dropbtn {
    color: black;
    padding: 5px 15px;
    font-size: 14px;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}
.dropbtn:hover {
    color: black;
}
.detalhes_frota .recentesobs_frota table tr td {
    padding: 0px 0px;
    font-size: small;
}

.cardheader {
    justify-content: space-between;
    align-items: center;
    border: 1px solid rgb(19, 103, 182);
}
h4 {
    color: white;
}

h5 {
    color: white;
}

</style>
<?php
        $datanasc = $carros['data_compra'];   
        $d1 = explode ('-', $datanasc);
        $datanasc = $d1[2]."/".$d1[1]."/".$d1[0];	
?>
<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                    <img src="imgs/CENSO.png" style=" width: 150px;">
                    <div style="text-align: center;">
                    <h4>CAS - INTERNET EM ALTA VELOCIDADE</h4>
                    <h5>RELATÓRIO - <?= $carros['modelo'];?></h5>
                    </div>
                        
                        <div class="dropdown">
                        <a href="principal.php?p=gestao_frota.php" class="dropbtn" style="padding: 5px 15px; border-radius: 5px; background: white;">Voltar</a>
                        </div>
                    </div>
                    
                    <div class="ladoalado">
                    <label class="form">MODELO: <?= $carros['modelo'];?></label>
                    <label class="form_a">PLACA: <?= $carros['placa'];?></label>
                    </div>
                    <!--  inicio  -->
                    <div class="ladoalado">
                    <label class="form">RENAVAN: <?= $carros['renavan'];?></label>
                    <label class="form_a">CHASSI: <?= $carros['chassi'];?></label>
                    </div>
                    <!-- SQL DE FABRICANTE -->
                    <?php
                    $fab = $pdo->prepare(" SELECT * FROM frota_fabricante where id_frota_fabricante = $id_fab");
                    $fab->execute();
                    while($fabri = $fab->fetch(PDO::FETCH_ASSOC)){
                    $fabricante = $fabri['fabricante'];
                    }

                    ?>
                    <div class="ladoalado">
                    <label class="form">FABRICANTE: <?= $fabricante?></label>
                    <label class="form_a">COR: <?= $carros['cor'];?></label>
                    </div>

                    <div class="ladoalado">
                    <label class="form">ANO DE FABRICAÇÃO: <?= $carros['ano_fab'];?></label>
                    <label class="form_a">ANO DO MODELO: <?= $carros['ano_mod'];?></label>
                    </div>
                    
                    
                    <!-- cadastrado por -->
                    <div class="ladoalado">
                    
                    <label class="form">REGISTRADO DIA: 

                        <?php
                        $data_cada = $carros['data_cad'];		 
                        list( $date, $time ) = explode( ' ', $data_cada );  
                        $d1 = explode ('-', $date);
                        $data_cada = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        echo $data_cada,' às ', $time; 
                    ?>

                    </label>
                    <?php
                    $cad = $pdo->prepare(" SELECT * FROM usuarios where id = $id_cad");
                    $cad->execute();
                    while($cads = $cad->fetch(PDO::FETCH_ASSOC)){
                    $cadastrar = $cads['nome'];
                    }

                    ?>
                    <label class="form_a">POR: <?= $cadastrar?></label>
                    </div>
                    <div class="ladoalado">
                    <label class="form">VALOR: <?= $carros['valor_compra'];?></label>
                    <!-- SQL DE FABRICANTE -->
                    <?php
                    $resp = $pdo->prepare(" SELECT * FROM usuarios where id = $id_resp");
                    $resp->execute();
                    while($respo = $resp->fetch(PDO::FETCH_ASSOC)){
                    $responsavel = $respo['nome'];
                    }

                    ?>
                    <label class="form_a">RESPONSÁVEL: <?=$responsavel?></label>
                    </div>
                    <div class="ladoalado">
                    <label class="form">DATA DE COMPRA: 
                        <?php
                        $data_compra = $carros['data_compra'];   
                        $d1 = explode ('-', $data_compra);
                        $data_compra = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        echo $data_compra; 
                    ?>
                    </label>
                    <label class="form_a">KM REGISTRADO: <?= $carros['KM'];?></label>
                    </div>
                    
                    <label class="form">DESCRIÇÃO: 
                    <?php
                        if ($desc == ' '){
                            echo ("NENHUMA INFORMAÇÃO!");
                        }
                        else {
                            echo $desc;
                        }
                    ?>
                    </label>
                </div>
                <!-- fim do card -->
            </div>
<?php
}}
?>




<style>
.ladoalado {
    justify-content: space-between;
    align-items: flex-start;
    display: flex;
}
.form {
    margin: 5px 0 0 0;
    background: white;
    display: block;
    border: none;
    font-weight: bold;
    border-radius: 5px;
    font-size: small;
    border: 1px solid rgb(19, 103, 182);
    outline: none;
    padding: 5px;
    width: 100%;
}
.form_a{
    margin: 5px 0 0 3px;
    background: white;
    display: block;
    border: none;
    border: 1px solid rgb(19, 103, 182);
    font-weight: bold;
    border-radius: 5px;
    font-size: small;
    outline: none;
    padding: 5px;
    width: 100%;
}
.cardheader h2 {
    color: white;
}
.detalhes {
    position: relative;
    width: 100%;
    padding: 20px;
    padding-top: 0;
    display: grid;
    grid-gap: 20px;
    grid-template-columns: 1fr;
}
.detalhes .recentesobs {
    position: relative;
    height: auto;
    min-height: auto;
    background: rgb(19, 103, 182);
    padding: 20px;
}
.cardbox {
    padding: 10px;
}
</style>
</body>
</html>