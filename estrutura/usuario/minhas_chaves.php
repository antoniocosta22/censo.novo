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
<title>CENSO - Solicitações</title>
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
            $('#teste').DataTable({
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



    
            // echo "{$dados['nome']}";
?>
    
           <div class="cardbox">
                
            </div>
            <!--detalhe-->
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h2>Chaveiros</h2>
                        
                    </div>
                    <!--Tabela de veiculos-->
                    <table id="teste">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Nome</th>
                            <th>Responsável</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php 
                        $frota = $pdo->prepare(" SELECT * FROM chave_chaveiros WHERE resp = $user ");
                        $frota->execute();
                        if($frota->rowCount() > 0){
                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){


                        ?>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                            <td style="text-align: center;"><?= $carros['id']; ?></td>
                                <td style="text-align: center;">
                                <?php
                               
                                if ($carros['resp'] == 0){
                                    $stat = 'a';
                                    $nome_stat = 'Disponível';
                                }
                                else{
                                    $stat = 'n';
                                    $nome_stat = 'Entregue';
                                }
                                ?>
                                <span class="status <?=$stat?>"><?=$nome_stat?></span>
                                </td>
                                <td style="text-align: center;"><?= $carros['nome_chaveiro']; ?></td>
                                <td style="text-align: center;">
                                <?php
                                $frota = $pdo->prepare(" SELECT nome FROM usuarios WHERE id = $carros[resp]");
                                $frota->execute();
                                while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                                $resp = $carros['nome'];

                                }
                                if ($carros['resp'] == 0){
                                    $nome = 'Gerenciar';
                                    $url = 'chaveiro_saida';
                                    echo 'CENTRAL CAS';
                                }
                                else{
                                    $nome = 'Receber';
                                    $url = 'chave_receber';
                                    echo $resp;
                                }
                                ?>
                                </td>
                            
                            </tr>
                            <?php }} ?>
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
<style>
.finalizado{
    background: rgb(0, 69, 90);
    color: white;
}
.detalhes_frota .recentesobs_frota table tr td {
    padding: 6px;
    text-align: center;
    font-size: 11px;
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
<script>
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
</script>
</body>
</html>