<?php
    include_once '../../componentes/tema.php';

    require_once '../../acciones/conexion.php';
    require_once '../../acciones/consultas.php';

    $id = trim($_GET['id'] ?? '');

    if (empty($id) || !ctype_digit($id)) {
        header('Location: ../panel-de-administrador/panel-de-administrador.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim($_POST['nombre'] ?? '');
    
        $precioPost = trim($_POST['precio'] ?? '');
        if (!empty($precioPost)) {
            if (is_numeric($precioPost) && $precioPost >= 0) {
                $precio = (float) $precioPost;
            }
        }
    
        $descripcion = trim($_POST['descripcion'] ?? '');
        
        $rutaImg = trim($_POST['ruta'] ?? '');
        
        $altImg = trim($_POST['alt'] ?? '');
    
        $categoriaPost = trim($_POST['categoria'] ?? '');
        if (!empty($categoriaPost)) {
            if (ctype_digit($categoriaPost)) {
                $idCategoria = (int) $categoriaPost;
            }
        }
    
        $destacadoPost = trim($_POST['destacado'] ?? '');
        if ($destacadoPost === '0' || $destacadoPost === '1') {
            $destacado = (int) $destacadoPost;
        }
    
        actualizarProducto(
            $conexion,
            $id,
            $nombre,
            $precio,
            $descripcion === '' ? null : $descripcion,
            $idCategoria,
            $destacado,
            $rutaImg,
            $altImg
        );

        header('Location: ../panel-de-administrador/panel-de-administrador.php');
        exit;
    } else {
        $productoResult = obtenerProductoPorId($conexion, (int) $id);
        $producto = mysqli_fetch_assoc($productoResult);
        mysqli_free_result($productoResult);

        if (!$producto) {
            header('Location: ../panel-de-administrador/panel-de-administrador.php');
            exit;
        }
        
        $nombre = trim($producto['nombre'] ?? '');

        $precioGet = trim($producto['precio'] ?? '');
        if (!empty($precioGet)) {
            if (is_numeric($precioGet) && $precioGet >= 0) {
                $precio = $precioGet;
            }
        }

        $descripcion = trim($producto['descripcion'] ?? '');
        
        $rutaImg = trim($producto['ruta'] ?? '');
        
        $altImg = trim($producto['altImg'] ?? '');

        $categoriaGet = trim($producto['id_categoria'] ?? '');
        if (!empty($categoriaGet)) {
            if (ctype_digit($categoriaGet)) {
                $idCategoria = (int) $categoriaGet;
            }
        }

        $destacadoPost = trim($producto['destacado'] ?? '');
        if ($destacadoPost === '0' || $destacadoPost === '1') {
            $destacado = (int) $destacadoPost;
        }
    }

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
    <title>Edición Producto</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php
        include_once '../../componentes/nav.php'
    ?>
    <main class="flex-grow-1">
        <div class="d-flex flex-column justify-content-center containerForm p-3 mx-3 mt-5">
            <h2 class="text-center mb-5">Editar Producto</h2>
    
            <form method="POST">
                <div class="d-flex gap-3">
                    <div class="mb-3 w-100">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            required
                            placeholder="Nombre"
                            value="<?= htmlspecialchars($nombre) ?>"
                        >
                    </div>
                    <div class="mb-3 w-100">
                        <label for="precio" class="form-label">Precio</label>
                        <input
                            type="number"
                            class="form-control"
                            id="precio"
                            name="precio"
                            required
                            placeholder="Precio"
                            step="0.01"
                            value="<?= htmlspecialchars($precio) ?>"
                        >
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <textarea
                        class="form-control"
                        id="descripcion"
                        name="descripcion"
                        placeholder="Descripcion"
                    ><?= htmlspecialchars($descripcion) ?></textarea>
                </div>
                <div class="d-flex gap-3">
                    <div class="mb-3 w-100">
                        <label for="ruta" class="form-label">Ruta Imagen</label>
                        <input
                            type="text"
                            class="form-control"
                            id="ruta"
                            name="ruta"
                            required
                            placeholder="Ruta Imagen"
                            value="<?= htmlspecialchars($rutaImg) ?>"
                        >
                    </div>
                    <div class="mb-3 w-100">
                        <label for="altImg" class="form-label">Alt Imagen</label>
                        <input
                            type="text"
                            class="form-control"
                            id="altImg"
                            name="altImg"
                            required
                            placeholder="Alt Imagen"
                            value="<?= htmlspecialchars($altImg) ?>"
                        >
                    </div>
                </div>
                <div class="d-flex gap-3 mb-5">
                    <div class="w-100">
                        <label for="categoria" class="form-label">Categoría</label>
    
                        <select class="form-select" aria-label="categoria" id="categoria" name="categoria">
                            <option selected disabled hidden>Seleccionar</option>
                            <?php
                                while ($categoria = mysqli_fetch_assoc($categorias)) {
                            ?>
                                    <option
                                        value="<?= htmlspecialchars($categoria['id_categoria']) ?>"
                                        <?= (int) $categoria['id_categoria'] === $idCategoria ? 'selected' : '' ?>
                                    >
                                        <?= htmlspecialchars($categoria['nombre']) ?>
                                    </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="w-100">
                        <label for="destacado" class="form-label">Destacado</label>
                        <div>
                            <select class="form-select" aria-label="destacado" id="destacado" name="destacado">
                                <option selected disabled hidden>Seleccionar</option>
                                <option value="1" <?= $destacado === 1 ? 'selected' : '' ?> >Si</option>
                                <option value="0" <?= $destacado === 0 ? 'selected' : '' ?> >No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <div class="w-25">
                        <a href="../panel-de-administrador/panel-de-administrador.php" class="btn btnNaranja btn-lg w-100">
                            Cancelar
                        </a>
                    </div>
                    <div class="w-25">
                        <button type="submit" class="btn btnNaranja btn-lg w-100">Editar</button>
                    </div>
                </div>
            </form>
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
    mysqli_free_result($categorias);
    mysqli_close($conexion);
?>