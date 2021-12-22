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

<?php 
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
    $stmt->execute();
    if($stmt->rowCount() > 0){
        while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){



    
            // echo "{$dados['nome']}";
?>
    
<style>
    .dropbtn {
    color: black;
    padding: 5px 35px;
    font-size: 14px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}
.dropbtn:hover {
    color: black;
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
  border-radius: 10px;
}
</style>
           <div class="cardbox">
                
            </div>
            <!--detalhe-->
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h2>Frota - Automóveis</h2>
                        <div class="dropdown">
                                    <button href="#" class="dropbtn" style="padding: 5px 35px; border-radius: 5px; background: gold;">Ações</button>
                                    <div class="listar_acoes" style="border-radius: 5px;">
                                    <a href="principal.php?p=gestao_frota.php">Gerenciar</a>
                                    <a href="principal.php?p=frota/cadastro_frota.php">Cadastrar</a>
                                    </div>
                        </div>

                    </div>
                    <!--Tabela de veiculos-->
                    <table id="carros">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>KM</td>
                                <td>Modelo</td> 
                                <td>Responsável</td>
                                <td>Cidade</td>
                                <td>Placa</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <?php 
                        $frota = $pdo->prepare(" SELECT * FROM frota_automovel ORDER BY id_automovel");
                        $frota->execute();
                        if($frota->rowCount() > 0){
                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                            $id_cid = $carros['cidade'];
                        ?>
                        <tbody>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td><?= $carros['id_automovel']; ?></td>
                                <td><?= $carros['KM']; ?></td>
                                <td><?= $carros['modelo']; ?></td>
                                <td>
                                    <?php
                                        $resp = $pdo->prepare(" SELECT * FROM usuarios WHERE id = $carros[responsavel]");
                                        $resp->execute();
                                        while($user = $resp->fetch(PDO::FETCH_ASSOC)){
                                        echo $user["nome"];
                                     }
                                    ?>
                                </td>
                                <?php
                                        $cid = $pdo->prepare(" SELECT * FROM cidades WHERE id_cidade = $id_cid");
                                        $cid->execute();
                                        while($cidade = $cid->fetch(PDO::FETCH_ASSOC)){
                                        $nome_c = $cidade['cidade'];
                                     }
                                ?>
                                <td>
                                <?=$nome_c?>
                                </td>
                                <td><?= $carros['placa']; ?></td>
                                <?php
                                if ($carros["stat"] == "a"){
                                    echo "<td><span class='status_frota a'>Ativo</span></td>" ; } 
                                    else {
                                    echo "<td><span class='status_frota i'>Inativo</span></td>" ; } 
                                ?>
                               
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

</body>
</html>