<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');
    include('../includes/funcionesResultado.php');

    $id = ValidarSesionUsuario();
    
    // Recupero el codigo del evento
    $cod = $_REQUEST['cod'];

    // Recupero el nombre y el valor del evento
    $fila = NombreValorEventoInsertarResultado($cod);

    // Agrego el resultado
    if(isset($_POST['Agregar'])){
        AgregarResultado($cod);
    }

?>

<!-- INVOCO EL HEADER DEL ADMIN -->
<?php include('includes/headerAdmin.php') ?>
    
    <!-- SECCION QUE CONTIENE EL FORMULARIO PARA INGRESAR LOS DATOS DEL RESULTADO -->
    <section class="bg-grey">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-8 my-3">

                <input type="button" value="Atrás" class="btn btn-menu my-3" onClick="history.go(-1);">

                <div class="card rounded-2 border">

                    <div class="card-header container-info">
                        <h6 class="font-weight-bold mb-0">Información de los Resultados Obtenidos. </h6>
                    </div>

                    <div class="card-body">
                        <!-- NOMBRE DEL EVENTO -->
                        <p><b class="font-weight-bold">Evento:</b> <?php print $fila['Nombre'] ?></p>

                        <form action="" method="post" class="carta-formulario">

                            <!-- COSTO DE ENTRADA Y ASISTENCIA -->
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

                            <!-- COSTOS OPERACIONALES -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="costo" class="font-weight-bold">
                                        Costos Operacionales*
                                    </label>
                                    <input type="number" name="costo" id="costo" class="form-control mb-3" placeholder="Valor($) que se necesito para llevar a cabo el evento" min="0" max="999999999" required>
                                </div>
                            </div>

                            <!-- INGRESOS ADICIONALES (INSUMOS, ETC) -->
                            <div class="row">    
                                <div class="col-md-12 col-sm-12">
                                    <label for="ingresosadicionales" class="font-weight-bold">
                                        Ingresos Adicionales*
                                    </label>
                                    <input type="number" name="ingresosadicionales" id="ingresosadicionales" class="form-control mb-3" placeholder="Ganancia obtenida por los servicios 'secundarios'" min="0" max="999999999" required>
                                </div>
                            </div>

                            <!-- VALORACION CONCLUIDA -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="valoracion" class="font-weight-bold">
                                        Valoración Concluida*
                                    </label>
                                    <input type="number" name="valoracion" id="valoracion" class="form-control mb-3" placeholder="Ingrese un número entre el 1 - 5 para calificar el evento" min="1" max="5" required>
                                </div>
                            </div>

                            <!-- OBSERVACIONES CON CKEDITOR -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="descripcion" class="font-weight-bold">
                                        Observaciones
                                    </label>
                                    <textarea name="descripcion" id="descResultado" class="form-control mb-3" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <!-- BOTON -->
                            <div class="row mt-3">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-menu mb-0" name="Agregar" Value="Agregar"><b>Agregar</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>  

    <!-- ACTIVAR CKEDITOR PARA EL TEXTAREA DEL FORMULARIO -->
    <script>
        CKEDITOR.replace('descResultado', {
            extraPlugins: 'editorplaceholder',
            editorplaceholder: 'Agrega los factores positivos o a mejorar que se observaron durante la realización del evento y puedan ser tenidos en cuenta posteriormente...'
        });                                 
    </script>

<!-- INVOCO EL FOOTER DEL ADMIN -->
<?php include('includes/footerAdmin.php') ?>
</body>
</html>
