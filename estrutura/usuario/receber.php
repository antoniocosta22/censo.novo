<?php
require_once './classes/usuarios.php';
$u = new usuario;

$ferramenta = $_GET['tool'];
$data_conf = date("Y-m-d H:i:s");
$confirmado = 's';
if (!empty($ferramenta)){

    $sql2 = $pdo->prepare(" UPDATE ferramenta_ocorrencia SET confirmado= :conf, usr_confir= :usr_conf, data_confir= :data_conf WHERE id_ferramenta= :id ");
    $sql2->execute(array(
            ':conf' => $confirmado,
            ':usr_conf' => $user,
            ':data_conf' => $data_conf,
            ':id' => $ferramenta 
        ));
      
}
?>

<script src="./js/swalert.js"></script>
<script>
    swal("Feito!", "ferramenta recebida!","success").then( () => {
        location.href = 'principal.php?p=usuario/minha_caixa.php'
    })
</script>


