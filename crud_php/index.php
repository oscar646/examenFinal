<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    header("Location: login.php");
    exit();
}
include "modelo/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Gestión Universitaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #b2f7c1 0%, #e0ffe6 100%);
            min-height: 100vh;
        }
        .container {
            margin-top: 40px;
        }
        .table thead {
            background: #a3e635;
            color: #fff;
        }
        .btn-custom {
            background: #34d399;
            color: #fff;
            border: none;
        }
        .btn-custom:hover {
            background: #059669;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Panel de Gestión Universitaria</h2>
        <a href="cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>
    <ul class="nav nav-tabs mb-4" id="crudTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="usuarios-tab" data-bs-toggle="tab" data-bs-target="#usuarios" type="button" role="tab">Usuarios</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="estudiantes-tab" data-bs-toggle="tab" data-bs-target="#estudiantes" type="button" role="tab">Estudiantes</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="docentes-tab" data-bs-toggle="tab" data-bs-target="#docentes" type="button" role="tab">Docentes</button>
      </li>
    </ul>
    <div class="tab-content" id="crudTabsContent">
      <!-- Usuarios -->
      <div class="tab-pane fade show active" id="usuarios" role="tabpanel">
        <h4>Usuarios</h4>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = $conexion->query("SELECT u.id_usuario, u.nombre, u.email, r.nombre_rol FROM usuario u JOIN rol r ON u.id_rol = r.id_rol");
            while($row = $sql->fetch_object()){
              echo "<tr>
                <td>{$row->id_usuario}</td>
                <td>{$row->nombre}</td>
                <td>{$row->email}</td>
                <td>{$row->nombre_rol}</td>
              </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- Estudiantes -->
      <div class="tab-pane fade" id="estudiantes" role="tabpanel">
        <h4>Estudiantes</h4>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>CI</th>
              <th>Fecha Nacimiento</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = $conexion->query("SELECT e.id_estudiante, u.nombre, u.email, e.ci, e.fecha_nacimiento FROM estudiante e JOIN usuario u ON e.id_usuario = u.id_usuario");
            while($row = $sql->fetch_object()){
              echo "<tr>
                <td>{$row->id_estudiante}</td>
                <td>{$row->nombre}</td>
                <td>{$row->email}</td>
                <td>{$row->ci}</td>
                <td>{$row->fecha_nacimiento}</td>
              </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- Docentes -->
      <div class="tab-pane fade" id="docentes" role="tabpanel">
        <h4>Docentes</h4>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Profesión</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = $conexion->query("SELECT d.id_docente, u.nombre, u.email, d.profesion FROM docente d JOIN usuario u ON d.id_usuario = u.id_usuario");
            while($row = $sql->fetch_object()){
              echo "<tr>
                <td>{$row->id_docente}</td>
                <td>{$row->nombre}</td>
                <td>{$row->email}</td>
                <td>{$row->profesion}</td>
              </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 