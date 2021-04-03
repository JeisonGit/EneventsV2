<?php 
    
    // RECUPERO CUAL ES EL DEPARTAMENTO SELECCIONADO
    $Departamento = filter_input(INPUT_POST, 'Departamento');

    // VALIDO QUE EL DEPARTAMENTO SI HAYA SIDO SELECCIONADO
    if($Departamento == null || $Departamento == ''){
        print   "<script>
                    alert('ERROR: Verifiqué e intente nuevamente.');
                    location.href = 'index.php';
                </script>";
        die();        
    }

    // VALIDO QUE NO ESTE VACIO
    if($Departamento != ''){

        // ABRO CONEXION BD
        require_once('includes/conexion.php');

        // CONSULTA BD -> MUNICIPIOS QUE PERTENEZCAN AL DEPARTAMENTO QUE SE SELECCIONO
        $sql = "SELECT Codigo, Nombre FROM tblciudad WHERE Departamento = ".$Departamento;
        $query = mysqli_query($conn, $sql);
        $filasciu = mysqli_fetch_all($query, MYSQLI_ASSOC);

        // CIERRO CONEXION BD
        mysqli_close($conn);
        
    }
    else{
        header('Location:../index.php');
    }
?>

<!-- RELLENO EL SELECT DE CIUDAD CON EL RESULTADO DE LA CONSULTA -->
<option value="">- Seleccione -</option>
<?php foreach($filasciu as $op): ?>
<option value="<?= $op['Codigo'] ?>"><?= $op['Nombre'] ?></option>
<?php endforeach; ?>