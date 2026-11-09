<?php
    include_once './componentes/tema.php';
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

    <title>Document</title>
</head>
<body>
    <?php
        include_once './componentes/nav.php';
        require_once './acciones/conexion.php';
        
        $sql = "SELECT * FROM `productos`";
        $resultado = mysqli_query($conexion, $sql);

        while ($fila = mysqli_fetch_assoc($resultado)) {
            ?>
                <p>
                <?php
                    echo "id: " . $fila['id_producto'] . ", nombre: " . $fila['nombre'];
                ?> </p>
            <?php
        }

        mysqli_free_result($resultado);
        mysqli_close($conexion);
    ?>
    <main>
        <img src="./recursos/Vera_Benitez_Sebastian_ACN1BV_TP1.jpg" alt="Banner Bullpader" class="w-100 d-none d-md-block">
        <img src="./recursos/Vera_Benitez_Sebastian_ACN1BV_TP1_mobile.jpg" alt="Banner Mobile Bullpader" class="w-100 d-md-none">
        <img src="./recursos/palaHorizontal.png" alt="Pala Bullpader" class="w-100">
    </main>
    <?php
        include_once './componentes/footer.php'
    ?>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>