<?php
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }
    $user = $_SESSION["id_user"];
    $chave = $_GET['ch'];

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

    
           <div class="cardbox">
                
            </div>
            <!--detalhe-->
            <?php
                $frota = $pdo->prepare(" SELECT * FROM chave_chaveiros where id = $chave");
                $frota->execute();
                while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
         
            ?>
            <div class="detalhes">
                <!-- divisão e dados -->
                <div class="recentesobs">
                    <div class="cardheader">
                    <img src="imgs/CENSO.png" style=" width: 150px;">
                    <div style="text-align: center;">
                    <h4>CAS - INTERNET EM ALTA VELOCIDADE</h4>
                    <h5>CHAVEIRO Nº - <?= $carros[id];?></h5>
                    </div>
                        
                        <div class="dropdown">
                        <a href="principal.php?p=chaveiro/chaveiros.php" class="dropbtn" style="padding: 5px 15px; border-radius: 5px; background: white; text-decoration: none; ">Voltar</a>
                        </div>
                    </div>
                    
                    <div class="ladoalado">
                    <label class="form">ID: <?= $carros['id'];?></label>
                    <label class="form_a">CHAVEIRO: <?= $carros['nome_chaveiro'];?></label>
                    </div>
                    <!--  inicio  -->
                    <div class="ladoalado">
                    <label class="form">DATA DE CADASTRO: 
                        <?php
                    
                        $data_cad = $carros['data_cad'];		 
                        list( $date, $time ) = explode( ' ', $data_cad );  
                        $d1 = explode ('-', $date);
                        $data_cad = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        echo $data_cad; 
                
                        ?>


                    </label>
                    <label class="form_a">CIDADE: 
                        <?php
                        $tip3 = $pdo->prepare("SELECT * FROM cidades WHERE id_cidade = $carros[cidade] ");
                        $tip3->execute();
                        while($tipo3 = $tip3->fetch(PDO::FETCH_ASSOC)){
                            echo $tipo3['cidade'];
                        }
                        ?>
                    </label>
                    </div>
                    <!-- SQL DE FABRICANTE -->
                
                    <div class="ladoalado">
                    <label class="form">DATA ALTERAÇÃO: 
                        <?php
                            $data_alt = $carros['data_alt'];		 
                            list( $date, $time ) = explode( ' ', $data_alt );  
                            $d1 = explode ('-', $date);
                            $data_alt = $d1[2]."/".$d1[1]."/".$d1[0];		 
                            echo $data_alt,' às ', $time; 
                        ?>
                        
                        </label>
                    <label class="form_a">RESPONSÁVEL: 
                      
                        <?php
                        if ($carros[resp] == 0){
                            $resp = 'CENTRAL CAS';
                        }
                        else {
                            $tip4 = $pdo->prepare("SELECT * FROM usuarios WHERE id = $carros[resp] ");
                            $tip4->execute();
                            while($tipo4 = $tip4->fetch(PDO::FETCH_ASSOC)){
                                $resp = $tipo4['nome'];
                            }
                        }
                        echo $resp;
                        ?>
                    </label>
                    </div>

                </div>
                <?php
                    }
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
                                <td>ID</td>
                                <td>DATA</td> 
                                <td>TIPO</td>
                                <td>RESPONSÁVEL</td>
                                <td>OPERADOR</td>
                                <td>OBSERVAÇÕES</td>
                            </tr>
                        </thead>
                        <?php 
                        $frota = $pdo->prepare(" SELECT * FROM chaveiro_ocorrencia WHERE id_chaveiro = $chave");
                        $frota->execute();
                        if($frota->rowCount() > 0){
                        while($ocor_chave = $frota->fetch(PDO::FETCH_ASSOC)){
                            $status = $ocor_chave['acao'];
                            $recebida = $ocor_chave['tipo_ocor'];
                        ?>
                        <tbody>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td>
                                <?=$ocor_chave['id_ocorrencia'];?>
                                </td>
                                <td>
                                <?
                                    $data_ocorrencia = $ocor_chave['data_cad'];		 
                                    list( $date, $time ) = explode( ' ', $data_ocorrencia );  
                                    $d1 = explode ('-', $date);
                                    $data_ocorrencia = $d1[2]."/".$d1[1]."/".$d1[0];		 
                                    echo $data_ocorrencia,' às ', $time; 
                                
                                ?>  
                                </td>
                                <td>
                                <?php
                                    if ($recebida == 1){
                                        $classe1 = 'atencao';
                                        $status1 = 'SAÍDA';
                                    }elseif($recebida == 2){
                                        $classe1 = 'n';
                                        $status1 = 'ENTREGA';
                                    }elseif ($recebida == 3){
                                        $classe1 = 'a';
                                        $status1 = 'RECEBIDA';
                                    }
                                    ?>
                                    <span class="status <?=$classe1?>"><?=$status1?></span>
                                </td>
                                
                                
                                <td>
                                <?php 
                                if ($ocor_chave['usr_dest'] == 0) {
                                    echo "CENTRAL CAS!" ;
                                }
                                else { 
                                $tip = $pdo->prepare(" SELECT * FROM usuarios WHERE id = $ocor_chave[usr_dest] ");
                                $tip->execute();
                                while($tipo = $tip->fetch(PDO::FETCH_ASSOC)){
                                    echo $tipo['nome'];
                                } }
                                ?>
                                </td>
                                <td>
                                <?php 
                                
                                $tip = $pdo->prepare(" SELECT * FROM usuarios WHERE id = $ocor_chave[id_usr] ");
                                $tip->execute();
                                while($tipo = $tip->fetch(PDO::FETCH_ASSOC)){
                                    echo $tipo['nome'];
                                } 
                                ?>
                                </td>
                                <td>
                                <?php
                                if ($ocor_chave['descr'] == ''){
                                    echo "Sem observações!";
                                }else {
                                    echo $ocor_chave['descr'];
                                }

                                ?>
                                </td>
                               
                            </tr>
                        </tbody>
                        <?php } } else {?>
                            <tbody>
                            
                                <td colspan="6">

                                        Nenhuma Ocorrencia

                                </td>
                            </tbody>
                       <?php  }   ?>
                    </table>

                    
                    
                </div>
                
            </div>
            <!--fim detalhe-->
        </div>


        
  
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