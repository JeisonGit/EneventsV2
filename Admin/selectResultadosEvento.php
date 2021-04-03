<?php
    
    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');
    include('../includes/funcionesResultado.php');

    $id = ValidarSesionUsuario();

    // Recupero el codigo del evento seleccionado
    $cod = $_REQUEST['cod'];

    // Consulto los resultados del evento seleccionado
    $resultado = ListarResultadosEvento($cod);

    // Guardo el nombre del evento en una variable
    if($row = $resultado -> fetch_assoc()){}
    $nombreEvento = $row['Nombre'];

?>

<!-- INVOCO EL HEADER DEL USUARIO -->
<?php include('includes/headerAdmin.php') ?>

    <!-- SECCION QUE CONTIENE LA TABLA QUE A SU VEZ CONTIENE LOS REGISTROS DEL EVENTO -->
    <section class="bg-grey">
        <div class="container">

            <input type="button" value="Atrás" class="btn btn-menu mt-3" onClick="history.go(-1);">

            <div class="row">
                <div class="col-lg-12 my-3">
                    <div class="card rounded-2">

                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Resultados</h6>
                        </div>

                        <!-- TABLA -->
                        <div class="card-body">

                            <!-- NOMBRE EVENTO -->
                            <p>Evento: <?php print $nombreEvento ?></p>

                            <!-- BOTON AGREGAR NUEVO RESULTADO AL EVENTO -->
                            <a href="insertResultadoEvento.php?cod=<?php print $cod ?>" class="btn btn-success mb-3">Agregar Nuevo Resultado</a>

                            <div class="table-responsive">
                                <table id="tablas-eventos" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Costo de Entrada</th>
                                            <th scope="col">Asistencia</th>
                                            <th scope="col">Ingresos por Entrada</th>
                                            <th scope="col">Ingresos Adicionales</th>
                                            <th scope="col">Costos Operacionales</th>
                                            <th scope="col">Ganancia Bruta</th>
                                            <th scope="col">Fecha y Hora Registro</th>
                                            <th scope="col">Información Completa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($fila = $resultado -> fetch_assoc())
                                            {
                                                // ASIGNO FORMATOS DE MONEDA USD Y DE FECHA A LOS CAMPOS QUE LO REQUIERAN RESULTADO
                                                $fila['ValorEntrada'] = number_format($fila['ValorEntrada']);
                                                $fila['Costo'] = number_format($fila['Costo']);
                                                $fila['IngresosAdicionales'] = number_format($fila['IngresosAdicionales']);
                                                $fila['IngresosEntrada'] = number_format($fila['IngresosEntrada']);
                                                $fila['GananciaBruta'] = number_format($fila['GananciaBruta']);
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
                                                <a href="selectInfoResultado.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-info">Visualizar</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>    
                        </div>
                        <!-- FIN TABLA -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ACTIVAR DATATABLE EN LA TABLA -->
    <script src="js/DataTable.js"></script>

<!-- INVOCO EL FOOTER DEL USUARIO -->
<?php include('includes/footerAdmin.php') ?>
</body>
</html>