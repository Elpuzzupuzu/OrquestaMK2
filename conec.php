<?php
$conection = new mysqli("localhost", "root", "1234", "orquesta");
if ($conection->connect_error) {
    die("Error de conexión: " . $conection->connect_error);
}
$conection->set_charset("utf8");
?>
