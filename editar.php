<?php
include "conec.php";

$errors = []; // Array para almacenar errores de validación

// Función para validar datos (puedes expandir esta función según tus necesidades de validación)
function validarDatos($datos) {
    if (empty($datos['nombre'])) {
        return 'El nombre es obligatorio.';
    }
    if (empty($datos['apellido'])) {
        return 'El apellido es obligatorio.';
    }
    return ''; // Devuelve cadena vacía si no hay errores
}

// Función para ejecutar el procedimiento almacenado de actualización
function actualizarMusico($conexion, $id, $nombre, $apellido, $fecha_nacimiento, $genero, $nacionalidad, $id_instrumento, $fecha_ingreso, $estado, $lista_programa) {
    $sql = $conexion->prepare("CALL EditarMusicoPorID(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($sql === false) {
        die('Error en la preparación de la consulta SQL: ' . $conexion->error);
    }
    $sql->bind_param("isssssissi", $id, $nombre, $apellido, $fecha_nacimiento, $genero, $nacionalidad, $id_instrumento, $fecha_ingreso, $estado, $lista_programa);

    if ($sql->execute()) {
        return true; // Éxito en la ejecución del procedimiento almacenado
    } else {
        die('Error al ejecutar la consulta: ' . $sql->error);
    }
}

// Manejo del formulario POST para actualizar el músico
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = !empty($_POST['fechanacimiento']) ? $_POST['fechanacimiento'] : null;
    $genero = $_POST['genero'];
    $nacionalidad = $_POST['nacionalidad'];
    $id_instrumento = $_POST['instrumento']; // Ahora se espera recibir el valor del instrumento como una cadena de texto
    $fecha_ingreso = $_POST['fechaingreso'];
    $estado = $_POST['estado'];
    $lista_programa = $_POST['temporada'];

    // Validación de datos
    $validacion = validarDatos($_POST);
    if (!empty($validacion)) {
        $errors[] = $validacion;
    }

    // Llamar al procedimiento almacenado para actualizar el músico
    if (empty($errors)) {
        if (actualizarMusico($conection, $id, $nombre, $apellido, $fecha_nacimiento, $genero, $nacionalidad, $id_instrumento, $fecha_ingreso, $estado, $lista_programa)) {
            // Almacenar mensaje de éxito en sesión
            session_start();
            $_SESSION['mensaje'] = "El músico se actualizó correctamente.";

            // Redirigir de vuelta a la página de búsqueda por ID
            header('Location: form_buscar_por_id.php');
            exit;
        } else {
            $errors[] = "Error al actualizar el músico.";
        }
    }
}

// Obtener datos del músico para prellenar el formulario en caso de GET o error de validación
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
                <?php if (!empty($errors)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($errors as $error) { ?>
                            <p><?php echo $error; ?></p>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : $musico->nombre; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="apellido" value="<?php echo isset($_POST['apellido']) ? $_POST['apellido'] : $musico->apellido; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fechanacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="fechanacimiento" value="<?php echo isset($_POST['fechanacimiento']) ? $_POST['fechanacimiento'] : $musico->fecha_nacimiento; ?>">
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <input type="text" class="form-control" name="genero" value="<?php echo isset($_POST['genero']) ? $_POST['genero'] : $musico->genero; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nacionalidad" class="form-label">Nacionalidad</label>
                    <input type="text" class="form-control" name="nacionalidad" value="<?php echo isset($_POST['nacionalidad']) ? $_POST['nacionalidad'] : $musico->nacionalidad; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="instrumento" class="form-label">Instrumento</label>
                    <select class="form-select" id="instrumento" name="instrumento" required>
                        <option value="1" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 1) || $musico->id_instrumento == 1 ? 'selected' : ''; ?>>Violin</option>
                        <option value="2" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 2) || $musico->id_instrumento == 2 ? 'selected' : ''; ?>>Viola</option>
                        <option value="3" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 3) || $musico->id_instrumento == 3 ? 'selected' : ''; ?>>Violonchelo</option>
                        <option value="4" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 4) || $musico->id_instrumento == 4 ? 'selected' : ''; ?>>Contrabajo</option>
                        <option value="5" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 5) || $musico->id_instrumento == 5 ? 'selected' : ''; ?>>Flauta</option>
                        <option value="6" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 6) || $musico->id_instrumento == 6 ? 'selected' : ''; ?>>Clarinete</option>
                        <option value="7" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 7) || $musico->id_instrumento == 7 ? 'selected' : ''; ?>>Oboe</option>
                        <option value="8" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 8) || $musico->id_instrumento == 8 ? 'selected' : ''; ?>>Clarinete</option>
                        <option value="9" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 9) || $musico->id_instrumento == 9 ? 'selected' : ''; ?>>Fagot</option>
                        <option value="10" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 10) || $musico->id_instrumento == 10 ? 'selected' : ''; ?>>Trompeta</option>
                        <option value="11" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 11) || $musico->id_instrumento == 11 ? 'selected' : ''; ?>>Trombón</option>
                        <option value="12" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 12) || $musico->id_instrumento == 12 ? 'selected' : ''; ?>>Tuba</option>
                        <option value="13" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 13) || $musico->id_instrumento == 13 ? 'selected' : ''; ?>>Corno</option>
                        <option value="14" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 14) || $musico->id_instrumento == 14 ? 'selected' : ''; ?>>Tambor</option>
                        <option value="15" <?php echo (isset($_POST['instrumento']) && $_POST['instrumento'] == 15) || $musico->id_instrumento == 15 ? 'selected' : ''; ?>>Piano</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fechaingreso" class="form-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control" name="fechaingreso" value="<?php echo isset($_POST['fechaingreso']) ? $_POST['fechaingreso'] : $musico->fecha_ingreso; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado" required>
                        <option value="Activo" <?php echo (isset($_POST['estado']) && $_POST['estado'] == 'Activo') || $musico->estado == 'Activo' ? 'selected' : ''; ?>>Activo</option>
                        <option value="Inactivo" <?php echo (isset($_POST['estado']) && $_POST['estado'] == 'Inactivo') || $musico->estado == 'Inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="temporada" class="form-label">Temporada</label>
                    <select class="form-select" id="temporada" name="temporada" required>
                        <option value="1" <?php echo (isset($_POST['temporada']) && $_POST['temporada'] == 1) || $musico->lista_programa == 1 ? 'selected' : ''; ?>>Concierto de primavera</option>
                        <option value="2" <?php echo (isset($_POST['temporada']) && $_POST['temporada'] == 2) || $musico->lista_programa == 2 ? 'selected' : ''; ?>>Festival de Verano</option>
                        <option value="3" <?php echo (isset($_POST['temporada']) && $_POST['temporada'] == 3) || $musico->lista_programa == 3 ? 'selected' : ''; ?>>Recital de Otoño</option>
                        <option value="4" <?php echo (isset($_POST['temporada']) && $_POST['temporada'] == 4) || $musico->lista_programa == 4 ? 'selected' : ''; ?>>Gala de Invierno</option>
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
