<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesEvento.php');
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    // Recupero el codigo del evento
    $codigo = $_REQUEST['cod'];

    $fila = InformacionEventoSeleccionadoUsuarioSesion($codigo);

    // Formatos de moneda, fechas y horas
    $fila['Valor'] = number_format($fila['Valor']);
    $fila['FechaHora_inicio'] = date_create($fila['FechaHora_inicio']);
    $fila['FechaHora_inicio'] = date_format($fila['FechaHora_inicio'], "d-m-Y g:ia");
    $fila['FechaHora_final'] = date_create($fila['FechaHora_final']);
    $fila['FechaHora_final'] = date_format($fila['FechaHora_final'], "d-m-Y g:ia");

    // Funciones de los estados de evento
    if(isset($_POST['tipoSolicitud'])){
        GestionarEstadoEventoUsuarioSesion($codigo, $id);
    }

?>

<!-- INVOCO EL HEADER DEL USUARIO -->
<?php include('includes/headerUsuario.php') ?>

    <!-- SECCION QUE CONTIENE LA INFORMACIÓN COMPLETA DEL EVENTO SELECCIONADO -->
    <section class="bg-grey">
        <div class="container">
        <input type="button" value="Atrás" class="btn btn-menu mt-3" onClick="history.go(-1);">
            <div class="row">
                <div class="col-lg-12 my-3">

                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Información Completa Del Evento</h6>
                        </div>

                        <!--CARD QUE CONTIENE TODA LA INFORMACIÓN DE LA CONSULTA  -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 my-3">

                                    <!-- CATEGORIA Y NOMBRE DEL DEVENTO  - 1RA FILA -->
                                    <div class="row">
                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Categoría:</b> <?php print $fila['Categoria'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Nombre:</b> <?php print $fila['Nombre'] ?>
                                            </p>
                                        </div>
                                    </div>    

                                    <!-- FECHA / HORA DE INICIO Y FINALIZACIÓN - 2DA FILA -->
                                    <div class="row">
                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Fecha y Hora de Iniciación:</b><br> <?php print $fila['FechaHora_inicio'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Fecha y Hora de Finalización:</b><br> <?php print $fila['FechaHora_final'] ?>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- LUGAR DONDE SE REALIZARÁ Y VALOR DE ENTRADA 3RA FILA -->
                                    <div class="row">
                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Lugar:</b> <?php print $fila['Lugar'] ?>
                                            </p> 
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Valor:</b> $<?php print $fila['Valor'] ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>

                                <!-- ESTADO E IMAGEN DEL EVENTO - 3RA COLUMNA -->
                                <div class="col-lg-4 my-3">
                                    <div class="row">
                                        <div class="col-lg-12 my-2">
                                            <p class="card-text"><b class="font-weight-bold">Estado del Evento:</b> <?php print $fila['estadoEvento'] ?></p>
                                            <img src="<?php print $fila['Imagen'] ?>" alt="" class="img-fluid img-thumbnail img-avatar"> 
                                        </div>
                                    </div>
                                </div>

                            </div>  
                            <!-- FIN PRIMERA PARTE DE LA INFORMACIÓN -->


                            <!-- NUEVA FILA DE LARGO COMPLETO DONDE VA LA DESCRIPCION MEDIANTE UN BOTON QUE LA OCULTA O MUESTRA -->
                            <div class="row">

                                <div class="col-lg-12 mx-3">
                                    <button class="btn btn-menu mb-3 font-weight-bold" type="button" data-toggle="collapse" data-target="#mostrarDescripcion" aria-expanded="false" aria-controls="mostrarDescripcion">
                                        Mostrar / Ocultar Descripción
                                    </button>

                                    <div class="collapse mr-4" id="mostrarDescripcion">
                                        <div class="card card-body">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Descripción: </b><?php print $fila['Descripcion'] ?>
                                            </p>
                                        </div>
                                        
                                    </div>
                                </div>

                            </div>


                            <!-- FILA DONDE DEPENDIENDO DEL ESTADO DEL EVENTO APARECEN DIFERENTES OPCIONES -->
                            <div class="row">
                                <div class="col-lg-12 mt-2">

                                    <!-- SI EL EVENTO ESTA EN ESTADO ACTIVO, LA OPCION A MOSTRAR ES DESACTIVAR -->
                                    <?php 
                                        if($fila['estadoEvento'] == "Activo"){
                                    ?>
                                        <form method="post" onclick="return confirmDesactivar()">
                                            <button type="submit" name="tipoSolicitud" value="Desactivar" class="btn btn-danger float-right mx-3 my-2">Desactivar</button>
                                        </form>


                                    <!-- SI EL EVENTO ESTA EN ESTADO INACTIVO, LA OPCION A MOSTRAR ES SOLICITAR ACTIVACIÓN -->
                                    <?php    
                                        }
                                        else if($fila['estadoEvento'] == "Inactivo"){
                                    ?>
                                        <form method="post" onclick="return confirmSoliActivar()">
                                            <button type="submit" name="tipoSolicitud" value="Activar" class="btn btn-danger float-right mx-3 my-2">Solicitar Activación Evento</button>
                                        </form>

                                    <!-- SI EL EVENTO ESTA EN ESTADO ESPERA, LA OPCION A MOSTRAR ES CANCELAR EVENTO Y SOLICITUD -->
                                    <?php
                                        }
                                        else if($fila['estadoEvento'] == "Esperando"){
                                    ?>
                                        <form method="post" onclick="return confirmCancelar()">
                                            <button type="submit" name="tipoSolicitud" value="Cancelar" class="btn btn-danger float-right mx-3 my-2">Cancelar Evento y Solicitud</button>
                                        </form>
                                    <?php
                                        }
                                    ?>  

                                    <!-- BOTONES DE MODIFICAR Y VER LOS RESULTADOS DEL EVENTO -->
                                    <a href="selectResultadosEvento.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-success float-right mx-3 my-2">Resultados</a>

                                    <a href="updateEvento.php?cod=<?php print $fila['Codigo'] ?>" class="btn btn-info float-right mx-3 my-2">Modificar Datos</a>  

                                </div>
                            </div>
                            <!-- FIN FILA BOTONES DE OPCIONES -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FIN SECCION INFORMACIÓN COMPLETA DEL EVENTO -->


    <!-- ALERTAS DE CONFIRMACIÓN PARA LAS DIFERENTES OPCIONES DEPENDIENDO DEL ESTADO DEL EVENTO -->
    <script type="text/javascript">

        function confirmDesactivar(){
            var respuesta = confirm("¿Está seguro que desea DESACTIVAR el evento? La información dejara de ser visible para la población.");
            if (respuesta == true){
                return true;
            }else{
                return false;
            }
        }

        function confirmSoliActivar(){
            var respuesta = confirm("¿Está seguro que desea solicitar a los administrativos la ACTIVACIÓN del evento? Si es aprobado, la información será visible para la población.");
            if (respuesta == true){
                return true;
            }else{
                return false;
            }
        }

        function confirmCancelar(){
            var respuesta = confirm("¿Está seguro que desea CANCELAR el evento? Se eliminará la solicitud y también los datos del evento. Pero, SI el evento ya ha sido realizado previamente y cuenta con resultados, se cancelará la solicitud y sólo se desactivará");
            if (respuesta == true){
                return true;
            }else{
                return false;
            }
        }
    </script>
    <!-- FIN DE ALERTAS DE CONFIRMACIÓN -->


<!-- INVOCO EL FOOTER DEL USUARIO -->
<?php include('includes/footerUsuario.php') ?>
</body>
</html>