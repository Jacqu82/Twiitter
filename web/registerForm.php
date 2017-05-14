<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <p>Masz konto? <a href="loginForm.php">Zaloguj się</a></p>
        <p>Utwórz nowe konto na Twiterze</p>
        <form method="POST" action="register.php">
            <p><label>Login: </label><input name="username" type="text"></label></p>
            <p><label>Email: <input name="email" type="email"></label></p>
            <p><label>Hasło: <input name="password" type="password"></label></p>
            <p><label><input type="submit" value="Zarejestruj się"></label></p>
        </form>
    </body>
</html>
