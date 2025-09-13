<!DOCTYPE html>
<html>
<head>
    <title>Login | Paws & Pixels</title>
    <link rel="stylesheet" href="../css/loginstyle.css">
</head>
<body>
    <form method="POST" action="login.php">
        <h1>Paws & Pixels</h1>
        <h2>Log in: </h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Log In</button>

        <?php if (!empty($error_message)): ?>
            <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>

        <div class="register-section">
            <div class="register-text">New here? Register below!</div>
            <a href="register.php" class="register-btn">Create an Account</a>
        </div>

    </form>
</body>
</html>