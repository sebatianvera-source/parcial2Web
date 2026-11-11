<?php
    $base = '/26-ACN2BV-veraBenitez-sebastian-parcial2/';

    function obtenerProductosDestacados($conexion) {
        $sql = "SELECT
                p.id_producto,
                p.nombre,
                p.precio,
                i.ruta AS imagen,
                i.alt AS imagen_alt
            FROM productos p
            LEFT JOIN imagenes_producto i
                ON i.id_producto = p.id_producto
                AND i.orden = 1
            WHERE p.destacado = 1
                AND p.activo = 1
                LIMIT 4
            ";
        $resultado = mysqli_query($conexion, $sql);
        return $resultado;
    }

    function obtenerProductosFiltrados($conexion, $idCategoria, $precioMin, $precioMax, $orden, $nombreProducto) {
        $sql = "SELECT
                    p.id_producto,
                    p.nombre,
                    p.precio,
                    i.ruta AS imagen,
                    i.alt AS imagen_alt
                FROM productos p
                LEFT JOIN imagenes_producto i
                    ON i.id_producto = p.id_producto
                AND i.orden = 1
                WHERE p.activo = 1
                AND (? = 0 OR p.id_categoria = ?)
                AND (? = 0 OR p.precio >= ?)
                AND (? = 0 OR p.precio <= ?)
                AND (? = '' OR p.nombre LIKE ?)
                ORDER BY
                    CASE WHEN ? = 'desc' THEN p.precio END DESC,
                    CASE WHEN ? = 'asc' THEN p.precio END";

        $stmt = mysqli_prepare($conexion, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            'iiddddssss',
            $idCategoria, $idCategoria,
            $precioMin, $precioMin,
            $precioMax, $precioMax,
            $nombreProducto, $nombreProducto,
            $orden, $orden,
        );

        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        return $resultado;
    }

    function obtenerCategorias($conexion) {
        $sql = "SELECT * FROM categorias";
        $resultado = mysqli_query($conexion, $sql);
        return $resultado;
    }
?>