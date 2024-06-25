<?php
session_start(); // Iniciar sesión si no se ha iniciado aún
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para Registrar Directores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <?php if (isset($_SESSION['mensaje'])): ?>
                    <div class="alert alert-<?php echo strpos($_SESSION['mensaje'], 'Error') === 0 ? 'danger' : 'success'; ?>" role="alert">
                        <?php echo $_SESSION['mensaje']; ?>
                    </div>
                    <?php unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo ?>
                <?php endif; ?>

                <form action="registrar_director.php" method="POST">
                    <h3>Registrar Director</h3>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="numero_conciertos" class="form-label">Número de Conciertos</label>
                        <input type="number" class="form-control" id="numero_conciertos" name="numero_conciertos" required min="1">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Registrar Director</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
