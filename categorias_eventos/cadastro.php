<?php
  //  $id = $_GET['id'];
?>

<div class="modal fade" id="modal_cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h3>Inclusão
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color: #555">&times;</span><span class="sr-only">Close</span></button></h3>
            </div>            
            <div class="container-fluid">
                <form action="" method="post" class="form-horizontal">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="control-group">
                        <label class="control-label" for="nome">Nome <span class="required">*</span>:</label>
                        <div class="controls">
                            <input type="text" id="nome" name="nome" value="" required="required">
                        </div>
                    </div>
                    <div class="well">
                        <button type="submit" class="btn">Salvar</button>
                    </div>
                </form>                
            </div>
            <div id="padrao" class="modal-footer">
                <button type="button" id="btn-fechar-modal-padrao" class="btn btn-sm btn-default btn-primary" data-dismiss="modal"
                        style="margin-left:40px; width:90px">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;Fechar</button> 
            </div> 


        </div>
    </div>
</div>
