<?php
include "conec.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Llamar al procedimiento almacenado para eliminar el músico
    $sql = $conection->prepare("CALL EliminarMusicoPorID(?)");
    if ($sql === false) {
        die('Error en la preparación de la consulta SQL: ' . $conection->error);
    }
    $sql->bind_param("i", $id);
    
    if ($sql->execute()) {
        // Redirigir de vuelta a la página de búsqueda por ID
        header('Location: form_buscar_por_id.php');
        exit;
    } else {
        die('Error al ejecutar la consulta: ' . $sql->error);
    }
}
?>
