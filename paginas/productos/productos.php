<?php
    include_once '../../componentes/tema.php';

    require_once '../../acciones/conexion.php';
    require_once '../../acciones/consultas.php';

    $productosDestacados = obtenerProductosDestacados($conexion);
    $productosActivos = obtenerProductosActivos($conexion);
    $categorias = obtenerCategorias($conexion);
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="<?= $tema ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Google Icons -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"
    >
    
    <!-- Estilos propios -->
    <link rel="stylesheet" href="../../styles.css">

    <title>Productos</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php
        include_once '../../componentes/nav.php'
    ?>
    <main class="flex-grow-1">
        <div>
            <section class="my-5">
                <div class="p-3 m-3 containerForm">
                    <form action="">
                        <div class="d-flex align-items-center">
                            <div class="d-flex justify-content-around align-items-center w-75">
                                <div class="w-100 p-3">
                                    <div class="d-flex flex-row">
                                        <div class="me-3">
                                            <label for="precioInicial" class="form-label">Precio Desde</label>
                                            <input type="number" class="form-control" id="precioInicial">
                                        </div>
                                        <div>
                                            <label for="precioFinal" class="form-label">Precio Hasta</label>
                                            <input type="number" class="form-control" id="precioFinal">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 p-3">
                                    <p class="form-label">Categoria</p>

                                    <select class="form-select" aria-label="categorias" name="categorias">
                                        <option selected disabled hidden>Seleccionar</option>
                                        <?php
                                            while ($categoria = mysqli_fetch_assoc($categorias)) {
                                        ?>
                                                <option value="<?= $categoria['id_categoria'] ?>">
                                                    <?= htmlspecialchars($categoria['nombre']) ?>
                                                </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="w-100 p-3">
                                    <p class="form-label">Ordenar</p>
                                    <div>
                                        <select class="form-select" aria-label="ordenamiento" name="ordenar">
                                            <option selected disabled hidden>Seleccionar</option>
                                            <option value="1">Menor precio</option>
                                            <option value="2">Mayor precio</option>
            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end w-25">
                                <button type="submit" class="btn btnNaranja btn-lg w-75">Filtrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="mx-4 my-5">
                <h2 class="my-5">Productos</h2>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                    <?php
                        while ($productoActivo = mysqli_fetch_assoc($productosActivos)) {
                            ?>
                            <div class="producto-card">
                                <a
                                    href="<?= $base ?>paginas/productos/producto.php?id=<?= (int) $productoActivo['id_producto'] ?>"
                                >
                                    <div class="producto-card-media">
                                        <img
                                            src="<?= htmlspecialchars($base . $productoActivo['imagen']) ?>"
                                            alt="<?= htmlspecialchars($productoActivo['imagen_alt']) ?>"
                                        >
                                    </div>
                                    <h3 class="producto-card-nombre"><?= htmlspecialchars($productoActivo['nombre']) ?></h3>
                                    <p class="producto-card-precio">$<?= number_format($productoActivo['precio'], 0, ',', '.') ?></p>
                                </a>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </section>
            <section class="mx-4 my-5">
                <h2 class="my-5">Recomendaciones</h2>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                    <?php
                        while ($producto = mysqli_fetch_assoc($productosDestacados)) {
                            ?>
                            <div class="producto-card">
                                <a
                                    href="<?= $base ?>paginas/productos/producto.php?id=<?= (int) $producto['id_producto'] ?>"
                                >
                                    <div class="producto-card-media">
                                        <img
                                            src="<?= htmlspecialchars($base . $producto['imagen']) ?>"
                                            alt="<?= htmlspecialchars($producto['imagen_alt']) ?>"
                                        >
                                    </div>
                                    <h3 class="producto-card-nombre"><?= htmlspecialchars($producto['nombre']) ?></h3>
                                    <p class="producto-card-precio">$<?= number_format($producto['precio'], 0, ',', '.') ?></p>
                                </a>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </section>
        </div>
    </main>
    <?php
        include_once '../../componentes/footer.php'
    ?>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>

<?php
    mysqli_free_result($productosDestacados);
    mysqli_free_result($productosActivos);
    mysqli_free_result($categorias);
    mysqli_close($conexion);
?>