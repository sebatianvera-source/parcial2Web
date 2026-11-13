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

    function eliminarProducto($conexion, $id) {
        $sql = "DELETE FROM productos WHERE id_producto = ?";

        $stmt = mysqli_prepare($conexion, $sql);

        mysqli_stmt_bind_param($stmt, 'i', $id);

        return mysqli_stmt_execute($stmt);
    }

    function actualizarProducto($conexion, $id_producto, $nombre, $precio, $descripcion, $id_categoria, $destacado, $rutaImg, $altImg) {
        $sql = "UPDATE productos
            SET nombre = ?, precio = ?, descripcion = ?, id_categoria = ?, destacado = ?
            WHERE id_producto = ?";

        $stmt = mysqli_prepare($conexion, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            'sdsiii', 
            $nombre,
            $precio,
            $descripcion,
            $id_categoria,
            $destacado,
            $id_producto
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sql ="UPDATE imagenes_producto
            SET ruta = ?, alt = ?
            WHERE id_producto = ?
            AND orden = 1";

        $stmt = mysqli_prepare($conexion, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            'ssi',
            $rutaImg,
            $altImg,
            $id_producto
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    function ingresarProductos($conexion, $nombre, $precio, $descripcion, $id_categoria, $destacado, $ruta, $alt) {
        $sql = "INSERT INTO productos
            (nombre, precio, descripcion, id_categoria, destacado)
            VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            'sdsii', 
            $nombre,
            $precio,
            $descripcion,
            $id_categoria,
            $destacado,
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $id_producto = mysqli_insert_id($conexion);

        $sql = "INSERT INTO imagenes_producto
            (id_producto, ruta, alt, orden)
            VALUE (?, ?, ?, 1)";
        
        $stmt = mysqli_prepare($conexion, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            'iss',
            $id_producto,
            $ruta,
            $alt
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
?>