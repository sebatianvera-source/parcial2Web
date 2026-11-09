<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $baseDeDatos = "storeDB";
    $puerto = "3306";

    $conexion = mysqli_connect($host, $user, $pass, $baseDeDatos, $puerto);

    if (!$conexion) {
        die("Error al conectar..." . mysqli_connect_error());
    }
?>