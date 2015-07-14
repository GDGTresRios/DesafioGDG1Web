<?php

$id                  = $_POST['id'];
$fk_categoria        = $_POST['fk_categoria'];
$nome                = $_POST['nome'];
$descricao           = $_POST['descricao'];
$descricao_detalhada = $_POST['descricao_detalhada'];
$endereco_virtual    = $_POST['endereco_virtual'];
$email               = $_POST['email'];
$telefone            = $_POST['telefone'];
$endereco            = $_POST['endereco'];
$patrocinador        = (isset($_POST['patrocinador']) && $_POST['patrocinador'] == 1) ? 1 : 0;
$palestrante         = (isset($_POST['palestrante']) && $_POST['palestrante'] == 1) ? 1 : 0;
$expositor           = (isset($_POST['expositor']) && $_POST['expositor'] == 1) ? 1 : 0;
$logo                = (isset($_FILES['logo'])) ? $_FILES['logo'] : FALSE;

require '../global/TImagem.class.php';

$imagem = new TImagem();
$logo   = $imagem->verifica_imagem($logo, 128, 128);
$logo   = $imagem->getCodigoImagem();

require '../global/TConnection.class.php';
try {
    $db = TConnection::open();
    if ($id == 0) {
        if ($logo) {
            $sql = 'INSERT INTO colaboradores (
                                fk_categoria,
                                nome, 
                                descricao,
                                descricao_detalhada,
                                endereco_virtual,
                                email,
                                telefone,
                                endereco,
                                patrocinador,
                                palestrante,
                                expositor,
                                logo
                    ) VALUES (
                                :fk_categoria,
                                :nome, 
                                :descricao,
                                :descricao_detalhada,
                                :endereco_virtual,
                                :email,
                                :telefone,
                                :endereco,
                                :patrocinador,
                                :palestrante,
                                :expositor,
                                :logo
                    )';
        } else {
            $sql = 'INSERT INTO colaboradores (
                                fk_categoria,
                                nome, 
                                descricao,
                                descricao_detalhada,
                                endereco_virtual,
                                email,
                                telefone,
                                endereco,
                                patrocinador,
                                palestrante,
                                expositor
                    ) VALUES (
                                :fk_categoria,
                                :nome, 
                                :descricao,
                                :descricao_detalhada,
                                :endereco_virtual,
                                :email,
                                :telefone,
                                :endereco,
                                :patrocinador,
                                :palestrante,
                                :expositor
                    )';
        }
        $qry = $db->prepare($sql);
    } else {
        if ($logo) {
            $sql = 'UPDATE colaboradores SET
                        fk_categoria = :fk_categoria,
                        nome = :nome, 
                        descricao = :descricao,
                        descricao_detalhada = :descricao_detalhada,
                        endereco_virtual = :endereco_virtual,
                        email = :email,
                        telefone = :telefone,
                        endereco = :endereco,
                        patrocinador = :patrocinador,
                        palestrante = :palestrante,
                        expositor = :expositor,
                        logo = :logo
                    WHERE id = :id';
        } else {
            $sql = 'UPDATE colaboradores SET 
                        fk_categoria = :fk_categoria,
                        nome = :nome, 
                        descricao = :descricao,
                        descricao_detalhada = :descricao_detalhada,
                        endereco_virtual = :endereco_virtual,
                        email = :email,
                        telefone = :telefone,
                        endereco = :endereco,
                        patrocinador = :patrocinador,
                        palestrante = :palestrante,
                        expositor = :expositor 
                    WHERE id = :id';
        }
        $qry = $db->prepare($sql);
        $qry->bindParam('id', $id);
    }
    $qry->bindParam('fk_categoria', $fk_categoria);
    $qry->bindParam('nome', $nome);
    $qry->bindParam('descricao', $descricao);
    $qry->bindParam('descricao_detalhada', $descricao_detalhada);
    $qry->bindParam('endereco_virtual', $endereco_virtual);
    $qry->bindParam('email', $email);
    $qry->bindParam('telefone', $telefone);
    $qry->bindParam('endereco', $endereco);
    $qry->bindParam('patrocinador', $patrocinador);
    $qry->bindParam('palestrante', $palestrante);
    $qry->bindParam('expositor', $expositor);
    if ($logo) {
        $qry->bindParam('logo', $logo);
    }
    $qry->execute();

    $db = null;

    header('location:index.php');
} catch (PDOException $e) {
    echo $e->getMessage();
}
