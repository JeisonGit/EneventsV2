<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesResultado.php');
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    // Recupero el codigo del evento seleccionado
    $codEvento = $_REQUEST['cod'];

    $resultados = ListarResultadosEvento($codEvento);

    // Para obtener el nombre del evento, lo guardo en un array
    if($filaResultado = $resultados -> fetch_assoc()){}

    // Guardi el nombre del evento en una variable
    $nombreEvento = $filaResultado['Nombre'];

?>

<!-- INVOCO EL HEADER DEL USUARIO -->
<?php include('includes/headerUsuario.php') ?>

    <!-- SECCION QUE CONTIENE LA TABLA QUE A SU VEZ CONTIENE TODOS LOS RESULTADOS DEL EVENTO QUE CONSULTAMOS -->
    <section class="bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Resultados del Evento:</h6>
                        </div>
                        <div class="card-body">

                            <!-- NOMBRE DEL EVENTO -->
                            <p><?php print $nombreEvento ?></p>

                            <!-- BOTON AGREGAR NUEVO RESULTADO AL EVENTO -->
                            <a href="insertResultado.php?cod=<?php print $codEvento ?>" class="btn btn-success mb-3">Agregar Nuevo Resultado</a>

                            <!-- TABLA CON LOS RESULTADOS -->
                            <div class="table-responsive">
                                <table id="tablas-eventos" class="table table-striped table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Costo de Entrada</th>
                                            <th scope="col">Asistencia</th>
                                            <th scope="col">Ingresos por Entrada</th>
                                            <th scope="col">Ingresos Adicionales</th>
                                            <th scope="col">Costos Operacionales</th>
                                            <th scope="col">Ganancia Bruta</th>
                                            <th scope="col">Fecha y Hora de Registro</th>
                                            <th scope="col">Información Completa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($fila = $resultados -> fetch_assoc())
                                            {
                                                // DAMOS FORMATO DE MONEDA USD A LOS CAMPOS QUE LO REQUIERAN
                                                $fila['ValorEntrada'] = number_format($fila['ValorEntrada']);
                                                $fila['IngresosEntrada'] = number_format($fila['IngresosEntrada']);
                                                $fila['IngresosAdicionales'] = number_format($fila['IngresosAdicionales']);
                                                $fila['Costo'] = number_format($fila['Costo']);
                                                $fila['IngresosTotales'] = number_format($fila['IngresosTotales']);

                                                // FORMATO FECHA
                                                $fila['FechaHora'] = date_create($fila['FechaHora']);
                                                $fila['FechaHora'] = date_format($fila['FechaHora'], "d-m-Y g:i a");
                                        ?>
                                        <tr>
                                            <td> 
                                                <?php print "$".$fila['ValorEntrada'] ?> 
                                            </td>
                                            <td> 
                                                <?php print $fila['Asistencia'] ?> 
                                            </td>
                                            <td> 
                                                <?php print "$".$fila['IngresosEntrada'] ?> 
                                            </td>
                                            <td> 
                                                <?php print "$".$fila['IngresosAdicionales'] ?> 
                                            </td>
                                            <td> 
                                                <?php print "$".$fila['Costo'] ?> 
                                            </td>
                                            <td> 
                                                <?php print "$".$fila['GananciaBruta'] ?> 
                                            </td>
                                            <td> 
                                                <?php print $fila['FechaHora'] ?> 
                                            </td>
                                            <td>
                                                <a href="selectInfoResultado.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-secondary">Visualizar</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>  
                            <!-- FIN TABLA RESULTADOS -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FIN SECCION QUE CONTIENE LA TABLA -->


    <!-- ACTIVAR EL DATATABLE EN LA TABLA ACTUAL -->
    <script src="js/DataTable.js"></script>

<!-- INVOCO EL FOOTER DEL USUARIO -->
<?php include('includes/footerUsuario.php') ?>
</body>
</html>