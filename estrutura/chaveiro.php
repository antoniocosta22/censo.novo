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
<title>CENSO - Metas</title>

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
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h2>Chaveiro</h2>
                   
                    </div>
                    <!--Tabela de veiculos-->
                    <table>
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>KM</td>
                                <td>Modelo</td> 
                                <td>Responsável</td>
                                <td>Data</td>
                                <td>Placa</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><span class='status_frota i'>Inativo</span></td>
                               
                            </tr>
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

</body>
</html>