<?php 

    // OCULTA LOS ERRORES, DE MODO QUE EL USUARIO NO PUEDA APORVECHARSE DE ELLOS
    error_reporting(0);


    // TRAIGO EL ID MEDIANTE LA VARIABLE SESION
    session_start(); 
    $idAdmin = $_SESSION['id'];

    // VALIDO QUE EL USUARIO SI HAYA INICIADO SESION DE FORMA LEGITIMA
    if($idAdmin == null || $idAdmin == ''){
        print   "<script>
                    alert('DEBES INICIAR SESIÓN PRIMERO');
                    location.href = '../iniciarSesion.php';
                </script>";
        die();        
    }

    // OCULTA LOS ERRORES, DE MODO QUE EL USUARIO NO PUEDA APORVECHARSE DE ELLOS
    error_reporting(0);


    // TRAIGO EL ID MEDIANTE LA VARIABLE SESION
    session_start(); 
    $id = $_SESSION['id'];


    // VALIDO QUE EL USUARIO SI HAYA INICIADO SESION DE FORMA LEGITIMA
    if($id == null || $id == ''){
        print   "<script>
                    alert('DEBES INICIAR SESIÓN PRIMERO');
                    location.href = '../iniciarSesion.php';
                </script>";
        die();        
    }


    // OBTENGO CUAL FUE EL DEPARTAMENTO QUE SE SELECCIONO EN EL FORMULARIO
    $Departamento = filter_input(INPUT_POST, 'Departamento');


    // VALIDO QUE EL DATO DEL DEPARTAMENTO NO ESTE VACIO
    if($Departamento != ''){


        // ABRO CONEXION BD
        require_once('../includes/conexion.php');

        
        // VALIDO QUE EXISTA CONEXION CON LA BD
        if(!$conn){
            die("<br/>Sin Conexion.");
        }
  

        // CONSULTA BD -> SELECCIONAR TODOS LOS MUNICIPIOS/CIUDADES QUE PERTENEZCAN AL DEPARTAMENTO SELECCIONADO. GUARDO LOS DATOS EN UN ARRAY
        $sql = "SELECT Codigo, Nombre FROM tblciudad WHERE Departamento = ".$Departamento;
        $query = mysqli_query($conn, $sql);
        $filasciu = mysqli_fetch_all($query, MYSQLI_ASSOC);


        // CIERRO CONEXION BD
        mysqli_close($conn);

    }
?>

<!-- RELLENO EL SELECT DE MUNICIPIOS/CIUDADES CON LOS RESULTADOS DE LA CONSULTA, LOS CUALES ESTAN EN EL ARRAY -->
<option value="">- Seleccione -</option>
<?php foreach($filasciu as $op): ?>
<option value="<?= print $op['Codigo'] ?>"><?= $op['Nombre'] ?></option>
<?php endforeach; ?>