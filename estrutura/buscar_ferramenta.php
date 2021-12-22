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
<link rel="preload" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <script>
        $(document).ready(function() {
            $('#ferramentas').DataTable({
                "language": {
                    "url": "json/Portuguese-Brasil.json"
                }
            });
        } );

        
    </script>
    <style >
.detalhes_frota .recentesobs_frota table tr td {
    padding: 2px;
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
    padding: 5px 15px;
    font-size: 14px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}
.cardheader_frota {
    padding: 12px 2px;
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
    <div class="cardbox">
                
            </div>
            <!--detalhe-->
            <div class="detalhes_frota">
                <div class="recentesobs_frota">
                    <div class="cardheader_frota">
                        <h2>Ferramentas</h2>
                        <a class="link" href="principal.php?p=tools/cadastro_tool.php"><label id="att" for="attu" class="botao" value="button" style="margin-bottom: 20px; padding: 5px 10px;">Cadastrar</label></a>
                    </div>
                    
                    <table id="ferramentas" >
                        <thead>
                            <th>ID</th>
                            <th>Tombo</th>
                            <th>Status</th>
                            <th>Situação</th>
                            <th>Ferramenta</th>
                            <th>Responsável</th>
                            <th>Cidade</th>
                            <th>Ações</th>
                        </thead>
                        <tbody>
                        <?php 
                            $stmt = $pdo->prepare("SELECT id_ferramenta, status, ferramenta, responsavel, cidade, data_cad, tombo FROM ferramenta_cadastro ORDER BY id_ferramenta");
                            $stmt->execute();
                            if($stmt->rowCount() > 0){
                                while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    // echo "{$dados['nome']}";
                                   $id_ferra =  $dados['id_ferramenta'];
                                   $respon = $dados['responsavel'];
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $dados['id_ferramenta']; ?></td>
                              
                                <?php
                                $dia_cad = $dados['data_cad'];		 
                                list( $date, $time ) = explode( ' ', $dia_cad );  
                                $d1 = explode ('-', $date);
                                $dia_cad = $d1[2]."/".$d1[1]."/".$d1[0];
                              
                                // filtro dia cad  
                                $hoje = date('d/m/Y');

                            
                                    if ($dia_cad == $hoje) {
                                        $status = 'Novo';
                                        $class = 'n';
                                    }else {

                                        if ($dados['status'] == 'A') {
                                            $status = 'Ativo'; //retorna o status se for ativo
                                            $class = 'a'; //retorna a classe pra colorir a tag span
                                        }
                                        elseif ($dados['status'] == 'I') {
                                            $status = 'Inativo'; // retorna o status se for inativo
                                            $class = 'i'; //retorna a classe pra colorir a tag span
                                        }
                                    }
                                //verificação se a ferramenta esta ativa
                                    
                                ?>
                                <?php 
                                    $buscar_stat = $pdo->prepare("SELECT * FROM ferramenta_ocorrencia where id_ferramenta = $id_ferra ORDER BY id_ferramenta desc");
                                    $buscar_stat->execute();
                                        while($stat_fer = $buscar_stat->fetch(PDO::FETCH_ASSOC)){
                                         $status_fer = $stat_fer['confirmado'];
                                        }


                                        if ($buscar_stat->rowCount() < 1){
                                            $status_fera = 'Entrega';
                                            $class_f = 'a';
                                        }else {
                                            if ($status_fer == 's') {
                                                $status_fera = 'Recebida';
                                                $class_f = 'n';
                                            }else if ($status_fer == 'n'){
                                                $status_fera = 'pendente';
                                                $class_f = 'e';
                                                
                                            }
                                        }
                                        
                                ?>
                                <?php
                                    // entregar
                                    if ($dados['responsavel'] == 0){
                                       
                                        $ajuste = '#';
                                  
                                    }
                                    // atualziar 
                                    else {
                                      
                                        $ajuste = "principal.php?p=patrimonio/caixa_usuarios.php&cx_us=".$respon;
                                     
                                    }
                                    ?>
                                <td><?=$dados['tombo'];?></td>
                                <td><span class="status <?=$class?>">
                                <?=$status?>
                                </span></td>
                                <td><span class="status <?=$class_f?>">
                                <?=$status_fera?>
                                </span></td>
                                <td style="text-align: center;"><?= $dados['ferramenta']; ?></td>
                                <td style="text-align: left;">
                                <a href="<?=$ajuste?>" class="linkar" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                <?php 
                                $usuario_resp = $pdo->prepare("SELECT nome FROM usuarios WHERE id = $dados[responsavel]");
                                $usuario_resp->execute();
                                    while($resp = $usuario_resp->fetch(PDO::FETCH_ASSOC)){
                                        $res = $resp['nome'];
                                }

                                if ($dados['responsavel'] == 0){
                                    echo 'PARA ENTREGA!';
                                }else {
                                    
                                    $primeironome = explode(" ", $res);
                                //SELECIONA O PRIMEIRO E ULTIMO NOME DA PESSOA
                                
                                    echo current($primeironome);
                                    echo " ";
                                    echo end($primeironome);
                                }
                                ?>
                                
                                </td>

                                <?php
                                //verificação se a ferramenta esta ativa
                                    if ($dados['cidade'] == 'smt') {
                                        $cidade = 'São Mateus'; //retorna o status se for ativo
                                    }
                                    elseif ($dados['cidade'] == 'aal') {
                                        $cidade = 'Alto Alegre'; // retorna o status se for inativo
                                    }
                                    elseif ($dados['cidade'] == 'bac') {
                                        $cidade = 'Bacabal'; // retorna o status se for inativo
                                    }
                                    elseif ($dados['cidade'] == 'slg') {
                                        $cidade = 'São luis G.'; // retorna o status se for inativo
                                    }
                                    elseif ($dados['cidade'] == 'pir') {
                                        $cidade = 'Pirapemas'; // retorna o status se for inativo
                                    }
                                    elseif ($dados['cidade'] == 'cth') {
                                        $cidade = 'Cantanhede'; // retorna o status se for inativo
                                    }
                                    elseif ($dados['cidade'] == 'mat') {
                                        $cidade = 'Matões'; // retorna o status se for inativo
                                    }
                                    elseif ($dados['cidade'] == 'mir') {
                                        $cidade = 'Miranda'; // retorna o status se for inativo
                                    }
                                ?>
                                <td style="text-align: center;"><?= $cidade ?></td>
                                <td>
                                <div class="dropdown">
                                    <button href="#" class="dropbtn" style="padding: 2px 15px; border-radius: 5px; background: gold;">Ações</button>
                                    <div class="listar_acoes" style="border-radius: 5px;">
                                    <a href="principal.php?p=tools/tools_ocorrencia.php&tool=<?=$id_ferra?>&pg=buscar_ferramenta" target="_blank">Ocorrências</a>
                                    <a href="principal.php?p=tools/editar_tool.php&tool=<?=$id_ferra?>" target="_blank">Editar</a>
                                    <!-- verifica se a ferramenta ja foi entregue -->
                                    <?php
                                    // entregar
                                    if ($dados['responsavel'] == 0){
                                        $pagina = 'entregar.php';
                                        $nome_func = 'Entregar';
                                    }
                                    // atualziar 
                                    else {
                                        $pagina = 'atualizar.php';
                                        $nome_func = 'Transferir';
                                    }''
                                    ?>
                                    <!-- pagina de transferencia -->
                                    <a href="principal.php?p=tools/<?=$pagina?>&t=<?=$dados['id_ferramenta'];?>" target="_blank" ><?=$nome_func?></a>
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