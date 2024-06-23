<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>
<body>


<form class="col-4 p-3" action="registrar_director.php" method="POST">
    <h3 class="text-center text-secondary">Registro de músicos</h3>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido" required>
    </div>

    <div class="mb-3">
        <label for="numero_conciertos" class="form-label">Numero de conciertos</label>
        <input type="number" class="form-control" id="numero_conciertos" name="numero_conciertos" required>
    </div>
   
    <button type="submit" class="btn btn-primary">Registrar Músico</button>
</form>








    
</body>
</html>