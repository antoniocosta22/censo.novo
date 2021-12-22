<?php 

//verificar se clicou no botão
require_once './classes/usuarios.php';
$u = new usuario;
?>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/mascaras.js"></script>
<!-- informações do usuario -->
<?php
$infos = $pdo->prepare(" SELECT * FROM usuarios WHERE id = $user ORDER BY id");
$infos->execute();
while($info = $infos->fetch(PDO::FETCH_ASSOC)){
$usuario = $info['nome'];
$instit = $info['instit'];
$usuario = $info['nome'];
$depart = $info['depart'];
}
?>
<!-- informações de solicitação -->
<?php
$infos2 = $pdo->prepare(" SELECT id FROM solicitacoes ORDER BY id DESC LIMIT 1");
$infos2->execute();
while($info2 = $infos2->fetch(PDO::FETCH_ASSOC)){

if ( empty($info2) ){
    $cod = 1 ; echo $cod ; }
    else { $cod = $info2[id] + 1; }}
    
$ano = date("Y");
$mes = date("m");
$solicitacao = ($ano . $mes . $cod);
?>
<style>
    .cards {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 5px;
    }
    @media (max-width: 480px) {
        .cardheader {
            display: grid;
    justify-content: center;
    align-items: center;
        }
        .cards {
            display: contents;
            text-align: center;
        }
        .voltar {
            margin-bottom: 5px;
        }
        .cardheader h2 {
            padding: 15px;
        }
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
                        <h2>Solicitar Serviço</h2>
                        <div class="cards">
                        <a class="voltar" href="principal.php?p=solicitacoes.php">Voltar</a>
                        <label id="att" for="attu" class="botao" value="button">Registrar</label>
                        </div>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <!-- nome do cliente -->
                        <?php

                        $central = $pdo->prepare(" SELECT * FROM central ORDER BY id");
                        $central->execute();
                        while($central1 = $central->fetch(PDO::FETCH_ASSOC)){
                            $id_central = $central1['id'];
                            $nome_central = $central1['nome'];

                        }
                        ?>
                        
                    <!-- central da solocitação -->
                    <select name="central" class="cidade">
                        <option value="x">Selecione a Central</option>
                        <?php

                        $user1 = $pdo->prepare(" SELECT * FROM central ORDER BY id");
                        $user1->execute();
                        if($user1->rowCount() > 0){
                        while($user_1 = $user1->fetch(PDO::FETCH_ASSOC)){
                        
                        ?>
                                <option value="<?=$user_1['id'];?>"><?=$user_1['nome'];?></option>
                        <?php }} ?>
                    </select>
                    <!-- usuario de destino -->
                    <select name="resp" class="cidade">
                        <option value="x">Selecione o responsável</option>
                        <?php

                        $user2 = $pdo->prepare(" SELECT id, nome FROM usuarios WHERE status = 'A' AND func_mes = 'S' AND id <> $user ORDER BY nome asc");
                        $user2->execute();
                        if($user2->rowCount() > 0){
                        while($user_2 = $user2->fetch(PDO::FETCH_ASSOC)){
                        
                        ?>
                                <option value="<?=$user_2['id'];?>"><?=$user_2['nome'];?></option>
                        <?php }} ?>
                    </select>
                    <!-- categoria do serviço -->
                    <select name="categoria" class="cidade">
                        <option value="x">Selecione a categoria</option>
                        <?php

                        $user3 = $pdo->prepare(" SELECT * FROM tpsoli  ORDER BY id");
                        $user3->execute();
                        while($user_3 = $user3->fetch(PDO::FETCH_ASSOC)){
                        ?>
                                <option value="<?=$user_3['id'];?>"><?=$user_3['tpsoli'];?></option>

                        <?php }?>
                    </select>
                    <!-- observação -->
                    <textarea class="textarea" name="descr" type="textarea" placeholder="Descrição" REQUIRED></textarea>
                
                    <!-- botão de submit -->
                    <input type="submit" id="attu" >
                    </form>


<!--fim-->
                </div>
                
            </div>


<?php 

//verifica se clicou
if (isset($_POST["resp"])){
    $repart = 'ATENDIMENTO';
    $central = $_POST['central']; 	
    $tipo = $_POST['categoria'];
    $resp = $_POST['resp'];
    $descr = $_POST['descr'];
    $status = "AB";
    $datacad = date("Y-m-d H:i:s"); 

    if(!empty($descr) AND $tipo != 'x' AND $resp != 'x' AND $central != 'x'){
        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->solicitar_serviço($user, $instit, $depart, $solicitacao, $central, $tipo, $descr, $status, $datacad, $repart, $resp)){
            
                    ?>
                    <script src="./js/swalert.js"></script>
                    <script>
                        swal("Feito!", "Solicitação enviada!","success").then( () => {
                            history.back();
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
    height: 100px;
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
