<?php

$id   = $_POST['id'];
$nome = $_POST['nome'];

require '../global/TConnection.class.php';
try {
    $db = TConnection::open();
    if ($id == 0) {
        $qry = $db->prepare('INSERT INTO categorias_eventos (nome) VALUES (:nome)');
    } else {
        $qry = $db->prepare('UPDATE categorias_eventos SET nome = :nome WHERE id = :id');
        $qry->bindParam('id', $id);
    }
    $qry->bindParam('nome', $nome);
    $qry->execute();

    $db = null;
    
    header('location:index.php');
} catch (PDOException $e) {
    echo $e->getMessage();
}
