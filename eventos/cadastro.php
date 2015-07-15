<?php
$id = (isset($_GET['id'])) ? $_GET['id'] : 0;

$fk_categoria        = 0;
$fk_colaborador      = 0;
$nome                = '';
$descricao           = '';
$descricao_detalhada = '';
$data_hora           = '';
$duracao             = '';
$local               = '';

require '../global/TConnection.class.php';
$db = TConnection::open();

if ($id) {
    try {
        $qry = $db->query("SELECT   
                                id,
                                fk_categoria,
                                fk_colaborador
                                nome, 
                                descricao,
                                descricao_detalhada,
                                data_hora,
                                duracao,
                                local
                            FROM eventos WHERE id=$id");
        if ($r   = $qry->fetchObject()) {
            $fk_categoria        = $r->fk_categoria;
            $fk_colaborador      = $r->fk_colaborador;
            $nome                = $r->nome;
            $descricao           = $r->descricao;
            $logo                = $r->logo;
            $descricao_detalhada = $r->descricao_detalhada;
            $data_hora           = $r->data_hora;
            $duracao             = $r->duracao;
            $local               = $r->local;
            $endereco            = $r->endereco;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

$qry        = $db->query("SELECT * FROM categorias_eventos");
$categorias = '<option value="0"></option>';
while ($r          = $qry->fetchObject()) {
    $categorias .= '<option value="' . $r->id . '"';
    if (($fk_categoria > 0) && ($fk_categoria == $r->id)) {
        $categorias .= 'selected';
    }
    $categorias .= ' > ' . $r->nome . '</option>';
}

$qry           = $db->query("SELECT * FROM colaboradores");
$colaboradores = '<option value="0"></option>';
while ($r             = $qry->fetchObject()) {
    $colaboradores .= '<option value="' . $r->id . '"';
    if (($fk_colaborador > 0) && ($fk_colaborador == $r->id)) {
        $colaboradores .= 'selected';
    }
    $colaboradores .= ' > ' . $r->nome . '</option>';
}


$db = null;
?>

<div class="modal fade" id="modal_cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h3>Inclusão
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color: #555">&times;</span><span class="sr-only">Close</span></button></h3>
            </div>            
            <div class="container-fluid">
                <form action="gravar.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <div class="control-group">
                        <label class="control-label" for="fk_categoria">Categoria <span class="required">*</span>:</label>
                        <div class="controls">
                            <select id="fk_categoria" name="fk_categoria" required>
                                <?php echo $categorias; ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="fk_colaborador">Colaborador <span class="required">*</span>:</label>
                        <div class="controls">
                            <select id="fk_colaborador" name="fk_colaborador" required>
                                <?php echo $colaboradores; ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="nome">Nome <span class="required">*</span>:</label>
                        <div class="controls">
                            <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required="required">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="descricao">Descrição <span class="required">*</span>:</label>
                        <div class="controls">
                            <input type="text" id="descricao" name="descricao" value="<?php echo $descricao; ?>" required="required">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="descricao_detalhada">Descrição Detalhada:</label>
                        <div class="controls">
                            <textarea id="descricao_detalhada" name="descricao_detalhada">
                                <?php echo $descricao_detalhada; ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="data_hora">Horário:</label>
                        <div class="controls">
                            <input type="date" id="data_hora" name="data_hora" value="<?php echo $data_hora; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="duracao">Duração:</label>
                        <div class="controls">
                            <input type="time" id="duracao" name="duracao" value="<?php echo $duracao; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="local">Local:</label>
                        <div class="controls">
                            <input type="text" id="local" name="local" value="<?php echo $local; ?>">
                        </div>
                    </div>

                    <br />
                    <div id="padrao" class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary btn-default" style="float: left; width:90px"><span class="glyphicon glyphicon-save"></span>&nbsp;Salvar</button>
                        <button type="button" id="btn-fechar-modal-padrao" class="btn btn-sm btn-default btn-primary" data-dismiss="modal" style="margin-left:40px; width:90px">
                            <span class="glyphicon glyphicon-remove"></span>&nbsp;Fechar</button> 
                    </div> 
                </form>     
            </div>



        </div>
    </div>
</div>
