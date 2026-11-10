<?php
    include_once './componentes/tema.php';

    $base = '/26-ACN2BV-veraBenitez-sebastian-parcial2/';
    require_once './acciones/conexion.php';

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
                LIMIT 12
            ";
    $resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="<?= $tema ?>">
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
    <link rel="stylesheet" href="./styles.css">

    <title>Bullpadel Argentina</title>
</head>
<body>
    <?php
        include_once './componentes/nav.php';
    ?>
    <main>
        <div>
            <div>
                <img src="./recursos/Vera_Benitez_Sebastian_ACN1BV_TP1.jpg" alt="Banner Bullpader" class="w-100 d-none d-md-block">
                <img src="./recursos/Vera_Benitez_Sebastian_ACN1BV_TP1_mobile.jpg" alt="Banner Mobile Bullpader" class="w-100 d-md-none">
            </div>
            <section class="mx-4 my-5">
                <h2 class="my-5">Recomendaciones</h2>

                <div>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                        <?php
                            while ($producto = mysqli_fetch_assoc($resultado)) {
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
                </div>
            </section>
            <div>
                <img src="./recursos/palaHorizontal.png" alt="Pala Bullpader" class="w-100">
            </div>
            <section class="mx-4 my-5">
                <h2 class="my-5">Nuestros Jugadores</h2>

                <article>
                    <div class="row g-4 align-items-start">
                        <div class="col-12 col-md-3 col-lg-2 text-center text-md-start">
                            <img src="./recursos/chingotto.jpg" alt="Jugador Federico Chingotto">
                        </div>
                        <div class="col-12 col-md-3 col-lg-2 text-center text-md-start">
                            <h3>Fede Chingotto</h3>
                            <p>Fede Chingotto es uno de los referentes más destacados del pádel mundial y un orgullo para Argentina. Reconocido por su inteligencia táctica, velocidad y capacidad defensiva, se ha consolidado entre los mejores jugadores del circuito profesional gracias a su esfuerzo, disciplina y pasión por el deporte.
Como integrante del Team Bullpadel, Fede confía en la innovación y la calidad de los productos de la marca para competir al más alto nivel. Su estilo de juego, basado en la precisión y el control, representa los valores que impulsan a Bullpadel a desarrollar equipamiento de excelencia para jugadores de todas las categorías.</p>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </main>
    <?php
        include_once './componentes/footer.php'
    ?>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>

<?php
    mysqli_free_result($resultado);
    mysqli_close($conexion);
?>