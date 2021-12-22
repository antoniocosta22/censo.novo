<?php

//verificar se clicou no botão
require_once './classes/usuarios.php';
$u = new usuario;
$usuario = $_GET['u'];
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
                <?php

$vendedor = $pdo->prepare(" SELECT * FROM usuarios where id = $usuario");
$vendedor->execute();
while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
    $nome = $vender['nome'];
    $ender = $vender['ender'];
    $bairro = $vender['bairro'];
    $cidade = $vender['cidade'];
    $fone1 = $vender['cel'];
    $fone2 = $vender['fone'];
    $datanasc = $vender['datanasc'];
    $d1 = explode ('-', $datanasc);
    $datanasc = $d1[2]."/".$d1[1]."/".$d1[0];

    $instit = $vender['instit'];
    $depart = $vender['depart'];
    $funcao = $vender['funcao'];
    $cargo = $vender['cargo'];
    $usuario_c = $vender['usuario'];
    $senha = $vender['senha'];
}
?>
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Editar usuário</h2>
                        <label id="att" for="attu" class="botao" value="button">Atualizar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <!-- nome do cliente -->
                    <div class="pessoal">
                        <h4 style="color: white; text-align: center;">Dados pessoais</h4>
                        <!-- nome -->
                        <input class="form" name="nome" type="text" placeholder="Nome" value="<?=$nome?>" REQUIRED>
                        <!-- card -->
                        <div class="cardheader">
                            <!-- select cidade -->
                            <input class="form" name="cidade" type="text" placeholder="Cidade" value="<?=$cidade?>" REQUIRED>
                            <!-- data de nascimento -->
                            <input class="form_a" id ="data" name="datanasc" type="text" placeholder="Data de nascimento" value="<?=$datanasc?>" REQUIRED>

                        </div>
                        <!-- card -->
                        <div class="cardheader">
                        <!-- endereço -->
                        <input class="form" name="ender" type="text" placeholder="Endereço" value="<?=$ender?>" REQUIRED>
                        <!-- bairro -->
                        <input class="form_a" name="bairro" type="text" placeholder="Bairro" value="<?=$bairro?>" REQUIRED>
                        </div>
                        <!-- card -->
                        <div class="cardheader">
                            <!-- celular 1 -->
                            <input id="celular" class="form" name="fone1" type="text" placeholder="Celular 01" value="<?=$fone1?>" REQUIRED>
                            <!-- celuylar 2 -->
                            <input id="celular2" class="form_a" name="fone2" type="text" placeholder="Celular 02" value="<?=$fone2?>" REQUIRED>
                        </div>

                    </div>
                    <!-- instituição e departamento -->
                    <div class="pessoal">
                    <h4 style="color: white; text-align: center;">Dados trabalhistas</h4>
                            <div class="cardheader">
                                <!-- instituição -->
                                <select name="instit" class="cidade">
                                        <option value="<?=$instit?>">INSTITUIÇÃO</option>
                                        <?php
                                        $instit = $pdo->prepare("SELECT * FROM central ");
                                        $instit->execute();
                                            while($instit2 = $instit->fetch(PDO::FETCH_ASSOC)){?>

                                        <option value="<?=$instit2['id']?>"><?=$instit2['nome']?></option>

                                        <?php }?>
                                </select>
                                <!-- departamento -->
                                <select name="depart" class="equipamento">
                                        <option value="<?=$depart?>">DEPARTAMENTO</option>

                                        <?php
                                        $setor = $pdo->prepare("SELECT * FROM setores ");
                                        $setor->execute();
                                            while($setor2 = $setor->fetch(PDO::FETCH_ASSOC)){?>

                                        <option value="<?=$setor2['id']?>"><?=$setor2['depart']?></option>

                                        <?php }?>
                                </select>
                            </div>
                            <div class="cardheader">
                            <select name="funcao" class="cidade">
                                        <option value="<?=$funcao?>">FUNÇÃO</option>
                                        <?php
                                        $funcs = $pdo->prepare("SELECT * FROM funcoes ");
                                        $funcs->execute();
                                            while($funcs2 = $funcs->fetch(PDO::FETCH_ASSOC)){?>

                                        <option value="<?=$funcs2['id_func']?>"><?=$funcs2['nome']?></option>

                                        <?php }?>
                                </select>
                                <!-- departamento -->
                                <!-- RG -->
                                <input class="form_a" name="cargo" type="text" placeholder="Cargo" value="<?=$cargo?>" REQUIRED>
                                </div>
                            <!-- card -->
                            <div class="cardheader">

                                <!-- CPF -->
                                <input class="form" name="usuario" type="text" placeholder="Usuário" value="<?=$usuario_c?>" REQUIRED>
                                <!-- RG -->
                                <input class="form_a" name="senha" type="text" placeholder="Senha" value="<?=$senha?>" REQUIRED>
                            </div>


                    </div>

                    <!-- botão de submit -->
                    <input type="submit" id="attu" >
                    </form>


<!--fim-->
                </div>

            </div>

<?php

//verifica se clicou
if (isset($_POST["nome"])){

    $nome2 = $_POST["nome"];
    $cidade2 = $_POST["cidade"];
    $datanasc2 = $_POST["datanasc"];
    $d2 = explode ('/', $datanasc2);
    $datanasc2 = $d2[2]."-".$d2[1]."-".$d2[0];

    $endereco2 = $_POST["ender"];
    $bairro2 = $_POST["bairro"];
    $cel1 = $_POST["fone1"];
    $cel2 = $_POST["fone2"];
    $instit2 = $_POST["instit"];
    $depart2 = $_POST["depart"];
    $funcao2 = $_POST["funcao"];
    $cargo2 = $_POST["cargo"];
    $usuario2 = $_POST["usuario"];
    $senha2 = $_POST["senha"];
    $data_atual = date("Y-m-d H:i:s");

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {


                if($u->atualizar_usuario($nome2, $cidade2, $datanasc2, $endereco2, $bairro2, $cel1, $cel2, $instit2, $depart2, $funcao2, $cargo2, $usuario2, $senha2, $user, $data_atual, $usuario)){


                    ?>

                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Usuário alterado!","success").then( () => {
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
    .pessoal{
    background: radial-gradient(#0c2b91, transparent);
    padding: 10px;
    border-radius: 10px;
    display: block;
    margin-top: 10px;
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
