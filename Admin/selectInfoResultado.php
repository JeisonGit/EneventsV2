<?php
    
    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');
    include('../includes/funcionesResultado.php');

    $id = ValidarSesionUsuario();

    // RECUPERO EL CODIGO DEL RESULTADO SELECCIONADO
    $codigo = $_REQUEST['cod'];

    $fila = InformacionResultadoSeleccionAdmin($codigo);

?>

<!-- INVOCO EL HEADER DEL ADMIN -->
<?php include('includes/headerAdmin.php') ?>

    <!-- SECCION QUE CONTIENE TODA LA INFORMACIÓN DEL EVENTO Y DEL RESULTADO SELECCIONADO -->
    <section class="bg-grey">
        <div class="container">

            <input type="button" value="Atrás" class="btn btn-menu mt-3" onClick="history.go(-1);">

            <div class="row">
                <div class="col-lg-12 my-3">
                    <div class="card rounded-2">

                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Información Completa del Resultado</h6>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <!-- INFORMACIÓN DEL EVENTO -->
                                <div class="col-lg-12 mx-3 my-3">

                                    <button class="btn btn-menu mb-3 font-weight-bold" type="button" data-toggle="collapse" data-target="#mostrarEvento" aria-expanded="false" aria-controls="mostrarEvento">Información del Evento</button>

                                    <div class="collapse mr-4" id="mostrarEvento">
                                        <div class="container">
                                            <div class="row">

                                                <!-- CATEGORIA - NOMBRE - FECHAS Y HORAS -->
                                                <div class="col-lg-3 mx-3">
                                                    <p class="card-text">
                                                        <b class="font-weight-bold">Categoría:</b> <?php print $fila['Categoria'] ?>
                                                    </p>

                                                    <p class="card-text">
                                                        <b class="font-weight-bold">Nombre:</b> <?php print $fila['Nombre'] ?>
                                                    </p>

                                                    <p class="card-text">
                                                        <b class="font-weight-bold">Fecha y Hora de Iniciación:</b> <?php print $fila['FechaHora_inicio'] ?>
                                                    </p>

                                                    <p class="card-text mb-3">
                                                        <b class="font-weight-bold">Fecha y Hora de Finalización:</b> <?php print $fila['FechaHora_final'] ?>
                                                    </p>
                                                </div>

                                                <!-- LUGAR DE REALIZACIÓN - VALOR DE LA ENTRADA -->
                                                <div class="col-lg-3 mx-3">
                                                    <p class="card-text">
                                                        <b class="font-weight-bold">Lugar:</b> <?php print $fila['Lugar'] ?>
                                                    </p>  

                                                    <p class="card-text mb-3">
                                                        <b class="font-weight-bold">Valor de Entrada(Actual):</b> $<?php print $fila['Valor'] ?>
                                                    </p>

                                                    <p class="card-text mb-3">
                                                        <b class="font-weight-bold">Usuario:</b> <?php print $fila['Nombres'] ?>
                                                    </p>

                                                    <p class="card-text mb-3">
                                                        <b class="font-weight-bold">Área de Trabajo:</b> <?php print $fila['areaTrabajo'] ?>
                                                    </p>
                                                </div>

                                                <!-- ESTADO E IMAGEN DEL EVENTO -->
                                                <div class="col-lg-4 mx-3">
                                                    <p class="card-text">
                                                        <b class="font-weight-bold">Estado del Evento:</b> <?php print $fila['Estado'] ?>
                                                    </p>

                                                    <img src="<?php print $fila['Imagen'] ?>" alt="" class="img-fluid img-thumbnail img-avatar">
                                                </div>
                                                
                                                <!-- DESCRIPCION DEL EVENTO  -->
                                                <div class="col-lg-12 mx-3 my-3">
                                                    <button class="btn btn-info mb-3 font-weight-bold" type="button" data-toggle="collapse" data-target="#mostrarDescripcion" aria-expanded="false" aria-controls="mostrarDescripcion">Descripción del Evento</button>

                                                    <div class="collapse mr-4" id="mostrarDescripcion">
                                                        <div class="card card-body">
                                                            <p class="card-text">
                                                                <b class="font-weight-bold">Descripción: </b><?php print $fila['descEvento'] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- FIN INFORMACIÓN DEL EVENTO -->
                                

                                <!-- INFORMACIÓN DEL RESULTADO -->
                                <div class="col-lg-12">

                                    <!-- VALOR ENTRADA(RESULTADO) - ASISTENCIA - INGRESOS POR ENTRADA(MULTIPLICACION) -->
                                    <div class="row mx-3 text-center">
                                        <div class="col-lg-4 my-3">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Valor de Entrada (Resultado):</b><br> $<?php print $fila['ValorEntrada'] ?>
                                            </p> 
                                        </div>
                                        <div class="col-lg-4 my-3">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Cantidad de Personas que Asistieron:</b><br> <?php print $fila['Asistencia'] ?>
                                            </p> 
                                        </div>
                                        <div class="col-lg-4 my-3">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Ingresos por Entrada:</b><br> $<?php print $fila['IngresosEntrada'] ?>
                                            </p>
                                        </div>
                                    </div>


                                    <!-- INGRESOS POR SERVICIOS SECUNDARIOS(INSUMOS) - GANANCIA TOTAL(SUMA) - COSTOS OPERACIONALES -->
                                    <div class="row mx-3 text-center">
                                        <div class="col-lg-4 my-3">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Ingresos por Servicios Secundarios:</b><br> $<?php print $fila['IngresosAdicionales'] ?>
                                            </p>  
                                        </div>
                                        <div class="col-lg-4 my-3">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Ganancia Total:</b><br> $<?php print $fila['IngresosTotales'] ?>
                                            </p>
                                        </div>
                                        <div class="col-lg-4 my-3">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Costos Operacionales:</b><br> $<?php print $fila['Costo'] ?>
                                            </p>
                                        </div>
                                    </div>


                                    <!-- GANANCIA BRUTA(MULTIPLICACION, SUMA Y RESTA) - VALORACION ASIGNADA - FECHA Y HORA DEL REGISTRO -->
                                    <div class="row mx-3 text-center">
                                        <div class="col-lg-4 my-3">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Ganancia Bruta: <br> $<?php print $fila['GananciaBruta'] ?></h5></b>
                                            </p>   
                                        </div>
                                        <div class="col-lg-4 my-3">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Valoración:</b> <?php print $fila['Valoracion'] ?>
                                            </p>
                                        </div>
                                        <div class="col-lg-4 my-3">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Fecha y Hora Registro del Resultado:</b><br> <?php print $fila['FechaHora'] ?>
                                            </p>
                                        </div>
                                    </div>


                                    <!-- DESCRIPCIÓN DEL RESULTADO(OBSERVACIONES) -->
                                    <div class="row my-4 mx-2">
                                        <div class="col-lg-12">
                                            <button class="btn btn-info mb-3 mr-3 font-weight-bold" type="button" data-toggle="collapse" data-target="#mostrarDescripcionResultado" aria-expanded="false" aria-controls="mostrarDescripcionResultado">Descripción del Resultado</button>

                                            <a href="updateResultadoEvento.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-info mb-3 font-weight-bold">Modificar Resultado</a>

                                            <div class="collapse mr-4" id="mostrarDescripcionResultado">
                                                <div class="card card-body">
                                                    <p class="card-text"><?php print $fila['Descripcion'] ?></p>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>

                                </div>
                                <!-- FIN INFORMACIÓN RESULTADO -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- INVOCO EL FOOTER DEL ADMIN -->
<?php include('includes/footerAdmin.php') ?>
</body>
</html>    