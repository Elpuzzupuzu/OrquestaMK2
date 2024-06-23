<?php
include "conec.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = $conection->prepare("SELECT * FROM musicos WHERE id_musico = ?");
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
    $estado = $_POST['estado']; // El valor del radio button será 'activo' o 'inactivo'
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
        exit; // Asegurarse de que el script termine después de la redirección
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
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $musico->nombre; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $musico->apellido; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fechanacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" value="<?php echo $musico->fecha_nacimiento; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <select class="form-select" id="genero" name="genero" required>
                        <option value="masculino" <?php echo ($musico->genero == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                        <option value="femenino" <?php echo ($musico->genero == 'femenino') ? 'selected' : ''; ?>>Femenino</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nacionalidad" class="form-label">Nacionalidad</label>
                    <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="<?php echo $musico->nacionalidad; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="instrumento" class="form-label">Instrumento</label>
                    <select class="form-select" id="instrumento" name="instrumento" required>
                        <option value="1" <?php echo ($musico->id_instrumento == 1) ? 'selected' : ''; ?>>Violin</option>
                        <option value="2" <?php echo ($musico->id_instrumento == 2) ? 'selected' : ''; ?>>Viola</option>
                        <option value="3" <?php echo ($musico->id_instrumento == 3) ? 'selected' : ''; ?>>Violonchelo</option>
                        <option value="4" <?php echo ($musico->id_instrumento == 4) ? 'selected' : ''; ?>>Contrabajo</option>
                        <option value="5" <?php echo ($musico->id_instrumento == 5) ? 'selected' : ''; ?>>Arpa</option>
                        <option value="6" <?php echo ($musico->id_instrumento == 6) ? 'selected' : ''; ?>>Flauta</option>
                        <option value="7" <?php echo ($musico->id_instrumento == 7) ? 'selected' : ''; ?>>Oboe</option>
                        <option value="8" <?php echo ($musico->id_instrumento == 8) ? 'selected' : ''; ?>>Clarinete</option>
                        <option value="9" <?php echo ($musico->id_instrumento == 9) ? 'selected' : ''; ?>>Fagot</option>
                        <option value="10" <?php echo ($musico->id_instrumento == 10) ? 'selected' : ''; ?>>Trompeta</option>
                        <option value="11" <?php echo ($musico->id_instrumento == 11) ? 'selected' : ''; ?>>Trombón</option>
                        <option value="12" <?php echo ($musico->id_instrumento == 12) ? 'selected' : ''; ?>>Tuba</option>
                        <option value="13" <?php echo ($musico->id_instrumento == 13) ? 'selected' : ''; ?>>Corno</option>
                        <option value="14" <?php echo ($musico->id_instrumento == 14) ? 'selected' : ''; ?>>Tambor</option>
                        <option value="15" <?php echo ($musico->id_instrumento == 15) ? 'selected' : ''; ?>>Piano</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fechaingreso" class="form-label">Fecha de ingreso</label>
                    <input type="date" class="form-control" id="fechaingreso" name="fechaingreso" value="<?php echo $musico->fecha_ingreso; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="radio" id="activo" name="estado" value="activo" <?php echo ($musico->estado == 'activo') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="activo">Activo</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="radio" id="inactivo" name="estado" value="inactivo" <?php echo ($musico->estado == 'inactivo') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="inactivo">Inactivo</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="temporada" class="form-label">Temporada</label>
                    <select class="form-select" id="temporada" name="temporada" required>
                        <option value="1" <?php echo ($musico->lista_programa == 1) ? 'selected' : ''; ?>>Concierto de primavera</option>
                        <option value="2" <?php echo ($musico->lista_programa == 2) ? 'selected' : ''; ?>>Festival de Verano</option>
                        <option value="3" <?php echo ($musico->lista_programa == 3) ? 'selected' : ''; ?>>Recital de Otoño</option>
                        <option value="4" <?php echo ($musico->lista_programa == 4) ? 'selected' : ''; ?>>Gala de Invierno</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Músico</button>
            </form>
        <?php } else { ?>
            <p class="text-center">No se encontró el músico especificado.</p>
        <?php } ?>
    </div>
</body>
</html>
