<?php 

//verificar se clicou no botão
require_once './classes/usuarios.php';
$u = new usuario;
$chave = $_GET['ch'];
?>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/mascaras.js"></script>
<script>

$("#data").mask("00/00/0000");

</script>




<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Movimentar Chaveiro</h2>
                        <label id="att" for="attu" class="botao" value="button">Cadastrar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <!-- select tipo de solicitação -->
                        <select name="tipo" class="cidade" >
                                <option value="x">Tipo de saída</option>
                                <option value="1">Empréstimo</option>
                                <option value="2">Entrega</option>
                        </select>
                        <!-- select funcionario -->
                        <select name="func" class="cidade" >
                                <option value="x">Funcionário</option>
                                <?php

                                    $vendedor = $pdo->prepare(" SELECT * FROM usuarios WHERE central = '1' AND func_mes = 'S' AND status = 'A' ORDER BY nome ASC");
                                    $vendedor->execute();
                                    if($vendedor->rowCount() > 0){
                                    while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                                    
                                    ?>
                                <option value="<?=$vender['id'];?>"><?=$vender['nome'];?></option>


                            <?php }} ?>
                        </select>
                        <!-- data ocorrencia -->
                        <input class="form" id="data" name="data_ocor" type="text" placeholder="Data ocorrência" REQUIRED>
                        <!-- observação -->
                        <textarea class="textarea" name="obs" rows="5" type="textarea" placeholder="Observações" REQUIRED></textarea>
                        <input type="submit" id="attu" >
                    </form>
                </div>
            </div>

<?php 

//verifica se clicou
if (isset($_POST["tipo"])){   

    $tipo = $_POST["tipo"];
    $func = $_POST["func"];
    $obs = $_POST["obs"];
    $data_cad = date("Y-m-d H:i:s");

    // data ocorrencia com explode
    $data_ocor = $_POST["data_ocor"]; 
			$d1 = explode ('/', $data_ocor);
			$data_ocor = $d1[2]."-".$d1[1]."-".$d1[0];

    //verificar se esta vazio algum dado
    if( $tipo != 'x' AND $func != 'x' AND !empty($obs) AND !empty($data_ocor)){

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->movimento_chaveiro($user, $chave, $tipo, $func, $data_ocor, $obs, $data_cad)){

                    ?>
                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Ação realizada!","success").then( () => {
                            location.href = 'principal.php?p=chaveiro/chaveiros.php'
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
