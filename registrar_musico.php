<?php
// Incluir la conexión a la base de datos
include("conec.php");
session_start(); // Iniciar la sesión

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $fecha_nacimiento = htmlspecialchars($_POST['fechanacimiento']);
    $genero = htmlspecialchars($_POST['genero']);
    $nacionalidad = htmlspecialchars($_POST['nacionalidad']);
    $id_instrumento = intval($_POST['instrumento']); // Convertir a entero
    $fecha_ingreso = htmlspecialchars($_POST['fechaingreso']);
    $estado = isset($_POST['estado']) ? htmlspecialchars($_POST['estado']) : 'inactivo'; // Valor por defecto 'inactivo'
    $id_programa = intval($_POST['temporada']); // Convertir a entero

    // Preparar la consulta SQL para insertar datos
    $stmt = $conection->prepare("CALL RegistrarMusico(?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Verificar si la consulta se preparó correctamente
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conection->error);
    }

    // Asociar parámetros y ejecutar la consulta
    $stmt->bind_param("sssssissi", $nombre, $apellido, $fecha_nacimiento, $genero, $nacionalidad, $id_instrumento, $fecha_ingreso, $estado, $id_programa);
    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Registro exitoso."; // Guardar el mensaje en la sesión
        header('Location: form_musico.php');
        exit;
    } else {
        $_SESSION['mensaje'] = "Error al registrar: " . $stmt->error; // Guardar el mensaje de error en la sesión
        header('Location: form_musico.php');
        exit;
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conection->close();
}
?>
