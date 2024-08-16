<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Greenpost</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Bienvenido a Greenpost</h1>
        <?php
        // Me aseguro de que la sesión esté iniciada antes de acceder a $_SESSION
        session_start();
        ?>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <!-- Comentado porque necesita una sesión activa -->
                <!-- <li><a href="pages/profile.php?id=<?php echo $_SESSION['user_id']; ?>">Perfil</a></li> -->
                <li><a href="posts/create_post.php">Crear Publicación</a></li>
                <li><a href="pages/logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>