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
                        <h2>Alterar permissões</h2>
                        <a class="voltar" href="principal.php?p=usuarios.php">Voltar</a>
                        <label id="att" for="attu" class="botao" value="button" >Atualizar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <!-- nome do cliente -->
                        <?php

                        $vendedor = $pdo->prepare(" SELECT * FROM usuarios where id = $idcarro");
                        $vendedor->execute();
                        while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                            $carro = $vender['nome'];
                            $inserir = $vender['inserir'];
                            $alterar = $vender['alterar'];
                            $consultar = $vender['consultar'];
                            $excluir = $vender['excluir'];
                            $adm = $vender['adm'];
                            $funcMes = $vender['func_mes'];
                            $gerente = $vender['gvend'];
                            $supervisor = $vender['supervend'];
                            $vend_meta = $vender['venda_meta'];
                        }
                        ?>
                    <!-- nome do carro -->
                    <label class="form_b" name="modelo" type="text" placeholder=""><?=$carro?></label>

                    <div class='cardheader_a'>

                    <!-- status -->
                    <select name="inserir" class="equipamento">
                            <option value="<?=$inserir?>">INSERIR -

                            <?php
                            if ($inserir == 'N'){
                                $ins = 'NÃO';
                            }elseif ($inserir == 'S'){
                                $ins = 'SIM';
                            }
                            ?>
                            <?=$ins?>
                            </option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                    </select>
                        <!-- status -->
                    <select name="alterar" class="equipamento">
                            <option value="<?=$alterar?>">ALTERAR -
                            <?php
                            if ($alterar == 'N'){
                                $alt = 'NÃO';
                            }elseif ($alterar == 'S'){
                                $alt = 'SIM';
                            }
                            echo $alt;
                            ?>
                            </option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                    </select>
                        <!-- status -->
                    <select name="consultar" class="equipamento">
                            <option value="<?=$consultar?>">CONSULTAR -
                            <?php
                            if ($consultar == 'N'){
                                $cons = 'NÃO';

                            }elseif ($consultar == 'S'){
                                $cons = 'SIM';
                            }
                            echo $cons;
                            ?>
                            </option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                    </select>

                    <select name="excluir" class="equipamento">
                            <option value="<?=$excluir?>">EXCLUIR -
                            <?php
                            if ($excluir == 'N'){
                                $excl = 'NÃO';
                            }elseif ($excluir == 'S'){
                                $excl = 'SIM';
                            }
                            echo $excl;
                            ?>
                            </option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                    </select>
                        <!-- status -->
                    <select name="adm" class="equipamento">
                            <option value="<?=$adm?>">ADMINISTRADOR -
                            <?php
                            if ($adm == 'N'){
                                $adminis = 'NÃO';
                            }elseif ($adm == 'S'){
                                $adminis = 'SIM';
                            }
                            echo $adminis;
                            ?>
                            </option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                    </select>
                        <!-- status -->
                    <select name="func_mes" class="equipamento">
                            <option value="<?=$funcMes?>">FUNC. MÊS -
                            <?php
                            if ($funcMes == 'N'){
                                $funcm = 'NÃO';
                            }elseif ($funcMes == 'S'){
                                $funcm = 'SIM';
                            }
                            echo $funcm;
                            ?>
                            </option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                    </select>
                        <!-- gerente -->
                        <select name="gerente" class="equipamento">
                            <option value="<?=$gerente?>">GERENTE -
                            <?php
                            if ($gerente == 'N'){
                                $ger = 'NÃO';
                            }elseif ($gerente == 'S'){
                                $ger = 'SIM';
                            }
                            echo $ger;
                            ?>
                            </option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                    </select>
                        <!-- supervisor -->
                        <select name="supervisor" class="equipamento">
                            <option value="<?=$supervisor?>">SUPERVISOR -
                            <?php
                            if ($supervisor == 'N'){
                                $supv = 'NÃO';
                            }elseif ($supervisor == 'S'){
                                $supv = 'SIM';
                            }
                            echo $supv;
                            ?>
                            </option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                    </select>
                        <!-- meta de venda -->
                        <select name="vend_meta" class="equipamento">
                            <option value="<?=$vend_meta?>">META DE VENDAS - <?=$vend_meta?>
                            </option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                            <option value="35">35</option>
                            <option value="40">40</option>
                            <option value="45">45</option>
                            <option value="50">50</option>
                    </select>
                    </div>


                    <!-- botão de submit -->
                    <input type="submit" id="attu" >
                    </form>


<!--fim-->
                </div>

            </div>


<?php

//verifica se clicou
if (isset($_POST["inserir"])){

    $inserir2 = $_POST["inserir"];
    $alterar2 = $_POST["alterar"];
    $consultar2 = $_POST["consultar"];
    $excluir2 = $_POST["excluir"];
    $adm2 = $_POST["adm"];
    $fun_mes2 = $_POST["func_mes"];
    $gerente2 = $_POST["gerente"];
    $supervisor2 = $_POST["supervisor"];
    $vend_meta2 = $_POST["vend_meta"];
    $data_alt = date("Y-m-d H:i:s");

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {


                if($u->alterar_perm($idcarro, $user, $inserir2, $alterar2, $consultar2, $excluir2, $adm2, $fun_mes2, $gerente2, $supervisor2, $vend_meta2, $data_alt)){


                    ?>

                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Permissões alteradas!","success").then( () => {
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
.a {
    background: rgba(0, 255, 0, 0.781);
}
.i{
    background: rgb(255, 0, 85);
    color: white;
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
.cardheader_a {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 5px;
    margin-top: 10px;

}
@media (max-width: 590px) {
    .cardheader_a {
    display: grid;
    grid-template-columns: 1fr 1fr;
    }
    .equipamento {
    height: 40px;
    }

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
    width: auto;
    background: white;
    padding: 4.5px;
    border-radius: 5px;
    border: none;
}
.equipamento {
    width: auto;
    border-radius: 5px;
    background: white;
    padding: 4.5px;
    border: none;
}

</style>
