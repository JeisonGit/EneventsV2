<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "eventos";

    //Creo la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset($conn,"utf8");

    //Reviso la conexion
    if($conn->connect_error){
        die("Conexion exitosa: " . $conn->connect_error);
    }
?>