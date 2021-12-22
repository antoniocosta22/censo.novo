<?php
require_once './classes/usuarios.php';
$u = new usuario;

$id_obs = $_GET['obs'];
$status = "CA";  
$data_mo = date("Y-m-d H:i:s");	

if (!empty($id_obs)){

        $sql = $pdo->prepare(" UPDATE solicitacoes SET status= '".$status."' WHERE solicitacao= '".$id_obs."' ");
        $sql->execute();
        
}
?>
<script src="./js/swalert.js"></script>
<script>
        location.href = 'principal.php?p=usuario/minhas_soli.php'
</script>
