<?php
require_once './classes/usuarios.php';
$u = new usuario;

$chave = $_GET['ch'];
$data_cad = date("Y-m-d H:i:s");
$resp = '0';

if (!empty($chave)){

    $sql2 = $pdo->prepare(" UPDATE chave_chaveiros SET resp= :resp, data_alt= :data_alt WHERE id= :id ");

    $sql2->execute(array(
            ':resp' => $resp,
            ':data_alt' => $data_cad,
            ':id' => $chave 
        ));
        
        $sql3 = $pdo->prepare(" INSERT INTO chaveiro_ocorrencia (id_chaveiro, tipo_ocor, id_usr, descr, usr_dest, data_ocor, data_cad) VALUES ('".$chave."', '3', '".$user."', 'Recebimento', '0', '".$data_cad."', '".$data_cad."')");
        $sql3->execute();
}
?>

<script src="./js/swalert.js"></script>
<script>
    swal("Feito!", "Chave recebida!","success").then( () => {
        location.href = 'principal.php?p=chaveiro/chaveiros.php'
    })
</script>