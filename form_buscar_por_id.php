<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orquesta CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center p-3">Orquesta CRUD</h1>

    <div class="container-fluid">
        <div class="row">
            <!-- Formulario para buscar músicos por ID -->
            <form class="col-4 p-3" action="form_buscar_por_id.php" method="POST">
                <h3 class="text-center text-secondary">Búsqueda por ID</h3>
                <div class="mb-3">
                    <label for="id" class="form-label">ID del Músico</label>
                    <input type="number" class="form-control" name="id" required>
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>

            <!-- Tabla para mostrar todos los músicos -->
            <div class="col-8 p-4">
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

                            $sql = $conection->prepare("SELECT * FROM musicos WHERE id_musico = ?");
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
                                            <a href="editar.php?id=<?= $datos->id_musico ?>">editar</a>
                                            <a href="eliminar.php?id=<?= $datos->id_musico ?>">eliminar</a>
                                        </td>
                                    </tr>
                                <?php }
                            } else {
                                echo "<p>No se encontraron músicos con el ID especificado.</p>";
                            }
                        } else {
                            echo "<p>Por favor, proporcione un ID válido.</p>";
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
