<?php 
// conexão com o banco de dados do IXC soft para coleta de dados de clientes sem internet
try {
        $pdo_ixc = new PDO("mysql:host=138.97.232.2;dbname=ixcprovedor;charset=utf8", "henrique", "3jqxuamq");
        $pdo_ixc->setAtTribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e) {
        echo $e->getMessage();
    }

?>