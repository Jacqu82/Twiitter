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
    <div class="row">
        <h4>Zaloguj się na swoje konto</h4>
        <form method="POST" action="login.php" class="form-horizontal">
            <div class="form-group">
                <label for="nameField" class="col-xs-2">Login:</label>
                <div class="col-xs-3">
                    <input type="text" name="username" class="form-control" id="nameField" placeholder="Login"/>
                </div>
            </div>
            <div class="form-group">
                <label for="passwordField" class="col-xs-2">Hasło:</label>
                <div class="col-xs-3">
                    <input type="password" name="password" class="form-control" id="passwordField" placeholder="Hasło"/>
                </div>
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary">Zaloguj się</button>
            </div>
        </form>
    </div>
    <h4>Nie masz konta? <a href="registerForm.php" class="btn btn-primary">Zarejestruj się</a></h4
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>