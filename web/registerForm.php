<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <h4>Masz konto? <a href="loginForm.php" class="btn btn-primary">Zaloguj się</a></h4>
    </div>
    <h4>Utwórz nowe konto na Twiterze</h4>
    <form method="POST" action="register.php" class="form-horizontal">
        <div class="form-group">
            <label for="nameField" class="col-xs-2">Login:</label>
            <div class="col-xs-3">
                <input type="text" name="username" class="form-control" id="nameField" placeholder="Login"/>
            </div>
        </div>
        <div class="form-group">
            <label for="emailField" class="col-xs-2">E-mail</label>
            <div class="col-xs-3">
                <input type="email" name="email" class="form-control" id="emailField" placeholder="E-mail"/>
            </div>
        </div>
        <div class="form-group">
            <label for="passwordField" class="col-xs-2">Hasło:</label>
            <div class="col-xs-3">
                <input type="password" name="password" class="form-control" id="passwordField" placeholder="Hasło"/>
            </div>
        </div>
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary">Zarejestruj się</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>
