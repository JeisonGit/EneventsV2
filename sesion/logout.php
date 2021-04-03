<?php

    // ABRO SESION
    session_start();

    // DESTRUYO LA SESION
    session_destroy();

    // REDIRECCIONO AL LOGIN
    header('Location:../iniciarSesion.php');
?>