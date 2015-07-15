<?php

$id                  = $_POST['id'];
$fk_categoria        = $_POST['fk_categoria'];
$fk_colaborador      = $_POST['fk_colaborador'];
$nome                = $_POST['nome'];
$descricao           = $_POST['descricao'];
$descricao_detalhada = $_POST['descricao_detalhada'];
$data_hora           = $_POST['data_hora'];
$duracao             = $_POST['duracao'];
$local               = $_POST['local'];
$endereco            = $_POST['endereco'];

require '../global/TConnection.class.php';
try {
    $db = TConnection::open();
    if ($id == 0) {

        $sql = 'INSERT INTO eventos (
                                fk_categoria,
                                fk_colaborador
                                nome, 
                                descricao,
                                descricao_detalhada,
                                data_hora,
                                duracao,
                                local
                    ) VALUES (
                                :fk_categoria,
                                :fk_colaborador
                                :nome, 
                                :descricao,
                                :descricao_detalhada,
                                :data_hora,
                                :duracao,
                                :local
                    )';
        $qry = $db->prepare($sql);
    } else {
        $sql = 'UPDATE colaboradores SET 
                        fk_categoria = :fk_categoria,
                        fk_colaborador = :fk_colaborador,
                        nome = :nome, 
                        descricao = :descricao,
                        descricao_detalhada = :descricao_detalhada,
                        data_hora = :data_hora,
                        duracao = :duracao,
                        local = :local
                    WHERE id = :id';
        $qry = $db->prepare($sql);
        $qry->bindParam('id', $id);
    }
    $qry->bindParam('fk_categoria', $fk_categoria);
    $qry->bindParam('fk_colaborador', $fk_colaborador);
    $qry->bindParam('nome', $nome);
    $qry->bindParam('descricao', $descricao);
    $qry->bindParam('descricao_detalhada', $descricao_detalhada);
    $qry->bindParam('data_hora', $data_hora);
    $qry->bindParam('duracao', $duracao);
    $qry->bindParam('local', $local);
    $qry->execute();

    $db = null;

    header('location:index.php');
} catch (PDOException $e) {
    echo $e->getMessage();
}
