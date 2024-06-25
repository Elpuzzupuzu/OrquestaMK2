<?php
// Incluir el archivo de conexión
include "conec.php";

// Iniciar sesión
session_start();

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$numero_conciertos = $_POST['numero_conciertos'];

// Llamar al procedimiento almacenado
$sql = "CALL RegistrarDirector(?, ?, ?)";
$stmt = $conection->prepare($sql);
$stmt->bind_param("ssi", $nombre, $apellido, $numero_conciertos);

if ($stmt->execute()) {
    // Establecer mensaje de éxito en sesión
    $_SESSION['mensaje'] = "¡Nuevo director registrado exitosamente!";
} else {
    // Establecer mensaje de error en sesión
    $_SESSION['mensaje'] = "Error al registrar director: " . $stmt->error;
}

// Cerrar la consulta y la conexión
$stmt->close();
$conection->close();

// Redirigir de vuelta al formulario de registro de directores
header("Location: form_director.php");
exit();
?>
