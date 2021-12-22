<?php 

require_once './classes/usuarios.php';
$u = new usuario;
$carro = $_GET['car'];
 
$infos_carro = $pdo->prepare("SELECT * FROM frota_automovel WHERE id_automovel = $carro");
    $infos_carro->execute();
    while($info_carro = $infos_carro->fetch(PDO::FETCH_ASSOC)){
        $nome = $info_carro['modelo'];
        $placa = $info_carro['placa'];
    }


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
                        <h2>Troca de Óleo - <?=$nome?></h2>
                        <div class="dropdown">
                        <label id="att" for="attu" class="botao" value="button">Cadastrar</label>
                        <a href="javascript:window.close()" title="Fechar" class="dropbtn" style="padding: 7px 16px; border-radius: 5px; background: red; color: white; text-decoration: none; "> <strong> X </strong></a>
                        </div>
                    </div>
                    <!--  inicio  -->
                    <?php
$km_cars = $pdo->prepare("SELECT obss FROM `km_trocas` where veiculo = $carro and id_ocorrencia = '2' ORDER BY data_time DESC LIMIT 1");
$km_cars->execute();
while($cars_km = $km_cars->fetch(PDO::FETCH_ASSOC)){
    $km_last = $cars_km['obss'];
}
                    ?>
                    <?php
$km_oleo = $pdo->prepare("SELECT km FROM `frota_ocorrencia` where veiculo = $carro and id_ocorrencia = '3' ORDER BY data_time DESC LIMIT 1");
$km_oleo->execute();
while($oleo_k = $km_oleo->fetch(PDO::FETCH_ASSOC)){
    $oleo_km = $oleo_k['km'];
}
                    ?>
                         <?php
$oleos = $pdo->prepare("SELECT obs FROM `frota_ocorrencia` where veiculo = $carro and id_ocorrencia = '3' ORDER BY data_time DESC LIMIT 1");
$oleos->execute();
while($oleosk = $oleos->fetch(PDO::FETCH_ASSOC)){
    echo $oleosk['obs'];
}
                    ?>
                    <label style="color: white;">Último KM - <?=$km_last?>| <?=$oleo_km?></label>
                    <form action="" method="POST" >
                    <input class="form" name="km_oleo" type="text" placeholder="KM do óleo" REQUIRED>
                    <input class="form" name="km_troca" type="text" placeholder="KM atual" REQUIRED>
                    <textarea class="textarea" name="obs" rows="5" type="textarea" placeholder="Observações" ></textarea>
                    <input type="submit" id="attu" >
                    </form>
<!--fim-->
                </div>

</div>

<?php 

//verifica se clicou
if (isset($_POST['km_oleo'])){   
    $ocorrencia = 3;
    $km_oleo = $_POST['km_oleo'];
    $km_troca = $_POST['km_troca'];
    $obs = $_POST['obs'];
    $data_cad = date("Y-m-d H:i:s");

    //verificar se esta vazio algum dado
    if(!empty($km)){

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok
        {   
                if($u->lancar_oleo($user, $ocorrencia, $carro, $km_oleo, $km_troca, $obs, $data_cad)){

                    ?>

                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Troca de óleo registrada!","success").then( () => {
                            window.close();
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
.dropbtn {
    color: black;
    font-size: 14px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
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
