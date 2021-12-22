<?php 
$cid_sigla = $_GET['c'];
$id_cliente = $_GET['cliente'];
$frota = $pdo->prepare(" SELECT * FROM vendas where id = $id_cliente ");
$frota->execute();
if($frota->rowCount() > 0){
while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
    $nome = $carros['nome'];
    $apelido = $carros['apelido'];
    $pagina_anterior = $_GET['pg'];
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CENSO - Clientes</title>

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
        $datanasc = $carros['data_nasc'];   
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
                    <h5>CLIENTE - <?= $carros['nome'];?></h5>
                    </div>
                        
                        <!-- <div class="dropdown">
                        <a href="principal.php?p=vendas/fila_vendas.php&x!=<?=$cid_sigla?>&v=<?=$pagina_anterior?>" class="dropbtn" style="padding: 5px 15px; border-radius: 5px; background: white;">Voltar</a>
                        </div> -->
                    </div>
                    
                    <div class="ladoalado">
                    <label class="form"> <label class="status mig_t">NOME:</label> <?= $carros['nome'];?></label>
                    <label class="form_a"><label class="status mig_t">APELIDO:</label> <?= $carros['apelido'];?></label>
                    </div>
                    <!--  inicio  -->
                    <div class="ladoalado">
                    <label class="form"><label class="status mig_t">FILIAÇÃO:</label> <?= $carros['pai'];?> e <?= $carros['mae'];?></label>
                    <label class="form_a"><label class="status mig_t">NATURAL DE:</label> <?= $carros['natur'];?></label>
                    </div>
                    <!-- SQL DE FABRICANTE -->
                    <div class="ladoalado">
                    <label class="form"><label class="status mig_t">ENDEREÇO:</label> <?= $carros['ender'];?></label>
                    <label class="form_a"><label class="status mig_t">EMAIL:</label> <?= $carros['email'];?></label>
                    </div>

                    <div class="ladoalado">
                    <label class="form"><label class="status mig_t">CEP:</label> <?= $carros['cep'];?></label>
                    <label class="form_a"><label class="status mig_t">PROFISSÃO:</label> <?= $carros['profi'];?></label>
                    </div>
                    
                    
                    <!-- cadastrado por -->
                    <div class="ladoalado">
                    
                    <label class="form"><label class="status mig_t">ESTADO CIVIL:</label> <?= $carros['estcivil'];?></label>
                    <label class="form_a"><label class="status mig_t">BAIRRO:</label> <?= $carros['bairro'];?></label>
                    </div>
                    <div class="ladoalado">
                    <label class="form"><label class="status mig_t">CIDADE:</label> <?= $carros['cidade'];?> - <?= $carros['uf'];?></label>
                    <!-- SQL DE FABRICANTE -->
                   
                    <label class="form_a"><label class="status mig_t">RG | CPF:</label> <?= $carros['rg'];?> | <?= $carros['cpf'];?></label>
                    </div>
                    <div class="ladoalado">
                    <label class="form"><label class="status mig_t">DATA DE NASCIMENTO:</label>
                    <?=$datanasc?>
                    </label>
                    <label class="form_a"><label class="status mig_t">FONE 01 | FONE 02:</label> <?= $carros['fone1'];?> | <?= $carros['fone2'];?></label>
                    </div>
                    <div class="ladoalado">
                    <label class="form"><label class="status mig_t">PLANO:</label> 
                        <?=$carros['plano'];?>
                    </label>
                 
                    <label class="form"><label class="status mig_t">VENDEDOR:</label> 
                        <?php
                            $vende = $pdo->prepare(" SELECT nome FROM usuarios where id = $carros[vend] ");
                            $vende->execute();
                            while($list_vend = $vende->fetch(PDO::FETCH_ASSOC)){
                                echo $list_vend['nome'];
                            }

                        ?>
                    </label>
                    </div>
                    <label class="form"><label class="status mig_t">NEGOCIAÇÃO:</label> 
                        A negociação foi <?=$carros['neg'];?>, com parcela no valor de <?=$carros['parc'];?>
                    </label>
                    <?php
                    if ($carros['indicacao'] == 's'){
                        echo "<label class='form'>INDICADOR: 
                            $carros[indicador_nome]
                            </label>";
                    }?>
                    <label class="form"><label class="status mig_t">REFERÊNCIAS:</label> 
                    <?=$carros['ref'];?>
                    </label>
                    <label class="form"><label class="status mig_t">DESCRIÇÃO:</label>
                        <?=$carros['obs'];?>
                    </label>
                </div>
                <!-- fim do card -->
            </div>
<?php
}}
?>



<style>
    .mig_t {
        background-color: grey;
        font-size: smaller;
    }
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