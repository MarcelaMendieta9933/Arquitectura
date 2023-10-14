<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/flor.png" />
    <link rel="stylesheet" type="text/css" href="../css/styleusuarios.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Entrada</title>
    <style>
        body 
        {
        font-family: Arial;
        background-color: #CCA5EC;
        background-image: url('../img/flor.png');
        background-repeat: repeat;
        background-size: 50px 50px;
        padding: 50px;
        }
    </style>
</head>
<body>
    <!-- Vista de usuarios al logearse -->
    <div class="container">
        <div class="container-screen">
            <div class="mensaje_usuario">
                <?php
                // Obtener el nombre del usuario de la URL
                $nombre = $_GET["nombre"];
                
                // Mostrar un mensaje de bienvenida
                echo "<h2>Bienvenid@, $nombre!</h2>";
                ?>
                <?php 
                if(isset($_POST['btncerrar']))
                {
                    session_destroy();
                    header('location: ../pages/inicio.html');
                }
                ?>
            </div>
            <div class="btn_alineacion">
                <form method="POST" >
                    <input type="submit" class="close-button" value="Cerrar sesión" name="btncerrar" />
                </form>
                <button id="abrirModalAgregar" class="btn_agregar"> Agregar Nota</button>
            </div>
            <div id="miModalAgregar" class="modal">
                <div class="modal-contenido">
                    <span id="cerrarModal" class="cerrar">&times;</span>
                    <form method="post">
                        <label id="titulo_modal" class="form-label"><h2>Agrega un nueva nota</h2></label>
                        <input id="titulo" type="text" class="form-control" name="titulo" id="titulo" placeholder="Escribe un titulo" required>
                        <input id="descripcion" ttype="text" class="form-control" name="descripcion" id="descripcion" placeholder="Escribe un descripcion" required>
                        <input type="hidden" name="accion" value="insertar">
                        <button type="submit" class="agregar_nota">Agregar</button>
                    </form>
                </div>
            </div>
            
            <div class="table-responsive" id="table">
                <table class="table table-bordered" id="tabla_usuarios">
                    <thead>
                        <tr>
                            <th scope="col">Titulo</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fechas</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('servidor/notas_crud.php');
                        consultar();
                        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accion"])){
                            
                            if($_POST["accion"] === "insertar") {
                            // Llama a tu función PHP aquí
                            insertar();
                            consultar();
                            }
                            elseif (strpos($_POST["accion"], "modificar") !== false) {
                                // La cadena contiene "borrar"
                                // Dividir la cadena en "borrar" e ID
                                $accion_parts = explode(",", $_POST["accion"]);
                        
                                if (count($accion_parts) == 2) {
                                    // $accion_parts[0] contendría "borrar" y $accion_parts[1] contendría el ID
                                    $accion = $accion_parts[0];
                                    $id = intval($accion_parts[1]);
                                    if ($accion === "modificar") {
                                        actualizar($id);
                                        consultar();
                                    }
                                }
                            }
                            elseif (strpos($_POST["accion"], "borrar") !== false) {
                                $accion_parts = explode(",", $_POST["accion"]);
                        
                                if (count($accion_parts) == 2) {
                                    $accion = $accion_parts[0];
                                    $id = intval($accion_parts[1]);
                                    if ($accion === "borrar") {
                                        borrarRegistro($id);
                                        consultar();
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Agrega este código en la sección <body> de usuario.php -->
            <div id="miModalEditar" class="modal">
                <div class="modal-contenido">
                    <span id="cerrarModalEditar" class="cerrar">&times;</span>
                    <form method="post" id="editar_form">
                        <label id="titulo_modal" class="form-label"><h2>Editar nota</h2></label>
                        <input id="editar_id" type="hidden" name="editar_id">
                        <input id="editar_titulo" type="text" class="form-control" name="editar_titulo" placeholder="Nuevo título" required>
                        <input id="editar_descripcion" type="text" class="form-control" name="editar_descripcion" placeholder="Nueva descripción" required>
                        <button type="submit" class="editar_nota">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    document.getElementById("abrirModalAgregar").addEventListener("click", function() {
    document.getElementById("miModalAgregar").style.display = "block";
});

document.getElementById("cerrarModal").addEventListener("click", function() {
    document.getElementById("miModalAgregar").style.display = "none";
});
</script>
</html>
