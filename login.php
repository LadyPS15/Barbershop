<?php
session_start(); // Iniciar sesión

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Establecer las credenciales de admin
    $adminUsername = "admin";
    $adminPassword = "admin123"; // Asegúrate de tener una contraseña segura en producción

    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php"); // Redirigir al panel de administración
    } else {
        $error = "Credenciales inválidas, intenta de nuevo.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login de Administrador</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form action="login.php" method="POST">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        
        <button type="submit" name="login">Iniciar sesión</button>
    </form>
</body>
</html>
