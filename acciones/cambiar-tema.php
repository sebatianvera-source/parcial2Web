<?php
    $temaActual = $_COOKIE['tema'] ?? 'light';
    $nuevoTema = $temaActual === 'dark' ? 'light' : 'dark';

    setcookie('tema', $nuevoTema, [
        'expires'   => time() + (30 * 24 * 60 * 60),
        'path'      => '/',
        'domain'    => '',
        'secure'    => true,
        'httponly'  => true,
        'samesite'  => 'Strict',
    ]);

    // Volver a la página desde donde se tocó el botón
    $volver = $_POST['volver'] ?? '/26-ACN2BV-veraBenitez-sebastian-parcial2/index.php';

    // Solo permitir rutas internas (evita redirigir a otro sitio)
    if (!str_starts_with($volver, '/') || str_starts_with($volver, '//')) {
        $volver = '/26-ACN2BV-veraBenitez-sebastian-parcial2/index.php';
    }

    header('Location: ' . $volver);
    exit;
?>