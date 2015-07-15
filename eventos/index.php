<?php
try {
    $dados = '';

    require '../global/TConnection.class.php';
    $db  = TConnection::open();
    $qry = $db->query("SELECT * FROM eventos");
    while ($r   = $qry->fetchObject()) {
        $dados .= '<tr>
                        <td>' . $r->id . '</td>
                        <td>' . $r->nome . '</td>
                        <td><a href="javascript:void(0)" data-id="' . $r->id . '" class="lkEditar"><em class="glyphicon glyphicon-pencil"></em></a></td>
                        <td><a href="#" class="lkExcluir"><em class="glyphicon glyphicon-trash"></em></a></td>
                    </tr>';
    }
    $db = null;
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/dashboard.css" rel="stylesheet">

        <title>Eventos</title>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php require_once('../include/topo.php'); ?>
        <div class="container-fluid">
            <div class="row">
                <?php require_once('../include/menu.php'); ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <div class="container-fluid">
                        <div class="col-sm-11">
                            <h1 class="page-header">Eventos</h1>
                        </div>
                        <div class="col-sm-1 pull-right">
                            <a href="javascript:void(0)" id="btIncluir"  title="Incluir" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> &nbsp;Incluir</a>
                        </div>
                    </div>


                    <div class="container-fluid table-responsive">
                        <table class="table table-striped" id="tGrid">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th class="coluna-acao"></th>
                                    <th class="coluna-acao"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $dados; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="../assets/js/jquery-1.11.3.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/modalCadastro.js"></script>
    </body>
</html>
