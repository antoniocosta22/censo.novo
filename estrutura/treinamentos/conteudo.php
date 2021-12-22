<?php
    if(!isset($_SESSION["id_user"])){
        header("location: index.php");
        exit;
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
<title>CENSO - treinamentos</title>

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
            $ano = date('Y');
            $anopassado = $ano - 1;
            $anoantepassado = $ano - 2;
?>


<style>
.link {
    text-decoration: none;
    color: black;
}
.cardbox .card {
    position: relative;
    padding: 7px;
    min-height: 250px;
    border-radius: 10px;
    text-align: center;
    flex-direction: column;
    border: 3px solid rgb(19, 103, 182);
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    cursor: pointer;
}
.cardbox .card .numbers {
    position: relative;
    font-size: 37px;
    font-weight: bold;
}
.fa, .fas {
    font-weight: 900;
    font-size: -webkit-xxx-large;
}
.cardbox .card .cardname {
    color: rgb(100, 100, 100);
    font-size: revert;
    font-weight: bold;
}
.dropbtn {
    color: black;
    padding: 5px 15px;
    font-size: 14px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
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
  background-color: rgb(13, 127, 233);
  color: white;
  padding: 5px 16px;
  text-decoration: none;
  display: block;
}
.listar_acoes a:hover {
    color: black;
}
.dropdown:hover .listar_acoes {
  display: block;
  background-color: rgb(13, 127, 233);
  right: 0;
  border-radius: 10px;
}
.detalhes_frota .recentesobs_frota table tr td {
    padding: 0px 0px;
    font-size: small;
}
.new {
    position: absolute;
    right: 0;
    color: white;
    padding: 5px 1pc;
    background-color: rgb(19, 103, 182);
    bottom: 0;
    border-radius: 10px 0px 15px 0px;
}
.cardbox {
    position: relative;
    width: 100%;
    padding: 20px;
    display: grid;
    grid-template-columns: 1fr;
    grid-gap: 8px;
}   
.titulo {
    display: flex;
    padding: 5px 20px;
    justify-content: center;
    width: 100%;
    flex-direction: column;
    border-bottom: 3px solid rgb(19, 103, 182);
}
.links {
    text-decoration: none;
    color: darkslategrey;
    font-size: smaller;
    border-bottom: 1px solid black;
}
li {
    list-style: none;
}

</style>
<?php 
$tp_treino = $_GET['tp_t'];
$n_aula = $_GET['nome_a'];
$qtd = $_GET['qtd'];

// financeiro
if($tp_treino == '1'){
    $nome_curso = "Financeiro";
    if ($n_aula == '1'){
        $nome_aula = "Comissões de ordens de serviço";
        $link01 = 'https://www.youtube.com/embed/3_96NiS5Bas?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }elseif($n_aula == '2'){
        $nome_aula = "Agendamento uma ordem de serviço";
        $link01 = 'https://www.youtube.com/embed/nveKUd8Uods?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }elseif($n_aula == '3'){
        $nome_aula = "Finalizando uma ordem de serviço";
        $link01 = 'https://www.youtube.com/embed/fXrNGhfQYVg?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }elseif($n_aula == '4'){
        $nome_aula = "Cadastrando uma ordem de serviço";
        $link01 = 'https://www.youtube.com/embed/j_sjt2fLMlo?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }elseif($n_aula == '5'){
        $nome_aula = "Treinamento manutenção de ordem de serviço";
        $link01 = 'https://www.youtube.com/embed/Scd5ku2PHUc?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }elseif($n_aula == '6'){
        $nome_aula = "Treinamento atendimento e processos";
        $link01 = 'https://www.youtube.com/embed/UZ_69dKRAo0?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }else{
        $nome_aula = "Nenhuma aula selecionada!";
        $link01 = "Nenhuma aula selecionada";
    }
    $html_mostra .="<iframe width='100%' height='480' src=$link01 title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
    </div>
    <h3 class='titulo'>
        <details>
            <summary>Treinamentos</summary>
            <li><a class='links' href='#'>Aula 01</a></li>
        </details>
    </h3>";
// atendimento
}elseif ($tp_treino == '2'){
    $nome_curso = "Atendimento";
    if ($n_aula == '1'){
        $nome_aula = "Comissões de ordens de serviço";
        $link01 = 'https://www.youtube.com/embed/3_96NiS5Bas?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }elseif($n_aula == '2'){
        $nome_aula = "Agendamento uma ordem de serviço";
        $link01 = 'https://www.youtube.com/embed/nveKUd8Uods?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }elseif($n_aula == '3'){
        $nome_aula = "Finalizando uma ordem de serviço";
        $link01 = 'https://www.youtube.com/embed/fXrNGhfQYVg?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }elseif($n_aula == '4'){
        $nome_aula = "Cadastrando uma ordem de serviço";
        $link01 = 'https://www.youtube.com/embed/j_sjt2fLMlo?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }elseif($n_aula == '5'){
        $nome_aula = "Treinamento manutenção de ordem de serviço";
        $link01 = 'https://www.youtube.com/embed/Scd5ku2PHUc?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }elseif($n_aula == '6'){
        $nome_aula = "Treinamento atendimento e processos";
        $link01 = 'https://www.youtube.com/embed/UZ_69dKRAo0?list=PLXTY-uyBpSRXavv7eJlZro3t_GpRkka86';
    }elseif($n_aula == '7'){
        $nome_aula = "Principais Erros de atendimento";
        $link01 = 'https://www.youtube.com/embed/dSokG0tLJUQ';
    }elseif($n_aula == '8'){
        $nome_aula = "Atendimento Robotizado";
        $link01 = 'https://www.youtube.com/embed/Y-D8dasL5-M';
    }elseif($n_aula == '9'){
        $nome_aula = "Como vender planos de Fibra Optica ";
        $link01 = 'https://www.youtube.com/embed/ryu2Z2Vvygo';
    }elseif($n_aula == '10'){
        $nome_aula = "Como diferenciar a Fibra Óptica utilizando palavras simples";
        $link01 = 'https://www.youtube.com/embed/YaBJGGJOaqM';
    }elseif($n_aula == '11'){
        $nome_aula = "Como ofertar Upgrade para seus clientes";
        $link01 = 'https://www.youtube.com/embed/PJfOlW3t_W0';
    }elseif($n_aula == '12'){
        $nome_aula = "Como ofertar migração";
        $link01 = 'https://www.youtube.com/embed/FAyYt3wSQpk';
    }elseif($n_aula == '13'){
        $nome_aula = "Faça o cliente se sentir importante";
        $link01 = 'https://www.youtube.com/embed/yrVJOFQXKP8';
    }elseif($n_aula == '14'){
        $nome_aula = "Não fale todos os planos para o cliente.";
        $link01 = 'https://www.youtube.com/embed/LsUC-awYoac';
    }elseif($n_aula == '15'){
        $nome_aula = "Um dos erros mais comuns na venda";
        $link01 = 'https://www.youtube.com/embed/7Gs5gOrpO1Y';
    }else{
        $nome_aula = "Nenhuma aula selecionada!";
        $link01 = "Nenhum treinamento selecionado!";
    }
    $html_mostra .="<iframe width='100%' height='480' src=$link01 title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
    </div>
    <h3 class='titulo'>
        <details>
            <summary style='cursor: pointer;'>IXC treinamentos</summary>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=1'>01 - Comissões de ordens de serviço</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=2'>02 - Agendamento uma ordem de serviço</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=3'>03 - Finalizando uma ordem de serviço</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=4'>04 - Cadastrando uma ordem de serviço</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=5'>05 - Treinamento manutenção de ordem de serviço</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=6'>06 - Treinamento atendimento e processos</a></li>
        </details>
    </h3>
    <h3 class='titulo'>
        <details>
            <summary style='cursor: pointer;'>Instituto Nícolas Bueno</summary>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=7'>01 - Principais Erros de atendimento</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=8'>02 - Atendimento Robotizado</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=9'>03 - Como vender planos de Fibra Optica </a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=10'>04 - Como diferenciar a Fibra Óptica utilizando palavras simples</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=11'>05 - Como ofertar Upgrade para seus clientes</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=12'>06 - Como ofertar migração</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=13'>07 - Faça o cliente se sentir importante</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=14'>08 - Não fale todos os planos para o cliente</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=2&nome_a=15'>09 - Um dos erros mais comuns na venda</a></li>
        </details>
    </h3>";
}elseif ($tp_treino == '3'){

    $nome_curso = "Maps";
    if ($n_aula == '1'){
        $nome_aula = "Como obter chaves de acesso para o IXC Maps";
        $link01 = 'https://www.youtube.com/embed/uDvxdmg8Ofg?list=PLXTY-uyBpSRWY4THwOKL2lGnqPEPN42vj';
    }elseif($n_aula == '2'){
        $nome_aula = "Configuração de elementos no IXC Maps";
        $link01 = 'https://www.youtube.com/embed/gQBmLRwnbIY?list=PLXTY-uyBpSRWY4THwOKL2lGnqPEPN42vj';
    }else{
        $nome_aula = "Nenhuma aula selecionada!";
        $link01 = "Nenhuma aula selecionada";
    }
    $html_mostra .="<iframe width='100%' height='480' src=$link01 title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
    </div>
    <h3 class='titulo'>
        <details>
            <summary>Aulas</summary>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=3&nome_a=1'>01 - Como obter chaves de acesso para o IXC Maps</a></li>
            <li><a class='links' href='principal.php?p=treinamentos/conteudo.php&tp_t=3&nome_a=2'>02 - Configuração de elementos no IXC Maps</a></li>
        </details>
    </h3>";
}else {
    $nome_curso = "Nenhum curso selecionado!";
}
// curso de atendimento



?>

           <div class="cardbox">
                <!--Cards de conteudo-->
                <h3 class="titulo">Treinamento - <?=$nome_curso?></h3>
                <div class="card">
                <? echo $html_mostra; ?>
                
            </div>

<?php 
   }
}
?>

<!-- geral -->


</body>
</html>