<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de directores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        h1 {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 30px;
        }

        .container-fluid {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .table {
            background-color: #fff;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .bg-info {
            background-color: #17a2b8 !important;
            color: white;
        }

        .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h1>Lista de directores</h1>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Número Conciertos</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "conec.php";

                        // Consultar directores utilizando un procedimiento almacenado
                        $sql = $conection->query("CALL ObtenerTodosLosDirectores()");
                        
                        while ($datos = $sql->fetch_object()) { ?>
                            <tr onmouseover="this.classList.add('table-primary')" onmouseout="this.classList.remove('table-primary')">
                                <td><?= $datos->id_director ?></td>
                                <td><?= $datos->nombre ?></td>
                                <td><?= $datos->apellido ?></td>
                                <td><?= $datos->numero_conciertos ?></td>
                                <td>
                                    <a href="editar_director.php?id=<?= $datos->id_director ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="eliminar_director.php?id=<?= $datos->id_director ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">Eliminar</a>
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
</
