<?php
include "conec.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = $conection->prepare("DELETE FROM musicos WHERE id_musico = ?");
    $sql->bind_param("i", $id);
    if ($sql->execute()) {
        echo "Músico eliminado correctamente.";
    } else {
        echo "Error al eliminar el músico: " . $conection->error;
    }
} else {
    echo "Solicitud no válida.";
}
?>
