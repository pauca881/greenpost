<?php
session_start();
include 'includes/db.php';

// Si no hi ha sessió creada, vas directament a login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

// Procesar el formulario de creación de post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $content = trim($_POST['content']);

    if (!empty($content)) {
        $sql = "INSERT INTO posts (user_id, content) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $user_id, $content);

        if ($stmt->execute()) {
            $success_message = "¡Post creado exitosamente!";
        } else {
            $error_message = "Hubo un error al crear el post.";
        }

        $stmt->close();
    } else {
        $error_message = "El contenido del post no puede estar vacío.";
    }
}

// Obtener los posts para mostrarlos
$sql = "SELECT posts.content, posts.created_at, user.nombre FROM posts JOIN user ON posts.user_id = user.id ORDER BY posts.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect - Inicio</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div id="container">
        <h1>GreenConnect</h1>

        <!-- Botón de Logout -->
        <form action="logout.php" method="POST">
            <input type="submit" value="Logout" style="float: right; background-color: red; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer;">
        </form>

        <h2>Crear un nuevo post</h2>

        <?php
        if (isset($success_message)) {
            echo "<p style='color:green;'>$success_message</p>";
        }
        if (isset($error_message)) {
            echo "<p style='color:red;'>$error_message</p>";
        }
        ?>

        <form action="index.php" method="POST">
            <textarea name="content" rows="4" cols="50" placeholder="¿Qué estás pensando?" required></textarea><br>
            <input type="submit" value="Crear Post">
        </form>

        <h2>Posts Recientes</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<p><strong>" . htmlspecialchars($row['nombre']) . "</strong> dijo:</p>";
                echo "<p>" . htmlspecialchars($row['content']) . "</p>";
                echo "<p><small>Publicado en " . $row['created_at'] . "</small></p>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>No hay posts aún. ¡Sé el primero en crear uno!</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();