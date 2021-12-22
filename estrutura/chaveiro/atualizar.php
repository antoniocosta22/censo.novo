<?php 

//verificar se clicou no botão
require_once './classes/usuarios.php';
$u = new usuario;
$chave = $_GET['ch'];
?>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/mascaras.js"></script>

<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Editar chaveiro</h2>
                        <a class="voltar" href="principal.php?p=chaveiro/chaveiros.php">Voltar</a>
                        <label id="att" for="attu" class="botao" value="button">Atualizar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <!-- nome do cliente -->
                        <?php

                        $vendedor = $pdo->prepare(" SELECT * FROM chave_chaveiros where id = $chave");
                        $vendedor->execute();
                        while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                            $nome = $vender['nome_chaveiro'];
                            $cidade = $vender['cidade'];

                        }
                        ?>
                    <!-- nome do carro -->
                    <input class="form_b" name="nome_chaveiro" type="text" placeholder="<?=$nome?>">
                    <!-- cidade -->
                    <select name="cidade" class="cidade">
                    <option value="<?=$cidade?>">Selecione a cidade</option>

                    <?php
                    $cid = $pdo->prepare(" SELECT * FROM cidades ");
                    $cid->execute();
                    while($cids = $cid->fetch(PDO::FETCH_ASSOC)){

                    ?>
                            <option value="<?=$cids['id'];?>"><?=$cids['cidade'];?></option>

                    <?php } ?>
                    </select>
                    <!-- botão de submit -->
                    <input type="submit" id="attu" >
                    </form>


<!--fim-->
                </div>
                
            </div>


<?php 

//verifica se clicou
if (isset($_POST["nome_chaveiro"])){

    $nome_c = $_POST['nome_chaveiro'];
    $cidade_c = $_POST['cidade'];

    if(!empty($nome_c)){
        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   

                if($u->atualizar_chaveiro($nome_c, $cidade_c, $chave)){
            

                    ?>
                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Chaveiro atualizado!","success").then( () => {
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

        <div class="msgerro" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(199, 63, 90); border: 1px solid white; ">

        Preencha todos os campos!

        </div>

        <?php

    }
 

}



?>


<!-- fim do script de cadastro de venda -->



<style>
.voltar{
    position: relative;
    padding: 5px 10px;
    background: white;
    color: black;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
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
    border-radius: 5px;
    outline: none;
    padding: 5px;
    width: 100%;
}
.form_b {
    margin: 10px 0 0 0;
    background: white;
    border: none;
    font-size: small;
    font-weight: bold;
    display: block;
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
