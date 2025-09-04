<?php
session_start();
require '../includes/connection.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (!$username || !$password || !$confirm) {
        $error = 'Vul alle velden in.';
    } elseif ($password !== $confirm) {
        $error = 'Wachtwoorden komen niet overeen.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            $error = 'Gebruikersnaam is al in gebruik.';
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashed]);
            $success = 'Registratie voltooid!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
    <style>
        body { background: #111; color: #f5f5f5; font-family: sans-serif; text-align: center; padding-top: 100px; }
        form { background: #1e1e1e; padding: 30px; border-radius: 10px; width: 300px; margin: 0 auto; box-shadow: 0 0 10px #e50914; }
        input { width: 100%; padding: 10px; margin: 10px 0; background: #222; color: #fff; border: none; }
        input[type="submit"] { background: #e50914; cursor: pointer; }
        .error { color: #f88; }
        .success { color: #9f9; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Registreren</h2>
        <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
        <?php if ($success): ?><p class="success"><?= htmlspecialchars($success) ?></p><?php endif; ?>
        <input type="text" name="username" placeholder="Gebruikersnaam" required>
        <input type="password" name="password" placeholder="Wachtwoord" required>
        <input type="password" name="confirm_password" placeholder="Bevestig wachtwoord" required>
        <input type="submit" value="Registreren">
        <p>Heb je al een account? <a href="login.php" style="color:#e50914;">Log hier in</a></p>
    </form>
</body>
</html>
