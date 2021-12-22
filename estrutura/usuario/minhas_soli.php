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
<style>
    .send {
        background: black;
        color: white;
        border: none;
        padding: 5px;
        border-radius: 5px;
        cursor: pointer;
    }
    .select {
        background: cornflowerblue;
        padding: 5px;
        border: none;
        color: white;
        outline: none;
        border-radius: 5px;
        
    }
    .listar_acoes {
        text-align: center;
        background-color: rgb(13, 127, 233);
        color: white;
        padding: 5px 9px;
        border-radius: 5px;
        letter-spacing: 1px;
        text-decoration: none;
        display: block;
    }
    @media (max-width: 480px) {
        .cardheader_frota {
            display: grid;
    justify-content: center;
    align-items: center;
        }
        .formes {
            justify-content: center;
            align-items: center;
            display: contents;
        }
        .select {
            margin-bottom: 5px;
            
        }
        .send {
            margin-bottom: 5px;
        }
        .botao_frota {
            text-align: center;
            font-size: small;
        }
    }
</style>
           <div class="cardbox">
                
            </div>
            <!--detalhe-->
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h2>Minhas solicitações</h2>
                        <form action="" method="POST" class="formes">
                        <select class="select" name="tipo">
                            <option value="AV">Avaliar</option>
                            <option value="CA">Canceladas</option>
                            <option value="MO">Movimentadas</option>
                            <option value="AB">Abertas</option>
                            <option value="EN">Encerradas</option>
                        </select>
                        <input class="send" type="submit" value="Mostrar" name="Mostrar">
                        </form>
                        <a href="principal.php?p=./solicitacoes/solicitar.php" class="botao_frota">Solicitar</a>
                    </div>
                    <!--Tabela de veiculos-->
                    <!-- select -->
                    <?php
                    if ($_POST['Mostrar'] == "Mostrar") {
                    $status = $_POST['tipo'];
                    if ($status == 'EN'){
                        $tb = 'NOTA';
                    }else{
                        $tb = 'AÇÕES';
                    }
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <td>Nº</td>
                                <td>STATUS</td>
                                <td>DEPARTAMENTO</td>
                                <td>TIPO</td>
                                <td>DETALHES</td>
                                <td><?=$tb?></td>
                               
                            </tr>
                        </thead>
                        <?php 
                        $frota = $pdo->prepare(" SELECT * FROM solicitacoes WHERE usuario = $user AND status = '$status' ORDER BY solicitacao");
                        $frota->execute();
                        if($frota->rowCount() > 0){
                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                            $status = $carros['status'];
                            $solic = $carros['solicitacao'];
                            $avaliar = $carros['avaliar'];
                        ?>

                        <tbody>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td><?= $carros['solicitacao']; ?></td>
                                <td>
                                    <?php
                                           
                                    if ($status == 'AB'){
                                        $classe = 'a';
                                        $status = 'Aberto';
                                    }elseif($status == 'MO'){
                                        $classe = 'e';
                                        $status = 'Movimentado';
                                    }
                                    elseif($status == 'AV'){
                                        $classe = 'indi';
                                        $status = 'Avaliar';
                                    }
                                    elseif($status == 'EN'){
                                        $classe = 'f';
                                        $status = 'Encerrado';
                                    }
                                    elseif($status == 'CA'){
                                        $classe = 'i';
                                        $status = 'Cancelada';
                                    }

                                    ?>
                                    <?php
                                           
                                           if ($avaliar == '1'){
                                               $notas = 'RUIM';
                                           }elseif($avaliar == '2'){
                                            $notas = 'REGULAR';
                                            }
                                           elseif($avaliar == '3'){
                                            $notas = 'BOM';
                                            }
                                            elseif($avaliar == '4'){
                                                $notas = 'ÓTIMO';
                                            }
       
                                           ?>
                                <span class="status <?=$classe?>"><?=$status?></span>
                                </td>
                                <td>
                                <?php 
                                $setor = $pdo->prepare(" SELECT * FROM setores WHERE id = $carros[depart] ");
                                $setor->execute();
                                while($setores = $setor->fetch(PDO::FETCH_ASSOC)){
                                    echo $setores["depart"];
                                } 
                                ?> 
                                </td>
                                
                                
                                <td>
                                <?php 
                                $tip = $pdo->prepare(" SELECT * FROM tpsoli WHERE id = $carros[tipo] ");
                                $tip->execute();
                                while($tipo = $tip->fetch(PDO::FETCH_ASSOC)){
                                    echo $tipo["tpsoli"];
                                } 
                                ?>
                                </td>
                                <td><a href="principal.php?p=solicitacoes/solicitacoes_infos.php&sl=<?= $carros['solicitacao'];?>&pg_atual=usuario/minhas_soli.php" target="_blank" style=" text-decoration: none; "><span class="status a" title="<?=$carros['descr']?>" style="background-color: slategray;  color: white;">Infos</span></a></td>
                                <?php
                                  
                                   $stmt2 = $pdo->prepare("SELECT * FROM solicitacoes WHERE solicitacao = $carros[solicitacao]");
                                   $stmt2->execute();
                                       while($refer = $stmt2->fetch(PDO::FETCH_ASSOC)){
                                           $condicao = $refer['status'];
                                       
                                       }?>
                                <td>
                                <div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                                    <?php
                                  
                                    if ($condicao == 'AV'){?> 
                                        <a class="listar_acoes" style="background-color: lime; color: black; cursor: help;" href="" onClick="javascript:window.open ('estrutura/solicitacoes/avaliar.php?id=<?=$carros['solicitacao'];?>', '', 'toolbar=yes,scrollbars=yes,resizable=yes,top=170,left=250,width=882,height=400')">Avaliar</a>
                                    <?php }elseif ($condicao == 'EN'){?>
                                        <a class="listar_acoes" href="#" style="background-color: rgba(0, 255, 0, 0.781); cursor: no-drop;"><?=$notas?></a>
                                    <?php }elseif ($condicao == 'CA'){?>
                                        <a class="listar_acoes" href="#" style="background-color: yellow; cursor: no-drop;"><i class="fas fa-check-circle"></i></a>
                                    <?php }else{?>
                                        <a class="listar_acoes" style="background-color: teal; cursor: no-drop;" href="#" title="Aguardando..."><i class="fas fa-clock" ></i></a>
                                        <a class="listar_acoes" style="background-color: crimson; cursor: pointer;" href="principal.php?p=usuario/cancelar_soli.php&soli=<?=$carros['solicitacao'];?>" title="Cancelar"><i class="fas fa-times" ></i></a>
                                    <?php } ?>
                                    </div>
                                
                                </td>
                            </tr>
                        </tbody>
                        <?php } }else {
                            echo '<tbody>
                            <td style="text-align: center; font-size: 13px; background-color:white; color: black; font-weight: 300px; border-radius: 0px 0px 5px 5px;" colspan="7">
                                Nenhuma solicitação para avaliar!
                            </td>
                        </tbody>';
                            
                        }?>
                    </table>
                    <?php
                    }else{?>
                    <table>
                        <thead>
                            <tr>
                                <td>Nº</td>
                                <td>STATUS</td>
                                <td>DEPARTAMENTO</td>
                                <td>TIPO</td>
                                <td>DETALHES</td>
                                <td>AÇÕES</td>
                               
                            </tr>
                        </thead>
                        <?php 
                        $frota = $pdo->prepare(" SELECT * FROM solicitacoes WHERE usuario = $user AND status = 'AV' ORDER BY solicitacao");
                        $frota->execute();
                        if($frota->rowCount() > 0){
                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                            $status = $carros['status'];
                            $solic = $carros['solicitacao'];
                        ?>

                        <tbody>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td><?= $carros['solicitacao']; ?></td>
                                <td>
                                    <?php
                                           
                                    if ($status == 'AB'){
                                        $classe = 'a';
                                        $status = 'Aberto';
                                    }elseif($status == 'MO'){
                                        $classe = 'e';
                                        $status = 'Movimentado';
                                    }
                                    elseif($status == 'AV'){
                                        $classe = 'indi';
                                        $status = 'Avaliar';
                                    }
                                    elseif($status == 'EN'){
                                        $classe = 'f';
                                        $status = 'Encerrado';
                                    }

                                    ?>
                                <span class="status <?=$classe?>"><?=$status?></span>
                                </td>
                                <td>
                                <?php 
                                $setor = $pdo->prepare(" SELECT * FROM setores WHERE id = $carros[depart] ");
                                $setor->execute();
                                while($setores = $setor->fetch(PDO::FETCH_ASSOC)){
                                    echo $setores["depart"];
                                } 
                                ?> 
                                </td>
                                
                                
                                <td>
                                <?php 
                                $tip = $pdo->prepare(" SELECT * FROM tpsoli WHERE id = $carros[tipo] ");
                                $tip->execute();
                                while($tipo = $tip->fetch(PDO::FETCH_ASSOC)){
                                    echo $tipo["tpsoli"];
                                } 
                                ?>
                                </td>
                                <td><a href="principal.php?p=solicitacoes/solicitacoes_infos.php&sl=<?= $carros['solicitacao'];?>&pg_atual=usuario/minhas_soli.php" target="_blank" style=" text-decoration: none; "><span class="status a" title="<?=$carros['descr']?>" style="background-color: slategray;  color: white;">Infos</span></a></td>
                                <td>
                                <div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                                    <?php
                                    $stmt2 = $pdo->prepare("SELECT * FROM solicitacoes WHERE solicitacao = $carros[solicitacao]");
                                    $stmt2->execute();
                                        while($refer = $stmt2->fetch(PDO::FETCH_ASSOC)){
                                            $condicao = $refer['status'];
                                        
                                        }
                                    if ($condicao == 'AV'){?> 
                                        <a class="listar_acoes" style="background-color: lime; color: black; cursor: help;" href="" onClick="javascript:window.open ('estrutura/solicitacoes/avaliar.php?id=<?=$carros['solicitacao'];?>', '', 'toolbar=yes,scrollbars=yes,resizable=yes,top=170,left=250,width=882,height=400')">Avaliar</a>
                                    <?php }else{?>
                                        <a class="listar_acoes" style="background-color: teal; cursor: no-drop;" href="#" title="Aguardando..."><i class="fas fa-clock" ></i></a>
                                        <a class="listar_acoes" style="background-color: crimson; cursor: pointer;" href="principal.php?p=usuario/cancelar_soli.php&soli=<?=$carros['solicitacao'];?>" title="Cancelar"><i class="fas fa-times" ></i></a> 
                                    <?php } ?>

                                    
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <?php } }else {
                            echo '<tbody>
                            <td style="text-align: center; font-size: 13px; background-color:white; color: black; font-weight: 300px; border-radius: 0px 0px 5px 5px;" colspan="7">
                                Nenhuma solicitação para avaliar!
                            </td>
                        </tbody>';
                            
                        }?>
                    </table>
                    <?php }?>
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
    text-align: center;
    background-color: rgb(13, 127, 233);
    color: white;
    padding: 5px 9px;
    border-radius: 5px;
    letter-spacing: 1px;
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