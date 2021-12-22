<?php
require_once './classes/usuarios.php';
$u = new usuario;

$id_obs = $_GET['obs'];

if (!empty($id_obs)){

    $sql2 = $pdo->prepare("DELETE FROM obs WHERE id = :id");
    $sql2->execute(array(
            ':id' => $id_obs 
        ));   
}
?>
<script src="./js/swalert.js"></script>
<script>
        window.close();
</script>
