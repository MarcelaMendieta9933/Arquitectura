<!DOCTYPE html>

<head>
<script src="dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="icon" type="image/x-icon" href="../imagenes/logo.png"/>
</head>

</html>
<?php
include('conexion_bd.php');

// Obtiene los datos del formulario
function insertar(){
$conn = conectar();
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$estado = 'Nuevo';
 // Inserta los datos en la base de datos
$sq = "INSERT INTO notas (titulo, descripcion, estado, fecha) VALUES ('$titulo','$descripcion', '$estado',NOW())";
    
if ($conn->query($sq) === TRUE) {
    echo "<script> Swal.fire(
      'Se creo la nota',
      'Exitosamente!!!',
      'success'
    ); 
    </script>";
} else {
    echo "Error: " . $sq . "<br>" . $conn->error;
}
$conn->close();
}

function consultar()
{
  $conn = conectar();
  $consulta = "SELECT id, titulo, descripcion, estado, fecha FROM notas";
  $resultado = mysqli_query($conn, $consulta);
  
  // Generar filas de la tabla
  while ($fila = mysqli_fetch_assoc($resultado)) {
      echo "<tr id='num_id" . $fila['id'] . "'>";
      echo "<td>" . $fila['titulo'] . "</td>";
      echo "<td>" . $fila['descripcion'] . "</td>";
      echo "<td>" . $fila['estado'] . "</td>";
      echo "<td>" . $fila['fecha'] . "</td>";
      echo "<td>";
      echo "<form method='post'>";
      echo "<input type='hidden' name='accion' value='modificar,". $fila['id'] . "'>";
      echo "<button data-modal='miModalEditar' id='abrirModalEditar' type='submit'class='btn_modificar' onclick='abirirEditar()'>modificar</button>";
      echo "</form>";
      echo "<form method='post'>";
      echo "<input class='btn_borrar'type='hidden' name='accion' value='borrar,". $fila['id'] . "'>";
      echo "<button type='submit' class='btn_borrar'>borrar</button>";
      echo "</form>";
      echo "</td>";
      echo "</tr>";
  }
  $conn->close();
}





function borrarRegistro($id) {
  
  $conn = conectar();
  // Verificar la conexión
  if (!$conn) {
      die("Error al conectar a la base de datos: " . mysqli_connect_error());
  }

  // Consulta SQL para borrar el registro con el ID proporcionado
  $sql = "DELETE FROM notas WHERE id = $id";

  if (mysqli_query($conn, $sql)) {
    echo "<script> Swal.fire(
      'Registro borrado correctamente',
      'Exitosamente!!!',
      'success'
    ); 
    </script>";
      echo "<script> Swal.fire(
        {
        'Registro borrado correctamente',
        'Exitosamente!!!',
        'success'
      );
      </script>";
  } else {
      echo "Error al borrar el registro: " . mysqli_error($conn);
  }

  // Cerrar la conexión a la base de datos
  $conn->close();
}

// ... (código previo) ...

function actualizar($id) {
  $conn = conectar();
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editar_titulo']) && isset($_POST['editar_descripcion'])) {
      $titulo = $_POST['editar_titulo'];
      $descripcion = $_POST['editar_descripcion'];
      
      // Consulta SQL para actualizar los datos en la base de datos
      $sql = "UPDATE notas SET titulo='$titulo', descripcion='$descripcion', estado='Actualizado' WHERE id = $id";

      if ($conn->query($sql) === TRUE) {
        echo "Nota actualizada exitosamente!";
      } else {
        echo "Error al actualizar la nota: " . $conn->error;
      }
    }
  }
}

// ... (código previo) ...
?>