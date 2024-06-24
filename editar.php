<?php
include "conec.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = $conection->prepare("CALL BuscarMusicoPorID(?)");
    if ($sql === false) {
        die('Error en la preparación de la consulta SQL: ' . $conection->error);
    }
    $sql->bind_param("i", $id);
    if ($sql->execute()) {
        $result = $sql->get_result();
        $musico = $result->fetch_object();
        if (!$musico) {
            die('No se encontró ningún músico con ese ID.');
        }
    } else {
        die('Error al ejecutar la consulta: ' . $sql->error);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = !empty($_POST['fechanacimiento']) ? $_POST['fechanacimiento'] : null;
    $genero = $_POST['genero'];
    $nacionalidad = $_POST['nacionalidad'];
    $id_instrumento = $_POST['instrumento'];
    $fecha_ingreso = $_POST['fechaingreso'];
    $estado = $_POST['estado'];
    $lista_programa = $_POST['temporada'];

    // Ajustar el tipo de dato según la estructura de la tabla
    $sql = $conection->prepare("UPDATE musicos SET nombre = ?, apellido = ?, fecha_nacimiento = ?, genero = ?, nacionalidad = ?, id_instrumento = ?, fecha_ingreso = ?, estado = ?, lista_programa = ? WHERE id_musico = ?");
    if ($sql === false) {
        die('Error en la preparación de la consulta SQL: ' . $conection->error);
    }
    $sql->bind_param("sssssisssi", $nombre, $apellido, $fecha_nacimiento, $genero, $nacionalidad, $id_instrumento, $fecha_ingreso, $estado, $lista_programa, $id);

    if ($sql->execute()) {
        // Redirigir de vuelta a la página de búsqueda por ID
        header('Location: form_buscar_por_id.php');
        exit;
    } else {
        die('Error al ejecutar la consulta: ' . $sql->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Músico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center p-3">Editar Músico</h1>
        <?php if (isset($musico)) { ?>
            <form class="col-4 p-3" action="editar.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $musico->id_musico; ?>">
                <h3 class="text-center text-secondary">Editar Músico</h3>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $musico->nombre; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="apellido" value="<?php echo $musico->apellido; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fechanacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="fechanacimiento" value="<?php echo $musico->fecha_nacimiento; ?>">
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <input type="text" class="form-control" name="genero" value="<?php echo $musico->genero; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nacionalidad" class="form-label">Nacionalidad</label>
                    <input type="text" class="form-control" name="nacionalidad" value="<?php echo $musico->nacionalidad; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="instrumento" class="form-label">ID del Instrumento</label>
                    <input type="number" class="form-control" name="instrumento" value="<?php echo $musico->id_instrumento; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fechaingreso" class="form-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control" name="fechaingreso" value="<?php echo $musico->fecha_ingreso; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado" required>
                        <option value="Activo" <?php echo $musico->estado == 'Activo' ? 'selected' : ''; ?>>Activo</option>
                        <option value="Inactivo" <?php echo $musico->estado == 'Inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="temporada" class="form-label">Temporada</label>
                    <select class="form-select" id="temporada" name="temporada" required>
                        <option value="1" <?php echo $musico->lista_programa == 1 ? 'selected' : ''; ?>>Concierto de primavera</option>
                        <option value="2" <?php echo $musico->lista_programa == 2 ? 'selected' : ''; ?>>Festival de Verano</option>
                        <option value="3" <?php echo $musico->lista_programa == 3 ? 'selected' : ''; ?>>Recital de Otoño</option>
                        <option value="4" <?php echo $musico->lista_programa == 4 ? 'selected' : ''; ?>>Gala de Invierno</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </form>
        <?php } else { ?>
            <p>No se encontró el músico especificado.</p>
        <?php } ?>
    </div>

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
