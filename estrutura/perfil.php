<?php 
                                $frota = $pdo->prepare(" SELECT * FROM usuarios where id = $user ORDER BY id");
                                $frota->execute();
                                if($frota->rowCount() > 0){
                                while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                                    $instituicao = $carros[instit];
                                    $depart = $carros[depart];
                                    
?>
<?php 
//PHP para selecionar um dado e criar variáveis
    $instit = $pdo->prepare(" SELECT instit FROM instit where id = $instituicao ORDER BY id");
    $instit->execute();
    if($instit->rowCount() > 0){
    while($institu = $instit->fetch(PDO::FETCH_ASSOC)){
        $institui = $institu[instit];
    }}
?>
<?php 
    $dep = $pdo->prepare(" SELECT depart FROM setores where id = $depart ORDER BY id");
    $dep->execute();
    if($dep->rowCount() > 0){
    while($depa = $dep->fetch(PDO::FETCH_ASSOC)){
        $depart = $depa[depart];
    }}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CENSO - Metas</title>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/mascaras.js"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<style>
.dropbtn {
    color: black;
    padding: 5px 15px;
    font-size: 14px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}
.dropbtn:hover {
    color: black;
}

.dropdown {
  position: relative;
  display: inline-block;
}
.botao_ops {
    background: turquoise;
}

.listar_acoes {
  display: none;
  position: absolute;
  min-width: 160px;
  width: max-content;
  border-radius: 5px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.listar_acoes a {
  color: black;
  text-align: center;
  background-color: white;;
  padding: 5px 16px;
  text-decoration: none;
  display: block;
}
.listar_acoes a:hover {
    color: white;
    background-color: rgb(13, 127, 233);
}
.dropdown:hover .listar_acoes {
  display: block;
  font-size: 14px;
  background-color: rgb(13, 127, 233);
  right: 0;
  color: white;
}
.detalhes_frota .recentesobs_frota table tr td {
    padding: 0px 0px;
    font-size: small;
}

    

</style>
<?php
        $datanasc = $carros[datanasc];   
        $d1 = explode ('-', $datanasc);
        $datanasc = $d1[2]."/".$d1[1]."/".$d1[0];	
?>
<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Meus dados</h2>
                        <div class="dropdown">
                                    <button href="#" class="dropbtn" style="padding: 5px 15px; border-radius: 5px; background: white;">Outras infos</button>
                                    <div class="listar_acoes" style="border-radius: 5px;">
                                    <a href="principal.php?p=usuario/atualizar.php">Mudar senha</a>
                                    <a href="principal.php?p=usuario/meus_servicos.php">Meus serviços</a>
                                    <a href="principal.php?p=usuario/minhas_vendas.php">Minhas Vendas</a>
                                    <?php
                                        if ($depart != 4) {
                                            $setor = 'Meus Equipamentos';
                                            $tp_cx = 1;
                                        }else {
                                            $setor = 'Minhas Ferramentas';
                                            $tp_cx = 2;
                                        }
                                    ?>
                                    <a href="principal.php?p=usuario/minha_caixa.php&tp_cx=<?=$tp_cx?>"><?=$setor?></a>
                                    <a href="principal.php?p=usuario/observacoes.php">Observações</a>
                                    <a href="principal.php?p=usuario/minhas_chaves.php">Meus Chaveiros</a>
                                    </div>
                        </div>
                    </div>
                    <!--  inicio  -->
                    <form action="painel.php?p=perfil.php" method="POST" >
                    <input  type="hidden" id="" name="id">
                    <label class="form"><?= $carros['nome'];?></label>
                    <label class="form"><?= $carros['ender'];?></label>
                    <label class="form"><?= $carros['bairro'];?></label>
                    <label class="form"><?= $carros['uf'];?></label>
                    <label class="form"><?= $datanasc ?></label>
                    <label class="form"><?= $institui ?></label>
                    <label class="form"><?= $carros['cel'];?></label>
                    <label class="form"><?= $depart ?></label>
                    <label class="form"><?= $carros['cargo'];?></label>
                    <label class="form"><?= $carros['usuario'];?></label>
                    </form>
<!--fim-->
                </div>
                
            </div>
<?php
}}
?>




<style>
input[type="submit"]{
    display: none;
}
.form {
    margin: 10px 0 0 0;
    background: white;
    display: block;
    border: none;
    font-weight: bold;
    border-radius: 5px;
    font-size: small;
    outline: none;
    padding: 5px;
    width: 100%;
}
.cardheader h2 {
    color: white;
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
.cardbox {
    padding: 10px;
}
</style>
</body>
</html>