<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orquesta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        h1 {
            background-color: #343a40;
            color: white;
            padding: 15px;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        .container-fluid {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .table {
            background-color: #ffffff;
        }

        .bg-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h1>Orquesta</h1>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Fecha Nacimiento</th>
                            <th scope="col">Género</th>
                            <th scope="col">Nacionalidad</th>
                            <th scope="col">Id Instrumento</th>
                            <th scope="col">Fecha Ingreso</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Id Programa</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "conec.php";
                        
                        // Llamar al procedimiento almacenado para obtener todos los músicos
                        $sql = $conection->query("CALL ObtenerTodosLosMusicos()");
                        
                        while ($datos = $sql->fetch_object()) { ?>
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
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
