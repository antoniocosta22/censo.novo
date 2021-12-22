<?php 

//verificar se clicou no botão
require_once './classes/usuarios.php';
$u = new usuario;

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




<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Cadastrar automóvel</h2>
                        <label id="att" for="attu" class="botao" value="button">Cadastrar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <div class="cardheader">
                        <!-- nome do cliente -->
                        <select name="tipo" class="cidade">
                                <option value="x">Tipo</option>
                                <?php

                                    $tipo = $pdo->prepare(" SELECT * FROM tipo_veiculo ORDER BY id_veiculo ASC");
                                    $tipo->execute();
                                    while($tipo1 = $tipo->fetch(PDO::FETCH_ASSOC)){
                                    
                                    ?>
                                <option value="<?=$tipo1['id_veiculo'];?>"><?=$tipo1['tipo'];?></option>


                                <?php } ?>
                        </select>


                        <!-- equipamento -->
                        <select name="marca" class="equipamento">
                                <option value="x">Marca</option>
                                <?php

                                $marca = $pdo->prepare(" SELECT * FROM frota_fabricante ");
                                $marca->execute();
                                while($marca1 = $marca->fetch(PDO::FETCH_ASSOC)){

                                ?>
                                        <option value="<?=$marca1['id_frota_fabricante'];?>"><?=$marca1['fabricante'];?></option>


                                <?php } ?>
                        </select>
                    </div>
                        
                    <!-- card -->
                    <div class="cardheader">
                    <!-- endereço -->
                    <input class="form" name="modelo" type="text" placeholder="Modelo" REQUIRED>
                    <!-- referencias -->
                    <input class="form_a" name="placa" type="text" placeholder="Placa" REQUIRED>
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- email -->
                        <input class="form" name="renavam" type="text" placeholder="Renavam" REQUIRED>
                        <!-- profissão -->
                        <input class="form_a" name="chassi" type="text" placeholder="Chassi" REQUIRED>
                    </div>

                    <div class="cardheader">
                        <!-- naturalidade -->
                        <input class="form" name="km" type="text" placeholder="Kilometragem" REQUIRED>
                        <!-- data de nascimento -->
                        <input class="form_a" name="ano_fab" type="text" placeholder="Ano de fabricação"  REQUIRED>
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- RG -->
                        <input class="form" name="ano_mod" type="text" placeholder="Ano modelo" REQUIRED>
                        <!-- CPF -->
                        <input class="form_a" name="cor" type="text" placeholder="Cor" REQUIRED>
                    </div>
                    <!-- card -->
                    <div class="cardheader">
                        <!-- Telefone 01 -->
                        <input class="form" name="consumo" type="text" placeholder="Consumo veículo" REQUIRED>
                        <!-- Telefone 02 -->
                        <input id="data2" class="form_a" name="data_compra" type="text" placeholder="Data de compra" required>
                    </div>
                    <div class="cardheader">
                        <!-- equipamento -->
                        <select name="responsavel" class="cidade">
                                <option value="x">Responsável</option>
                                <?php

                                $func_res = $pdo->prepare(" SELECT * FROM usuarios where status = 'A' and func_mes = 'S' ");
                                $func_res->execute();
                                if($func_res->rowCount() > 0){
                                while($func_res1 = $func_res->fetch(PDO::FETCH_ASSOC)){

                                ?>
                                        <option value="<?=$func_res1['id'];?>"><?=$func_res1['nome'];?></option>


                                <?php }} ?>
                        </select>
                        <!-- Telefone 02 -->
                        <input class="form_a" name="valor_c" type="text" placeholder="Valor de compra" required>
                    </div>
             
                    <!-- types radio -->
                    <div class="carder">

                            <div class="position">
                                <h5>Direção hidraulica</h5>
                            <label class="label">
                                <input class="radio" type="radio" name="d_hidraulica" value="s"> 
                                Sim
                            </label>
                            <label class="label">
                                <input class="radio" type="radio" name="d_hidraulica" value="n"> 
                                Não
                            </label>
                            </div>
                            <!-- 2 -->
                            <div class="position">
                                <h5>Som</h5>
                            <label class="label">
                                <input class="radio" type="radio" name="som" value="s"> 
                                Sim
                            </label>
                            <label class="label">
                                <input class="radio" type="radio" name="som" value="n"> 
                                Não
                            </label>
                            </div>

                    </div>
                    <div class="carder">

                            <div class="position">
                                <h5>Ar condicionado</h5>
                            <label class="label">
                                <input class="radio" type="radio" name="ar" value="s"> 
                                Sim
                            </label>
                            <label class="label">
                                <input class="radio" type="radio" name="ar" value="n"> 
                                Não
                            </label>
                            </div>
                            <!-- 2 -->
                            <div class="position">
                                <h5>Vidro elétrico</h5>
                            <label class="label">
                                <input class="radio" type="radio" name="v_eletrico" value="s"> 
                                Sim
                            </label>
                            <label class="label">
                                <input class="radio" type="radio" name="v_eletrico" value="n"> 
                                Não
                            </label>
                            </div>

                    </div>
                    <div class="carder">

                            <div class="position">
                                <h5>Alarme</h5>
                            <label class="label">
                                <input class="radio" type="radio" name="alarme" value="s"> 
                                Sim
                            </label>
                            <label class="label">
                                <input class="radio" type="radio" name="alarme" value="n"> 
                                Não
                            </label>
                            </div>
                            <!-- 2 -->
                            <div class="position">
                                <h5>Flex</h5>
                            <label class="label">
                                <input class="radio" type="radio" name="flex" value="s"> 
                                Sim
                            </label>
                            <label class="label">
                                <input class="radio" type="radio" name="flex" value="n"> 
                                Não
                            </label>
                            </div>

                    </div>
                    <!-- 2 -->
                    <div class="position">
                                <h5>Farol neblina</h5>
                            <label class="label">
                                <input class="radio" type="radio" name="f_neb" value="s"> 
                                Sim
                            </label>
                            <label class="label">
                                <input class="radio" type="radio" name="f_neb" value="n"> 
                                Não
                            </label>
                    </div>
                    
                    
                    
               
                    <textarea class="textarea" name="obs" type="textarea" placeholder="Observações" REQUIRED></textarea>
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
if (isset($_POST['modelo'])){   

    $tipo = $_POST['tipo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];
    $renavam = $_POST['renavam'];
    $chassi = $_POST['chassi'];
    $km = $_POST['km'];
    $ano_fab = $_POST['ano_fab'];
    $ano_mod = $_POST['ano_mod'];
    $cor = $_POST['cor'];
    $consumo = $_POST['consumo'];
    $data_compra = $_POST['data_compra'];
    $d4 = explode ('/', $data_compra);
    $data_compra = $d4[2]."-".$d4[1]."-".$d4[0];

    $responsavel = $_POST['responsavel'];
    $valor_compra = $_POST['valor_c'];
    $direcao_h = $_POST['d_hidraulica'];
    $som = $_POST['som'];
    $ar = $_POST['ar'];
    $v_eletrico = $_POST['v_eletrico'];
    $alarme = $_POST['alarme'];
    $flex = $_POST['flex'];
    $f_neb = $_POST['f_neb'];
    $obs = $_POST['obs'];
    $data_completa = date('Y-m-d H:i:s');

    //verificar se esta vazio algum dado

    if($tipo != 'x' AND $marca != 'x' AND $responsavel != 'x'){

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->cadfrota($tipo, $marca, $modelo, $placa, $renavam, $chassi, $km, $ano_fab, $ano_mod, $cor, $consumo, $data_compra, $responsavel, $valor_compra, $direcao_h, $som, $ar, $v_eletrico, $alarme, $flex, $f_neb, $obs, $user, $data_completa)){

                    ?>

                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Veículo cadastrado!","success").then( () => {
                            location.href = 'principal.php?p=automoveis.php'
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
