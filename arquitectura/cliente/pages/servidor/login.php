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

    // Obtener los parametros del fomrulario
    $usuario = $_POST["username"];
    $contrasena = $_POST["password"];
    
    // Consulta SQL enviando el usuario y contraseña 
    $sql = "SELECT nombre FROM usuarios WHERE usuario = '$usuario' AND contraseña = '$contrasena'";
    $queryusuario = mysqli_query($conn,$sql);
    $nr = mysqli_num_rows($queryusuario); 
    $mostrar = mysqli_fetch_array($queryusuario); 

    if ($mostrar > 0) {
        //Si existe el usuario y contraseña, se redirecciona a la paina del usuario
        header("Location: ../usuario.php?nombre=" . urlencode($mostrar["nombre"]));
        exit();
    } else {
        // Sino muestra un mensaje de datos incorrectos
        echo "<script> alert('Usuario o contraseña incorrecto. ');window.location= '../login.html'</script>"; 
        exit();
    }
} else {
    // Si no se logró enviar, muestra una alerta
    echo "<script> alert('Usuario o contraseña incorrecto. ');window.location= '../inicio.html'</script>"; 
    exit();
}
$conn->close();
?>
