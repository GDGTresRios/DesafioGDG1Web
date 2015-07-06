<?php
$id   = (isset($_GET['id'])) ? $_GET['id'] : 0;
$nome = '';
require '../global/TConnection.class.php';

if ($id) {
    try {
        $db  = TConnection::open();
        $qry = $db->query("SELECT id, nome, logo FROM categorias_colaboradores WHERE id=$id");
        if ($r   = $qry->fetchObject()) {
            $nome = $r->nome;
            $logo = $r->logo;
        }

        $db = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
    if (!$logo) {
        $logo = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGU2MGNiYmEyOCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZTYwY2JiYTI4Ij48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQzLjUiIHk9Ijc0LjgiPjE0MHgxNDA8L3RleHQ+PC9nPjwvZz48L3N2Zz4=";
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
                <form action="gravar.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <div class="control-group">
                        <label class="control-label" for="nome">Nome <span class="required">*</span>:</label>
                        <div class="controls">
                            <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required="required">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="nome">Logo:</label>
                        <div class="controls">
                            <input type="file" id="logo" name="logo">
                        </div>
                    </div>
                    <img class="img-thumbnail" src="<?php echo $logo; ?>" />
                    
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
