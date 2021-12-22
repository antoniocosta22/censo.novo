<?php 

//verificar se clicou no botão
require_once './classes/usuarios.php';
$u = new usuario;
$id_user = $_GET['user'];
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

<style>

.pessoal{
    background: radial-gradient(#0c2b91, transparent);
    padding: 10px;
    border-radius: 10px;
    display: block;
    margin-top: 10px;
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

<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Novo usuário</h2>
                        <label id="att" for="attu" class="botao" value="button">Cadastrar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <!-- nome do cliente -->
                    <div class="pessoal">
                        <h4 style="color: white; text-align: center;">Dados pessoais</h4>
                        <!-- nome -->
                        <input class="form" name="nome" type="text" placeholder="Nome" REQUIRED> 
                        <!-- card -->
                        <div class="cardheader">
                            <!-- select cidade -->
                            <input class="form" name="cidade" type="text" placeholder="Cidade" REQUIRED>
                            <!-- data de nascimento -->
                            <input class="form_a" id ="data" name="datanasc" type="text" placeholder="Data de Nascimento"  REQUIRED>
                            
                        </div>
                        <!-- card -->
                        <div class="cardheader">
                        <!-- endereço -->
                        <input class="form" name="ender" type="text" placeholder="Endereço" REQUIRED>
                        <!-- bairro -->
                        <input class="form_a" name="bairro" type="text" placeholder="Bairro" REQUIRED>
                        </div>
                        <!-- card -->
                        <div class="cardheader">
                            <!-- celular 1 -->
                            <input id="celular" class="form" name="cel2" type="text" placeholder="Celular 01" REQUIRED>
                            <!-- celuylar 2 -->
                            <input id="celular2" class="form_a" name="cel1" type="text" placeholder="Celular 02" REQUIRED>
                        </div>
                       
                    </div>
                    <!-- instituição e departamento -->
                    <div class="pessoal">
                    <h4 style="color: white; text-align: center;">Dados trabalhistas</h4>
                            <div class="cardheader">
                                <!-- instituição -->
                                <select name="inst" class="cidade">
                                        <option value="x">Instituição</option>
                                        <?php 
                                        $instit = $pdo->prepare("SELECT * FROM central ");
                                        $instit->execute();
                                            while($instit2 = $instit->fetch(PDO::FETCH_ASSOC)){?>

                                        <option value="<?=$instit2['id']?>"><?=$instit2['nome']?></option>

                                        <?php }?>
                                </select>
                                <!-- departamento -->
                                <select name="depart" class="equipamento">
                                        <option value="x">Departamento</option>
                                        
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
                                        <option value="x">Função</option>
                                        <?php 
                                        $funcs = $pdo->prepare("SELECT * FROM funcoes ");
                                        $funcs->execute();
                                            while($funcs2 = $funcs->fetch(PDO::FETCH_ASSOC)){?>

                                        <option value="<?=$funcs2['id_func']?>"><?=$funcs2['nome']?></option>

                                        <?php }?>
                                </select>
                                <!-- departamento -->
                                <select name="central" class="equipamento">
                                        <option value="x">CENTRAL</option>
                                        <option value="1">CENTRAL CAS</option>
                                </select>
                                </div>
                            <!-- card -->
                            <div class="cardheader">
                                <!-- RG -->
                                <input class="form" name="cargo" type="text" placeholder="Cargo" REQUIRED>
                                <!-- CPF -->
                                <input class="form_a" name="usuario" type="text" placeholder="Usuário" REQUIRED>
                            </div>
                            <!-- card -->
                            <div class="cardheader">
                                <!-- RG -->
                                <input class="form" name="senha" type="password" placeholder="Senha" REQUIRED>
                                <!-- CPF -->
                                <input class="form_a" name="r_senha" type="password" placeholder="Repetir senha" REQUIRED>
                            </div>
                            
                    </div>
                    <div class="pessoal">
                    <h4 style="color: white; text-align: center;">Permissões</h4>
                            <!-- card -->
                            <div class="cardheader">
                                <!-- negociação -->
                            <select name="editar" class="cidade">
                                        <option value="x">Editar</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>

                            </select>
                            <!-- cartão de credito -->
                            <select name="func_mes" class="equipamento">
                                        <option value="x">Func Mês</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                            </select>
                            </div>
                            <div class="cardheader">
                                <!-- negociação -->
                            <select name="vend" class="cidade">
                                        <option value="x">Vendedor</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>

                            </select>
                            <!-- cartão de credito -->
                            <select name="alterar" class="equipamento">
                                        <option value="x">Alterar</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                            </select>
                            </div>
                            <!-- card -->
                            <div class="cardheader">
                                <!-- negociação -->
                            <select name="consultar" class="cidade">
                                        <option value="x">Consultar</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option> 
                            </select>
                            <!-- cartão de credito -->
                            <select name="excluir" class="equipamento">
                                        <option value="x">Excluir</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                            </select>
                            </div>
                            <!-- card -->
                            <div class="cardheader">
                                <!-- negociação -->
                            <select name="admin" class="cidade">
                                        <option value="x">ADM</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                            </select>
                            <!-- cartão de credito -->
                            <select name="gerente" class="equipamento">
                                        <option value="x">Gerente</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                            </select>
                            </div>
                            <!-- card -->
                            <div class="cardheader">
                                <!-- negociação -->
                            <select name="superv" class="cidade">
                                        <option value="x">Supervisor</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                            </select>
                            <!-- cartão de credito -->
                            <select name="meta_venda" class="equipamento">
                                        <option value="x">Meta de vendas</option>
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
                            <!-- card -->
                            <div class="cardheader">
                                <!-- negociação -->
                            <select name="patrimonio" class="cidade">
                                        <option value="x">patrimonio</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                            </select>
                            <!-- cartão de credito -->
                            <!-- cartão de credito -->
                            <select name="osmeta" class="equipamento">
                                        <option value="x">Meta de OS</option>
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

    // dados pessoais
    $status = "A";
    $nome = $_POST["nome"];
    $cidade = $_POST["cidade"];
    $bairro = $_POST["bairro"];
    $ender = $_POST["ender"];
    $cel1 = $_POST["cel1"];
    $cel2 = $_POST["cel2"];

    $datanasc = $_POST["datanasc"];   //Recebe conteudo do form
    $d1 = explode ('/', $datanasc);
    $datanasc = $d1[2]."-".$d1[1]."-".$d1[0];
    $data_cad = date("Y-m-d H:i:s");		
    
    // dados trabalhistas

    $central = $_POST["inst"];
    $setor = $_POST["depart"];
    $funcao = $_POST["funcao"];
    $cargo = $_POST["cargo"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $r_senha = $_POST["r_senha"];

    // permissoes

    $editar = $_POST["editar"];
    $func_mes = $_POST["func_mes"];
    $vendedor = $_POST["vend"];
    $alterar = $_POST["alterar"];
    $consultar = $_POST["consultar"];
    $excluir = $_POST["excluir"];
    $adm = $_POST["admin"];
    $gerente = $_POST["gerente"];
    $supervisor = $_POST["superv"];
    $mvend = $_POST["meta_venda"];
    $patrimonio = $_POST["patrimonio"];
    $meta_os = $_POST["osmeta"];
    $central_cas = $_POST["central"];
    $uf = 'MA';

    //verificar se esta vazio algum dado

    if($central != 'x' AND $setor != 'x' AND $funcao != 'x' AND $instit != 'x' ){

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   
            if($senha == $r_senha){

                if($u->cad_user($data_cad, $uf, $status, $user, $nome, $cidade, $bairro, $ender, $cel1, $cel2, $datanasc, $central, $setor, $funcao, $cargo, $usuario, $senha, $r_senha, $editar, $func_mes, $vendedor, $alterar, $consultar, $excluir, $adm, $gerente, $supervisor, $mvend, $patrimonio, $meta_os, $central_cas)){



                    ?>

                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Usuário cadastrado!","success").then( () => {
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
        else {



            ?>

            <div class="msgerro" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(199, 63, 90); border: 1px solid white; ">

             As senhas não correspondem!

            </div>

            <?php

        }

        

    }else{

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
