<?php
    $base = '/26-ACN2BV-veraBenitez-sebastian-parcial2/';

    function obtenerProductosDestacados($conexion) {
        $sql = "SELECT
                `p`.`id_producto`,
                `p`.`nombre`,
                `p`.`precio`,
                `i`.`ruta` AS `imagen`,
                `i`.`alt` AS `imagen_alt`
            FROM `productos` `p`
            LEFT JOIN imagenes_producto i
                ON `i`.`id_producto` = `p`.`id_producto`
                AND `i`.`orden` = 1
            WHERE `p`.`destacado` = 1
                AND `p`.`activo` = 1
                LIMIT 4
            ";
        $resultado = mysqli_query($conexion, $sql);
        return $resultado;
    }

    function obtenerProductosActivos($conexion) {
        $sql = "SELECT
                `p`.`id_producto`,
                `p`.`nombre`,
                `p`.`precio`,
                `i`.`ruta` AS `imagen`,
                `i`.`alt` AS `imagen_alt`
            FROM `productos` `p`
            LEFT JOIN imagenes_producto i
                ON `i`.`id_producto` = `p`.`id_producto`
                AND `i`.`orden` = 1
            WHERE `p`.`activo` = 1";
        $resultado = mysqli_query($conexion, $sql);
        return $resultado;
    }

    function obtenerCategorias($conexion) {
        $sql = "SELECT * FROM `categorias`";
        $resultado = mysqli_query($conexion, $sql);
        return $resultado;
    }
?>