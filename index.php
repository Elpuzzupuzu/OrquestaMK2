<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indice de tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('./imgs/titleimageBLOG.jpg'); /* Ruta de tu imagen de fondo */
            background-size: cover; /* Ajusta la imagen para cubrir todo el fondo */
            background-position: center; /* Centra la imagen en el fondo */
        }
        h1 {
            text-align: center;
            color: #343a40;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 15px 0; /* Aumenta el margen para mayor separación */
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-size: 1.2em;
            padding: 12px 25px; /* Aumenta el padding para más espacio */
            border: 2px solid #007bff;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            display: inline-block; /* Asegura que el padding se aplique correctamente */
        }
        a:hover {
            background-color: #007bff;
            color: #fff;
        }
        .container {
            background: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente blanco para el contenido */
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Tareas</h1>
        <ul>
            <li><a href="lista_musicos.php" target="_blank">Lista de Músicos</a></li>
            <li><a href="lista_directores.php" target="_blank">Lista de Directores</a></li>
            <li><a href="form_musico.php" target="_blank">Registrar Músico</a></li>
            <li><a href="form_director.php" target="_blank">Registrar Director</a></li>
            <li><a href="form_buscar_por_id.php" target="_blank">Búsqueda por ID</a></li>
            <li><a href="mostrar_auditoria.php" target="_blank">Auditoria</a></li>
        </ul>
    </div>
</body>
</html>
