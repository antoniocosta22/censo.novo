<?php
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }
    $user = $_SESSION["id_user"];
    $id_soli = $_GET['sl'];
    $pg_ant = $_GET['pg_atual'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CENSO - Veiculos</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
?>
    
           <div class="cardbox">
                
            </div>
            <!--detalhe-->
            <?php
                $frota = $pdo->prepare(" SELECT * FROM solicitacoes where solicitacao = $id_soli");
                $frota->execute();
                if($frota->rowCount() > 0){
                while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                    $data_cad = $carros['datacad'];
            ?>
            <div class="detalhes">
                <!-- divisão e dados -->
                <div class="recentesobs">
                    <div class="cardheader">
                    <img src="imgs/CENSO.png" style=" width: 150px;">
                    <div style="text-align: center;">
                    <h4>CAS - INTERNET EM ALTA VELOCIDADE</h4>
                    <h5>SOLICITACÃO Nº - <?= $carros['solicitacao'];?></h5>
                    </div>
                        
                        <div class="dropdown">
                        <a href="javascript:window.close()" title="Fechar" class="dropbtn" style="padding: 5px 15px; border-radius: 5px; background: red; color: white; text-decoration: none; "> <strong> X </strong></a>
                        </div>
                    </div>
                    
                    <div class="ladoalado">
                    <label class="form">SOLICITAÇÃO: <?= $carros['solicitacao'];?></label>
                    <label class="form_a">REFERENTE A: 
                        <?php
                        $tip1 = $pdo->prepare("SELECT * FROM tpsoli WHERE id = $carros[tipo] ");
                        $tip1->execute();
                        while($tipo1 = $tip1->fetch(PDO::FETCH_ASSOC)){
                            echo $tipo1['tpsoli'];
                        }
                        ?>
                    </div>
                    <!--  inicio  -->
                    <div class="ladoalado">
                    <label class="form">DE: 
                        <?php
                        $tip2 = $pdo->prepare("SELECT * FROM instit WHERE id = $carros[instit] ");
                        $tip2->execute();
                        while($tipo2 = $tip2->fetch(PDO::FETCH_ASSOC)){
                            echo $tipo2['instit'];
                        }
                        ?>
                    </label>
                    <label class="form_a">SETOR: 
                        <?php
                        $tip3 = $pdo->prepare("SELECT * FROM setores WHERE id = $carros[depart] ");
                        $tip3->execute();
                        while($tipo3 = $tip3->fetch(PDO::FETCH_ASSOC)){
                            echo $tipo3['depart'];
                        }
                        ?>
                    </label>
                    </div>
                    <!-- SQL DE FABRICANTE -->
                
                    <div class="ladoalado">
                    <label class="form">SOLICITADO DIA: <?= $carros['datacad'];?></label>
                    <label class="form_a">SOLICITANTE: 
                        <?php
                        $tip4 = $pdo->prepare("SELECT * FROM usuarios WHERE id = $carros[usuario] ");
                        $tip4->execute();
                        while($tipo4 = $tip4->fetch(PDO::FETCH_ASSOC)){
                            echo $tipo4['nome'];
                        }
                        ?>
                    </label>
                    </div>

                    <div class="ladoalado">
                    <label class="form">1º ENCAMINHAMENTO: 
                        <?php
                        if ($carros['data'] == '') {
                            echo "NÃO FOI ENCAMINHADA!";
                        }else {
                            echo $carros['data'];
                        }
                        ?>
                    </label>
                    <label class="form_a">DESCRIÇÃO: <?= $carros['descr'];?></label>
                    </div>
                    
                </div>
                <?php
                    }}
                    ?>
            </div>
            <div class="detalhes_frota">
                <!-- divisão das tables -->
                <div class="recentesobs_frota" style="padding-top: 5px;">
                    <div class="cardheader_frota">
                    </div>
                    <!--Tabela de veiculos-->
                    <table>
                        <thead>
                            <tr>
                                <td>AÇÃO</td>
                                <td>DATA</td> 
                                <td>RECEBEU?</td>
                                <td>RESPONSÁVEL</td>
                                <td>DESCRIÇÃO</td>
                                <td>OBSERVAÇÕES</td>
                            </tr>
                        </thead>
                        <?php 
                        $frota = $pdo->prepare(" SELECT * FROM movimento WHERE solicitacao = $id_soli");
                        $frota->execute();
                        if($frota->rowCount() > 0){
                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                            $status = $carros['acao'];
                            $recebida = $carros['recebido'];
                        ?>
                        <tbody>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td>
                                <?php
                                    if ($status == 'ABERTA'){
                                        $classe = 'a';
                                        $status = 'Aberto';
                                    }elseif($status == 'MOVIMENTADO'){
                                        $classe = 'encaminhada';
                                        $status = 'Movimentado';
                                    }
                                    elseif($status == 'AVALIAR'){
                                        $classe = 'pendente';
                                        $status = 'Avaliar';
                                    }
                                    elseif($status == 'ENCERRADO'){
                                        $classe = 'finalizado';
                                        $status = 'Encerrado';
                                    }
                                    ?>
                                <span class="status <?=$classe?>"><?=$status?></span>
                                </td>
                                <td>
                                <?
                                    $dtmov = $carros['dtmov'];		 
                                    list( $date, $time ) = explode( ' ', $dtmov );  
                                    $d1 = explode ('-', $date);
                                    $dtmov = $d1[2]."/".$d1[1]."/".$d1[0];		 
                                    echo $dtmov,' às ', $time; 
                                
                                ?>  
                                </td>
                                <td>
                                <?php
                                    if ($recebida == 'S'){
                                        $classe1 = 'a';
                                        $status1 = 'SIM';
                                    }elseif($recebida == 'N'){
                                        $classe1 = 'i';
                                        $status1 = 'NÃO';
                                    }
                                    ?>
                                    <span class="status <?=$classe1?>"><?=$status1?></span>
                                </td>
                                
                                
                                <td>
                                <?php 
                                if ($carros['resp'] == 0) {
                                    echo "NÃO FOI ENCAMINHADA!" ;
                                }
                                else { 
                                $tip = $pdo->prepare(" SELECT * FROM usuarios WHERE id = $carros[resp] ");
                                $tip->execute();
                                while($tipo = $tip->fetch(PDO::FETCH_ASSOC)){
                                    echo $tipo['nome'];
                                } }
                                ?>
                                </td>
                                <td>
                                <?php
                                if ($carros['descr'] == ''){
                                    echo 'Encaminhado!';
                                }else {
                                    echo $carros['descr'];
                                }
                                ?>
                                </td>
                                <td>
                                <?php
                                if ($carros['obs'] == ''){
                                    echo "Sem observações!";
                                }else {
                                    echo $carros['obs'];
                                }

                                ?>
                                </td>
                               
                            </tr>
                        </tbody>
                        <?php } }?>
                    </table>

                    
                    
                </div>
                
            </div>
            <!--fim detalhe-->
        </div>


        


<?php 
        
    }
}     
?>
<style>
.finalizado{
    background: rgb(0, 69, 90);
    color: white;
}
    .dropbtn:hover {
    color: black;
}
.detalhes_frota .recentesobs_frota table tr td {

    text-align: center;
    font-size: 11px;
    font-weight: bold;

}
.detalhes_frota .recentesobs_frota {
    min-height: auto;
    margin-top: 20px;
    border-radius: 5px;
}

.detalhes_frota .recentesobs_frota table thead tr td:last-child, .detalhes_frota .recentesobs_frota table tbody tr td:last-child {
    text-align: center;
}
.detalhes_frota .recentesobs_frota table thead tr td:nth-child(2), .detalhes_frota .recentesobs_frota table tbody tr td:nth-child(2) {
    text-align: center;
}
.dropbtn {
    color: black;
    font-size: 14px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}
.botao_ops {
    background: turquoise;
}
.status {
    padding: 2px 10px;
    font-size: 12px;
}
.listar_acoes {
  display: none;
  position: absolute;
  min-width: 160px;
  width: max-content;
  border-radius: 5px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.listar_acoes a {
  color: black;
  text-align: center;
  background-color: rgb(13, 127, 233);
  color: white;
  padding: 5px 10px;
  text-decoration: none;
  display: block;
}
.listar_acoes a:hover {
    color: black;
}
.dropdown:hover .listar_acoes {
  display: block;
  background-color: rgb(13, 127, 233);
  right: 0;
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
    font-size: 11px;
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
    font-size: 11px;
    outline: none;
    padding: 5px;
    width: 100%;
}
.detalhes .recentesobs {
    position: relative;
    height: auto;
    min-height: auto;
    background: rgb(19, 103, 182);
    padding: 20px;
}
.detalhes {
    position: relative;
    width: 100%;
    margin-top: -20px;
    padding: 20px;
    padding-top: 0;
    display: grid;
    grid-gap: 20px;
    grid-template-columns: 1fr;
}
h4 {
    color: white;
}

h5 {
    color: white;
}
.cardheader {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

</style>
<script>
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
</script>
</body>
</html>