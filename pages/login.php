<?php
session_start();
require '../includes/connection.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Ongeldige gebruikersnaam of wachtwoord.';
        }
    } else {
        $error = 'Vul beide velden in.';
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Inloggen</title>
    <style>
        body {
            background: #111;
            color: #f5f5f5;
            font-family: sans-serif;
            text-align: center;
            padding-top: 100px;
        }

        form {
            background: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            width: 300px;
            margin: 0 auto;
            box-shadow: 0 0 10px #e50914;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background: #222;
            color: #fff;
            border: none;
        }

        input[type="submit"] {
            background: #e50914;
            cursor: pointer;
        }

        .error {
            color: #f88;
        }
    </style>
</head>

<body>
    <form method="POST">
        <h2>Inloggen</h2>
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
        <input type="text" name="username" placeholder="Gebruikersnaam" required>
        <input type="password" name="password" placeholder="Wachtwoord" required>
        <input type="submit" value="Login">
        <p>Nog geen account? <a href="register.php" style="color:#e50914;">Registreer hier</a></p>
    </form>

    <script src="js/script.js"></script>
</body>

</html>