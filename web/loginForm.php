<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body>
    <div class="container">
        <h3>Zaloguj się na swoje konto</h3>
        <form method="POST" action="login.php" class="form-horizontal">
            <div class="form-group">
                <label for="nameField" class="col-xs-2">Login:</label>
                <div class="col-xs-3">
                    <input type="text" name="username" class="form-control" id="nameField" placeholder="Login" />
                </div>
            </div>
            <div class="form-group">
                <label for="passwordField" class="col-xs-2">Hasło:</label>
                <div class="col-xs-3">
                    <input type="password" name="password" class="form-control" id="passwordField" placeholder="Hasło" />
                </div>
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary">Zaloguj się</button>
            </div>
        </form>
    </div>
    <div class="container">
        <h3>Nie masz konta? <a href="registerForm.php">Zarejestruj się</a></h3>
    </div>
<!--        <form method="POST" action="login.php">-->
<!--            <p>Zaloguj się na swoje konto</p>-->
<!--            <p>-->
<!--                <label>-->
<!--                    Login: <input name="username" type="text">-->
<!--                </label>-->
<!--            </p>-->
<!--            <p>-->
<!--                <label>-->
<!--                    Hasło: <input name="password" type="password">-->
<!--                </label>-->
<!--            </p>-->
<!--            <p>-->
<!--                <input type="submit" value="Zaloguj się">-->
<!--            </p>-->
<!--        </form>-->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    </body>
</html>
