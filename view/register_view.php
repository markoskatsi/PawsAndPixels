<!DOCTYPE html>
<head>
    <title>Register | Paws & Pixels</title>
    <link rel="stylesheet" href="../css/registerstyle.css">
</head>
<body>
    <form action="register.php" method="POST">
        <h1>Paws & Pixels</h1>
        <h2>Create Account: </h2>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Register</button>

        <?php if (!empty($error_message)): ?>
            <p style="color: red;"> <?= htmlspecialchars($error_message); ?> </p>
        <?php endif; ?>

        <?php if (!empty($userStatus)): ?>
            <div class="success-message">
                <?= htmlspecialchars($userStatus) ?>
                <a href="../controller/login.php" class="login">Proceed to Login Page</a>
            </div>
        <?php endif; ?>
    </form>

    

</body>
</html>