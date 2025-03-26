<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $file = 'users.json';
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }
    $users = json_decode(file_get_contents($file), true);

    foreach ($users as $user) {
        if ($user['username'] === $username) {
            $error = "Utilizatorul există deja!";
            break;
        }
    }

    if (!$error) {
        $users[] = ['username' => $username, 'password' => $password];
        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

        // Autentificare automată după înregistrare
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Înregistrare</h2>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Utilizator:</label>
        <input type="text" name="username" required>
        <label>Parolă:</label>
        <input type="password" name="password" required>
        <button type="submit">Înregistrează-te</button>
    </form>

    <p>Ai deja cont? <a href="login.php">Autentifică-te</a></p>
</body>
</html>
