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
    
           <div class="cardbox">
                
            </div>
            <!--detalhe-->
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h2>Solicitações</h2>
                        <a href="principal.php?p=solicitacoes/solicitar.php" class="botao_frota">Solicitar</a>
                    </div>
                    <!--Tabela de veiculos-->
                    <table>
                        <thead>
                            <tr>
                                <td>Nº</td>
                                <td>STATUS</td>
                                <td>SOLICITANTE</td> 
                                <td>DEPARTAMENTO</td>
                                <td>TIPO</td>
                                <td>DETALHES</td>
                                <td>AÇÕES</td>
                               
                            </tr>
                        </thead>
                        <?php 
                        $frota = $pdo->prepare(" SELECT solicitacao, status, usuario, depart, tipo, descr FROM solicitacoes WHERE status IN ('MO', 'AB')  AND resp = $user  ORDER BY datacad");
                        $frota->execute();
                        if($frota->rowCount() > 0){
                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                            $status = $carros['status'];
                            $solic = $carros['solicitacao'];
                            $users = $carros['usuario'];
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
                                    elseif($status == 'EN'){
                                        $classe = 'f';
                                        $status = 'Encerrado';
                                    }

                                    ?>
                                <span class="status <?=$classe?>"><?=$status?></span>
                                </td>
                                <td>
                                <?php 
                                $solici = $pdo->prepare(" SELECT nome FROM usuarios WHERE id = $carros[usuario] limit 1 ");
                                $solici->execute();
                                while($sol = $solici->fetch(PDO::FETCH_ASSOC)){
                                $soli = $sol["nome"];
                                $primeironome = explode(" ", $soli);
                                //SELECIONA O PRIMEIRO E ULTIMO NOME DA PESSOA
                                
                                echo current($primeironome);
                                echo " ";
                                echo end($primeironome);
                                
                                } 
                                ?>   
                                </td>
                                <td>
                                <?php 
                                if ($carros['depart'] == '1'){
                                    echo "DIVISÃO DE TECNOLOGIA";
                                }elseif ($carros['depart'] == '2'){
                                    echo "DIVISÃO ORCAMENTARIA E FINANCEIRA";
                                }elseif ($carros['depart'] == '3'){
                                    echo "DIVISÃO DE SUPORTE E ATENDIMENTO";
                                }elseif ($carros['depart'] == '4'){
                                    echo "DIVISÃO DE ATIVACAO E MANUTENÇÃO";
                                }elseif ($carros['depart'] == '4'){
                                    echo "DIVISÃO COMERCIA";
                                }
                                
                                ?> 
                                </td>
                                
                                
                                <td>
                                <?php 
                                $tip = $pdo->prepare(" SELECT tpsoli FROM tpsoli WHERE id = $carros[tipo] limit 1 ");
                                $tip->execute();
                                while($tipo = $tip->fetch(PDO::FETCH_ASSOC)){
                                    echo $tipo["tpsoli"];
                                } 
                                ?>
                                </td>
                                <td><a href="principal.php?p=solicitacoes/solicitacoes_infos.php&sl=<?= $carros['solicitacao'];?>&pg_atual=solicitacoes.php" target="_blank" style=" text-decoration: none; "><span class="status a" style="background-color: slategray;  color: white;" title="<?=$carros['descr']?>">Infos</span></a></td>
                                <td>
                                <div class="dropdown">
                                    <button href="#" class="dropbtn" style="color: white; padding: 3px 15px; border-radius: 5px; background: dodgerblue;">Ações</button>
                                    <div class="listar_acoes" style="border-radius: 5px;">
                                    <?php
                                     $receba = $pdo->prepare(" SELECT * FROM movimento WHERE solicitacao = $carros[solicitacao] ORDER BY id desc limit 1 ");
                                     $receba->execute();
                                     while($receba_s = $receba->fetch(PDO::FETCH_ASSOC)){
                                         $recebido = $receba_s['recebido'];
                                     }
                                    if ($recebido == 'N'){
                                    echo "<a style='padding: 9px 10px;' href='principal.php?p=solicitacoes/receber.php&soli=$carros[solicitacao]' target='_blank'>Receber</a>";
                                    }?>
                                    <a href="" onClick="javascript:window.open ('estrutura/solicitacoes/movimentar.php?id=<?=$carros['solicitacao']?>', '', 'toolbar=yes,scrollbars=yes,resizable=yes,top=170,left=250,width=882,height=400')">Movimentar</a>
                                    <a href="" onClick="javascript:window.open ('estrutura/solicitacoes/observar.php?id=<?=$carros['solicitacao']?>', '', 'toolbar=yes,scrollbars=yes,resizable=yes,top=170,left=250,width=882,height=400')">Observar</a>
                                    
                                    <?php
                                        if ($users != $user){?> 
                                        <a href="" onClick="javascript:window.open ('estrutura/solicitacoes/encerrar.php?id=<?=$carros['solicitacao']?>', '', 'toolbar=yes,scrollbars=yes,resizable=yes,top=170,left=250,width=882,height=400')">Encerrar</a>
                                    <?php }?>
                                    </div>
                                </td>
                               
                            </tr>
                        </tbody>
                        <?php } }else {
                            echo '<tbody>
                            <td style="text-align: center; font-size: 13px; background-color:white; color: black; font-weight: 300px; border-radius: 0px 0px 5px 5px;" colspan="7">
                                Nenhuma solicitação pendente!
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
  padding: 9px 10px;
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