<?php

$id   = $_POST['id'];
$nome = $_POST['nome'];
$logo = (isset($_FILES['logo'])) ? $_FILES['logo'] : FALSE;

require '../global/TImagem.class.php';

$imagem = new TImagem();
$logo   = $imagem->verifica_imagem($logo, 128, 128);
$logo   = $imagem->getCodigoImagem();

require '../global/TConnection.class.php';
try {
    $db = TConnection::open();
    if ($id == 0) {
        if ($logo) {
            $sql = 'INSERT INTO categorias_colaboradores (nome, logo) VALUES (:nome, :logo)';
        } else {
            $sql = 'INSERT INTO categorias_colaboradores (nome) VALUES (:nome)';
        }
        $qry = $db->prepare($sql);
    } else {
        if ($logo) {
            $sql = 'UPDATE categorias_colaboradores SET nome = :nome, logo = :logo WHERE id = :id';
        } else {
            $sql = 'UPDATE categorias_colaboradores SET nome = :nome WHERE id = :id';
        }
        $qry = $db->prepare($sql);
        $qry->bindParam('id', $id);
    }
    $qry->bindParam('nome', $nome);
    if ($logo) {
        $qry->bindParam('logo', $logo);
    }
    $qry->execute();

    $db = null;

    header('location:index.php');
} catch (PDOException $e) {
    echo $e->getMessage();
}
