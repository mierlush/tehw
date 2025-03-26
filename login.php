<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $file = 'users.json';
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }
    $users = json_decode(file_get_contents($file), true);

    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        }
    }
    $error = "Utilizator sau parolă greșită!";
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare</title>
    <style>
        /* Fundal roz deschis pentru întreaga pagină */
        body {
            background-color: #FFB6C1; /* Roz deschis */
            margin: 0;
            font-family: 'Playfair Display', serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* 100% din înălțimea paginii */
        }

        .container {
            background-color: #FFFFFF; /* Fundal alb pentru formular */
            border-radius: 10px; /* Colțuri rotunjite */
            padding: 30px;
            width: 100%;
            max-width: 400px; /* Lățimea maximă a formularului */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Umbra ușoară */
            text-align: center;
        }

        h2 {
            color: #333333;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555555;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #FF69B4; /* Pink mai intens */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #FF1493; /* Pink mai închis la hover */
        }

        p {
            color: #555555;
        }

        a {
            color: #FF69B4; /* Link cu culoare roz */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline; /* Subliniere la hover */
        }

        .error {
            color: red;
            margin-bottom: 20px;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Autentificare</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Utilizator:</label>
            <input type="text" name="username" required>
            <label>Parolă:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>

        <p>Nu ai cont? <a href="register.php">Înregistrează-te</a></p>
    </div>
</body>
</html>
