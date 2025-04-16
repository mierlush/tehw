<?php
session_start();

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Utilizator sau parolă greșită!'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $file = 'users.json';
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }

    $users = json_decode(file_get_contents($file), true);

    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $response = ['success' => true];
            break;
        }
    }
}

echo json_encode($response);
?>
