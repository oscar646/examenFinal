<?php
include "conexion.php";

// Verificar si ya existe el usuario admin
$email = 'admin@email.com';
$password = 'admin123';
$nombre = 'admin';
$id_rol = 1; // Administrador

$sql = $conexion->query("SELECT * FROM usuario WHERE email='$email'");
if($sql->num_rows == 0){
    $conexion->query("INSERT INTO usuario (nombre, email, password, id_rol) VALUES ('$nombre', '$email', '$password', $id_rol)");
    echo "Usuario admin creado correctamente.";
} else {
    echo "El usuario admin ya existe.";
}
?> 