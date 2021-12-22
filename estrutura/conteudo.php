<?php
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }
    $cid = $_GET['x!'];
    $user = $_SESSION["id_user"];

    $infos = $pdo->prepare("SELECT id, adm, gvend, supervend, vend FROM `usuarios` WHERE usuario = $user");
    $infos->execute();
    while($dados = $infos->fetch(PDO::FETCH_ASSOC)){
        $adm = $retorno["adm"];
		$gvend = $retorno["gvend"];
		$supervend = $retorno["supervend"];
		$vend = $retorno["vend"]; 
	    $id = $retorno["id"];
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CENSO - Dashboard</title>
<link rel="preload" href="css/inicio.css" as="style">
<link rel="stylesheet" href="css/inicio.css">
<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php 
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
    $stmt->execute();
    if($stmt->rowCount() > 0){
        while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
            // echo "{$dados['nome']}";
?>
<style>
    .detalhes {
    position: relative;
    width: 100%;
    padding: 20px;
    padding-top: 0;
    display: grid;
    grid-gap: 20px;
    grid-template-columns: 1fr 1fr 1fr;
} 
@media (max-width: 800px) {
    .detalhes {
    position: relative;
    width: 100%;
    padding: 20px;
    padding-top: 0;
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(2, 1fr );
} 
}
@media (max-width: 452px) {
    .detalhes {
    position: relative;
    width: 100%;
    padding: 20px;
    padding-top: 0;
    display: grid;
    grid-gap: 20px;
    grid-template-columns: 1fr;
} 
}

</style>
           <div class="cardbox">
                <!--Cards de conteudo-->
                <a class="link" href="principal.php?p=solicitacoes.php">
                <div class="card">
                    <div>
                        <?php 
                        $caixa = $pdo->prepare("SELECT * FROM solicitacoes WHERE resp = $user and status in ('MO', 'AB')");
                        $caixa->execute();
                        $gera = $caixa->rowCount($caixa)

                        ?>
                        <div class="numbers"><?=$gera?></div>
                        <div class="cardname">Solicitações</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-people-arrows"></i>
                    </div>
                </div>
                </a>
                <!-- divisão de cards -->
                <a class="link" href="principal.php?p=obs/observacoes.php">
                <div class="card">
                    <div>
                        <?php 
                        $mes = date("m");
                        $ano = date("Y");
                        $obs_p = $pdo->prepare("SELECT id FROM obs WHERE func = $user and MONTH(data_ocor)=$mes and YEAR(data_ocor)=$ano and tipo = 'p'");
                        $obs_p->execute();
                        $positivas = $obs_p->rowCount($obs_p)

                        ?>
                        <?php 
                        $mes = date("m");
                        $ano = date("Y");
                        $obs_n = $pdo->prepare("SELECT id FROM obs WHERE func = $user and MONTH(data_ocor)=$mes and YEAR(data_ocor)=$ano and tipo = 'n'");
                        $obs_n->execute();
                        $negativas = $obs_n->rowCount($obs_n)

                        ?>
                        <div class="cardname" style="color: GREEN;">Positivas - <?=$positivas?></div>
                        <div class="cardname" style="color: #ff1c59;">Negativas - <?=$negativas?></div>
                        <div class="cardname">Observações</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
                </a>
                <!-- divisão de cards -->
                <a class="link" href="principal.php?p=dados/vendas_mes.php">
                <div class="card">
                    <div>
                        <?php 
                        $mes = date("m");
                        $ano = date("Y");

                        $vendas = $pdo->prepare("SELECT * FROM vendas WHERE vend = $user and consolidada != 'c' and MONTH(data_consol)=$mes and YEAR(data_consol) = $ano");
                        $vendas->execute();
                        $vendas_cont = $vendas->rowCount($vendas)
                        
                        ?>
                        <div class="numbers"><?=$vendas_cont?> | <?=$dados["venda_meta"]?></div>
                        <div class="cardname">Vendas</div>
                    </div>
                    <div class="iconbox">
                        <i class="fas fa-tags"></i>
                    </div>
                </div>
                 </a>
                 <!-- divisão de cards -->
                 <a class="link" href="principal.php?p=dados/servicos_mes.php">
                <div class="card">
                    <div>
                        <?php 
                    
                        $meta_os = $pdo->prepare("SELECT id FROM solicitacoes WHERE status = 'EN' AND finalizador = $user and avaliar = '4' and MONTH(data_finaliz)=$mes and YEAR(data_finaliz) = $ano ");
                        $meta_os->execute();
                        $geral = $meta_os->rowCount($meta_os)

                        ?>
                        <div class="numbers"><?=$geral?> | <?=$dados["os_meta"]?></div>
                        <div class="cardname">OS Ótima</div>
                    </div>
                    <div class="iconbox">
                        <i class="far fa-smile-beam"></i>
                    </div>
                </div>
                </a>
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes" >
                <div class="recentesobs">
                <div style="position: absolute;
                            left: 0;
                            border-radius: 7px 0;
                            top: 0;
                            color: white;
                            z-index: 0;
                            width: 180px;
                            padding: 15px 31px;
                            background: rgb(19, 103, 182);">
                                Acesso rápido
                            </div>
                    <div class="cardheader">
                        <h2>Acesso rápido</h2>
                    </div>
                    <br>
        
                    <!-- observações totais -->
                    <?php
                    $cont_obs = $pdo->prepare(" SELECT * FROM obs WHERE func = $user");
                    $cont_obs->execute();
                    $cont_sol = $cont_obs->rowCount($cont_obs);

                    if ($cont_sol == 0){
                        $valor = '0 totais';
                        $class = 'a';
                    }elseif ($cont_sol > 0){
                        $valor = $cont_sol.' totais';
                        $class = 'inst';
                    }
                    ?>
                    <a class="meusdados" href="principal.php?p=usuario/observacoes.php"> <strong>Observações gerais</strong>  - <span class="status <?=$class?>"><?=$valor?></span></a>
                    <!-- conta as solicitações para avaliar -->
                    <?php
                    $cont_soli = $pdo->prepare(" SELECT * FROM solicitacoes WHERE usuario = $user AND status = 'AV'");
                    $cont_soli->execute();
                    $cont_sol = $cont_soli->rowCount($cont_soli);

                    if ($cont_sol == 0){
                        $valor = '0 pendente';
                        $class = 'a';
                    }elseif ($cont_sol > 0){
                        $valor = $cont_sol.' pendentes';
                        $class = 'pendente';
                    }
                    ?>
                    <a class="meusdados" href="principal.php?p=usuario/minhas_soli.php"> <strong>Minhas solicitações</strong>  - <span class="status <?=$class?>"><?=$valor?></span></a>
                    
                    <!-- conta os serviços -->
                    <?php
                    $cont_jobs = $pdo->prepare(" SELECT solicitacao, status, usuario, depart, datacad, avaliar FROM solicitacoes WHERE status = 'EN' AND finalizador = $user");
                    $cont_jobs->execute();
                    $cont_sol = $cont_jobs->rowCount($cont_jobs);

                    if ($cont_sol == 0){
                        $valor = '0 totais';
                        $class = 'mig_t';
                    }elseif ($cont_sol > 0){
                        $valor = $cont_sol.' totais';
                        $class = 'mig_t';
                    }
                    ?>
                    <a class="meusdados" href="principal.php?p=usuario/meus_servicos.php"> <strong>Meus serviços</strong>  - <span class="status <?=$class?>"><?=$valor?></span></a>

                    <!-- conta os equipamentos pendentes -->
                
                    <?php
                    $cont_tools = $pdo->prepare(" SELECT * FROM ferramenta_cadastro WHERE responsavel = $user");
                    $cont_tools->execute();
                    $cont_toos = $cont_tools->rowCount($cont_tools);

                    if ($cont_toos == 0){
                        $valor = '0 totais';
                        $class = 'n';
                    }elseif ($cont_toos > 0){
                        $valor = $cont_toos.' totais';
                        $class = 'n';
                    }
                    ?>
                    <a class="meusdados" href="principal.php?p=usuario/minha_caixa.php"> <strong>Meus Equipamentos</strong>  - <span class="status <?=$class?>"><?=$valor?></span></a>

                    <a class="meusdados" href="principal.php?p=func_mes/func_mes.php"> <strong>Funcionário do mês</strong>  - <span style="color: white;" class="status finalizado">Visualizar</span></a>
                    <?php
                    // contagem de pontos mes passado
                    $contult = $pdo->prepare("SELECT total FROM func_mes WHERE func = $user  ORDER BY id desc limit 1");
                    $contult->execute();
                    while($result_p = $contult->fetch(PDO::FETCH_ASSOC)){
                        $pontos = $result_p['total'];
                    }

                    ?>
                    <a class="meusdados" href="#" style="cursor: no-drop;"> <strong>Última pontuação</strong>  - <span style="color: white;" class="status mig_p"><?=$pontos?> totais</span></a>
                </div>
                <!-- divsão -->
                <!-- funcionário do ano -->
                <div class="recentesobs" style=" text-align: center; background-color: white; border: none; font-size: small; border: 3px solid rgb(19 103 182)">
                <span style="font-size: larger; font-weight: bold;">MELHORES DO ANO</span>
    
                    <!-- metas -->
                    <div class="cardheader" >
                            <table>
                                <thead>
                                    <th>ANO</th>
                                    <th>COLABORADOR</th>
                                    <th>PONTOS</th>
                                </thead>
                                <!-- JANEIRO -->
                                <tbody>
                                    <tr>
                                    <th>2018</th>
                                    <th style="padding: 5px;">RIVIERE BEZERRA</th>
                                    <?php
                                    // contagem de pontos mes passado
                                    $jan = $pdo->prepare("SELECT sum(total) FROM func_mes WHERE func = '5' AND ano = '2018' ");
                                    $jan->execute();
                                    while($jan1 = $jan->fetch(PDO::FETCH_ASSOC)){
                                        $jane = array_sum($jan1);
                                    }
                                    ?>
                                    <th><span class="status inst"><?=$jane?></span></th>
                                    </tr>
                        
                                    <tr>
                                    <th>2019</th>
                                    <th style="padding: 5px;">HELOI NASCIMENTO</th>
                                    <?php
                                    // contagem de pontos mes passado
                                    $fev = $pdo->prepare("SELECT sum(total) FROM func_mes WHERE func = '44' AND ano = '2019' ");
                                    $fev->execute();
                                    while($fev1 = $fev->fetch(PDO::FETCH_ASSOC)){
                                        $feve = array_sum($fev1);
                                    }

                                    ?>
                                    <th><span class="status inst"><?=$feve?></span></th>
                                    </tr>
                                    <tr>
                   
                                    <th>2020</th>
                                    <th style="padding: 5px;">LEDIANA BRITO</th>
                                    <?php
                                    // contagem de pontos mes passado
                                    $marc = $pdo->prepare("SELECT sum(total) FROM func_mes WHERE func = '4' AND ano = '2020' ");
                                    $marc->execute();
                                    while($marc1 = $marc->fetch(PDO::FETCH_ASSOC)){
                                        $marce = array_sum($marc1);
                                    
                                    }

                                    ?>
                                    <th><span class="status inst" ><?=$marce?></span></th>
                                    </tr>
                                    <tr>
                     
                                    <th>2021</th>
                                    <th style="padding: 5px;">Aguardando...</th>
                                    <th><span class="status inst" >00</span></th>
                                    </tr>
                     </tbody>
                            </table>
                    </div>


                </div>
                <!-- divisão -->
                <div class="recentesinfos">
                <div style="position: absolute;
                            left: 0;
                            border-radius: 15px 0;
                            top: 0;
                            color: white;
                            z-index: 0;
                            width: 180px;
                            padding: 15px 31px;
                            background: rgb(19, 103, 182);">
                                Informações
                            </div>
                    <div class="cardheader">
                        <h3>Informações</h3>
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <div id="slider">
                                        <a href="#"><img class="imgbx selected" src="imgs/cas1.jpg"></a>
                                        <a href="#"><img class="imgbx" src="imgs/cas2.jpg"></a>
                                        <a href="#"><img class="imgbx" src="imgs/cas3.jpg"></a>
                                        <a href="http://cas.net.br/site/" target="_blank"><img class="imgbx" src="imgs/cas4.jpg"></a>
                                        <a href="#"><img class="imgbx" src="imgs/cas5.jpg"></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--fim detalhe-->
        </div>
    </div>
<?php 
    }
}
?>

    <script>
        function menufecha() {
            var toggle = document.querySelector('.toggle');
            var navegacao = document.querySelector('.navegacao');
            var main = document.querySelector('.main');
            toggle.classList.toggle('active');
            navegacao.classList.toggle('active');
            main.classList.toggle('active');

        }
        
    </script>
<script src="js/scripts.js"></script>
<style>
    .meusdados {
        padding: 6px;
    border-radius: 2px;
    display: block;
    text-align: center;
    text-decoration: none;
    font-size: smaller;
    width: 100%;
    border-bottom: 1px solid black;
    cursor: pointer;
    color: black;
}
.meusdados:hover {
    background-color: rgb(19, 103, 182);
    transition: .6s;
    color: white;
    border-radius: 10px 0px;
    border: none;
}
</style>
</body>
</html>