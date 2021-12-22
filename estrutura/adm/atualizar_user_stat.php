<?php 

//verificar se clicou no botão
require_once './classes/usuarios.php';
$u = new usuario;
$idcarro = $_GET['u'];
?>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/mascaras.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Alterar status</h2>
                        <a class="voltar" href="principal.php?p=usuarios.php">Voltar</a>
                        <label id="att" for="attu" class="botao" value="button" onclick="alerta();">Atualizar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <!-- nome do cliente -->
                        <?php

                        $vendedor = $pdo->prepare(" SELECT * FROM usuarios where id = $idcarro");
                        $vendedor->execute();
                        while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                            $carro = $vender['nome'];

                        }
                        ?>
                    <!-- nome do carro -->
                    <label class="form_b" name="modelo" type="text" placeholder=""><?=$carro?></label>
                
                    <!-- status -->
                    <select name="status" class="cidade">
                            <option value="A">Ativo</option>
                            <option value="I">Inativo</option>
                    </select>
         
                    <!-- botão de submit -->
                    <input type="submit" id="attu" >
                    </form>


<!--fim-->
                </div>
                
            </div>


<?php 

//verifica se clicou
if (isset($_POST["status"])){

    $status = $_POST["status"];
    $data_alt = date("Y-m-d H:i:s");

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->atualizar_status($user, $status, $data_alt, $idcarro)){
                   

                    ?>

                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Status do usuário alterado!","success").then( () => {
                            location.href = 'principal.php?p=usuarios.php'
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
