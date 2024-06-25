<?php
session_start(); // Iniciar sesión para obtener el mensaje de éxito

// Verificar si hay un mensaje almacenado en la sesión
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']); // Eliminar el mensaje para que no se muestre más de una vez
} else {
    $mensaje = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>busqueda por id</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .negative-margin {
            margin-bottom: -10px; /* Ajusta el valor según tus necesidades */
        }
    </style>
</head>
<body>
    <h1 class="text-center p-3">Orquesta búsqueda por id</h1>

    <div class="container-fluid" style="display: flex;">
        <div class="row">
            <!-- Formulario para buscar músicos por ID -->
            <form class="col-4 p-3 negative-margin" action="form_buscar_por_id.php" method="POST">
                <h3 class="text-center text-secondary">Búsqueda por ID</h3>
                <div class="mb-3">
                    <label for="id" class="form-label">ID del Músico</label>
                    <input type="number" class="form-control" name="id" required min="1" style="width: 150px;">

                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>

            <!-- Tabla para mostrar todos los músicos -->
            <div class="col-8 p-4 negative-margin">
                <?php if (!empty($mensaje)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $mensaje; ?>
                    </div>
                <?php } ?>
                <table class="table">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Fecha_Nacimiento</th>
                            <th scope="col">Genero</th>
                            <th scope="col">Nacionalidad</th>
                            <th scope="col">id_instrumento</th>
                            <th scope="col">Fecha_Ingreso</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Id_programa</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "conec.php";

                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
                            $id = intval($_POST['id']); // Asegúrate de que el ID es un número entero

                            $sql = $conection->prepare("CALL BuscarMusicoPorID(?)");
                            $sql->bind_param("i", $id);
                            $sql->execute();
                            $result = $sql->get_result();

                            if ($result->num_rows > 0) {
                                while ($datos = $result->fetch_object()) { ?>
                                    <tr>
                                        <td><?= $datos->id_musico ?></td>
                                        <td><?= $datos->nombre ?></td>
                                        <td><?= $datos->apellido ?></td>
                                        <td><?= $datos->fecha_nacimiento ?></td>
                                        <td><?= $datos->genero ?></td>
                                        <td><?= $datos->nacionalidad ?></td>
                                        <td><?= $datos->id_instrumento ?></td>
                                        <td><?= $datos->fecha_ingreso ?></td>
                                        <td><?= $datos->estado ?></td>
                                        <td><?= $datos->lista_programa ?></td>
                                        <td>
                                            <a href="editar.php?id=<?= $datos->id_musico ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <a href="eliminar.php?id=<?= $datos->id_musico ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php }
                            } else {
                                echo "<tr><td colspan='11'>No se encontraron músicos con el ID especificado.</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11'>Por favor, proporcione un ID válido.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
