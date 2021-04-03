<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    $seleccion = $_POST['r'];

    if($seleccion == "r1"){

        // REPORTE 1
        // Los 10 eventos que obtuvieron mayor ganancia bruta.

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteAdminEventosMayorGananciaBruta()");

        mysqli_close($conn);

    }
    else if($seleccion == "r2"){

        // REPORTE 2
        // Los 10 eventos que fueron más costosos operacionalmente.
        
        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteAdminEventosMayorCostoOperacional()");

        mysqli_close($conn);

    }
    else if($seleccion == "r3"){

        // REPORTE 3
        // Los 10 eventos que obtuvieron mayores ingresos secundarios.

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteAdminEventosMayorIngresosSecundarios()");

        mysqli_close($conn);

    }
    elseif($seleccion == "r4"){

        // REPORTE 4
        // Ganancia Bruta por cada categoría de evento.

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteAdminGananciaBrutaCategoria()");

        mysqli_close($conn);
        
    }
    elseif($seleccion == "r5"){

        // REPORTE 5
        // Ganancia Bruta por cada área de trabajo.

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteAdminGananciaBrutaAreaTrabajo()");

        mysqli_close($conn);
        
    }
    elseif($seleccion == "r6"){

        // REPORTE 6
        // Ganancia Bruta Total obtenida por cada evento realizado.

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteAdminGananciaBrutaTotalEvento()");

        mysqli_close($conn);
        
    }
    elseif($seleccion == "r7"){
        
        // REPORTE 7
        // Asistencia Total por cada categoría de evento.

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteAdminAsistenciaTotalCategoria()");

        mysqli_close($conn);
        
    }
    elseif($seleccion == "r8"){

        // REPORTE 8
        // Eventos que tuvieron una asistencia mayor o igual a ___ (parametros - POST)

        include('../includes/conexion.php');

            $asistenciaMayor = $_POST['asistenciaMayor'];
            $reporte = $conn -> query("CALL sp_ReporteAdminEventoAsistenciaMayorIgualX('$asistenciaMayor')");

        mysqli_close($conn);
        
    }
    elseif($seleccion == "r9"){

        // REPORTE 9
        // Eventos que fueron realizados o se llevaran a cabo entre las fechas ___ (parametros - POST)

        $fechaAntigua = $_POST['fechaAntigua'];
        $fechaReciente = $_POST['fechaReciente'];

        if($fechaAntigua > $fechaReciente){
            print   "<script>
                        alert('La Fecha Antigua debe ser menor a la Fecha Reciente.');
                        location.href = 'reportesAdmin.php';
                    </script>";
        }
        else{
            include('../includes/conexion.php');

                $reporte = $conn -> query("CALL sp_ReporteAdminEventosFechas('$fechaAntigua','$fechaReciente')");

            mysqli_close($conn);
        }    
    }
    else{
        print   "<script>
                    alert('Debe seleccionar primero un reporte.');
                    location.href = 'reportesAdmin.php';
                </script>";
    }

?>

<?php include('includes/headerAdmin.php') ?>

    <section class="bg-grey">
        <div class="container">
            <input type="button" value="Atrás" class="btn btn-menu mt-3" onClick="history.go(-1);">
            <div class="row">
                <div class="col-lg-12 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte</h6>
                        </div>
                        <div class="card-body">

                        <!-- Dependiendo de la opcion seleccionada de los diferentes reportes, se mostrara la información correspondiente -->

                            <div class="table-responsive">

                                <!-- REPORTE 1 -->
                                <div class="container">
                                    <?php 
                                        if($seleccion == "r1"){
                                        
                                    ?>
                                    <p>1. Los 10 eventos que obtuvieron mayor <b class="font-weight-bold">Ganancia Bruta</b>.</p>
                                    <table class="table table-striped table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">Evento</th>
                                                <th scope="col">Ganancia Bruta</th>
                                                <th scope="col">Usuario</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    $fila['gananciaBruta'] = number_format($fila['gananciaBruta']);
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php print $fila['Nombre'] ?> 
                                                </td>
                                                <td>
                                                    <?php print "$".$fila['gananciaBruta'] ?> 
                                                </td>
                                                <td>
                                                    <?php print $fila['Nombres']?> 
                                                </td>
                                                <td>
                                                    <a href="selectInfoResultado.php?cod=<?php print $fila['Codigo'] ?>" class="btn btn-info">Visualizar</a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>    
                                </div>
                                <!-- FIN REPORTE 1 -->
                                

                                <!-- REPORTE 2 -->
                                <div class="container">
                                    <?php
                                        }   
                                        else if($seleccion == "r2"){
                                        
                                    ?>
                                    <p>2. Los 10 eventos que fueron más <b class="font-weight-bold">Costosos Operacionalmente</b>.</p>
                                    <table class="table table-striped table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">Evento</th>
                                                <th scope="col">Costos Operacionales</th>
                                                <th scope="col">Usuario</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    $fila['Costo'] = number_format($fila['Costo']);
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Nombre'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['Costo'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['Nombres']?> 
                                                </td>
                                                <td>
                                                    <a href="selectInfoResultado.php?cod=<?php print $fila['Codigo'] ?>" class="btn btn-info">Visualizar</a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- FIN REPORTE 2 -->


                                <!-- REPORTE 3 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r3"){
                                            
                                    ?>
                                    <p>3. Los 10 eventos que obtuvieron mayores <b class="font-weight-bold">Ingresos Adicionales</b>.</p>
                                    <table class="table table-striped table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">Evento</th>
                                                <th scope="col">Ingresos Adicionales</th>
                                                <th scope="col">Usuario</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    $fila['IngresosAdicionales'] = number_format($fila['IngresosAdicionales']);
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Nombre'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['IngresosAdicionales'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['Nombres']?> 
                                                </td>
                                                <td>
                                                    <a href="selectInfoResultado.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-info">Visualizar</a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- FIN REPORTES 3 -->


                                <!-- REPORTE 4 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r4"){
                                            
                                    ?>
                                    <table class="table table-striped table-bordered table-hover text-center">
                                    <p>4.<b class="font-weight-bold"> Ganancia Bruta Total</b> obtenida por cada categoría de evento.</p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Categoría del Evento</th>
                                                <th scope="col">Ganancia Bruta</th>
                                                <th scope="col">Número de Eventos Realizados</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    $fila['gananciaBruta'] = number_format($fila['gananciaBruta']);
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Categoria'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['gananciaBruta'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['CantidadEventos'] ?> 
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- FIN REPORTES 4 -->
                                
                                
                                <!-- REPORTE 5 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r5"){
                                            
                                    ?>
                                    <table class="table table-striped table-bordered table-hover text-center">
                                    <p>5.<b class="font-weight-bold"> Ganancia Bruta Total</b> obtenida por cada área de trabajo.</p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Área De Trabajo</th>
                                                <th scope="col">Ganancia Bruta</th>
                                                <th scope="col">Número de Eventos Realizados</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    $fila['gananciaBruta'] = number_format($fila['gananciaBruta']);
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['areaTrabajo'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['gananciaBruta'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['CantidadEventos'] ?> 
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- FIN REPORTE 5 -->


                                <!-- REPORTE 6 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r6"){
                                            
                                    ?>
                                    <table id="tablas-eventos" class="table table-striped table-bordered table-hover text-center">
                                    <p>6.<b class="font-weight-bold"> Ganancia Bruta Total</b> obtenida por cada evento realizado.</p>
                                        <thead>
                                            <tr>    
                                                <th scope="col">Evento</th>
                                                <th scope="col">Categoría</th>
                                                <th scope="col">Ganancia Bruta</th>
                                                <th scope="col">Número de Veces que se ha Realizado </th>
                                                <th scope="col">Usuario</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    $fila['gananciaBruta'] = number_format($fila['gananciaBruta']);
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $fila['Nombre'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila['Categoria'] ?>
                                                </td>
                                                <td>
                                                    <?php echo "$".$fila['gananciaBruta'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila['CantidadRealizado'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila['Nombres'] ?>
                                                </td>
                                                <td>
                                                    <a href="selectInfoEvento.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-info">Visualizar</a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- FIN REPORTE 6 -->


                                <!-- REPORTE 7 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r7"){
                                            
                                    ?>
                                    <table class="table table-striped table-bordered table-hover text-center">
                                    <p>7.<b class="font-weight-bold"> Asistencia Total</b> por cada categoría de evento.</p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Categoría Del Evento</th>
                                                <th scope="col">Asistencia Total</th>
                                                <th scope="col">Número de Eventos Realizados</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Categoria'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['asistenciaTotal'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['CantidadRealizados'] ?> 
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- FIN REPORTE 7 -->
                                
                                
                                <!-- REPORTE 8 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r8"){
                                            
                                    ?>
                                    <p class="card-text">8. Eventos que tuvieron una asistencia mayor o igual a <b class="font-weight-bold"><?php print $asistenciaMayor ?></b></p>
                                    <table id="tablas-eventos" class="table table-striped table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">Categoría</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Asistencia</th>
                                                <th scope="col">Valor Ingreso</th>
                                                <th scope="col">Usuario</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    $fila['ValorEntrada'] = number_format($fila['ValorEntrada']);
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $fila['nombre_cat'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila['Nombre'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila['Asistencia'] ?>
                                                </td>
                                                <td>
                                                    <?php echo "$".$fila['ValorEntrada'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila['Usuario'] ?>
                                                </td>
                                                <td>
                                                    <a href="selectInfoResultado.php?cod=<?php print $fila['codResultado']; ?>" class="btn btn-info">Visualizar</a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- FIN REPORTE 8 -->


                                <!-- REPORTE 9 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r9"){

                                            $fechaAntigua = date_create($fechaAntigua);
                                            $fechaAntigua = date_format($fechaAntigua, "d-m-Y g:i a");

                                            $fechaReciente = date_create($fechaReciente);
                                            $fechaReciente = date_format($fechaReciente, "d-m-Y g:i a");

                                            
                                            
                                    ?>
                                    <p class="card-text">9. Eventos que fueron realizados o se llevarán a cabo entre las fechas: <b class="font-weight-bold"><?php print $fechaAntigua ?></b> y <b class="font-weight-bold"><?php print $fechaReciente ?></b></p>
                                    <table id="tablas-eventos" class="table table-striped table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">Categoría</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Fecha - Hora Inicio</th>
                                                <th scope="col">Fecha - Hora Final</th>
                                                <th scope="col">Usuario</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    $fila['FechaHora_inicio'] = date_create($fila['FechaHora_inicio']);
                                                    $fila['FechaHora_inicio'] = date_format($fila['FechaHora_inicio'], "d-m-Y g:i a");

                                                    $fila['FechaHora_final'] = date_create($fila['FechaHora_final']);
                                                    $fila['FechaHora_final'] = date_format($fila['FechaHora_final'], "d-m-Y g:i a");
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $fila['nombre_cat'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila['Nombre'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila['FechaHora_inicio'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila['FechaHora_final'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila['Usuario'] ?>
                                                </td>
                                                <td>
                                                    <a href="selectInfoEvento.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-info">Visualizar</a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>          
                                </div>
                                <!-- FIN REPORTE 9 -->
                                
                                <?php
                                    }   
                                ?>          
                            </div>    

                        <!-- Final de reportes -->
                        </div>
                        
                    </div> 
                </div>
            </div>
        </div>
    </section>

    <!-- ACTIVAR EL DATATABLE EN LAS TABLAS QUE LO SOLICITEN -->
    <script src="js/DataTable.js"></script>

<!-- INVOCO EL FOOTER DEL ADMIN -->
<?php include('includes/footerAdmin.php') ?>
</body>
</html>