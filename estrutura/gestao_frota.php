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
<title>CENSO - Veiculos</title>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<style>

.dropbtn {
    color: black;
    padding: 5px 15px;
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
  border-radius: 10px;
  padding: 5px 16px;
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
.detalhes_frota .recentesobs_frota table tr td {
    padding: 0px 0px;
    font-size: small;
}

</style>
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
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h2>Gerenciar - Frota</h2>
                        <a href="principal.php?p=automoveis.php" class="botao_frota">Quadro Geral</a>
                    </div>
                    <!--Tabela de veiculos-->
                    <table>
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>KM</td>
                                <td>Modelo</td> 
                                <td>Responsável</td>
                                <td>Placa</td>
                                <td>Detalhes</td>
                                <td>Ocorrências</td>
                            </tr>
                        </thead>
                        <?php 
                        $frota = $pdo->prepare(" SELECT * FROM frota_automovel ORDER BY id_automovel");
                        $frota->execute();
                        if($frota->rowCount() > 0){
                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                        
                        ?>
                        <tbody>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td><?= $carros['id_automovel']; ?></td>
                                <td>
                                    <?php
                                    $km_atua = $pdo->prepare(" SELECT obss FROM km_trocas WHERE veiculo = $carros[id_automovel] ORDER BY id desc limit 1");
                                    $km_atua->execute();
                                    while($register = $km_atua->fetch(PDO::FETCH_ASSOC)){
                                        $rows = $km_atua->rowCount();
                                        if (isset($rows)){
                                            echo $register['obss'];
                                        }else{
                                            echo 'Nenhum KM';
                                        }
                                        
                                    }
                                    ?>
                                </td>
                                <td><?= $carros['modelo']; ?></td>
                                <td>
                                    <?php
                                        $resp = $pdo->prepare(" SELECT * FROM usuarios WHERE id = $carros[responsavel]");
                                        $resp->execute();
                                        while($user = $resp->fetch(PDO::FETCH_ASSOC)){
                                        echo $user[nome];
                                     }
                                    ?>
                                </td>
                                <td><?= $carros['placa'];?></td>
                                <td><a href="principal.php?p=frota/relatorio_frota.php&f=<?= $carros['id_automovel']; ?>" class="botao_ops"><span><i class="fas fa-info"></i></span></a></td>
                                <td>
                                <div class="dropdown">
                                    <button href="#" class="dropbtn" style="padding: 5px 15px; border-radius: 5px; background: gold;">Ações</button>
                                    <div class="listar_acoes" style="border-radius: 5px;">
                                    <a href="principal.php?p=frota/lancar_km.php&car=<?=$carros[id_automovel];?>" target="_blank">Lançar KM</a>
                                    <a href="principal.php?p=frota/checklist.php&f=<?=$carros[id_automovel];?>">Ckecklist</a>
                                    <a href="principal.php?p=frota/gerenciar_frota.php&c=frota_chart.php&id_carro=<?= $carros['id_automovel'];?>">Gerenciar</a>
                                    <!-- <a href="#">Troca de Óleo</a>
                                    <a href="#">Kilometragens</a>
                                    <a href="#">Troca de Correia</a>
                                    <a href="#">Lançar Manutenção</a> -->
                                    <?php
                                    if ($dados['adm'] == 'S'){
                                        echo "<a href='principal.php?p=frota/atualizar.php&f=$carros[id_automovel]'>Editar</a>";
                                    }
                                    ?>

                                    </div>
                                    </div>
                                </td>
                               
                                
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                    

    
                </div>
                
            </div>
            <!--fim detalhe-->
        </div>
    </div>
<?php 
        }
    }
}     
?>
<script>
    /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function listagem() {
    document.getElementById("listar").classList.toggle("shows");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("listar_acoes");
    for (var d = 0; d < dropdowns.length; d++) {
      var openDropdown = dropdowns[d];
      if (openDropdown.classList.contains('shows')) {
        openDropdown.classList.remove('shows');
      }
    }
  }
}
</script>

</body>
</html>