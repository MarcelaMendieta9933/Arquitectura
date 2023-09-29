<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/flor.png" />
    <link rel="stylesheet" type="text/css" href="../css/styleusuarios.css"/>
    <title>Entrada</title>
</head>
<body>
    <!-- Vista de usuarios al logearse -->
    <div class="login">
        <div class="login-screen">
            <?php
            // Obtener el nombre del usuario de la URL
            $nombre = $_GET["nombre"];
            
            // Mostrar un mensaje de bienvenida
            echo "<h2>Bienvenid@, $nombre!</h2>";
            ?>
        </div>
    </div>
</body>
</html>
