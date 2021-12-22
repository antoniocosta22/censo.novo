<?php 


require_once './classes/usuarios.php';
$u = new usuario;

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = $user");
$stmt->execute();
    while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
        
    }

?>