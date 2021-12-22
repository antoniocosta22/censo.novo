<?php
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }


                            // $permission = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
                            // $permission->execute();
                            //     while($perm = $permission->fetch(PDO::FETCH_ASSOC)){
                            //             $adm = $perm['']
                            //     }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CENSO - Central de Solicitações</title>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-3.5.1.js"></script>
<script src="js/cdn_data.js"></script>
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<style>
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
  padding: 4px 10px;
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
.detalhes_frota .recentesobs_frota table tbody tr td:last-child {
    text-align: center;
}
.detalhes_frota .recentesobs_frota table tr td {
    text-align: center;
    font-size: 11px;
    font-weight: bold;
    padding: 2px 1px;
}
.detalhes_frota .recentesobs_frota {
    min-height: auto;
    border-radius: 5px;
}
.cardheader_frota {
    padding: 12px 2px;
}
.detalhes_frota .recentesobs_frota table thead tr td:last-child, .detalhes_frota .recentesobs_frota table tbody tr td:last-child {
    text-align: center;
}
.detalhes_frota .recentesobs_frota table thead tr td:nth-child(2), .detalhes_frota .recentesobs_frota table tbody tr td:nth-child(2) {
    text-align: center;
}
.linkar {
    display: inline-flex;
    color: white;
    padding: 6px;
    background: black;
    border-radius: 5px;
}
.link {
    text-decoration: none;
    color: white;
}
.botao {
    cursor: pointer;
}
</style>
<body>
    <script>
        $(document).ready(function() {
            $('#usuarios').DataTable({
                "language": {
                    "url": "json/Portuguese-Brasil.json"
                }
            });
        } );

        
    </script>
    <div class="cardbox">
                
            </div>
            <!--detalhe-->
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h2>Chaveiros</h2>
                        <a class="link" href="#"><label id="att" for="attu" class="botao" value="button" style="margin-bottom: 20px; padding: 5px 10px;">Cadastrar</label></a>
                        
                    </div>
                    
                    <table id="usuarios" >
                        <thead>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Nome</th>
                            <th>Responsável</th>
                            <th>Ações</th>
                        </thead>
                        <tbody>
                        <?php 
                            $stmt = $pdo->prepare("SELECT * FROM chave_chaveiros ORDER BY id");
                            $stmt->execute();
                            if($stmt->rowCount() > 0){
                                while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    // echo "{$dados['nome']}";
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $dados['id']; ?></td>
                                <td style="text-align: center;">
                                <?php
                               
                                if ($dados['resp'] == 0){
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
                                <td style="text-align: center;"><?= $dados['nome_chaveiro']; ?></td>
                                <td style="text-align: center;">
                                <?php
                                $frota = $pdo->prepare(" SELECT nome FROM usuarios WHERE id = $dados[resp]");
                                $frota->execute();
                                while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                                $resp = $carros['nome'];

                                }
                                if ($dados['resp'] == 0){
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
                                <td>
                                <div class="dropdown">
                                    <button href="#" class="dropbtn" style="color: white; padding: 2px 15px; border-radius: 5px; background: rgb(19, 150, 182); ">Ações</button>
                                    <div class="listar_acoes" style="border-radius: 5px;">
                                    <a  href="principal.php?p=chaveiro/chaves_chaveiro.php&ch=<?= $dados['id']; ?>">Ver</a>
                                    <a  href="principal.php?p=chaveiro/chave_info.php&ch=<?= $dados['id']; ?>">Ocorrências</a>
                                    <a  href="principal.php?p=chaveiro/atualizar.php&ch=<?= $dados['id']; ?>">Editar</a>
                                    <?php 
                                    if ($user == 87){?>
                                        <a  href="principal.php?p=chaveiro/<?=$url?>.php&ch=<?=$dados['id'];?>"><?=$nome?></a>
                                    <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        
                    </table>
       
                </div>
                
            </div>
            <!--fim detalhe-->
        </div>
    </div>
  
                <?php } ?>        
 
</body>
</html>