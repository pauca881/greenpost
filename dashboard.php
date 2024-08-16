<?php
session_start();

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

// Aquí podrías hacer consultas adicionales a la base de datos si es necesario
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Greenpost</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div id="container">
        <h1>Bienvenido a tu Dashboard</h1>
        <p>Has iniciado sesión perfectamente!</p>
        <p><a href="index.php">Inicio</a></p>
        <p><a href="logout.php">Cerrar Sesión</a></p>
    </div>
</body>
</html>