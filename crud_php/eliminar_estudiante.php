<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    header("Location: login.php");
    exit();
}
include "modelo/conexion.php";

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $conexion->query("DELETE FROM estudiante WHERE id_estudiante = $id");
}
header("Location: index.php");
exit(); 