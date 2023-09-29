<?php

function conectar(){
    // Configuración de la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "servidor_db";
    
    $con = mysqli_connect($servername, $username, $password, $database);
    
        // Verificar la conexión
    if (!$con) {
        die("Error al conectar: " . mysqli_connect_error());
    }

    return $con;

}
$conn = conectar();
//Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener el nombre del formulario
    $usuario = $_POST["username"];
    $contrasena = $_POST["password"];
    
    // Consulta SQL para buscar el nombre en la base de datos y verificar la contraseña
    $sql = "SELECT nombre FROM usuarios WHERE usuario = '$usuario' AND contraseña = '$contrasena'";
    $queryusuario = mysqli_query($conn,$sql);
    $nr = mysqli_num_rows($queryusuario); 
    $mostrar = mysqli_fetch_array($queryusuario); 

    if ($mostrar > 0) {
        // Si se encuentra el nombre en la base de datos, redirigir a la página de bienvenida
        header("Location: ../usuario.php?nombre=" . urlencode($mostrar["nombre"]));
        exit();
    } else {
        // Si el nombre no se encuentra en la base de datos, redirigir de nuevo al formulario de inicio de sesión
        echo "<script> alert('Usuario o contraseña incorrecto. ');window.location= '../login.html'</script>"; 
        exit();
    }
} else {
    // Si no se ha enviado el formulario, redirigir al formulario de inicio de sesión
    echo "<script> alert('Usuario o contraseña incorrecto. ');window.location= '../inicio.html'</script>"; 
    exit();
}
$conn->close();
?>
