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
<title>CENSO - Observações</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php 
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
    $stmt->execute();
    if($stmt->rowCount() > 0){
        while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){


            $mes= date('n');
            $ano= date('Y');

            // validação do mês
            if ($mes == 1){
                $nome_mes = 'Janeiro';
            }elseif ($mes == 2){
                $nome_mes = 'Fevereiro';
            }elseif ($mes == 3 ){
                $nome_mes = 'Março';
            }elseif ($mes == 4) {
                $nome_mes = 'Abril';
            }elseif ($mes == 5) {
                $nome_mes = 'Maio';
            }elseif ($mes == 6) {
                $nome_mes = 'Junho';
            }elseif ($mes == 7) {
                $nome_mes = 'Julho';
            }elseif ($mes == 8) {
                $nome_mes = 'Agosto';
            }elseif ($mes == 9) {
                $nome_mes = 'Setembro';
            }elseif ($mes == 10) {
                $nome_mes = 'Outubro';
            }elseif ($mes == 11) {
                $nome_mes = 'Novembro';
            }elseif ($mes == 12) {
                $nome_mes = 'Dezembro';
            }
    
            // echo "{$dados['nome']}";
?>
<style>
.dropbtn {
  background-color: #007fb5;
  color: white;
  padding:0px 21px;
  font-size: 16px;
  border: none;
  border-radius: 10px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  border:none;
  cursor: pointer;
  border-radius: 0px 10px 10px 10px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content p {
  color: black;
  padding: 12px 16px;
  max-width: 200px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: white; color: black; border-radius: 10px 10px 0px 0px; transition: 0.2s;}

.detalhes_frota .recentesobs_frota {
    height: max-content;
    min-height: auto;
}
.detalhes_frota .recentesobs_frota table tr td {
    padding: 2px 1px;
}
</style>
           <div class="cardbox">
                
            </div>
            <!--detalhe-->
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h2>Observações - <?=$nome_mes?></h2>
                        <a href="principal.php?p=../classes/observar.php" class="botao_frota">Observar</a>
                    </div>
                    <!--Tabela de veiculos-->
                    <table>
                        <thead>
                            <tr>
                                <td style="text-align: center;">Nº</td>
                                <td style="text-align: center;">Tipo</td>
                                <td style="text-align: center;">Observação</td> 
                                <td style="text-align: center;">Data</td>
                                <td style="text-align: center;">Responsável</td>
                            </tr>
                        </thead>
                        <?php 
                        $frota = $pdo->prepare(" SELECT * FROM obs WHERE func = $user and MONTH(data_ocor)=$mes AND YEAR(data_ocor) = $ano");
                        $frota->execute();
                        if($frota->rowCount() > 0){
                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){

                        ?>
                        <tbody>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td style="text-align: center;"><?= $carros['id']; ?></td>
                                <?php
                                //verificação se a ferramenta esta ativa
                                    if ($carros['tipo'] == 'p') {
                                        $class = 'a';
                                        $status = 'Positivo'; //retorna o status se for ativo
                                    }
                                    elseif ($carros['tipo'] == 'n') {
                                        $class = 'i';
                                        $status = 'Negativo'; // retorna o status se for inativo
                                    }
                                ?>
                                <td style="text-align: center;"><span class="status <?=$class?>">
                                <?= $status ?>
                                </span>
                                
                                </td>
                                <td style="text-align: center;">
                                <div class="dropdown">
                                    <button class="dropbtn">Infos</button>
                                    <div class="dropdown-content">
                                        <p>
                                        <?=$carros[obs]?>
                                        </p>
                                    </div>
                                </div>
                                </td>
                                <td style="text-align: center;">
                                <?php
                                $data_ocor = $carros[data_ocor];	 
                                $d1 = explode ('-', $data_ocor);
                                $data_ocor = $d1[2]."/".$d1[1]."/".$d1[0];		 
                                echo $data_ocor;
                                ?>
                                </td>
                                <td style="text-align: center;">
                                <?php 
                                $tip = $pdo->prepare(" SELECT * FROM usuarios WHERE id = $carros[cadastradopor] ");
                                $tip->execute();
                                while($tipo = $tip->fetch(PDO::FETCH_ASSOC)){
                                    echo $tipo[nome];
                                } 
                                ?>
                                </td>
                                
                             
                            </tr>
                            
                        </tbody>
                        <?php }}else {
                            echo '<tbody>
                                        <td style="text-align: center; font-size: 13px; background-color:white; color: black; border-radius: 0px 0px 10px 10px;" colspan="5">
                                            Nenhuma observação nesse mês!
                                        </td>
                                    </tbody>';
                             }?>
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
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
</script>
</body>
</html>