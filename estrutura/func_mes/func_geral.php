<?php 

require_once './classes/usuarios.php';
$u = new usuario;

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
$stmt->execute();
    while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
        
$permissao_ADM = $dados['adm'];
$permissao_AMX = $dados['patrimonio_adm'];
$perm_gestor = $dados['func_mes'];
$nome = $dados['nome'];
    }
    $mes = date("m");
    $ano = date("Y");
?>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/mascaras.js"></script>
<script src="/js/swalert.js"></script>

<script>

$("#cpf").mask("000.000.000-00");
$("#data").mask("00/00/0000");
$("#rg").mask("000.000.000.000-00");
$("#cep").mask("00000-000");
$("#celular").mask("(00)00000-0000");
$("#celular2").mask("(00)00000-0000");

</script>

<style>
.ladoalado {
    display: flex;
}
.infosa{
    display: grid;
    width: 100%;
}
.infosa h3 {
    color: black;
}
.infosa input {
    border: 1px solid black;
    width: 50%;
    justify-self: center;
}
.detalhes .recentesobs table th {
    padding: 0px 6px;
    font-size: 11px;
}
.detalhes .recentesobs table tr td {
    padding: 2px 5px;
    font-size: 11px;
    font-weight: bold;
}
.botao {
    width: 199px;
    margin: 10px;
    justify-self: center;
}
tbody tr td {
    color: black;
    border-bottom: 1px solid black;
    font-size: 14px;
    text-align: center;
}
.cidade {
    width: 100%;
    background: white;
    padding: 4.5px;
    border-radius: 5px;
    margin: 9.5px 0px 1px 0px;
}
.equipamento {
    width: 100%;
    border-radius: 5px;
    background: white;
    padding: 4.5px;
    margin: 9.5px 0px 1px 3px;
}
.fomr{
    align-items: center;
    display: grid;
}
.boton {
    display: inline;
    padding: 3px 7px;
    margin-right: 15px;
    background: lawngreen;
    color: black;
    border-radius: 5px;
}
.detalhes .recentesobs table tr td {
    padding: 4px 15px;
}
.line {
    display: flex;
    justify-content: center;
    align-items: center;
}
.int {
    width: 25px;
    border: none;
    text-align: center;
    outline: none;
}
</style>


            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheade" >
                        <div class="infosa">
                                    <h3>Consultar Funcionário do mês</h3>
                                    <form action="#" method="POST" class="fomr">
                                        <div class="ladoalado" style="width: 50%; justify-self: center;">
                                            <select name="ano" class="cidade">
                                            <option value="<?=date('Y')?>">Selecione o ano</option>
                                            <option value="<?=date('Y')?>"><?=date('Y')?></option>
                                            <option value="<?=date('Y') - 1?>"><?=date('Y') - 1?></option>
                                            <option value="<?=date('Y') - 2?>"><?=date('Y') - 2?></option>
                                            </select>
                                            <select name="mes" class="equipamento">
                                                <option value="<?=date('m')?>">Selecione o mês</option>
                                                <option value="1">JANEIRO</option>
                                                <option value="2">FEVEREIRO</option>
                                                <option value="3">MARÇO</option>
                                                <option value="4">ABRIL</option>
                                                <option value="5">MAIO</option>
                                                <option value="6">JUNHO</option>
                                                <option value="7">JULHO</option>
                                                <option value="8">AGOSTO</option>
                                                <option value="9">SETEMBRO</option>
                                                <option value="10">OUTURBO</option>
                                                <option value="11">NOVEMBRO</option>
                                                <option value="12">DEZEMBRO</option>
                                            </select>
                                        </div>
                                        <input type="submit" value="Pesquisar" name="Pesquisar" id="att">
                                    </form>
                            <div class="cardheade" style="justify-content: center;">
                                    <label for="att" class="botao" style=" background: darkgray; cursor: pointer;">Pesquisar</label>
                                    <a href="principal.php?p=func_mes/pontuar.php" class="botao" target="_blank">Lançar pontos</a>
                            </div>
                                   
                        </div>
                    </div>
                </div>
                <?php
                if ($_POST['Pesquisar'] == "Pesquisar") {
                    $mesatual = $_POST['mes'];
                    $anoatual = $_POST['ano'];    
                ?>
                <div class="recentesobs">
                <span><h3 style="color: black;">CONSTRUÇÃO DO COLABORADOR DO MÊS - <?=$mesatual?></h3></span>
                    <!-- metas -->
                    <div class="cardheader">
                            <table>
                                <thead style="font-size: 11px;">
                                    <th style="text-align: center;">NOME</th>
                                    <th style="text-align: center;">OS's ÓTIMAS | META</th>
                                    <th style="text-align: center;">REGULARES | RUINS</th>
                                    <th style="text-align: center;">PONTOS</th>
                                    <th style="text-align: center;">VENDAS | META</th>
                                    <th>PONTOS</th>
                                    <th>OBS POSITIVAS</th>
                                    <TH>OBS NEGATIVAS</TH>
                                    <th>FREQUENCIA</th>
                                    <TH>PONTUALIDADE</TH>
                                    <th>TOTAL</th>
                                    <th>REGISTRAR</th>
                                </thead>
                                <!-- cobrança -->
                                
                                <tbody>
                                    <form  method="POST">
                                        <!-- ano referente -->
                                        <?php

                                        $vendedor = $pdo->prepare(" SELECT * FROM usuarios WHERE status = 'A' and func_mes = 'S' ORDER BY nome asc");
                                        $vendedor->execute();
                                        while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                    
                                        ?>
                                        <tr class="rows" style="font-size: 11px;">
                                        <td style="text-align: center;">
                                        <!-- input de id do usuario -->
                                        <!-- mostra o usuario -->
                                        <?=$vender['nome']?>
                                        </td>
                                        <td style="text-align: center;">
                                        <!-- Os ótimas -->
                                        <?php
                                        $os_cont = $pdo->prepare(" SELECT id FROM solicitacoes WHERE status = 'EN' AND finalizador = $vender[id] AND avaliar = 4 AND MONTH(data_finaliz) = $mesatual AND YEAR(data_finaliz) = $anoatual");
                                        $os_cont->execute();
                                        $cont_os = $os_cont->rowCount($os_cont);
                                        if ($cont_os < $vender['os_meta']) { $pos = "-1"; }
                                        elseif ($cont_os == $vender['os_meta']) { $pos = "1"; }
                                        elseif ($cont_os > $vender['os_meta']) { $pos = "2"; }	
                                        ?>
                                        <!-- contagem de os regulares -->
                                        <?php
                                        $os_reg = $pdo->prepare(" SELECT id FROM solicitacoes WHERE status = 'EN' AND  finalizador = $vender[id] AND avaliar = 2 AND MONTH(data_finaliz) = $mesatual AND YEAR(data_finaliz) = $anoatual");
                                        $os_reg->execute();
                                        $cont_reg = $os_reg->rowCount($os_reg);
                                        ?>
                                        <!-- contagem de os ruim -->
                                        <?php
                                        $os_ruim = $pdo->prepare(" SELECT id FROM solicitacoes WHERE status = 'EN' AND  finalizador = $vender[id] AND avaliar = 1 AND MONTH(data_finaliz) = $mesatual AND YEAR(data_finaliz) = $anoatual");
                                        $os_ruim->execute();
                                        $cont_ruim = $os_ruim->rowCount($os_ruim);
                                        ?>
                                        <!-- div pra mostrar os valores -->
                                    
                                            <?=$cont_os?> | <?=$vender['os_meta']?>
                                            <!-- input meta os -->
                                    
                                        </td>
                                        <td style="text-align: center;">
                                        <!-- input os regular -->
                                        <?=$cont_reg?> | <?=$cont_ruim?>
                                        </td>
                                        <td style="text-align: center;">
                                        <?=$pos?>
                                        </td>
                                        <?php
                                        $vend_cont = $pdo->prepare(" SELECT id FROM vendas WHERE vend = $vender[id] AND consolidada = 's' and MONTH(data_consol) = $mesatual and YEAR(data_consol) = $anoatual");
                                        $vend_cont->execute();
                                        $cont_vend = $vend_cont->rowCount($vend_cont);
                                        if ($cont_vend < $vender['venda_meta']) { $p_vend = "-1"; }
                                        elseif ($cont_vend == $vender['venda_meta']) { $p_vend = "1"; }
                                        elseif ($cont_vend > $vender['venda_meta']) { $p_vend = "2"; }	
                                        ?>
                                        <!-- parcial -->
                                        <td style="text-align: center;">
                                        <!-- Vendas -->
                                        <?=$cont_vend?> | <?=$vender['venda_meta']?>
                                        </td>
                                        <td>
                                            <!-- input pontos de vendas -->
                                            <?=$p_vend?>
                                        </td>
                                        <?php
                                        // soma as observações positivas do usuário
                                        $obs_p = $pdo->prepare(" SELECT id FROM obs WHERE func = $vender[id] and MONTH(data_ocor)=$mesatual and YEAR(data_ocor)=$anoatual and tipo = 'p'");
                                        $obs_p->execute();
                                        $cont_posi = $obs_p->rowCount($obs_p);
                                        ?>
                                        <td>
                                            <!-- input obs positivas -->
                                            <?=$cont_posi?>
                                        </td>
                                        <?php
                                        // soma as observações negativas do usuário
                                        $obs_n = $pdo->prepare(" SELECT id FROM obs WHERE func = $vender[id] and MONTH(data_ocor)=$mesatual and YEAR(data_ocor)=$anoatual and tipo = 'n'");
                                        $obs_n->execute();
                                        $cont_neg = $obs_n->rowCount($obs_n);
                                        ?>
                                        <td>
                                            <!-- input obs positivas -->
                                            <?=$cont_neg?>
                                        </td>

                                        <td>
                                            <?php
                                            $freq = $pdo->prepare(" SELECT freq FROM resumo_ponto WHERE func = $vender[id] AND mes= $mesatual AND ano = $anoatual ");
                                            $freq->execute();
                                            while($s_freq = $freq->fetch(PDO::FETCH_ASSOC)){
                                                $pontos_f = $s_freq['freq'];
                                            }
                                            ?>
                                            <?=$pontos_f?>
                                        </td>
                                        <td>
                                        <?php
                                            $pont = $pdo->prepare(" SELECT pont FROM resumo_ponto WHERE func = $vender[id] AND mes= $mesatual AND ano = $anoatual ");
                                            $pont->execute();
                                            while($s_pont = $pont->fetch(PDO::FETCH_ASSOC)){
                                                $pontos_p = $s_pont['pont'];
                                            }
                                            ?>
                                            <?=$pontos_p?>
                                        </td>
                                        <?php
        
                                        // Soma o resultado se o funcionário bão bater a meta	   
                                        if ($cont_vend < $vender['venda_meta']) { 
                                        $pvend = "1"; 
                                        $r1 = $pvend + $cont_neg + $cont_ruim + $cont_reg;
                                        $r2 = $pos + $cont_posi + $pontos_f + $pontos_p;
                                        $total = $r2 - $r1;
                                        }
                                        
                                        // Soma o resultado se o funcionário bater a meta
                                        elseif ($cont_vend == $vender['venda_meta']) { 
                                        $pvend = "1";
                                        $r1 = $cont_neg + $cont_ruim + $cont_reg;
                                        $r2 = $pos + $pvend + $cont_posi + $pontos_f + $pontos_p;
                                        $total = $r2 - $r1;
                                        }
                                        
                                        // Soma o resultado se o funcionário superar a meta
                                        elseif ($cont_vend > $vender['venda_meta']) { 
                                        $pvend = "2"; 
                                        $r1 = $cont_neg + $cont_ruim + $cont_reg;
                                        $r2 = $pos + $pvend + $cont_posi + $pontos_f + $pontos_p;
                                        $total = $r2 - $r1;
                                        }
                                        
                                        
                                        ?>
                                        <td style="text-align: center;"><?=$total?></td>
                                        <td style="text-align: center; padding: 8px;"> 
                                        <a title="Registrar" style="cursor: pointer; color: white; padding: 4px 14px; background-color: darkgrey; border-radius: 5px; text-decoration: none;" href="principal.php?p=func_mes/registrar.php&func=<?=$vender['id']?>&mes=<?=$mesatual?>&ano=<?=$anoatual?>" target="_blank"><i class="fas fa-file-import"></i></a>
                                        
                                        </td>
                                        </tr>
                                        <?php } ?>
                                    </form>
                                </tbody>
                            
                        </table>
                    </div>
                </div>

            <?php
            }else{?>
                        
            <?php }?>
        </div>
<style>
.cardheade{
    background: white;
    border-radius: 5px;
    overflow: auto;
    width: auto;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    }
.cardheader{
    background: white;
    border-radius: 5px;
    overflow: auto;
    width: auto;
}
.cardheader table thead th {
    color: black;
    padding: 3px;
    align-items: center;
    font-size: small;
}
.cardheader table tbody th {
    color: black;
    padding: 3px;
    border-bottom: 1px solid black;
    font-size: small;
}
.detalhes .recentesobs .cardheader table tbody tr:hover{
    background: white;
    color: white;
}
#att {
    position: relative;
    padding: 5px 10px;
    background: white;
    color: black;
    cursor: pointer;
    text-decoration: none;
}
input[type="submit"]{
    display: none;
}
.form {
    margin: 10px 0 0 0;
    background: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    outline: none;
    padding: 5px;
    width: 100%;
}
.textarea {
    margin: 10px 0 0 0;
    background: white;
    border: none;
    resize: none;
    cursor: pointer;
    border-radius: 5px;
    outline: none;
    padding: 5px;
    width: 100%;
}

.cardheader h2 {
    color: white;
}
.cardbox {
    padding: 10px;
}
.detalhes {
    position: relative;
    width: 100%;
    padding: 10px;
    padding-top: 0;
    display: grid;
    grid-gap: 20px;
    grid-template-columns: 1fr;
}
.detalhes .recentesobs {
    position: relative;
    height: auto;
    justify-content: center;
    text-align: center;
    min-height: auto;
    color: white;
    padding: 6px;
    margin-top: 20px;
    margin-bottom: -20px;
}
select {
    outline: none;
}
.sexo {
        width: 100%;
        background: white;
        padding: 4.5px;
        border-radius: 5px;
        margin: 9.5px 0px 1px 3px;
        border: none;
    }
.cidade {
    width: 100%;
    background: white;
    cursor: pointer;
    border-radius: 5px;
    padding: 4.5px;
    margin: 9.5px 0px 1px 0px;
}
@media (max-width: 480px) 
{
    .form {
    margin: 10px 0 0 0;
    background: white;
    border: none;
    cursor: pointer;
    height: 40px;
    border-radius: 5px;
    outline: none;
    padding: 5px;
    width: 100%;
    }
    .ladoalado {
        display: grid;
    }
    .cidade {
    width: 100%;
    background: white;
    cursor: pointer;
    height: 40px;
    border-radius: 5px;
    padding: 4.5px;
    margin: 9.5px 0px 1px 0px;
    border: none;
    }
    .cardheader{
    background: white;
    border-radius: 5px;
    overflow: auto;
    width: max-content;
}
}
</style>
