<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');
    include('../includes/funcionesEvento.php');

    $id = ValidarSesionUsuario();

    // Recupero del codigo del evento seleccionado
    $codigo = $_REQUEST['cod'];
    
    // Consulta la información del evento seleccionado
    $fila = InformacionEventoSeleccionadoAdmin($codigo);

    // Funcion para gestionar el estado del evento seleccionado
    if(isset($_POST['tipoSolicitud'])){
        GestionarEstadoEventoAdmin($codigo);
    }
    
?>

<!-- INVOCO EL HEADER DEL ADMIN -->
<?php include('includes/headerAdmin.php') ?>

    <!-- SECCION QUE CONTIENE TODA LA INFORMACIÓN DEL EVENTO Y OPCIONES -->
    <section class="bg-grey">
        <div class="container">

            <input type="button" value="Atrás" class="btn btn-menu mt-3" onClick="history.go(-1);">

            <div class="row">
                <div class="col-lg-12 my-3">
                    <div class="card rounded-2">

                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Información Completa del Evento</h6>
                        </div>

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
                                                <b class="font-weight-bold">Fecha y Hora de Inicio:</b><br> <?php print $fila['FechaHora_inicio'] ?>
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

                                    <div class="row">
                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Usuario:</b> <?php print $fila['Nombres'] ?>
                                            </p> 
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Área de Trabajo:</b> <?php print $fila['areaTrabajo'] ?>
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

                            <!-- SEGUN EL ESTADO DEL EVENTO, MOSTRAR LAS OPCIONES DISPONIBLES -->
                            <div class="row">
                                <div class="col-lg-12 mt-2">
                                    <?php 
                                        if($fila['estadoEvento'] == "Activo"){
                                    ?>
                                        <form method="post" onclick="return confirmDesactivar()">
                                            <button type="submit" name="tipoSolicitud" value="Desactivar" class="btn btn-danger float-right mx-3 my-2">Desactivar</button>
                                        </form>
                                    <?php    
                                        }
                                        else if($fila['estadoEvento'] == "Inactivo"){
                                    ?>
                                        <form method="post" onclick="return confirmActivar()">
                                            <button type="submit" name="tipoSolicitud" value="Activar" class="btn btn-danger float-right mx-3 my-2">Activar</button>
                                        </form>
                                    <?php
                                        }
                                        else if($fila['estadoEvento'] == "Esperando"){
                                    ?>
                                        <form method="post" onclick="return confirmActivar()">
                                            <button type="submit" name="tipoSolicitud" value="Activar" class="btn btn-danger float-right mx-3 my-2">Activar</button>
                                        </form>

                                        <form method="post" onclick="return confirmRechazar()">
                                            <button type="submit" name="tipoSolicitud" value="Cancelar" class="btn btn-danger float-right mx-3 my-2">Rechazar Solicitud</button>
                                        </form>
                                    <?php
                                        }
                                    ?>  
                                    
                                    <!-- OPCIONES COMUNES PARA TODOS LOS EVENTOS -->
                                    <a href="selectResultadosEvento.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-success float-right mx-3 my-2">Resultados</a>

                                    <a href="updateEventoUsuario.php?cod=<?php print $fila['Codigo'] ?>" class="btn btn-info float-right mx-3 my-2">Modificar Datos</a>

                                    <a href="selectinfoUsuario?id=<?php print $fila['Documento'] ?>" class="btn btn-secondary float-right mx-3 my-2">Usuario</a>
                                </div>
                            </div>   

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FUNCIONES PARA VALIDAR LA OPCION SELECCIONADA MEDIANTE UN CONFIRM -->
    <script type="text/javascript">
        function confirmDesactivar(){
            var respuesta = confirm("¿Está seguro que desea DESACTIVAR el evento? La información dejara de ser visible para la población.");
            if (respuesta == true){
                return true;
            }else{
                return false;
            }
        }

        function confirmActivar(){
            var respuesta = confirm("¿Está seguro que desea ACTIVAR el evento? La información será visible para la población.");
            if (respuesta == true){
                return true;
            }else{
                return false;
            }
        }

        function confirmRechazar(){
            var respuesta = confirm("¿Está seguro que desea RECHAZAR la solicitud del evento? Tenga en cuenta que SI el evento ya fue realizado y tiene resultados, el evento solo se puede desactivar.");
            if (respuesta == true){
                return true;
            }else{
                return false;
            }
        }
    </script>

<!-- INVOCO EL FOOTER DEL ADMIN -->
<?php include('includes/footerAdmin.php') ?>
</body>
</html>