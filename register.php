<?php
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $response['message'] = 'Toate câmpurile sunt obligatorii.';
        echo json_encode($response);
        exit;
    }

    $file = 'users.json';
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }

    $users = json_decode(file_get_contents($file), true);

    foreach ($users as $user) {
        if ($user['username'] === $username) {
            $response['message'] = 'Utilizatorul există deja!';
            echo json_encode($response);
            exit;
        }
    }

    $users[] = [
        'username' => $username,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ];
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

    $_SESSION['username'] = $username;
    $response['success'] = true;
    echo json_encode($response);
}
?>
