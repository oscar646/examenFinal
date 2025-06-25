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
        /* From Uiverse.io by cssbuttons-io */ 
        .uiverse-btn {
            position: relative;
            border: none;
            background: transparent;
            padding: 0;
            cursor: pointer;
            outline-offset: 4px;
            transition: filter 250ms;
            user-select: none;
            touch-action: manipulation;
            margin-right: 8px;
        }
        .uiverse-btn .shadow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            background: hsl(0deg 0% 0% / 0.25);
            will-change: transform;
            transform: translateY(2px);
            transition: transform 600ms cubic-bezier(.3, .7, .4, 1);
        }
        .uiverse-btn .edge {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            background: linear-gradient(
                to left,
                hsl(340deg 100% 16%) 0%,
                hsl(340deg 100% 32%) 8%,
                hsl(340deg 100% 32%) 92%,
                hsl(340deg 100% 16%) 100%
            );
        }
        .uiverse-btn .front {
            display: block;
            position: relative;
            padding: 8px 18px;
            border-radius: 12px;
            font-size: 1rem;
            color: white;
            background: hsl(345deg 100% 47%);
            will-change: transform;
            transform: translateY(-4px);
            transition: transform 600ms cubic-bezier(.3, .7, .4, 1);
        }
        .uiverse-btn.edit .front {
            background: #facc15;
            color: #333;
        }
        .uiverse-btn.add .front {
            background: #22c55e;
            color: #fff;
            padding: 8px 18px;
            font-size: 1rem;
            min-width: 90px;
        }
        .uiverse-btn:hover {
            filter: brightness(110%);
        }
        .uiverse-btn:hover .front {
            transform: translateY(-6px);
            transition: transform 250ms cubic-bezier(.3, .7, .4, 1.5);
        }
        .uiverse-btn:active .front {
            transform: translateY(-2px);
            transition: transform 34ms;
        }
        .uiverse-btn:hover .shadow {
            transform: translateY(4px);
            transition: transform 250ms cubic-bezier(.3, .7, .4, 1.5);
        }
        .uiverse-btn:active .shadow {
            transform: translateY(1px);
            transition: transform 34ms;
        }
        .uiverse-btn:focus:not(:focus-visible) {
            outline: none;
        }
        .add-btn-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 8px;
            width: 100%;
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
        <div class="add-btn-container">
          <a href="agregar_usuario.php" class="uiverse-btn add" title="Agregar Usuario">
            <span class="shadow"></span><span class="edge"></span><span class="front">Agregar</span>
          </a>
        </div>
        <h4>Usuarios</h4>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Acciones</th>
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
                <td>
                  <a href='editar_usuario.php?id={$row->id_usuario}' class='uiverse-btn edit' title='Editar'><span class='shadow'></span><span class='edge'></span><span class='front'>Editar</span></a>
                  <a href='eliminar_usuario.php?id={$row->id_usuario}' class='uiverse-btn' title='Borrar' onclick='return confirm(\'¿Seguro que deseas borrar este usuario?\')'><span class='shadow'></span><span class='edge'></span><span class='front'>Borrar</span></a>
                </td>
              </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- Estudiantes -->
      <div class="tab-pane fade" id="estudiantes" role="tabpanel">
        <div class="add-btn-container">
          <a href="agregar_estudiante.php" class="uiverse-btn add" title="Agregar Estudiante">
            <span class="shadow"></span><span class="edge"></span><span class="front">Agregar</span>
          </a>
        </div>
        <h4>Estudiantes</h4>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>CI</th>
              <th>Fecha Nacimiento</th>
              <th>Acciones</th>
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
                <td>
                  <a href='editar_estudiante.php?id={$row->id_estudiante}' class='uiverse-btn edit' title='Editar'><span class='shadow'></span><span class='edge'></span><span class='front'>Editar</span></a>
                  <a href='eliminar_estudiante.php?id={$row->id_estudiante}' class='uiverse-btn' title='Borrar' onclick='return confirm(\'¿Seguro que deseas borrar este estudiante?\')'><span class='shadow'></span><span class='edge'></span><span class='front'>Borrar</span></a>
                </td>
              </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- Docentes -->
      <div class="tab-pane fade" id="docentes" role="tabpanel">
        <div class="add-btn-container">
          <a href="agregar_docente.php" class="uiverse-btn add" title="Agregar Docente">
            <span class="shadow"></span><span class="edge"></span><span class="front">Agregar</span>
          </a>
        </div>
        <h4>Docentes</h4>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Profesión</th>
              <th>Acciones</th>
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
                <td>
                  <a href='editar_docente.php?id={$row->id_docente}' class='uiverse-btn edit' title='Editar'><span class='shadow'></span><span class='edge'></span><span class='front'>Editar</span></a>
                  <a href='eliminar_docente.php?id={$row->id_docente}' class='uiverse-btn' title='Borrar' onclick='return confirm(\'¿Seguro que deseas borrar este docente?\')'><span class='shadow'></span><span class='edge'></span><span class='front'>Borrar</span></a>
                </td>
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