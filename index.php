<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/dashboard.css" rel="stylesheet">

        <title>Dashboard Template for Bootstrap</title>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php require_once('include/topo.php'); ?>
        <div class="container-fluid">
            <div class="row">
                <?php require_once('include/menu.php'); ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Dashboard</h1>

                    <h2 class="sub-header">Section title</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Header</th>
                                    <th>Header</th>
                                    <th>Header</th>
                                    <th>Header</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1,001</td>
                                    <td>Lorem</td>
                                    <td>ipsum</td>
                                    <td>dolor</td>
                                    <td>sit</td>
                                </tr>
                                <tr>
                                    <td>1,002</td>
                                    <td>amet</td>
                                    <td>consectetur</td>
                                    <td>adipiscing</td>
                                    <td>elit</td>
                                </tr>
                                <tr>
                                    <td>1,003</td>
                                    <td>Integer</td>
                                    <td>nec</td>
                                    <td>odio</td>
                                    <td>Praesent</td>
                                </tr>
                                <tr>
                                    <td>1,003</td>
                                    <td>libero</td>
                                    <td>Sed</td>
                                    <td>cursus</td>
                                    <td>ante</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="assets/js/jquery-1.11.3.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>
