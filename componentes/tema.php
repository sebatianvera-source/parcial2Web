<?php
    $tema = $_COOKIE['tema'] ?? 'light';

    if ($tema !== 'light' && $tema !== 'dark') {
        $tema = 'light';
    }
?>