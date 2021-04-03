<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesResultado.php');
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    // Recupero el codigo del evento
    $codEvento = $_REQUEST['cod'];

    $fila = NombreValorEventoInsertarResultado($codEvento);

    // Zona Horaria
    date_default_timezone_set('America/Bogota');

    if(isset($_POST['Agregar'])){
        AgregarResultado($codEvento);    
    }

?>

<!-- INVOCO HEADER USUARIO -->
<?php include('includes/headerUsuario.php') ?>
    
    <!-- SECCION QUE CONTIENE EL FORMULARIO PARA INGRESAR LOS DATOS DE LOS RESULTADOS QUE SE OBTUVIERON -->
    <section class="bg-grey">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-8 my-3">
            
            <!-- BOTON ATRAS. RETROCEDE EN EL HISTORIA UNA PÁGINA -->
            <input type="button" value="Atrás" class="btn btn-menu my-3" onClick="history.go(-1);">

                <!-- CARD DEL FORMULARIO -->
                <div class="card rounded-2 border">

                    <!-- TITULO CARD -->
                    <div class="card-header container-info">
                        <h6 class="font-weight-bold mb-0">Información de los Resultados Obtenidos</h6>
                    </div>

                    <!-- CUERPO CARD -->
                    <div class="card-body">

                        <!-- NOMBRE DEL EVENTO AL CUAL SE AGREGARA EL RESULTADO -->
                        <p>
                            <b class="font-weight-bold">Evento:</b> <?php print $fila['Nombre'] ?>
                        </p>

                        <!-- FORMULARIO -->
                        <form action="" method="post" class="carta-formulario">

                            <!-- VALOR DE LA ENTRADA(VIENE POR LA CONSULTA AL EVENTO) Y LA ASISTENCIA QUE HUBO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="valorEntrada" class="font-weight-bold">
                                        Valor de la Entrada*
                                    </label>
                                    <input type="number" name="valorEntrada" id="valorEntrada" class="form-control mb-3" value="<?php print $fila['Valor'] ?>" placeholder="Costo para ingresar al evento" min="0" max="99999999" required>
                                </div>   

                                <div class="col-md-6 col-sm-12">
                                    <label for="asistencia" class="font-weight-bold">
                                        Asistencia*
                                    </label>
                                    <input type="number" name="asistencia" id="asistencia" class="form-control mb-3" placeholder="Cantidad de personas que asistieron" min="0" max="999999" required>
                                </div> 
                            </div>


                            <!-- COSTO OPERACIONALES -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="costo" class="font-weight-bold">
                                        Costo Operacional*
                                    </label>
                                    <input type="number" name="costo" id="costo" class="form-control mb-3" placeholder="Valor($) que se necesito para llevar a cabo el evento" min="0" max="999999999" required>
                                </div>
                            </div>


                            <!-- INGRESOS ADICIONALES (INSUMOS) -->
                            <div class="row">    
                                <div class="col-md-12 col-sm-12">
                                    <label for="ingresosadicionales" class="font-weight-bold">
                                        Ingresos Adicionales*
                                    </label>
                                    <input type="number" name="ingresosadicionales" id="ingresosadicionales" class="form-control mb-3" placeholder="Ganancia obtenida por los servicios 'secundarios'" min="0" max="999999999" required>
                                </div>
                            </div>


                            <!-- VALORACIÓN CONSIDERADA-->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="valoracion" class="font-weight-bold">
                                        Valoración Concluida*
                                    </label>
                                    <input type="number" name="valoracion" id="valoracion" class="form-control mb-3" placeholder="Ingrese un número entre el 1 - 5 para calificar el evento" min="1" max="5" required>
                                </div>
                            </div>
                            

                            <!-- OBSERVACIONES A TENER EN CUENTA. CUENTA CON LA HERRAMIENTA CKEDITOR -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="descripcion" class="font-weight-bold">
                                        Observaciones
                                    </label>
                                    <textarea name="descripcion" id="descResultado" class="form-control mb-3" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <!-- BOTON ENVIAR DATOS DEL FORMULARIO - VALUE = AGREGAR -->
                            <div class="row mt-3">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-menu mb-0" name="Agregar" Value="Agregar"><b>Agregar</b></button>
                                </div>
                            </div>
                            
                        </form>
                        <!-- FIN FORMULARIO -->

                    </div>
                </div>
                <!-- FIN CARD FORMULARIO -->

            </div>
        </div>
    </section>  


    <!-- ACTIVA EL CKEDITOR EN EL TEXTAREA DEL FORMULARIO -->
    <script>
        CKEDITOR.replace('descResultado', {
            extraPlugins: 'editorplaceholder',
            editorplaceholder: 'Agrega los factores positivos o a mejorar que se observaron durante la realización del evento y puedan ser tenidos en cuenta posteriormente...'
        });                                 
    </script>


<!-- INVOCA EL FOOTER DEL USUARIO -->
<?php include('includes/footerUsuario.php') ?>
</body>
</html>
