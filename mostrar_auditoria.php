<?php
// Incluir la conexión a la base de datos
include("conec.php");

// Consulta para obtener los registros de la tabla auditoria_musicos
$sql = "SELECT * FROM auditoria_musicos ORDER BY fecha DESC";
$result = $conection->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditoría de Músicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-primary:hover {
            background-color: #b8daff !important;
        }

        .table-primary.selected {
            background-color: #b8daff !important;
        }
    </style>
</head>
<body>
    <h1>Auditoría de Músicos</h1>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">ID Auditoría</th>
                            <th scope="col">ID Músico</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Acción</th>
                            <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Verificar si hay resultados
                        if ($result->num_rows > 0) {
                            // Recorrer los resultados y mostrarlos en la tabla
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id_auditoria'] . "</td>";
                                echo "<td>" . $row['id_musico'] . "</td>";
                                echo "<td>" . $row['nombre'] . "</td>";
                                echo "<td>" . $row['apellido'] . "</td>";
                                echo "<td>" . $row['accion'] . "</td>";
                                echo "<td>" . $row['fecha'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No hay registros en la auditoría.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script para resaltar fila seleccionada
        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {
                row.addEventListener("click", () => {
                    row.classList.toggle("table-primary");
                    const isSelected = row.classList.contains("table-primary");
                    rows.forEach(r => {
                        if (r !== row) {
                            r.classList.remove("table-primary");
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>

<?php
// Cerrar la conexión
$conection->close();
?>
