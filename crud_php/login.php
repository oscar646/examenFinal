<?php
session_start();
include "modelo/conexion.php";

if(isset($_POST['btnlogin'])){
    $email = $conexion->real_escape_string($_POST['usuario']); // El campo de usuario será el email
    $password = $conexion->real_escape_string($_POST['password']);
    
    $sql = $conexion->query("SELECT * FROM usuario WHERE email='$email' AND password='$password'");
    
    if($datos = $sql->fetch_object()){
        $_SESSION['id_usuario'] = $datos->id_usuario;
        $_SESSION['nombre'] = $datos->nombre;
        $_SESSION['email'] = $datos->email;
        $_SESSION['id_rol'] = $datos->id_rol;
        header("Location: index.php");
        exit();
    } else {
        $error = '<div class="alert alert-danger">Usuario o contraseña incorrectos</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)) echo $error; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Correo electrónico</label>
                                <input type="text" class="form-control" name="usuario" required placeholder="Ingrese su correo">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="btnlogin">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>