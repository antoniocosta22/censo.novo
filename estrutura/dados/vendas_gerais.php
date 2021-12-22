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
    font-size: small;
    font-weight: bold;
}
.direct {
    display: flex;
    text-decoration: none;
    padding: 5px 6px;
    background: gray;
    color: white;
    border-radius: 5px;
}
</style>


            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheade" >
                        <div class="infosa">
                                    <h3>Buscar Vendas</h3>
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
                                    <a href="principal.php?p=vendas.php" class="botao">Filas</a>
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
                    <div class="cardheader">
                        <h2>Minhas vendas do mês <?=$mesatual?>/<?=$anoatual?></h2>
                    </div>
                    <table id="vendas">
                        <thead>
                            <tr style="color: black; font-size: 12px;">
                                <td>Nº</td>
                                <td style="text-align: center;">NOME</td>
                                <td>CIDADE</td> 
                                <td>CADASTRADA</td>
                                <td style="text-align: center;">CONSOLIDADA</td>
                                <td style="text-align: center;">DETALHES</td>

                            </tr>
                        </thead>
                        
                        <tbody>
                            <!-- seleciona as vendas -->
                        <?php 
                        $mes = date("m");
                        $ano = date("Y");
                        $frota = $pdo->prepare("SELECT * FROM vendas WHERE vend = $user AND MONTH(data_cad)=$mesatual AND YEAR(data_cad) = $anoatual");
                        $frota->execute();

                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                            $id_venda = $carros['id'];
                            $nome_venda = $carros['nome'];
                            $id_cons = $carros["usr_consol"];
                        ?>
                        <!-- formata o nome da cidade -->
                        <?php
                                if ($carros['cidade'] == 'aal') { $cidade = " Alto Alegre do Maranhão"; } 
                                elseif ($carros['cidade'] == 'smt') { $cidade = " São Mateus do Maranhão"; }  		   
                                elseif ($carros['cidade'] == 'bac') { $cidade = " Bacabal"; } 
                                elseif ($carros['cidade'] == 'cth') { $cidade = " Cantanhede"; } 
                                elseif ($carros['cidade'] == 'slg') { $cidade = " São Luis Gonzaga"; } 
                                elseif ($carros['cidade'] == 'mir') { $cidade = " Miranda"; } 
                                elseif ($carros['cidade'] == 'mat') { $cidade = " Matões"; } 
                        ?>
                        <?php
                                $data_cad = $carros['data_cad'];		 
                                $d1 = explode( '-', $data_cad );  
                                $data_cad = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        ?> 
                        <?php
                                $data_consol = $carros['data_consol'];		 
                                $d1 = explode( '-', $data_consol );  
                                $data_consol = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        ?>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td><?=$id_venda?></td>
                                <td style="text-align: center;"><?=$nome_venda?></td>
                                <td><?=$cidade?></td>
                                <td><?=$data_cad?></td>
                                <?php
                                if ($carros['consolidada'] == 'n') { 
                                    $status = "NÃO"; 
                                    $class = "indi";
                                } 
                                elseif ($carros['consolidada'] == 's') { 
                                    $status = "SIM"; 
                                    $class = "a";
                                }  		   
                                elseif ($carros['consolidada'] == 'c') { 
                                    $status = "CANCELADA"; 
                                    $class = "i";
                                } 
                                ?>
                                <td style="text-align: center;"><span class="status <?=$class?>" title="<?=$data_consol?>"><?=$status?></span></td>
                                <td><a href="principal.php?p=./vendas/detalhes_venda.php&cliente=<?=$id_venda?>" class="direct" target="_blank">Detalhes</a></td>
                               
                            </tr>
                            <?php }?>
                        </tbody>
                    
                    </table>
                    
                </div>
                
                <?php
                    }else{?>
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Minhas vendas do mês <?=$mes?>/<?=$ano?></h2>
                    </div>
                    <table id="vendas">
                        <thead>
                            <tr style="color: black; font-size: 12px;">
                                <td>Nº</td>
                                <td style="text-align: center;">NOME</td>
                                <td>CIDADE</td> 
                                <td>CADASTRADA</td>
                                <td style="text-align: center;">CONSOLIDADA</td>
                                <td style="text-align: center;">DETALHES</td>

                            </tr>
                        </thead>
                        
                        <tbody>
                            <!-- seleciona as vendas -->
                        <?php 
                        $mes = date("m");
                        $ano = date("Y");
                        $frota = $pdo->prepare("SELECT * FROM vendas WHERE vend = $user AND MONTH(data_consol)=$mes AND YEAR(data_consol) = $ano");
                        $frota->execute();

                        while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                            $id_venda = $carros['id'];
                            $nome_venda = $carros['nome'];
                            $id_cons = $carros["usr_consol"];
                        ?>
                        <!-- formata o nome da cidade -->
                        <?php
                                if ($carros['cidade'] == 'aal') { $cidade = " Alto Alegre do Maranhão"; } 
                                elseif ($carros['cidade'] == 'smt') { $cidade = " São Mateus do Maranhão"; }  		   
                                elseif ($carros['cidade'] == 'bac') { $cidade = " Bacabal"; } 
                                elseif ($carros['cidade'] == 'cth') { $cidade = " Cantanhede"; } 
                                elseif ($carros['cidade'] == 'slg') { $cidade = " São Luis Gonzaga"; } 
                                elseif ($carros['cidade'] == 'mir') { $cidade = " Miranda"; } 
                                elseif ($carros['cidade'] == 'mat') { $cidade = " Matões"; } 
                        ?>
                        <?php
                                $data_cad = $carros['data_cad'];		 
                                $d1 = explode( '-', $data_cad );  
                                $data_cad = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        ?> 
                        <?php
                                $data_consol = $carros['data_consol'];		 
                                $d1 = explode( '-', $data_consol );  
                                $data_consol = $d1[2]."/".$d1[1]."/".$d1[0];		 
                        ?>
                            <tr style="border-bottom: 1px solid rgb(0, 140, 255);">
                                <td><?=$id_venda?></td>
                                <td style="text-align: center;"><?=$nome_venda?></td>
                                <td><?=$cidade?></td>
                                <td><?=$data_cad?></td>
                                <?php
                                if ($carros['consolidada'] == 'n') { 
                                    $status = "NÃO"; 
                                    $class = "indi";
                                } 
                                elseif ($carros['consolidada'] == 's') { 
                                    $status = "SIM"; 
                                    $class = "a";
                                }  		   
                                elseif ($carros['consolidada'] == 'c') { 
                                    $status = "CANCELADA"; 
                                    $class = "i";
                                } 
                                ?>
                                <td  style="text-align: center;"><span class="status <?=$class?>" title="<?=$data_consol?>"><?=$status?></span></td>
                                <td><a href="principal.php?p=./vendas/detalhes_venda.php&cliente=<?=$id_venda?>" class="direct" target="_blank">Detalhes</a></td>
                               
                            </tr>
                            <?php }?>
                        </tbody>
                    
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
    justify-content: center;
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
    color: black;
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
