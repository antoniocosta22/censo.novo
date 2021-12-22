<?php 

//verificar se clicou no botão
require_once './classes/usuarios.php';
$u = new usuario;
$id_cliente = $_GET['cliente'];
$pagina_anterior = $_GET['pg'];
$cid_sigla = $_GET['c'];
?>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/mascaras.js"></script>
<script>

$("#cpf").mask("000.000.000-00");
$("#data").mask("00/00/0000");
$("#rg").mask("000.000.000.000-00");
$("#cep").mask("00000-000");
$("#celular").mask("(00)00000-0000");
$("#celular2").mask("(00)00000-0000");
$("#cnpj").mask("00.000.000/0000-00");

</script>


<?php

$cliente = $pdo->prepare(" SELECT * FROM vendas where id = $id_cliente ");
$cliente->execute();
if($cliente->rowCount() > 0){
while($data_cliente = $cliente->fetch(PDO::FETCH_ASSOC)){

?>

<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Editar cliente</h2>
                        <a class="voltar" href="principal.php?p=vendas/fila_vendas.php&x!=<?=$cid_sigla?>&v=<?=$pagina_anterior?>">Voltar</a>
                        <label id="att" for="attu" class="botao" value="button">Atualizar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <!-- nome do cliente -->
                    <input class="form" name="nome" type="text" placeholder="Razão social" value="<?=$data_cliente['nome']?>">
                    <!-- card -->
                    <div class="cardheader">
                        <!-- select sexo -->
                        <select name="cidade" class="cidade">
                                <option value="<?=$data_cliente['cidade']?>">
                                <?php
                                if ($data_cliente['cidade'] == 'smt'){
                                    $cidade_c = 'São Mateus';
                                }elseif ($data_cliente['cidade'] == 'aal') {
                                    $cidade_c = 'Alto Alegre';
                                }elseif ($data_cliente['cidade'] == 'bac') {
                                    $cidade_c = 'Bacabal';
                                }elseif ($data_cliente['cidade'] == 'cth') {
                                    $cidade_c = 'Cantanhede';
                                }elseif ($data_cliente['cidade'] == 'slg') {
                                    $cidade_c = 'São Luis Gonzaga';
                                }elseif ($data_cliente['cidade'] == 'mir') {
                                    $cidade_c = 'Miranda';
                                }elseif ($data_cliente['cidade'] == 'mat') {
                                    $cidade_c = 'Matões';
                                }elseif ($data_cliente['cidade'] == 'pir') {
                                    $cidade_c = 'Pirapemas';
                                }
                                ?>
                                <?=$cidade_c?>
                                </option>
                                <option value="smt"> São Mateus do Maranhão </option>
                                <option value="aal"> Alto Alegre do Maranhão </option>
                                <option value="bac"> Bacabal </option>
                                <option value="cth"> Cantanhede </option>
                                <option value="slg"> São Luis Gonzaga </option>
                                <option value="mir"> Miranda </option>
                                <option value="mat"> Matões </option>
                                <option value="pir"> Pirapemas </option>
                        </select>
                        <!-- apelido -->
                        <input class="form_a" name="apelido" type="text" placeholder="Fantasia" value="<?=$data_cliente['apelido']?>">
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                    <!-- endereço -->
                    <input class="form" name="ender" type="text" placeholder="Endereço" value="<?=$data_cliente['ender']?>">
                    <!-- referencias -->
                    <input class="form_a" name="ref" type="text" placeholder="Referências" value="<?=$data_cliente['ref']?>">
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- email -->
                        <input class="form" name="bairro" type="text" placeholder="Bairro" value="<?=$data_cliente['bairro']?>">
                        <!-- profissão -->
                        <input id="cep" class="form_a" name="cep" type="text" placeholder="CEP" value="<?=$data_cliente['cep']?>">
                    </div>
                 
                    <div class="cardheader">
                        <!-- naturalidade -->
                        <input class="form" name="cpf" id ="cnpj" type="text" placeholder="CNPJ" value="<?=$data_cliente['cpf']?>">
                        <!-- data de nascimento -->
                        <!-- data de nascimento -->
                        <?php
                                $datanasc = $data_cliente['data_nasc'];   
                                $d1 = explode ('-', $datanasc);
                                $datanasc = $d1[2]."/".$d1[1]."/".$d1[0];	
                        ?>
                        <input class="form_a" id ="data" name="datanasc" type="text" placeholder="Data de abertura"  value="<?=$datanasc?>">
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- RG -->
                        <input class="form" name="rg" type="text" placeholder="IE" value="<?=$data_cliente['rg']?>">
                        <!-- CPF -->
                        <input class="form_a" name="email" type="text" placeholder="Email" value="<?=$data_cliente['email']?>">
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- Telefone 01 -->
                        <input id="celular" class="form" name="fone1" type="text" placeholder="Telefone 01" value="<?=$data_cliente['fone1']?>">
                        <!-- Telefone 02 -->
                        <input id="celular2" class="form_a" name="fone2" type="text" placeholder="Telefone 02" value="<?=$data_cliente['fone2']?>">
                    </div>
                    <!-- plano e equipamento -->
                    <div class="cardheader">
                        <!-- plano -->
                        <select name="plano" class="cidade">
                                <option value="<?=$data_cliente['plano']?>"><?=$data_cliente['plano']?></option>
                                <option value="5M"> 5 Megabits </option>
                                <option value="6M"> 6 Megabits </option>
                                <option value="10M"> 10 Megabits </option>
                                <option value="12M"> 12 Megabits </option>
                                <option value="15M"> 15 Megabits </option>
                                <option value="20M"> 20 Megabits </option>
                                <option value="25M"> 25 Megabits </option>
                                <option value="30M"> 30 Megabits </option>
                                <option value="40M"> 40 Megabits </option>
                                <option value="50M"> 50 Megabits </option>
                                <option value="100M"> 100 Megabits </option>
                                <option value="150M"> 150 Megabits </option>
                                <option value="200M"> 200 Megabits </option>
                                <option value="200M"> 250 Megabits </option>
                                <option value="200M"> 500 Megabits </option>
                                <option value="10MRF"> 10 Megabits Rural - Fibra</option>
                        </select>
                        <!-- equipamento -->
                        <select name="equip" class="equipamento">
                                <option value="<?=$data_cliente['equip']?>">
                                <?php
                                if ($data_cliente['equip'] == 'KR'){
                                    $equip = 'KIT + ROTEADOR';
                                }elseif ($data_cliente['equip'] == 'K') {
                                    $equip = 'KIT';
                                }elseif ($data_cliente['equip'] == 'KP') {
                                    $equip = 'KIT PRÓPRIO';
                                }elseif ($data_cliente['equip'] == 'MG') {
                                    $equip = 'MIGRAÇÃO';
                                }elseif ($data_cliente['equip'] == 'MP') {
                                    $equip = 'MIGRAÇÃO DE PLANO';
                                }
                                ?>
                                <?=$equip?>
                                </option>
                                <option value="KR"> KIT + ROTEADOR </option>
                                <option value="K"> KIT </option>
                                <option value="KP"> KIT PRÓPRIO </option>
                                <option value="MG"> MIGRAÇÃO </option>
                                <option value="MP"> MIGRAÇÃO DE PLANO </option>
                        </select>
                    </div>
                    <!-- vendedor -->
                    <select name="vend" class="cidade">
                        <option value="<?=$data_cliente['vend']?>">Vendedor</option>
                        <option value="0">INDICADOR</option>
                        <?php

                        $vendedor = $pdo->prepare(" SELECT * FROM usuarios WHERE status = 'A' ORDER BY nome asc");
                        $vendedor->execute();
                        if($vendedor->rowCount() > 0){
                        while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                        
                        ?>
                                <option value="<?=$vender['id'];?>"><?=$vender['nome'];?></option>


                        <?php }} ?>
                    </select>
                    <!-- indicação -->
                    <!-- indicação -->
                    <div class="cardheader">
                        <!-- select sexo -->
                        <select name="indicacao" class="cidade" >
                                <option value="<?=$data_cliente['indicacao']?>">Indicação?</option>
                                <option value="s">Sim</option>
                                <option value="n">Não</option>
                        </select>
                        <!-- apelido -->
                        <input class="form_a" name="indicador" type="text" placeholder="Nome do indicador" value="<?=$data_cliente['indicador_nome']?>">
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- negociação -->
                    <select name="neg" class="cidade">
                                <option value="<?=$data_cliente['neg']?>">Negociação</option>
                                <option value="AV"> A VISTA </option>
                                <option value="1+1"> 1+1 </option>
                                <option value="1+2"> 1+2 </option>
                                <option value="1+3"> 1+3 </option>  
                    </select>
                    <!-- cartão de credito -->
                    <select name="ccred" class="equipamento" title="Foi utilidado cartão de crédito?" >
                                <option value="<?=$data_cliente['ccred']?>">Cartão de crédito</option>
                                <option value="s">Sim</option>
                                <option value="n">Não</option>
                    </select>
                    <!-- valor da parcela -->
                    <input class="form_a" name="parc" type="text" placeholder="Valor parcela" value="<?=$data_cliente['parc']?>">
                    </div>
                    <!-- observação -->
                    <textarea class="textarea" name="obs" type="textarea" placeholder="Observações" ><?=$data_cliente['obs']?></textarea>
                    <!-- botão de submit -->
                    <input type="submit" id="attu" >
                    </form>


<!--fim-->
                </div>
                
            </div>

<?php
}}
?>
<?php 

//verifica se clicou
if (isset($_POST["nome"])){   

    $nome = $_POST["nome"];
    $apelido = $_POST["apelido"];
    $ender = $_POST["ender"];
    $ref = $_POST["ref"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
    $cep = $_POST["cep"];
    $datanasc = $_POST["datanasc"];   //Recebe conteudo do form
    $d1 = explode ('/', $datanasc);
    $datanasc = $d1[2]."-".$d1[1]."-".$d1[0];			
    $rg = $_POST["rg"];
    $cpf = $_POST["cpf"];
    $natur = $_POST["natur"];
    $fone1 = $_POST["fone1"];
    $fone2 = $_POST["fone2"];
    $email = $_POST["email"];
    $plano = $_POST["plano"];
    $equip = $_POST["equip"];
    $neg = $_POST["neg"];
    $ccred = $_POST["ccred"];
    $parc = $_POST["parc"];
    $vend = $_POST["vend"];
    $indicacao = $_POST["indicacao"];
    $indicador = $_POST["indicador"];
    $obs = $_POST["obs"];
    $datacad = date("Y-m-d");

    //verificar se esta vazio algum dado

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->atualizar_venda_j( $user, $nome, $apelido, $ender, $ref, $bairro, $cidade, $uf, $cep, $datanasc, $rg, $cpf, $natur, $profi, $fone1, $fone2, $email, $plano, $equip, $neg, $ccred, $parc, $vend, $obs, $consolidada, $id_cliente, $indicacao, $indicador)){



                    ?>

                    <div id="msgsucess" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(47, 165, 63); border: 1px solid white; ">

                    Cadastrado com sucesso!

                    </div>
                    <script>
                        setTimeout(() => {
                        location.href = 'principal.php?p=vendas.php'
                        }, 500)
                    </script>
                    <?php

                }

                else{



                    ?>

                    <div class="msgerro" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(199, 63, 90); border: 1px solid white; ">

                    O CPF já existe no nosso banco de dados!

                    </div>

                    <?php

                }
        

        }

        else{

            ?>

            <div class="msgerro" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(199, 63, 90); border: 1px solid white; ">

                <?php echo "Erro: ".$u->msgerro;?>

            </div>

            <?php

        }


}



?>


<!-- fim do script de cadastro de venda -->



<style>
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
    border-radius: 5px;
    cursor: pointer;
    outline: none;
    padding: 5px;
    width: 100%;
}
.form_a {
    margin: 10px 0 0 3px;
    background: white;
    border: none;
    border-radius: 5px;
    outline: none;
    padding: 5px;
    width: 100%;
}
.form_d {
    margin: 10px 0 0 3px;
    background: white;
    border: none;
    outline: none;
    border-radius: 5px;
    padding: 4px;
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
    padding: 20px;
    padding-top: 0;
    display: grid;
    grid-gap: 20px;
    grid-template-columns: 1fr;
}
.detalhes .recentesobs {
    position: relative;
    height: auto;
    min-height: auto;
    background: rgb(19, 103, 182);
    padding: 20px;
}
.voltar{
    position: relative;
    padding: 5px 10px;
    background: white;
    color: black;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}
select {
    outline: none;
}
.sexo {
        width: 100%;
        background: white;
        border-radius: 5px;
        padding: 4.5px;
        margin: 9.5px 0px 1px 3px;
        border: none;
    }
.cidade {
    width: 100%;
    background: white;
    padding: 4.5px;
    border-radius: 5px;
    margin: 9.5px 0px 1px 0px;
    border: none;
}
.equipamento {
    width: 100%;
    border-radius: 5px;
    background: white;
    padding: 4.5px;
    margin: 9.5px 0px 1px 3px;
    border: none;
}

</style>
