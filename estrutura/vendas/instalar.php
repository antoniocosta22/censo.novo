<?php
require_once './classes/usuarios.php';
$u = new usuario;
$sigla_cid = $_GET['c'];
$venda = $_GET['venda'];
$data_conf = date("Y-m-d");
$instalada = 's';
// desinstalar
$desin = 'n';
$data_desin = 'NULL';

$verifica_inst = $pdo->prepare("SELECT instalada FROM `vendas` WHERE id = $venda ");
$verifica_inst->execute();
    while($verifica_instalada = $verifica_inst->fetch(PDO::FETCH_ASSOC)){
        $stat_inst = $verifica_instalada['instalada'];
    }
// se ja estiver instalada, desinstala
if ($stat_inst == 's'){
    if (!empty($venda)){


      $sql2 = $pdo->prepare(" UPDATE vendas SET instalada = :sm WHERE id = :id ");
      $sql2->execute(array(
              ':sm' => $desin,
              ':id' => $venda 
          ));  
  }
}
// caso não seja instalada, instala
else{

    if (!empty($venda)){


      $sql2 = $pdo->prepare(" UPDATE vendas SET instalada= :s, data_instal= :data_inst, usr_instal= :usr_ins WHERE id= :id ");
      $sql2->execute(array(
              ':s' => $instalada,
              ':data_inst' => $data_conf,
              ':usr_ins' => $user,
              ':id' => $venda 
          ));  
  }
}


?>

<script>
    setTimeout(() => {
      location.href = 'principal.php?p=vendas/fila_vendas.php&x!=<?=$sigla_cid?>&v=nao_instaladas.php'
    }, 600)
</script>