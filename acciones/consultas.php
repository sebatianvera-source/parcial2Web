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
                WHERE (? = 0 OR p.id_categoria = ?)
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

    function obtenerProductos($conexion) {
        $sql = "SELECT p.*, i.ruta AS ruta, i.alt AS alt, c.nombre AS categoria
            FROM productos p
            LEFT JOIN imagenes_producto i
                ON i.id_producto = p.id_producto
                AND i.orden = 1
            LEFT JOIN categorias c
                ON c.id_categoria = p.id_categoria";
            
        $resultado = mysqli_query($conexion, $sql);
        return $resultado;
    }

    function obtenerProductoPorId($conexion, $id) {
        $sql = "SELECT p.*, i.ruta AS ruta, i.alt AS alt
            FROM productos p
            LEFT JOIN imagenes_producto i
                ON i.id_producto = p.id_producto
                AND i.orden = 1
            WHERE p.id_producto = ?";
        
        $stmt = mysqli_prepare($conexion, $sql);

        mysqli_stmt_bind_param($stmt, 'i', $id);

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

    function deleteProductos($conexion, $id) {
        $sql = "DELETE FROM productos WHERE p.id_productos = ?";

        $stmt = mysqli_prepare($conexion, $sql);

        mysqli_stmt_bind_param($stmt, 'i', $id);

        return mysqli_stmt_execute($stmt);
    }
?>