<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    // Recupero cual fue el resultado seleccionado
    $seleccion = $_POST['r'];

    if($seleccion == "r1"){

        // REPORTE 1
        // Los 10 eventos que obtuvieron mayor ganancia bruta.

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteUsuarioEventosMayorGananciaBruta('$id')");

        mysqli_close($conn);

    }
    else if($seleccion == "r2"){

        // REPORTE 2
        // Los 10 eventos que fueron más costosos operacionalmente 

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteUsuarioEventosMayorCostosOperacionales('$id')");

        mysqli_close($conn);

    }
    else if($seleccion == "r3"){

        // REPORTE 3
        // Los 10 eventos que obtuvieron mayores ingresos por entrada

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteUsuarioEventosMayorIngresosEntrada('$id')");

        mysqli_close($conn);
    }
    else if($seleccion == "r4"){

        // REPORTE 4
        // Ganancia Bruta obtenida por cada categoria de eventos realizados por el usuario

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteUsuarioGananciaBrutaTotalCategoriaEvento('$id')");

        mysqli_close($conn);
    }
    else if($seleccion == "r5"){

        // REPORTE 5
        // Ganancia bruta total por cada evento realizado por parte del usuario

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteUsuarioGananciaBrutaTotalEventos('$id')");

        mysqli_close($conn);
    }
    else if($seleccion == "r6"){

        // REPORTE 6
        // Eventos realizados entre dos fechas que vienen de un formulario modal

        // RECUPERO LOS PARAMETROS NECESARIOS PARA LA CONSULTA
        $fechaAntigua = $_POST['fecha_Antigua'];
        $fechaReciente = $_POST['fecha_Reciente'];

        include('../includes/conexion.php');    

            $reporte = $conn -> query("CALL sp_ReporteUsuarioEventosRealizadosFechas('$id','$fechaAntigua','$fechaReciente')");

        mysqli_close($conn);

        // FORMATOS A LAS FECHAS DIA-MES-AÑO | HORA-MIN-AM/PM
        $fechaAntigua = date_create($fechaAntigua);
        $fechaAntigua = date_format($fechaAntigua, "d-m-Y g:i a");
        $fechaReciente = date_create($fechaReciente);
        $fechaReciente = date_format($fechaReciente, "d-m-Y g:i a");

    }
    else if($seleccion == "r7"){

        // REPORTE 7 
        // Eventos que tuvieron una asistencia mayor o igual al dato que viene por post

        // RECUPERO PARAMETRO NECESARIO PARA CONSULTA
        $asisMayor = $_POST['asistenciaMayor'];

        include('../includes/conexion.php');  
        
            $reporte = $conn -> query("CALL sp_ReporteUsuarioEventosAsistenciaMayorIgualX('$id','$asisMayor')");

        mysqli_close($conn);
    }
    else if($seleccion == "r8"){

        // REPORTE 8
        // Eventos que tuvieron una asistencia menor o igual al dato que viene por post

        // RECUPERO EL PARAMETRO NECESARIO PARA LA CONSULTA
        $asisMenor = $_POST['asistenciaMenor'];

        include('../includes/conexion.php');

            $reporte = $conn -> query("CALL sp_ReporteUsuarioEventosAsistenciaMenorIgualX('$id','$asisMenor')");

        mysqli_close($conn);

    }
    else if($seleccion == "r9"){
        
        // REPORTE 9
        // Eventos que obtuvieron una ganancia bruta mayor o igual al primer dato que viene por POST y que sus costos operacionales sean menores o iguales al segundo dato que viene por POST

        // RECUPERO LOS PARAMETROS NECESARIOS PARA LA CONSULTA
        $gananciaBruta = $_POST['gananciaTotal'];
        $costosOpera = $_POST['costo'];

        include('../includes/conexion.php');  
        
            $reporte = $conn -> query("CALL sp_ReporteUsuarioEventosGanaciaBrutaMayorXCostoOperacionalMenorY('$id','$gananciaBruta','$costosOpera')");

        mysqli_close($conn);

        // ASIGNO FORMATOPS MONEDA USD
        $gananciaBruta = number_format($gananciaBruta);
        $costosOpera = number_format($costosOpera);
    }
    else{
        ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR!!',
                    html: 'Seleccione un reporte primero.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false
                }).then(okay => {
                    if (okay) {
                        location.href = "reportes.php";
                    }
                });
            </script>
        <?php 
    }
    
?>

<!-- INVOCO EL HEADER DEL USUARIO -->
<?php include('includes/headerUsuario.php') ?>

    <section class="bg-grey">
        <div class="container">

            <a href="reportes.php" class="btn btn-menu mt-4">Atrás</a>
            
            <div class="row">
                <div class="col-lg-12 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte</h6>
                        </div>

                        <!-- INICIO REPORTES -->
                        <div class="card-body">
                            <div class="table-responsive">

                                <!-- INICIO DE LOS REPORTES -->

                                <!-- REPORTE 1 -->
                                <div class="container">
                                    <?php 
                                        if($seleccion == "r1"){

                                    ?>
                                    <table class="table table-striped table-bordered table-hover text-center">
                                    <p class="card-text">1. Los 10 eventos que obtuvieron mayor <b class="font-weight-bold">Ganancia Bruta.</b></p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Evento</th>
                                                <th scope="col">Ganancia Bruta</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    //Formato USD para valores numericos
                                                    $fila['GananciaBruta'] = number_format($fila['GananciaBruta']);
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Nombre'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['GananciaBruta'] ?> 
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
                                <!-- FIN REPORTE 1 -->


                                <!-- REPORTE 2 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r2"){

                                    ?>
                                    <table class="table table-striped table-bordered table-hover text-center">
                                    <p class="card-text">2. Los 10 eventos que fueron más <b class="font-weight-bold">Costosos Operacionalmente.</b></p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Evento</th>
                                                <th scope="col">Costos Operacionales</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    //Formato USD para valores numericos
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
                                                    <a href="selectInfoResultado.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-info">Visualizar</a>
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
                                    <table class="table table-striped table-bordered table-hover text-center">
                                    <p class="card-text">3. Los 10 eventos que obtuvieron mayores <b class="font-weight-bold">Ingresos por Entrada</b> al evento.</p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Evento</th>
                                                <th scope="col">Ingresos por Entrada</th>
                                                <th scope="col">Asistencia</th>
                                                <th scope="col">Valor de Entrada</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    // FORMATOS MONEDA USD PARA LOS CAMPOS QUE LO REQUIEREN
                                                    $fila['IngresosEntrada'] = number_format($fila['IngresosEntrada']);
                                                    $fila['ValorEntrada'] = number_format($fila['ValorEntrada']);

                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Nombre'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['IngresosEntrada'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['Asistencia'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['ValorEntrada'] ?> 
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
                                <!-- FIN REPORTE 3 -->


                                <!-- REPORTE 4 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r4"){
                                            
                                    ?>
                                    <table class="table table-striped table-bordered table-hover text-center">
                                    <p class="card-text">4. <b class="font-weight-bold">Ganancia Bruta Total</b> obtenida por cada categoría de eventos realizados.</p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Categoría</th>
                                                <th scope="col">Ganancia Bruta</th>
                                                <th scope="col">Cantidad de Eventos Realizados</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    // FORMATO MONEDA USD PARA EL CAMPO QUE LO REQUIERA
                                                    $fila['GananciaBruta'] = number_format($fila['GananciaBruta']);
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Categoria'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['GananciaBruta'] ?> 
                                                </td>
                                                <td>
                                                    <?php print $fila['CantidadRealizado'] ?>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- FIN REPORTE 4 -->


                                <!-- REPORTE 5 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r5"){
                                            
                                    ?>
                                    <table id="tablas-eventos" class="table table-striped table-bordered table-hover text-center">
                                    <p class="card-text">5. <b class="font-weight-bold">Ganancia Bruta Total</b> por cada evento realizado.</p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Evento</th>
                                                <th scope="col">Ganancia Bruta</th>
                                                <th scope="col">Cantidad de Resultados del Evento</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    // FORMATO MONEDA USD
                                                    $fila['GananciaBruta'] = number_format($fila['GananciaBruta']);
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Nombre'] ?> 
                                                </td>
                                                <td>
                                                    <?php print "$".$fila['GananciaBruta'] ?> 
                                                </td>
                                                <td>
                                                    <?php print $fila['CantidadRealizado'] ?> 
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
                                <!-- FIN REPORTE 5 -->


                                <!-- REPORTE 6 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r6"){

                                    ?>
                                    <table id="tablas-eventos" class="table table-striped table-bordered table-hover text-center">
                                    <p class="card-text">6. Eventos realizados / realizarán entre el <b class="font-weight-bold"><?php print $fechaAntigua ?></b> y el <b class="font-weight-bold"><?php print $fechaReciente ?></b>.</p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Categoría</th>
                                                <th scope="col">Evento</th>
                                                <th scope="col">Fecha y Hora de Inicio</th>
                                                <th scope="col">Fecha y Hora de Finalización</th>
                                                <th scope="col">Estado del Evento</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    // FORMATOS PARA FECHAS
                                                    $fila['FechaHora_inicio'] = date_create($fila['FechaHora_inicio']);
                                                    $fila['FechaHora_inicio'] = date_format($fila['FechaHora_inicio'], "d-m-Y g:i a");

                                                    $fila['FechaHora_final'] = date_create($fila['FechaHora_final']);
                                                    $fila['FechaHora_final'] = date_format($fila['FechaHora_final'], "d-m-Y g:i a");
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Categoria'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['Nombre'] ?> </td>
                                                <td> 
                                                    <?php print $fila['FechaHora_inicio'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['FechaHora_final'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['EstadoEvento'] ?> 
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
                                    <table id="tablas-eventos" class="table table-striped table-bordered table-hover text-center">
                                    <p class="card-text">7. Eventos que tuvieron una <b class="font-weight-bold">Asistencia</b> mayor o igual a <b class="font-weight-bold"><?php print $asisMayor ?></b></p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Evento</th>
                                                <th scope="col">Asistencia</th>
                                                <th scope="col">Valor de Entrada</th>
                                                <th scope="col">Ingresos por Entrada</th>   
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    // FORMATO MONEDA USD
                                                    $fila['IngresosEntrada'] = number_format($fila['IngresosEntrada']);
                                                    $fila['ValorEntrada'] = number_format($fila['ValorEntrada']);
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Nombre'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['Asistencia'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['ValorEntrada'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['IngresosEntrada'] ?> 
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
                                <!-- FIN REPORTE 7 -->


                                <!-- REPORTE 8 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r8"){

                                    ?>
                                    <table id="tablas-eventos" class="table table-striped table-bordered table-hover text-center">
                                    <p class="card-text">8. Eventos que tuvieron una <b class="font-weight-bold">Asistencia</b> menor o igual a <b class="font-weight-bold"><?php print $asisMenor ?></b></p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Evento</th>
                                                <th scope="col">Asistencia</th>
                                                <th scope="col">Valor de Entrada</th>
                                                <th scope="col">Ingresos por Entrada</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    // FORMATOS MONEDA USD
                                                    $fila['IngresosEntrada'] = number_format($fila['IngresosEntrada']);
                                                    $fila['ValorEntrada'] = number_format($fila['ValorEntrada']);
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Nombre'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print $fila['Asistencia'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['ValorEntrada'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['IngresosEntrada'] ?> 
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
                                <!-- FIN REPORTE 8 -->


                                <!-- REPORTE 9 -->
                                <div class="container">
                                    <?php
                                        }
                                        else if($seleccion == "r9"){
                                    ?>
                                    <table id="tablas-eventos" class="table table-striped table-bordered table-hover text-center">
                                    <p class="card-text">9. Eventos que obtuvieron una <b class="font-weight-bold">Ganancia Bruta</b> mayor o igual a <b class="font-weight-bold"><?php print $gananciaBruta ?></b> y sus <b class="font-weight-bold">Costos Operacionales</b> fueron menores o iguales a <b class="font-weight-bold"><?php print $costosOpera ?></b>.</p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Evento</th>
                                                <th scope="col">Ganancia Bruta</th>
                                                <th scope="col">Costos Operacionales</th>
                                                <th scope="col">Información Completa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($fila = $reporte -> fetch_assoc())
                                                {
                                                    $fila['GananciaBruta'] = number_format($fila['GananciaBruta']);
                                                    $fila['Costo'] = number_format($fila['Costo']);
                                            ?>
                                            <tr>
                                                <td> 
                                                    <?php print $fila['Nombre'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['GananciaBruta'] ?> 
                                                </td>
                                                <td> 
                                                    <?php print "$".$fila['Costo'] ?> 
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
                                <!-- FIN REPORTE 9 -->

                                <?php
                                    }   
                                    else{
                                        ?>
                                            <script>
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'ERROR!!',
                                                    html: 'Seleccione un reporte primero.',
                                                    allowOutsideClick: false,
                                                    allowEscapeKey: false,
                                                    allowEnterKey: false
                                                }).then(okay => {
                                                    if (okay) {
                                                        location.href = "reportes.php";
                                                    }
                                                });
                                            </script>
                                        <?php 
                                    }
                                ?> 

                            </div> 
                        </div>
                        <!-- FIN REPORTES -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ACTIVAR DATATABLE EN LAS TABLAS DE REPORTES -->
    <script src="js/DataTable.js"></script>

<!-- INVOCO EL FOOTER DEL USUARIO -->
<?php include('includes/footerUsuario.php') ?>
</body>
</html>