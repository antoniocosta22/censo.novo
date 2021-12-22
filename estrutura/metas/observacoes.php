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
<script src="js/cdn_data.js"></script>
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
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
    padding: 4px 15px;
}
</style>


            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheade" >
                        <div class="infosa">
                                    <h3>Buscar Observações</h3>
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
                                                <option value="01">JANEIRO</option>
                                                <option value="02">FEVEREIRO</option>
                                                <option value="03">MARÇO</option>
                                                <option value="04">ABRIL</option>
                                                <option value="05">MAIO</option>
                                                <option value="06">JUNHO</option>
                                                <option value="07">JULHO</option>
                                                <option value="08">AGOSTO</option>
                                                <option value="09">SETEMBRO</option>
                                                <option value="10">OUTURBO</option>
                                                <option value="11">NOVEMBRO</option>
                                                <option value="12">DEZEMBRO</option>
                                            </select>
                                        </div>
                                        <input type="submit" value="Pesquisar" name="Pesquisar" id="att">
                                    </form>
                            <div class="cardheade" style="justify-content: center;">
                                    <label for="att" class="botao" style=" background: darkgray; cursor: pointer;">Pesquisar</label>
                                    <a href="principal.php?p=../classes/observar.php" class="botao">Observar</a>
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
                <span><h3 style="color: black;">Observações Mês - <?=$mesatual?>/<?=$anoatual?></h3></span>
                    <!-- metas -->
                    <div class="cardheader" >
                            <table class="vendas">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>COLABORADOR</th>
                                    <th style="text-align: center;">POSITIVAS</th>
                                    <th style="text-align: center;">NEGATIVAS</th>
                                    <th style="text-align: center;">JUSTIFICADAS</th>
                                    </tr>
                                </thead>
                                <!-- cobrança -->
                                <?php

                        $vendedor = $pdo->prepare(" SELECT * FROM usuarios WHERE status = 'A' and func_mes = 'S' ORDER BY nome asc");
                        $vendedor->execute();
                        while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                            $func = $vender['id'];
                           
                                $link = "<a href='principal.php?p=metas/obs_func.php&func=$func&mes=$mesatual&ano=$anoatual' target='_blank' class='boton'><i class='fas fa-eye'></i></a>";
                           
                        ?>
                                <tbody>
                                    <tr>
                                    <td><?=$vender['id']?></td>
                                    <td><?=$link?><?=$vender['nome']?> </td>
                                    <td style="text-align: center;">
                                    <?php 
                                    
                                        $obs_p = $pdo->prepare("SELECT id FROM obs WHERE func = $vender[id] and MONTH(data_ocor)=$mesatual and YEAR(data_ocor)=$anoatual and tipo = 'p'");
                                        $obs_p->execute();
                                        $positivas = $obs_p->rowCount($obs_p)
                                    
                                    ?>
                                    <?=$positivas?>
                                    </td>
                                    <td style="text-align: center;">
                                    <?php 
                                    
                                        $obs_n = $pdo->prepare("SELECT id FROM obs WHERE func = $vender[id] and MONTH(data_ocor)=$mesatual and YEAR(data_ocor)=$anoatual and tipo = 'n'");
                                        $obs_n->execute();
                                        $negativos = $obs_n->rowCount($obs_n)
                                
                                    ?>
                                    <?=$negativos?>
                                    </td>
                                    <td style="text-align: center;">0</td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                   
                    </div>
                </div><?php
                    }else{?>
                <div class="recentesobs">
                <span><h3 style="color: black;">Observações do mês - <?=$mes?>/<?=$ano?></h3></span>
                    <!-- metas -->
                    <div class="cardheader" >
                  
                            <table class="vendas">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>COLABORADOR</th>
                                    <th style="text-align: center;">POSITIVAS</th>
                                    <th style="text-align: center;">NEGATIVAS</th>
                                    <th style="text-align: center;">JUSTIFICADAS</th>
                                    </tr>
                                </thead>
                                <!-- cobrança -->
                                <?php

                        $vendedor = $pdo->prepare(" SELECT * FROM usuarios WHERE status = 'A' and func_mes = 'S' ORDER BY nome asc");
                        $vendedor->execute();
                        while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                               $func = $vender['id'];
                      
                                $link = "<a href='principal.php?p=metas/obs_func.php&func=$func&mes=$mes&ano=$ano' target='_blank' class='boton'><i class='fas fa-eye'></i></a>";
                          
                        ?>
                                <tbody>
                                    <tr>
                                    <td><?=$vender['id']?></td>
                                    <td><?=$link?><?=$vender['nome']?> </td>
                                    <td style="text-align: center;">
                                    <?php 
                                    
                                        $obs_p = $pdo->prepare("SELECT id FROM obs WHERE func = $vender[id] and MONTH(data_ocor)=$mes and YEAR(data_ocor)=$ano and tipo = 'p'");
                                        $obs_p->execute();
                                        $positivas = $obs_p->rowCount($obs_p)
                                    
                                    ?>
                                    <?=$positivas?>
                                    </td>
                                    <td style="text-align: center;">
                                    <?php 
                                    
                                    $obs_n = $pdo->prepare("SELECT id FROM obs WHERE func = $vender[id] and MONTH(data_ocor)=$mes and YEAR(data_ocor)=$ano and tipo = 'n'");
                                    $obs_n->execute();
                                    $negativos = $obs_n->rowCount($obs_n)
                                
                                    ?>
                                    <?=$negativos?>
                                    </td>
                                    <td style="text-align: center;">0</td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                   
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
