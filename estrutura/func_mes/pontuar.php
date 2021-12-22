<?php 

require_once './classes/usuarios.php';
$u = new usuario;

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




<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Lançar pontos</h2>
                        <label id="att" for="attu" class="botao" value="button">Lançar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                    <select name="func" class="cidade" >
                                <option value="x">Funcionário</option>
                                <?php

                                    $vendedor = $pdo->prepare(" SELECT * FROM usuarios WHERE func_mes = 'S' AND status = 'A' ORDER BY nome ASC");
                                    $vendedor->execute();
                                    if($vendedor->rowCount() > 0){
                                    while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                                    
                                    ?>
                                <option value="<?=$vender['id'];?>"><?=$vender['nome'];?></option>


                            <?php }} ?>
                        </select>
                        <div class="cardheader">
                        <!-- select tipo de solicitação -->
                        <select name="mes" class="cidade" >
                                <option value="x">MÊS</option>
                                <option value="01"> Janeiro </option>
                                <option value="02"> Fevereiro </option>
                                <option value="03"> Março </option>
                                <option value="04"> Abril </option>
                                <option value="05"> Maio </option>
                                <option value="06"> Junho </option>
                                <option value="07"> Julho </option>
                                <option value="08"> Agosto </option>
                                <option value="09"> Setembro </option>
                                <option value="10"> Outubro </option>
                                <option value="11"> Novembro </option>
                                <option value="12"> Dezembro </option>
                        </select>
                        <!-- select tipo de solicitação -->
                        <select name="ano" class="equipamento" >
                                <option value="x">ANO</option>
                                <option selected value="<?= date('Y')?>"><?= date('Y')?></option>
                                <option value="<?= date('Y') - 1?>"><?= date('Y') - 1?></option>
                                <option value="<?= date('Y') - 2?>"><?= date('Y') - 2?></option>
                        </select>
                        <!-- select funcionario -->
                        </div>
                        <div class="cardheader">
                        <!-- select tipo de solicitação -->
                        <select name="freq" class="cidade" >
                                <option value="x">FREQUÊNCIA</option>
                                <option value="-3"> -3 </option>
                                <option value="-2"> -2 </option>
                                <option value="-1"> -1 </option>
                                <option value="0"> 0 </option>
                                <option value="1"> 1 </option>
                                <option value="2"> 2 </option>
                                <option value="3"> 3 </option>
                                <option value="4"> 4 </option>
                                <option value="5"> 5 </option>
                                <option value="6"> 6 </option>
                                <option value="7"> 7 </option>
                                <option value="8"> 8 </option>
                                <option value="9"> 9 </option>
                                <option value="10"> 10 </option>
                                <option value="11"> 11 </option>
                                <option value="12"> 12 </option>
                                <option value="13"> 13 </option>       
                                <option value="14"> 14 </option>
                                <option value="15"> 15 </option>
                                <option value="16"> 16 </option>
                                <option value="17"> 17 </option>
                                <option value="18"> 18 </option>
                                <option value="19"> 19 </option>
                                <option value="20"> 20 </option>
                                <option value="21"> 21 </option>
                                <option value="22"> 22 </option>
                                <option value="23"> 23 </option>
                                <option value="24"> 24 </option>
                                <option value="25"> 25 </option>
                                <option value="26"> 26 </option>
                                <option value="27"> 27 </option>
                                <option value="28"> 28 </option>
                        </select>
                        <!-- select tipo de solicitação -->
                        <select name="pont" class="equipamento" >
                                <option value="x">PONTUALIDADE</option>
                                <option value="-12"> -12 </option>
                                <option value="-11"> -11 </option>
                                <option value="-10"> -10 </option>
                                <option value="-9"> -9 </option>
                                <option value="-8"> -8 </option>
                                <option value="-7"> -7 </option>
                                <option value="-6"> -6 </option>
                                <option value="-5"> -5 </option>
                                <option value="-4"> -4 </option>
                                <option value="-3"> -3 </option>
                                <option value="-2"> -2 </option>
                                <option value="-1"> -1 </option>
                                <option value="0"> 0 </option>
                                <option value="1"> 1 </option>
                                <option value="2"> 2 </option>
                                <option value="3"> 3 </option>
                                <option value="4"> 4 </option>
                                <option value="5"> 5 </option>
                                <option value="6"> 6 </option>
                                <option value="7"> 7 </option>
                                <option value="8"> 8 </option>
                                <option value="9"> 9 </option>
                                <option value="10"> 10 </option>
                                <option value="11"> 11 </option>
                                <option value="12"> 12 </option>
                                <option value="13"> 13 </option>       
                                <option value="14"> 14 </option>
                                <option value="15"> 15 </option>
                                <option value="16"> 16 </option>
                                <option value="17"> 17 </option>
                                <option value="18"> 18 </option>
                                <option value="19"> 19 </option>
                                <option value="20"> 20 </option>
                                <option value="21"> 21 </option>
                                <option value="22"> 22 </option>
                                <option value="23"> 23 </option>
                                <option value="24"> 24 </option>
                                <option value="25"> 25 </option>
                                <option value="26"> 26 </option>
                                <option value="27"> 27 </option>
                                <option value="28"> 28 </option>
                        </select>
                        <!-- select funcionario -->
                        </div>

                    <textarea class="textarea" name="obs" rows="5" type="textarea" placeholder="Observações" ></textarea>
                    <input type="submit" id="attu" name="enviar"  value="enviar">
                    </form>
                </div>
            </div>
<?php

//verifica se clicou
if ($_POST['enviar'] == "enviar"){   
    $funcs = $_POST["func"];
    $ano_func = $_POST["ano"];
    $mes_func = $_POST["mes"];
    $frequ = $_POST["freq"];
    $pontus = $_POST["pont"];
    $obs = $_POST["obs"];
    $data_cad = date("Y-m-d H:i:s");


    //verificar se esta vazio algum dado
    if( $funcs != 'x' AND $ano_func != 'x' AND $mes_func != 'x' AND $frequ != 'x' AND $pontus != 'x'){

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->pontuar($user, $funcs, $ano_func, $mes_func, $frequ, $pontus, $obs, $data_cad)){



                    ?>

                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Observação cadastrada!","success").then( () => {
                            location.href = 'principal.php?p=func_mes/pontuar.php'
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
}

</style>
