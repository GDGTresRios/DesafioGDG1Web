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
        <link href="assets/css/login.css" rel="stylesheet">

        <title>Login</title>


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">

            <form class="form-signin">
                <h2 class="form-signin-heading">Login</h2>
                <label for="inputEmail" class="sr-only">E-mail</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus>
                <label for="inputPassword" class="sr-only">Senha</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
                <div class="checkbox">
                    <!--          <label>
                                <input type="checkbox" value="remember-me"> Remember me
                              </label>-->
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            </form>

        </div> 
    </body>
</html>
