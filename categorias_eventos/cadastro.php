<?php
$id   = (isset($_GET['id'])) ? $_GET['id'] : 0;
$nome = '';
require '../global/TConnection.class.php';

if ($id) {
    try {
        $db  = TConnection::open();
        $qry = $db->query("SELECT id, nome FROM categorias_eventos WHERE id=$id");
        if ($r   = $qry->fetchObject()) {
            $nome = $r->nome;
        }

        $db = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<div class="modal fade" id="modal_cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h3>Inclusão
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color: #555">&times;</span><span class="sr-only">Close</span></button></h3>
            </div>            
            <div class="container-fluid">
                <form action="gravar.php" method="post" class="form-horizontal">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <div class="control-group">
                        <label class="control-label" for="nome">Nome <span class="required">*</span>:</label>
                        <div class="controls">
                            <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required="required">
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
