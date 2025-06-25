<?php
session_start();
include "modelo/conexion.php";
include "controlador/modificar_cliente.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = $conexion->query("SELECT * FROM cliente WHERE id_cliente=$id");
    
    if($datos = $sql->fetch_object()){ ?>
        <div class="container-fluid row">
            <form class="col-4 p-3 m-auto" method="POST">
                <h3 class="text-center text-secondary">Modificar Cliente</h3>
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Cliente</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido del Cliente</label>
                    <input type="text" class="form-control" name="apellido" value="<?= $datos->apellido ?>" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="direccion" value="<?= $datos->direccion ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="fecha" value="<?= $datos->fecha_nacimiento ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="number" class="form-control" name="telefono" value="<?= $datos->telefono ?>" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" name="correo" value="<?= $datos->correo ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="btnmodificar">Modificar Cliente</button>
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    <?php } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">No se encontró el cliente</div>';
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/60229f6865.js" crossorigin="anonymous"></script>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>