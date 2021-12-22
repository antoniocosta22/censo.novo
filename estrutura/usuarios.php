<?php
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }

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
  padding: 6px 10px;
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
    padding: 2px 1px;
    font-size: small;
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
                        <h2>Usuários</h2>
                     
                    </div>
                    
                    <table id="usuarios" >
                        <thead>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Bairro</th>
                            <th>Telefone</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </thead>
                        <tbody>
                        <?php 
                            $stmt = $pdo->prepare("SELECT id, nome, bairro, cel, status FROM usuarios ORDER BY id");
                            $stmt->execute();
                            if($stmt->rowCount() > 0){
                                while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    // echo "{$dados['nome']}";
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $dados['id']; ?></td>
                                <td style="text-align: center;"><?= $dados['nome']; ?></td>
                                <td style="text-align: center;"><?= $dados['bairro']; ?></td>
                                <td style="text-align: center;"><?= $dados['cel']; ?></td>
                                <?php
                                //verificação se a ferramenta esta ativa
                                    if ($dados['status'] == 'A') {
                                        $status = 'Ativo'; //retorna o status se for ativo
                                        $class = 'a'; //retorna a classe pra colorir a tag span
                                    }
                                    elseif ($dados['status'] == 'I') {
                                        $status = 'Inativo'; // retorna o status se for inativo
                                        $class = 'i'; //retorna a classe pra colorir a tag span
                                    }
                                ?>
                                <td style="text-align: center;"><span class="status <?=$class?>">
                                <?=$status?>
                                </span></td>
                                <td>
                                <div class="dropdown">
                                    <button href="#" class="dropbtn" style="color: white; padding: 2px 15px; border-radius: 5px; background: rgb(19, 150, 182);">Ações</button>
                                    <div class="listar_acoes" style="border-radius: 5px;">
                                    <a href="principal.php?p=adm/atualizar_user.php&u=<?= $dados['id']; ?>">Editar</a>
                                    <a href="principal.php?p=adm/atualizar_user_stat.php&u=<?= $dados['id']; ?>">Alterar status</a>
                                    <a href="principal.php?p=adm/atualizar_user_perm.php&u=<?= $dados['id']; ?>">Permissões</a>
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
