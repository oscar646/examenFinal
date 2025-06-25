<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = $conexion->query("DELETE FROM cliente WHERE id_cliente = $id");
    
    if($sql){
        $_SESSION['mensaje'] = '<div class="alert alert-success">Cliente eliminado correctamente</div>';
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar el cliente</div>';
    }
}
?> 