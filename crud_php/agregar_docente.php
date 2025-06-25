<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    header("Location: login.php");
    exit();
}
include "modelo/conexion.php";

$mensaje = "";
if(isset($_POST['btnAgregar'])){
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $email = $conexion->real_escape_string($_POST['email']);
    $password = $conexion->real_escape_string($_POST['password']);
    $profesion = $conexion->real_escape_string($_POST['profesion']);
    // Insertar usuario (rol docente = 2)
    $sql1 = $conexion->query("INSERT INTO usuario (nombre, email, password, id_rol) VALUES ('$nombre', '$email', '$password', 2)");
    if($sql1){
        $id_usuario = $conexion->insert_id;
        $sql2 = $conexion->query("INSERT INTO docente (id_usuario, profesion) VALUES ($id_usuario, '$profesion')");
        if($sql2){
            header("Location: index.php");
            exit();
        } else {
            $mensaje = '<div class=\'alert alert-danger\'>Error al agregar docente</div>';
        }
    } else {
        $mensaje = '<div class=\'alert alert-danger\'>Error al agregar usuario</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Docente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #b2f7c1 0%, #e0ffe6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            max-width: 420px;
            margin: 40px auto;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(34, 139, 34, 0.2);
            background: #f6fff8;
            border: 2px solid #a3e635;
        }
        .card-header {
            background: #2563eb;
            color: #fff;
            border-radius: 16px 16px 0 0;
        }
        .btn-custom {
            background: #2563eb;
            color: #fff;
            border: none;
        }
        .btn-custom:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header text-center">
            <h3>Agregar Docente</h3>
        </div>
        <div class="card-body">
            <?php if($mensaje) echo $mensaje; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="profesion" class="form-label">Profesión</label>
                    <input type="text" class="form-control" name="profesion" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-custom" name="btnAgregar">Agregar Docente</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <a href="index.php" class="btn btn-secondary">Volver al Panel</a>
            </div>
        </div>
    </div>
</body>
</html> 