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
    $password = $conexion->real_escape_string($_POST['password']);
    $id_rol = intval($_POST['id_rol']);
    $sql = $conexion->query("UPDATE usuario SET nombre='$nombre', email='$email', password='$password', id_rol=$id_rol WHERE id_usuario=$id");
    if($sql){
        header("Location: index.php");
        exit();
    } else {
        $mensaje = '<div class="alert alert-danger">Error al editar usuario</div>';
    }
}

$sql = $conexion->query("SELECT * FROM usuario WHERE id_usuario=$id");
$usuario = $sql->fetch_object();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
            <h3>Editar Usuario</h3>
        </div>
        <div class="card-body">
            <?php if($mensaje) echo $mensaje; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($usuario->nombre) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($usuario->email) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="text" class="form-control" name="password" value="<?= htmlspecialchars($usuario->password) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="id_rol" class="form-label">Rol</label>
                    <select class="form-select" name="id_rol" required>
                        <option value="">Selecciona un rol</option>
                        <?php
                        $roles = $conexion->query("SELECT * FROM rol");
                        while($rol = $roles->fetch_object()){
                            $selected = $usuario->id_rol == $rol->id_rol ? 'selected' : '';
                            echo "<option value='{$rol->id_rol}' $selected>{$rol->nombre_rol}</option>";
                        }
                        ?>
                    </select>
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