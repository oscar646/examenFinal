<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    header("Location: login.php");
    exit();
}
include "modelo/conexion.php";

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
}
$id = intval($_GET['id']);
$mensaje = "";

if(isset($_POST['btnEditar'])){
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $email = $conexion->real_escape_string($_POST['email']);
    $profesion = $conexion->real_escape_string($_POST['profesion']);
    // Actualizar usuario
    $sql1 = $conexion->query("UPDATE usuario u JOIN docente d ON u.id_usuario = d.id_usuario SET u.nombre='$nombre', u.email='$email' WHERE d.id_docente=$id");
    // Actualizar docente
    $sql2 = $conexion->query("UPDATE docente SET profesion='$profesion' WHERE id_docente=$id");
    if($sql1 && $sql2){
        header("Location: index.php");
        exit();
    } else {
        $mensaje = '<div class="alert alert-danger">Error al editar docente</div>';
    }
}
$sql = $conexion->query("SELECT d.*, u.nombre, u.email FROM docente d JOIN usuario u ON d.id_usuario = u.id_usuario WHERE d.id_docente=$id");
$docente = $sql->fetch_object();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Docente</title>
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
            background: #facc15;
            color: #333;
            border-radius: 16px 16px 0 0;
        }
        .btn-custom {
            background: #facc15;
            color: #333;
            border: none;
        }
        .btn-custom:hover {
            background: #fbbf24;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header text-center">
            <h3>Editar Docente</h3>
        </div>
        <div class="card-body">
            <?php if($mensaje) echo $mensaje; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($docente->nombre) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($docente->email) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="profesion" class="form-label">Profesión</label>
                    <input type="text" class="form-control" name="profesion" value="<?= htmlspecialchars($docente->profesion) ?>" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-custom" name="btnEditar">Guardar Cambios</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <a href="index.php" class="btn btn-secondary">Volver al Panel</a>
            </div>
        </div>
    </div>
</body>
</html> 