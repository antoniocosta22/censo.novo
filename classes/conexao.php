<?php 
// CONEXÃO COM O BANCO DE DADOS DO CENSO
try {
        $pdo = new PDO("mysql:host=192.168.12.150;dbname=censo.cas;charset=utf8", "root", "");
        $pdo->setAtTribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e) {
        echo $e->getMessage();
    }

?>
