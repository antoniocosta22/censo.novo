<?php 

//verificar se clicou no botão
require_once 'usuarios.php';
$u = new usuario;

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




<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Pessoa Jurídica</h2>
                        <label id="att" for="attu" class="botao" value="button">Cadastrar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <!-- nome do cliente -->
                    <input class="form" name="nome" type="text" placeholder="Razão social" REQUIRED>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- select sexo -->
                        <select name="cidade" class="cidade">
                                <option value="x">Cidade</option>
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
                        <input class="form_a" name="apelido" type="text" placeholder="Fantasia">
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                    <!-- endereço -->
                    <input class="form" name="ender" type="text" placeholder="Endereço" REQUIRED>
                    <!-- referencias -->
                    <input class="form_a" name="ref" type="text" placeholder="Referências" REQUIRED>
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- email -->
                        <input class="form" name="bairro" type="text" placeholder="Bairro" REQUIRED>
                        <!-- profissão -->
                        <input id="cep" class="form_a" name="cep" type="text" placeholder="CEP" REQUIRED>
                    </div>
                    <!-- Seleção da cidade --
                    
                    <!-- card -->
                    <div class="cardheader">
                        <!-- naturalidade -->
                        <input class="form" name="cpf" id ="cnpj" type="text" placeholder="CNPJ" REQUIRED>
                        <!-- data de nascimento -->
                        <input class="form_a" id ="data" name="datanasc" type="text" placeholder="Data de abertura"  REQUIRED>
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- RG -->
                        <input class="form" name="rg" type="text" placeholder="IE" REQUIRED>
                        <!-- CPF -->
                        <input class="form_a" name="email" type="text" placeholder="Email" REQUIRED>
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- Telefone 01 -->
                        <input id="celular" class="form" name="fone1" type="text" placeholder="Telefone 01" REQUIRED>
                        <!-- Telefone 02 -->
                        <input id="celular2" class="form_a" name="fone2" type="text" placeholder="Telefone 02">
                    </div>
                    <!-- plano e equipamento -->
                    <div class="cardheader">
                        <!-- plano -->
                        <select name="plano" class="cidade">
                                <option value="x">Plano</option>

                                <?php

                                $planosf = $pdo->prepare(" SELECT * FROM planos_venda Order by id");
                                $planosf->execute();
                                while($planoi = $planosf->fetch(PDO::FETCH_ASSOC)){
                                
                                ?>
                                <option value="<?=$planoi['mb']?>"><?=$planoi['nome']?></option>


                                <?php } ?>
                        </select>
                        <!-- equipamento -->
                        <select name="equip" class="equipamento">
                                <option value="x">Equipamento</option>
                                <option value="KR"> KIT + ROTEADOR </option>
                                <option value="K"> KIT </option>
                                <option value="KP"> KIT PRÓPRIO </option>
                                <option value="MG"> MIGRAÇÃO </option>
                                <option value="MP"> MIGRAÇÃO DE PLANO </option>
                        </select>
                    </div>
                    <!-- vendedor -->
                    <select name="vend" class="cidade">
                        <option value="x">Vendedor</option>
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
                                <option value="x">Indicação?</option>
                                <option value="s">Sim</option>
                                <option value="n">Não</option>
                        </select>
                        <!-- apelido -->
                        <input class="form_a" name="indicador" type="text" placeholder="Nome do indicador">
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- negociação -->
                    <select name="neg" class="cidade">
                                <option value="x">Negociação</option>
                                <option value="AV"> A VISTA </option>
                                <option value="1+1"> 1+1 </option>
                                <option value="1+2"> 1+2 </option>
                                <option value="1+3"> 1+3 </option>  
                    </select>
                    <!-- cartão de credito -->
                    <select name="ccred" class="equipamento" title="Foi utilidado cartão de crédito?" >
                                <option value="x">Cartão de crédito</option>
                                <option value="s">Sim</option>
                                <option value="n">Não</option>
                    </select>
                    <!-- valor da parcela -->
                    <input class="form_a" name="parc" type="text" placeholder="Valor parcela">
                    </div>
                    <!-- observação -->
                    <textarea class="textarea" name="obs" type="textarea" placeholder="Observações" REQUIRED></textarea>
                    <!-- botão de submit -->
                    <input type="submit" id="attu" >
                    </form>


<!--fim-->
                </div>
                
            </div>


<?php 

//verifica se clicou
if (isset($_POST["nome"])){   

    $tipo = "pj";
    $nome = $_POST["nome"];
    $apelido = $_POST["apelido"];
    $ender = $_POST["ender"];
    $ref = $_POST["ref"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
    $uf = "MA";
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
    $obs = $_POST["obs"];
    $indicacao = $_POST['indicacao'];
    $indicador = $_POST['indicador'];
    $datacad = date("Y-m-d");
    $consolidada = "n";

    //verificar se esta vazio algum dado

    if($cidade != 'x' AND $plano != 'x' AND $equip != 'x' AND $vend != 'x' AND $neg != 'x' AND $indicacao != 'x'){

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->cadastrar_j($indicacao, $indicador, $user, $tipo, $nome, $apelido, $mae, $sexo, $pai, $ender, $ref, $bairro, $cidade, $uf, $cep, $datanasc, $rg, $cpf, $natur, $estcivil, $profi, $fone1, $fone2, $email, $plano, $equip, $neg, $ccred, $parc, $vend, $obs, $datacad, $consolidada)){



                    ?>
                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Venda cadastrada!","success").then( () => {
                            location.href = 'principal.php?p=vendas.php'
                        })
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

    else{





        ?>

                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Erro!", "Preencha todos os campos!","error").then( () => {
                            history.back();
                        })
                    </script>

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
