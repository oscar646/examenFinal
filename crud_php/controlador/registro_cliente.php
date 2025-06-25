<?php
if(isset($_POST['btnregistrar'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $fecha = $_POST['fecha'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $sql = $conexion->query("INSERT INTO cliente (nombre, apellido, direccion, fecha_nacimiento, telefono, correo) 
                            VALUES ('$nombre', '$apellido', '$direccion', '$fecha', '$telefono', '$correo')");
    
    if($sql){
        $_SESSION['mensaje'] = '<div class="alert alert-success">Cliente registrado correctamente</div>';
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar el cliente</div>';
    }
}
?> 