<?php
session_start();
include "modelo/conexion.php";

if(isset($_POST['btnlogin'])){
    $email = $conexion->real_escape_string($_POST['usuario']);
    $password = $conexion->real_escape_string($_POST['password']);
    
    $sql = $conexion->query("SELECT * FROM usuario WHERE email='$email' AND password='$password'");
    
    if($datos = $sql->fetch_object()){
        $_SESSION['id_usuario'] = $datos->id_usuario;
        $_SESSION['nombre'] = $datos->nombre;
        $_SESSION['email'] = $datos->email;
        $_SESSION['id_rol'] = $datos->id_rol;
        // Redirigir al index solo si no se ha enviado salida antes
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
    <style>
    body {
      background: linear-gradient(135deg, #b2f7c1 0%, #e0ffe6 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      max-width: 420px;
      margin: 40px auto;
      border-radius: 18px;
      box-shadow: 0 8px 32px 0 rgba(34, 139, 34, 0.2);
      background: #f6fff8;
      border: 2px solid #a3e635;
    }
    .login-card .card-header {
      background: #a3e635;
      color: #fff;
      border-radius: 16px 16px 0 0;
    }
    .login-card .btn-primary {
      background: #34d399;
      border: none;
    }
    .login-card .btn-primary:hover {
      background: #059669;
    }
    /* From Uiverse.io by kamehame-ha */ 
    .coolinput {
      display: flex;
      flex-direction: column;
      width: 100%;
      position: static;
      max-width: 340px;
      margin: 0 auto 18px auto;
    }
    .coolinput label.text {
      font-size: 0.85rem;
      color: #059669;
      font-weight: 700;
      position: relative;
      top: 0.5rem;
      margin: 0 0 0 7px;
      padding: 0 3px;
      background: #f6fff8;
      width: fit-content;
    }
    .coolinput input.input {
      padding: 14px 12px;
      font-size: 1rem;
      border: 2px #34d399 solid;
      border-radius: 7px;
      background: #f6fff8;
      transition: border 0.2s;
    }
    .coolinput input.input:focus {
      outline: none;
      border: 2px #059669 solid;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card login-card">
                    <div class="card-header text-center">
                        <h3>Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)) echo $error; ?>
                        <form method="POST">
                            <div class="coolinput">
                                <label for="usuario" class="text">Correo electrónico:</label>
                                <input type="text" placeholder="Escribe tu correo..." name="usuario" class="input" required>
                            </div>
                            <div class="coolinput">
                                <label for="password" class="text">Contraseña:</label>
                                <input type="password" placeholder="Escribe tu contraseña..." name="password" class="input" required>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg" name="btnlogin">Iniciar Sesión</button>
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