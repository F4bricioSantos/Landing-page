
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleLogin.css">
    <link rel="shortcut icon" type="imagex/png" href="img/logo.jpg">
    <title>LAFTI</title>
</head>
<body>

    <div class="content-principal">
        <div class="content-quadrado">            
            <div class="content-login">
                <p class="login">LOGIN</p>
                <h4>
                    <?php 
                    error_reporting(0);
                    session_start();
                    session_destroy();
                    echo $_SESSION['LoginMensagem'];
                    ?>
                </h4>
                <form action="controlls/scriptLogin.php" method="POST" style="display:flex;flex-direction:column; align-items: center;">
                    <input type="email" name="email" placeholder="Email" class=" input" >
                    <input type="password" name="senha" placeholder="Senha" class="input " >
                    <input type="submit" name="submit" value="Entrar"  class="button-entrar" style="margin-bottom: 5px;">
                </form>
            </div>
        </div>
    </div>
</body>
</html>