<?php
    // definir o tipo de conteudo
    header('Content-Type: application/json');
    // conexão com o banco via PDO
    $conn = new PDO('mysql:host=192.168.12.150; dbname=censo.cas;', 'root', '');

    // inicio da query de insert
    $selecionar = $conn->prepare(' SELECT * FROM laboratorio');
    // executa a query
    $selecionar->execute();
    // verifica se foi cadastrado
    if($selecionar->rowCount() >= 1){
        echo json_encode($selecionar->fetchAll(PDO::FETCH_ASSOC));
    
    }else {
        echo json_encode('Ocorreu um erro');
    }