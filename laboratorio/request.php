<?php
    // definir o tipo de conteudo
    header('Content-Type: application/json');
    // recupera os dados enviados pelo arquivo script.js
    $nome = $_POST['name'];
    $comentario = $_POST['comment'];

    // conexão com o banco via PDO
    $conn = new PDO('mysql:host=192.168.12.150; dbname=censo.cas;', 'root', '');

    // inicio da query de insert
    $inserir = $conn->prepare(' INSERT INTO laboratorio (nome, comentario) VALUES (:n, :c)');
    $inserir->bindValue(':n', $nome);
    $inserir->bindValue(':c', $comentario);
    // executa a query
    $inserir->execute();
    // verifica se foi cadastrado
    if($inserir->rowCount() >= 1){
        echo json_encode('Salvo com sucesso');
    
    }else {
        echo json_encode('Ocorreu um erro');
    }