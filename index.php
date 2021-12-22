<?php
    require_once 'classes/usuarios.php';
    $u = new usuario;

    $ip_cliente = $_SERVER["REMOTE_ADDR"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CENSO -Central de Solicitações</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="formlogin">
    
    <div align="center" class="logotipo">
        <img id="logo-centro" src="imgs/CENSO.png" height="130" width="300">
    </div>
    <form method="POST" name="login" >
        <input name="usuario" type="text" placeholder="Usuário">
        <input name="senha" type="password" placeholder="Senha">
        <input type="submit" value="Entrar" name="btnlogar">
        <p>Meu ip: <?=$ip_cliente?></p>
    </form>
</div>

<?php 
//verificar se clicou no botão
if (isset($_POST['usuario'])){
$email = addslashes($_POST['usuario']);
$senha = addslashes($_POST['senha']);
//verificar se esta vazio algum dado
if(!empty($email) && !empty($senha)){   
    
        $u->conectar("censo.cas","192.168.12.150", "root", "");
        if($u->msgerro == "")//conexão ok
        {   
            if($u->logar($email, $senha))
            {   
                header("location: principal.php?p=conteudo.php");
            }
            else{
                ?>
                <div class="msgerro" style="text-align: center; padding: 10px; width: auto; margin: -40px auto; height: fit-content; background-color: rgb(199, 63, 90); border: 1px solid white; ">
                 Email ou senha inválidos!
                </div>
                <?php
                }
        }
        else
        {
        ?>
        <div style="text-align: center; padding: 10px; width: auto; margin: -40px auto; background-color: rgb(199, 63, 90); height: fit-content; border: 1px solid white; ">
            <?php echo "Erro: ".$u->msgerro;?>
        </div>
        <?php
        }
    }else
    {
    ?>
    <div style="text-align: center; padding: 10px; width: auto; margin: -40px auto; height: fit-content; background-color: rgb(199, 63, 90); border: 1px solid white; ">
    preencha todos os campos!
    </div>
    <?php
    }
}

?>

</body>
</html>