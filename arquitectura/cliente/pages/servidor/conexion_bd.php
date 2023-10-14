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
?>