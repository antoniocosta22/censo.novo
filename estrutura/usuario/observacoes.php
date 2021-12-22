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
<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-3.5.1.js"></script>
<script src="js/cdn_data.js"></script>
<link rel="preload" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<script>
        $(document).ready(function() {
            $('#obs').DataTable({
                "language": {
                    "url": "json/Portuguese-Brasil.json"
                }
            });
        } );

        
    </script>
<?php 
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
    $stmt->execute();
    if($stmt->rowCount() > 0){
        while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){


            $mes= date('n');
            $ano= date('Y');

         
?>
<style>
.finalizado{
    background: rgb(0, 69, 90);
    color: white;
}
.detalhes_frota .recentesobs_frota table tr td {
    text-align: center;
    font-size: 11px;
    padding: 2px 1px;
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
.botao_ops {
    background: turquoise;
}
.status {
    padding: 5px 10px;
    font-size: 11px;
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
  padding: 3px 10px;
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
</style>
           <div class="cardbox">
                
            </div>
            <!--detalhe-->
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h2>Observações gerais</h2>
                      
                    </div>
                    <!--Tabela de veiculos-->
                    <table id="obs">
                        <thead>
                            <tr>
                                <td>Nº</td>
                                <td>TIPO</td>
                                <td>OBSERVAÇÃO</td> 
                                <td>DATA</td>
                                <td>OBSERVADOR</td>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php 
                        $frota = $pdo->prepare(" SELECT * FROM obs WHERE func = $user order by id");
                        $frota->execute();
                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){

                        ?>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td><?= $carros['id']; ?></td>
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
                                <td><span class="status <?=$class?>">
                                <?= $status ?>
                                </span>
                                
                                </td>
                                <td>
                                <div class="dropdown">
                                    <button class="dropbtn">Infos</button>
                                    <div class="dropdown-content">
                                        <p>
                                        <?=$carros["obs"]?>
                                        </p>
                                    </div>
                                </div>
                                </td>
                                <td>
                                <?php
                                $data_ocor = $carros["data_ocor"];	 
                                $d1 = explode ('-', $data_ocor);
                                $data_ocor = $d1[2]."/".$d1[1]."/".$d1[0];		 
                                echo $data_ocor;
                                ?>
                                </td>
                                <td>
                                <?php 
                                $tip = $pdo->prepare(" SELECT * FROM usuarios WHERE id = $carros[cadastradopor] ");
                                $tip->execute();
                                while($tipo = $tip->fetch(PDO::FETCH_ASSOC)){
                                    echo $tipo["nome"];
                                } 
                                ?>
                                </td>
                                
                             
                            </tr>
                            <?php }?>
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
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
</script>
</body>
</html>