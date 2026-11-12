<?php
    include_once '../../componentes/tema.php';

    require_once '../../acciones/conexion.php';
    require_once '../../acciones/consultas.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        eliminarProducto($conexion, (int) $_POST['id']);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    $productos = obtenerProductos($conexion);
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
    <title>Panel de Administrador</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php
        include_once '../../componentes/nav.php'
    ?>
    <main class="flex-grow-1">

        <div class="d-flex justify-content-between my-5 mx-3">
            <h2>Panel de Administrador</h2>

            <button type="button" class="btn btn-success">
                <div class="d-flex">
                    <span class="material-symbols-outlined me-2">add</span>
                    <span>Agregar Nuevo</span>
                </div>
            </button>
        </div>


        <div class="mx-3">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($producto = mysqli_fetch_assoc($productos)) {
                        ?>
                        <tr>
                            <th scope="row">
                                <div>
                                    <img
                                        class="img-fluid"
                                        src="<?= htmlspecialchars($base . $producto['ruta']) ?>"
                                        alt="<?= htmlspecialchars($producto['alt']) ?>"
                                    >
                                </div>
                            </th>
                            <td><?= htmlspecialchars($producto['nombre']) ?></td>
                            <td><?= htmlspecialchars($producto['categoria'] ?? 'Sin categoría') ?></td>
                            <td>$<?= number_format($producto['precio'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($producto['descripcion'] ?? '--') ?></td>
                            <td>
                                <div class="d-flex gap-3">
                                    <a href="../editar-producto/editar-producto.php">
                                        <button type="button" class="btn btn-primary">
                                            <div class="d-flex">
                                                <span class="material-symbols-outlined me-2">edit</span>
                                                <span>Editar</span>
                                            </div>                                            
                                        </button>
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $producto['id_producto'] ?>">
                                        <div class="d-flex">
                                            <span class="material-symbols-outlined me-2">delete</span>
                                            <span>Eliminar</span>
                                        </div>
                                    </button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal-<?= $producto['id_producto'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Eliminar Produto</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <span>¿Desea eliminar el producto <strong><?= htmlspecialchars($producto['nombre']) ?></strong>?</span>
                                                    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
            </table>
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