<?php
session_start();
require '../includes/connection.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        // Haal de gebruiker op
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            // Admin-account (plain-text)
            if ($user['username'] === 'admin' && $password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ../index.php');
                exit;
            }
            // Alle andere accounts: hashed wachtwoord
            elseif (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ../index.php');
                exit;
            }
        }

        $error = 'Ongeldige gebruikersnaam of wachtwoord.';
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
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
    <form method="POST">
        <h2>Inloggen</h2>
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Gebruikersnaam" required>
        <input type="password" name="password" placeholder="Wachtwoord" required>
        <input type="submit" value="Login">
        <p>Nog geen account? <a href="register.php" style="color:#e50914;">Registreer hier</a></p>
    </form>

    <script src="js/script.js"></script>
</body>

</html>
