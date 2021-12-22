<?php
//$acao = 'recuperar';
//require '../cadastrogeral/tarefa_controller.php';
include'../../classes/conexao.php';
require_once '../../classes/usuarios.php';
$u = new usuario;
    session_start();
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }
    $user = $_SESSION["id_user"];
    $soli = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CENSO - Painel de movimentação</title>
    <link rel="shortcut icon" href="favicon.ico">

    <!-- preload dos css -->
    <link rel="preload" href="../../css/style.css" as="style">
    <link rel="preload" href="../../css/principal.css" as="style">
    <!-- css preload fim -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/principal.css">
</head>
<body>
<?php
$tp_soli = $pdo->prepare(" SELECT tipo FROM solicitacoes WHERE solicitacao = $soli");
$tp_soli->execute();
while($t_soli = $tp_soli->fetch(PDO::FETCH_ASSOC)){
$solicitacao = $t_soli['tipo'];
}
?>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="../../js/jquery-2.1.3.js"></script>
<script src="../../js/mascaras.js"></script>
<script src="/js/swalert.js"></script>
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
                        <h2>Movimentar Solicitação</h2>
                        <label id="att" for="attu" class="botao" value="button">Movimentar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >

                    <!-- vendedor -->
                    <select name="central" class="cidade">
                        <option value="x">Central</option>
                        <?php

                        $vendedor = $pdo->prepare(" SELECT * FROM central ORDER BY nome asc");
                        $vendedor->execute();
                        if($vendedor->rowCount() > 0){
                        while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                        
                        ?>
                                <option value="<?=$vender['id'];?>"><?=$vender['nome'];?></option>


                        <?php }} ?>
                    </select>
                    <!-- fim da movimentação -->
                    <!-- vendedor -->
                    <select name="user_dest" class="cidade">
                        <option value="x">Colaborador</option>
                        <?php

                        $vendedor = $pdo->prepare(" SELECT id, nome FROM usuarios WHERE status = 'A' AND id <> $user ORDER BY nome asc");
                        $vendedor->execute();
                        if($vendedor->rowCount() > 0){
                        while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                        
                        ?>
                                <option value="<?=$vender['id'];?>"><?=$vender['nome'];?></option>


                        <?php }} ?>
                    </select>
                    <!-- fim da movimentação -->
                    <textarea class="textarea" name="obs" rows="5" type="textarea" placeholder="Observações" REQUIRED></textarea>
                    <input type="submit" id="attu" >
                    </form>

                </div>

            </div>


<?php 
$select = $pdo->prepare(" SELECT * FROM usuarios WHERE id = $user");
$select->execute();
while($user_c = $select->fetch(PDO::FETCH_ASSOC)){
$depart = $user_c[depart];

if($depart == 1){
    $nome_depart = 'TECNOLOGIA';
}elseif($depart == 2){
    $nome_depart = 'ORÇAMENTO E FINANCEIRO';
}elseif($depart == 3) {
    $nome_depart = 'ATENDIMENTO';
}elseif($depart == 4){
    $nome_depart = 'ATIVAÇÃO E MANUTENÇÃO';
}elseif ($depart == 5){
    $nome_depart = 'COMERCIAL';
}

}
//verifica se clicou
if (isset($_POST["obs"])){  
    // usuario de destino
    $user_dest = $_POST['user_dest'];
    // central
    $central = $_POST['central'];
	// observação da movimentação
	$detalhe_consol = $_POST['obs'];
    // data que o usuário movimentou
    $data_cad_consol = date("Y-m-d H:i:s");
    $data_mo = date("Y-m-d H:i:s");
    $acao = 'MOVIMENTADO';	
    $status = 'MO';
    $recebido = 'N';		
    //verificar se esta vazio algum dado
    if(!empty($user_dest) AND $central != 'x'){

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->movimentar_soli($solicitacao, $data_mo, $soli, $user, $status, $nome_depart, $recebido, $user_dest, $central, $detalhe_consol, $data_cad_consol, $acao)){



                    ?>

                    <div id="msgsucess" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(47, 165, 63); border: 1px solid white; ">

                    Movimentada com sucesso!

                    </div>
                    <script>
                        setTimeout(() => {
                            // RECARREGA A PÁGINA PAI
                        window.opener.location.reload(true);
                        // FECHA A PÁGINA
                        window.close();
                        }, 500)
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
    min-height: 186px;
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
    box-shadow: 5px 5px 10px rgb(19 103 182);
    border-radius: 10px;
    min-height: auto;
    background: rgb(19, 103, 182);
    padding: 20px;
}
.cardheader {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
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
<script src="js/scripts.js"></script>

</body>
</html>