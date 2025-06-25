<?php
if(isset($_POST['btnmodificar'])){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $fecha = $_POST['fecha'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $sql = $conexion->query("UPDATE cliente SET 
                            nombre='$nombre',
                            apellido='$apellido',
                            direccion='$direccion',
                            fecha_nacimiento='$fecha',
                            telefono='$telefono',
                            correo='$correo'
                            WHERE id_cliente=$id");
    
    if($sql){
        $_SESSION['mensaje'] = '<div class="alert alert-success">Cliente modificado correctamente</div>';
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al modificar el cliente</div>';
    }
}
?> 