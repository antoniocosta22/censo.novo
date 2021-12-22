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
    <title>CENSO - Painel de encerramento</title>
    <link rel="shortcut icon" href="favicon.ico">

    <!-- preload dos css -->
    <link rel="preload" href="../../css/style.css" as="style">
    <link rel="preload" href="../../css/principal.css" as="style">
    <!-- css preload fim -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/principal.css">
</head>
<body>

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
                        <h2>Encerrar Solicitação</h2>
                        <label id="att" for="attu" class="botao" value="button">Encerrar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >

                    <!-- vendedor -->
                    <div class="position">
                                <h5>Cobrado?</h5>
                            <label class="label">
                                <input class="radio" type="radio" name="cobrado" value="S"> 
                                Sim
                            </label>
                            <label class="label">
                                <input class="radio" type="radio" name="cobrado" value="N"> 
                                Não
                            </label>
                            <input class="form_pg" type="text" name="valor" placeholder="Valor">
                            </div>
                    
                    <select name="tp_prob" class="cidade">
                        <option value="x">Tipo de problema</option>
                        <?php

                        $vendedor = $pdo->prepare(" SELECT * FROM tp_probl");
                        $vendedor->execute();
                        if($vendedor->rowCount() > 0){
                        while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                        
                        ?>
                                <option value="<?=$vender['id'];?>"><?=$vender['tp_probl'];?></option>


                        <?php }} ?>
                    </select>
                    <!-- fim da movimentação -->
                    <textarea class="textarea" name="obs" rows="5" type="textarea" placeholder="Observações" REQUIRED></textarea>
                    <input type="submit" id="attu" >
                    </form>

                </div>

            </div>


<?php 
$tp_soli = $pdo->prepare(" SELECT * FROM movimento WHERE solicitacao = $soli ORDER BY id DESC limit 1");
$tp_soli->execute();
while($t_soli = $tp_soli->fetch(PDO::FETCH_ASSOC)){
$central = $t_soli['central'];
$setor = $t_soli['setor'];
$tipop = $t_soli['tipo'];
$resp = $t_soli['resp'];
$descr = $t_soli['descr'];
}
$dtmov = date("Y-m-d H:i:s");
$recebido = "S";
$recebedor = $user;
$dtreceb = date("Y-m-d H:i:s");	
$acao = 'AVALIAR';	
$status = 'AV';
// Dados para tabela solicitaçoes

if (isset($_POST["obs"])){  
    // usuario de destino
    $cobrado = $_POST["cobrado"]; 
    $valor_cobrado = $_POST["valor"]; 
    $tipo_problema = $_POST["tp_prob"]; 
    $obs_enc = $_POST["obs"];
    //verificar se esta vazio algum dado
    if(!empty($cobrado) AND !empty($obs_enc)){

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->encerrar_soli($user, $resp, $soli, $status, $central, $setor, $tipop, $descr, $dtmov, $recebido, $recebedor, $acao, $cobrado, $valor_cobrado, $tipo_problema, $obs_enc)){



                    ?>

                    <div id="msgsucess" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(47, 165, 63); border: 1px solid white; ">

                    Encerrada com sucesso!

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
    justify-content: start;
    align-items: center;
    height: 30px;
    padding: 17px;
    border-radius: 5px;
    color: black;
    margin-top: 10px;
    width: 100%;
    gap: 5px;
    background-color: white;
    text-align: center;
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
.form_pg {
    background: white;
    cursor: pointer;
    border-radius: 5px;
    border: none;
    border-bottom: 2px solid black;
    outline: none;
    padding: 5px;
    width: 100%;
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
    .position {
        display: inline-table;
    }
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