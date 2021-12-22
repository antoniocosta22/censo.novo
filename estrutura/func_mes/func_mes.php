<?php 

require_once './classes/usuarios.php';
require_once 'func_mes.php';
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
    padding: 2px 5px;
    font-size: 11px;
    font-weight: bold;
}
.detalhes .recentesobs table th {
    padding: 0px 6px;
    font-size: 11px;
}
.dropbtn {
  background-color: dimgray;
  color: white;
  padding:0px 21px;
  font-size: 13px;
  border: none;
  border-radius: 10px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  border:none;
  cursor: pointer;
  border-radius: 0px 10px 10px 10px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content p {
  color: black;
  padding: 12px 16px;
  font-size: smaller;
  max-width: 200px;
  text-decoration: none;
  display: block;
}
.inst {
    background: rgba(94, 94, 94, 0.781);
    color: white;
    font-size: 11px;
}
.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: white; color: black; border-radius: 10px 10px 0px 0px; transition: 0.2s;}
</style>


            <div class="detalhes">
                <!-- busca de dados -->
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
                            </div>
                                   
                        </div>
                    </div>
                </div>
                <?php
                if ($_POST['Pesquisar'] == "Pesquisar") {
                    $mesatual = $_POST['mes'];
                    $anoatual = $_POST['ano'];    
                ?>
               <!-- fim da busca -->
                <div class="recentesobs">
                <span><h3 style="color: black;">CONSTRUÇÃO DO COLABORADOR DO MÊS - <?=$mesatual?>/<?=$anoatual?></h3></span>
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
                                    <th>OBS +</th>
                                    <TH>OBS -</TH>
                                    <th>FREQUÊNCIA</th>
                                    <TH>PONTUALIDADE</TH>
                                    <th>TOTAL</th>
                                </thead>
                                <!-- cobrança -->
                                <?php

                                $vendedor = $pdo->prepare(" SELECT * FROM func_mes WHERE mes = $mesatual and ano = $anoatual ORDER BY total desc");
                                $vendedor->execute();
                                if($vendedor->rowCount() > 0){
                                while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
            
                                ?>
                                <tbody>
                                    <tr class="rows" style="font-size: 11px;">
                                    <?php

                                    $user = $pdo->prepare(" SELECT nome FROM usuarios WHERE id = $vender[func] ");
                                    $user->execute();
                                    while($r_user = $user->fetch(PDO::FETCH_ASSOC)){
                                        $name_this = $r_user['nome'];
                                    }
                                    ?>
                                    <td style="text-align: center;"><?=$name_this?></td>
                                    <td style="text-align: center;"><?=$vender['osotimas']?> | <?=$vender['os_meta']?></td>
                                    <td style="text-align: center;"><?=$vender['osregulares']?> | <?=$vender['osruins']?></td>
                                    <td style="text-align: center;"><?=$vender['os_pontos']?></td>
                                    <td style="text-align: center;"><?=$vender['vendas']?> | <?=$vender['meta']?></td>
                                    <td><?=$vender['pontos']?></td>
                                    <td><?=$vender['obspos']?></td>
                                    <td><?=$vender['obsneg']?></td>
                                    <td><?=$vender['freq']?></td>
                                    <td><?=$vender['pont']?></td>
                                    <td style="text-align: center;"><?=$vender['total']?></td>
                                    </tr>
                                </tbody>
                            <?php } } else{?>
                                <tbody>
                                    <tr>
                                        <td colspan="11" style="text-align: center;">
                                            <h2 style="color: black;">Mês ainda não foi consolidado!</h2>
                                        </td>
                                    </tr>
                                </tbody>
                        <?php    }?>
                        </table>
                
                    </div>
                </div>
                <?php
            }else{?>
                     <!-- se não tiver clicado no pesquisar - construção do funcionário do m~es atual e ano -->
                     <!-- fim da busca -->
                <div class="recentesobs">
                <span><h3 style="color: black;">CONSTRUÇÃO DO COLABORADOR DO MÊS - <?=$mes?></h3></span>
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
                                    <th>PARCIAL</th>
                                </thead>
                                <!-- cobrança -->
                                <?php

                                $vendedor = $pdo->prepare(" SELECT * FROM usuarios WHERE status = 'A' and func_mes = 'S' ORDER BY nome asc");
                                $vendedor->execute();
                                while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
            
                                ?>
                                <tbody>
                                    <tr class="rows" style="font-size: 11px;">
                                    <td style="text-align: center;"><?=$vender['nome']?></td>
                                    <td style="text-align: center;">
                                    <!-- Os ótimas -->
                                    <?php
                                    $os_cont = $pdo->prepare(" SELECT id FROM solicitacoes WHERE status = 'EN' AND finalizador = $vender[id] AND avaliar = 4 AND MONTH(data_finaliz) = $mes AND YEAR(data_finaliz) = $ano");
                                    $os_cont->execute();
                                    $cont_os = $os_cont->rowCount($os_cont);
                                    if ($cont_os < $vender['os_meta']) { $pos = "-1"; }
                                    elseif ($cont_os == $vender['os_meta']) { $pos = "1"; }
                                    elseif ($cont_os > $vender['os_meta']) { $pos = "2"; }	
                                    ?>
                                    <?php
                                    $os_reg = $pdo->prepare(" SELECT id FROM solicitacoes WHERE status = 'EN' AND  finalizador = $vender[id] AND avaliar = 2 AND MONTH(data_finaliz) = $mes AND YEAR(data_finaliz) = $ano");
                                    $os_reg->execute();
                                    $cont_reg = $os_reg->rowCount($os_reg);
                                    ?>
                                    <?php
                                    $os_ruim = $pdo->prepare(" SELECT id FROM solicitacoes WHERE status = 'EN' AND  finalizador = $vender[id] AND avaliar = 1 AND MONTH(data_finaliz) = $mes AND YEAR(data_finaliz) = $ano");
                                    $os_ruim->execute();
                                    $cont_ruim = $os_ruim->rowCount($os_ruim);
                                    ?>
                                    <?=$cont_os?> | <?=$vender['os_meta']?>
                                    </td>
                                    <td style="text-align: center;">
                                    <?=$cont_reg?> | <?=$cont_ruim?>
                                    </td>
                                    <td style="text-align: center;">
                                    <?=$pos?>
                                    </td>
                                    <?php
                                    $vend_cont = $pdo->prepare(" SELECT id FROM vendas WHERE vend = $vender[id] AND consolidada = 's' and MONTH(data_consol) = $mes and YEAR(data_consol) = $ano");
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
                                    <td><?=$p_vend?></td>
                                    <?php
                                    // soma as observações positivas do usuário
                                    $obs_p = $pdo->prepare(" SELECT id FROM obs WHERE func = $vender[id] and MONTH(data_ocor)=$mes and YEAR(data_ocor)=$ano and tipo = 'p'");
                                    $obs_p->execute();
                                    $cont_posi = $obs_p->rowCount($obs_p);
                                    ?>
                                    <td><?=$cont_posi?></td>
                                    <?php
                                    // soma as observações negativas do usuário
                                    $obs_n = $pdo->prepare(" SELECT id FROM obs WHERE func = $vender[id] and MONTH(data_ocor)=$mes and YEAR(data_ocor)=$ano and tipo = 'n'");
                                    $obs_n->execute();
                                    $cont_neg = $obs_n->rowCount($obs_n);
                                    ?>
                                    <td><?=$cont_neg?></td>
                                    <?php
      
                                    // Soma o resultado se o funcionário bão bater a meta	   
                                    if ($cont_vend < $vender['venda_meta']) { 
                                    $pvend = "1"; 
                                    $r1 = $pvend + $cont_neg + $cont_ruim + $cont_reg;
                                    $r2 = $pos + $cont_posi + $a + $b;
                                    $total = $r2 - $r1;
                                    }
                                    
                                    // Soma o resultado se o funcionário bater a meta
                                    elseif ($cont_vend == $vender['venda_meta']) { 
                                    $pvend = "1";
                                    $r1 = $cont_neg + $cont_ruim + $cont_reg;
                                    $r2 = $pos + $pvend + $cont_posi + $a + $b;
                                    $total = $r2 - $r1;
                                    }
                                    
                                    // Soma o resultado se o funcionário superar a meta
                                    elseif ($cont_vend > $vender['venda_meta']) { 
                                    $pvend = "2"; 
                                    $r1 = $cont_neg + $cont_ruim + $cont_reg;
                                    $r2 = $pos + $pvend + $cont_posi + $a + $b;
                                    $total = $r2 - $r1;
                                    }
                                    
                                    
                                    ?>
                                    <td style="text-align: center;"><?=$total?></td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                
                    </div>
                </div>
                     
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
