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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
        .table tbody tr.selected {
            background-color: #d0e9c6;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Auditoría de Músicos</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Auditoría</th>
                        <th>ID Músico</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Acción</th>
                        <th>Fecha</th>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // jQuery para resaltar la fila seleccionada
        $(document).ready(function() {
            $('.table tbody tr').on('click', function() {
                $(this).toggleClass('selected').siblings().removeClass('selected');
            });
        });
    </script>
</body>
</html>

<?php
// Cerrar la conexión
$conection->close();
?>
