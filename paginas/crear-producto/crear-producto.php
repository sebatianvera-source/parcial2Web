<?php
    include_once '../../componentes/tema.php';

    require_once '../../acciones/conexion.php';
    require_once '../../acciones/consultas.php';

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
    <title>Creación Producto</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php
        include_once '../../componentes/nav.php'
    ?>
    <main class="flex-grow-1">
        <div class="d-flex flex-column justify-content-center containerForm p-3 mx-3 mt-5">
            <h2 class="text-center mb-5">Crear Producto</h2>
    
            <form action="">
                <div class="d-flex gap-3">
                    <div class="mb-3 w-100">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                    </div>
                    <div class="mb-3 w-100">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio" placeholder="Precio">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <textarea type="text" class="form-control" id="descripcion" placeholder="Descripcion"></textarea>
                </div>
                <div class="d-flex gap-3">
                    <div class="mb-3 w-100">
                        <label for="ruta" class="form-label">Ruta Imagen</label>
                        <input type="text" class="form-control" id="ruta" placeholder="Ruta Imagen">
                    </div>
                    <div class="mb-3 w-100">
                        <label for="altImg" class="form-label">Alt Imagen</label>
                        <input type="text" class="form-control" id="altImg" placeholder="Alt Imagen">
                    </div>
                </div>
                <div class="d-flex gap-3 mb-5">
                    <div class="w-100">
                        <label for="nombre" class="form-label">Categoría</label>
    
                        <select class="form-select" aria-label="categorias" id="categorias" name="categorias">
                            <option selected disabled hidden>Seleccionar</option>
                            <?php
                                while ($categoria = mysqli_fetch_assoc($categorias)) {
                            ?>
                                    <option value="<?= $categoria['id_categoria'] ?>" >
                                        <?= htmlspecialchars($categoria['nombre']) ?>
                                    </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="w-100">
                        <p class="form-label">Destacado</p>
                        <div>
                            <select class="form-select" aria-label="ordenamiento" id="ordenar" name="ordenar">
                                <option selected disabled hidden>Seleccionar</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
    
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
                        <button type="submit" class="btn btnNaranja btn-lg w-100">Crear</button>
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