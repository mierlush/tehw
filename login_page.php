
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare</title>
    <link rel="stylesheet" href="css/auth.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/login.js"></script>
</head>

<body>
    <div class="container">
        <h2>Autentificare</h2>

    <form id="login-form">
        <label>Utilizator:</label>
        <input type="text" name="username" required>
        <label>Parolă:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>

    <p id="error-message" class="error" style="display: none;"></p>


        <p>Nu ai cont? <a href="register_page.php">Înregistrează-te</a></p>
    </div>
</body>
</html>
