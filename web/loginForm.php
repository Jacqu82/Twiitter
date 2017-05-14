<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <form method="POST" action="login.php">
            <p>Zaloguj się na swoje konto</p>
            <p>
                <label>
                    Login: <input name="username" type="text">
                </label>
            </p>
            <p>
                <label>
                    Hasło: <input name="password" type="password">
                </label>
            </p>
            <p>
                <input type="submit" value="Zaloguj się">
            </p>          
        </form>
            <p>Nie masz konta? <a href="registerForm.php">Zarejestruj się</a></p>
    </body>
</html>
