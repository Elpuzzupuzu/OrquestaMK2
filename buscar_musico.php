<?php
// Incluir la conexión a la base de datos
include("conec.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar el ID del formulario
    $id = intval($_POST['id']); // Convertir a entero y asegurarse de que sea seguro

    // Preparar la consulta SQL para buscar al músico por ID
    $stmt = $conection->prepare("SELECT * FROM musicos WHERE id_musico = ?");

    // Verificar si la consulta se preparó correctamente
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conection->error);
    }

    // Asociar parámetros y ejecutar la consulta
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el músico
    if ($result->num_rows > 0) {
        // Mostrar los datos del músico
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id_musico"] . "<br>";
            echo "Nombre: " . $row["nombre"] . "<br>";
            echo "Apellido: " . $row["apellido"] . "<br>";
            echo "Fecha de Nacimiento: " . $row["fecha_nacimiento"] . "<br>";
            echo "Género: " . $row["genero"] . "<br>";
            echo "Nacionalidad: " . $row["nacionalidad"] . "<br>";
            echo "ID del Instrumento: " . $row["id_instrumento"] . "<br>";
            echo "Fecha de Ingreso: " . $row["fecha_ingreso"] . "<br>";
            echo "Estado: " . $row["estado"] . "<br>";
            echo "ID del Programa: " . $row["lista_programa"] . "<br>";
            // Agregar más campos según tu base de datos
        }
    } else {
        echo "No se encontró ningún músico con ese ID.";
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conection->close();
}
?>
