<?php 

//verificar se clicou no botão
require_once './classes/usuarios.php';
$u = new usuario;
$tool = $_GET['tool'];
?>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/mascaras.js"></script>
<script>

$("#cpf").mask("000.000.000-00");
$("#data").mask("00/00/0000");
$("#data2").mask("00/00/0000");
$("#rg").mask("000.000.000.000-00");
$("#cep").mask("00000-000");
$("#celular").mask("(00)00000-0000");
$("#celular2").mask("(00)00000-0000");
$("#cnpj").mask("00.000.000/0000-00");

</script>


              <!--Cards de conteudo-->
              <?php

$vendedor = $pdo->prepare(" SELECT * FROM ferramenta_cadastro where id_ferramenta = $tool");
$vendedor->execute();
while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
    $ferramenta = $vender['ferramenta'];
    $descricao = $vender['descricao'];
    $tombo = $vender['tombo'];
    $sn = $vender['sn'];
    $fabricante = $vender['fabricante'];
    $fornecedor = $vender['fornecedor'];
    $nf = $vender['nf'];
    $data_compra = $vender['data_compra'];
    $d1 = explode ('-', $data_compra);
    $data_compra = $d1[2]."/".$d1[1]."/".$d1[0];

    $valor_cad = $vender['valor_cad'];
    $valor_atual = $vender['valor_atual'];
    $cidade = $vender['cidade'];
    $obs = $vender['obs'];
}
?>  

<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Cadastrar ferramenta - id: <?=$tool?></h2>
                        <div class="dropdown">
                        <label id="att" for="attu" class="botao" value="button">Atualizar</label>
                        
                        <a href="javascript:window.close()" title="Fechar" class="dropbtn" style="padding: 7px 16px; border-radius: 5px; background: red; color: white; text-decoration: none; "> <strong> X </strong></a>
                        </div>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >

                         <!-- card -->
                        <div class="cardheader">
                            <!-- endereço -->
                            <input class="form" name="tool" type="text" placeholder="Ferramenta" value="<?=$ferramenta?>">
                            <!-- referencias -->
                            <input class="form_a" name="desc" type="text" placeholder="Descrição" value="<?=$descricao?>">
                        </div>
                        <!-- card -->
                        <div class="cardheader">
                            <!-- email -->
                            <input class="form" name="tombo" type="text" placeholder="Tombo" value="<?=$tombo?>">
                            <!-- profissão -->
                            <input class="form_a" name="nserie" type="text" placeholder="Nº de série" value="<?=$sn?>">
                        </div>
                        <div class="cardheader">
                        <!-- nome do cliente -->
                        <input class="form" name="fabricante" type="text" placeholder="Fabricante" value="<?=$fabricante?>">

                        <!-- equipamento -->
                        <select name="fornecedor" class="equipamento">
                                <option value="<?=$fornecedor?>">Fornecedor</option>
                                <?php

                                $marca = $pdo->prepare(" SELECT * FROM fornecedores ");
                                $marca->execute();
                                while($marca1 = $marca->fetch(PDO::FETCH_ASSOC)){

                                ?>
                                        <option value="<?=$marca1['id_fornecedor'];?>"><?=$marca1['fornecedor'];?></option>


                                <?php } ?>
                        </select>
                    </div>

                    <div class="cardheader">
                        <!-- naturalidade -->
                        <input class="form" name="nota_f" type="text" placeholder="Nota fiscal" value="<?=$nf?>">
                        <!-- data de nascimento -->
                        <input class="form_a" name="valor_cad" type="text" placeholder="Valor de cadastro"  value="<?=$valor_cad?>">
                    </div>
                    <input class="form" name="valor_atual" type="text" placeholder="Valor atual" value="<?=$valor_atual?>">
                    <div class="cardheader">
                        <!-- nome do cliente -->
                        <input id="data" class="form" name="data_c" type="text" placeholder="Data de compra" value="<?=$data_compra?>">

                        <!-- equipamento -->
                        <select name="cidade" class="equipamento">
                                <option value="<?=$cidade?>">Cidade</option>
                                <?php

                                $marca = $pdo->prepare(" SELECT * FROM cidades ");
                                $marca->execute();
                                while($marca1 = $marca->fetch(PDO::FETCH_ASSOC)){

                                ?>
                                        <option value="<?=$marca1['id_cidade'];?>"><?=$marca1['cidade'];?></option>


                                <?php } ?>
                        </select>
                    </div>
                    <textarea class="textarea" name="obs" type="textarea" placeholder="Observações" ><?=$obs?></textarea>
                    <!-- botão de submit -->
                    <input type="submit" id="attu" >
                </form>

                </div>
                
            </div>

<style>
.carder{
    display: flex;
    gap: 3px;
}
.radio {
border: 1px solid #ccc;
  box-sizing: border-box;
  float: left;
  height: 70px;
  position: relative;
  width: 20px;
}
.radio + .radio {
  margin-left: 25px;
}
.label {
    display: flex;
    align-items: center;
    color: white;
    padding: 12px;
    background-color: dodgerblue;
    border-radius: 13px;
    height: inherit;
    border: 1px solid white;
    gap: 10px;
}
.position {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    height: 30px;
    border-radius: 5px;
    color: black;
    margin-top: 10px;
    width: 100%;
    gap: 5px;
    background-color: white;
    text-align: center;
}
@media (max-width: 480px) {
    .carder{
        display: grid;
    }
    .position{
        display: contents;
        color: white;
    }
    h5 {
        padding: 5px;
    }
    .label {
        justify-content: center;
    }
}

</style>
<?php 

//verifica se clicou
if (isset($_POST['tool'])){   

    $ferramenta2 = $_POST['tool'];
    $descr2 = $_POST['desc'];
    $tombo2 = $_POST['tombo'];
    $nserie2 = $_POST['nserie'];
    $fabricante2 = $_POST['fabricante'];
    $fornecedor2 = $_POST['fornecedor'];
    $notaf2 = $_POST['nota_f'];
    $valor_cad2 = $_POST['valor_cad'];
    $valor_atual2 = $_POST['valor_atual'];
    $data_c2 = $_POST['data_c'];
    $d4 = explode ('/', $data_c2);
    $data_c2 = $d4[2]."-".$d4[1]."-".$d4[0];

    $cidade2 = $_POST['cidade'];
    $obs2 = $_POST['obs'];
    $data_completa = date('Y-m-d H:i:s');


        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->atttool($ferramenta2, $descr2, $tombo2, $nserie2, $fabricante2, $fornecedor2, $notaf2, $valor_cad2, $valor_atual2, $data_c2, $cidade2, $obs2, $data_completa, $user, $tool)){

                    ?>

                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Ferramenta atualizada!","success").then( () => {
                            window.close()
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
