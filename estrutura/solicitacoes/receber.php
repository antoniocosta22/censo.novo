<?php
require_once './classes/usuarios.php';
$u = new usuario;

$soli = $_GET['soli'];
$data_conf = date("Y-m-d H:i:s");
$confirmado = 'S';
if (!empty($soli)){

    $sql2 = $pdo->prepare(" UPDATE movimento SET recebido= :rece, recebedor= :usr_conf, dtreceb= :data_conf WHERE solicitacao= :id ");
    $sql2->execute(array(
            ':rece' => $confirmado,
            ':usr_conf' => $user,
            ':data_conf' => $data_conf,
            ':id' => $soli 
        ));
}
?>

<script>
  
      window.close();

</script>