<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/60229f6865.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    if(isset($_SESSION['mensaje'])) {
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);
    }
    ?>
    <script>
        function eliminar(){
            var respuesta=confirm("¿Estás seguro de eliminar este registro?");
            return respuesta;
        }
    </script>

    <h1 class="text-center p-3">Gestión de Clientes</h1>
    <div class="text-end p-3">
        <a href="cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>
    <?php
    include "modelo/conexion.php";
    include "controlador/eliminar_cliente.php";
    ?>
    <div class="container-fluid row">
        <form class="col-4 p-3 " method="POST">
            <h3 class="text-center text-secondary">Registro de Clientes</h3>
            <?php
            include "controlador/registro_cliente.php"
            ?>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido del Cliente</label>
                <input type="text" class="form-control" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="number" class="form-control" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="correo" required>
            </div>

            <button type="submit" class="btn btn-primary" name="btnregistrar">Registrar Cliente</button>
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead>
                    <tr class="table-info">
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">APELLIDO</th>
                        <th scope="col">DIRECCIÓN</th>
                        <th scope="col">FECHA DE NACIMIENTO</th>
                        <th scope="col">TELÉFONO</th>
                        <th scope="col">CORREO</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "modelo/conexion.php";
                    $sql = $conexion->query("SELECT * FROM cliente");
                    while ($datos = $sql->fetch_object()) { ?>
                        <tr>
                            <td><?= $datos->id_cliente ?></td>
                            <td><?= $datos->nombre ?></td>
                            <td><?= $datos->apellido ?></td>
                            <td><?= $datos->direccion ?></td>
                            <td><?= $datos->fecha_nacimiento ?></td>
                            <td><?= $datos->telefono ?></td>
                            <td><?= $datos->correo ?></td>
                            <td>
                                <a href="editar.php?id=<?= $datos->id_cliente ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a onclick="return eliminar()" href="index.php?id=<?= $datos->id_cliente ?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>