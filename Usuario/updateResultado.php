<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesResultado.php');
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    // Recupero el codigo del resultado
    $codResultado = $_REQUEST['cod'];

    $fila = InformacionResultadoModificar($codResultado); 

    if(isset($_POST['Actualizar'])){
        ModificarResultado($codResultado);
    }

?>

<!-- INVOCO EL HEADER DEL USUARIO -->
<?php include('includes/headerUsuario.php') ?>

    <section class="bg-grey">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-8 my-3">
            <input type="button" value="Atrás" class="btn btn-menu my-3" onClick="history.go(-1);">
                <div class="card rounded-2 border">
                    <div class="card-header container-info">
                        <h6 class="font-weight-bold mb-0">Modificar Información del Resultado</h6>
                    </div>
                    <div class="card-body">

                        <!-- FORMULARIO QUE CONTIENE LA INFORMACIÓN DE LA CONSULTA -->
                        <form action="" method="post" class="carta-formulario">

                            <!-- VALOR DE LA ENTRADA(VIENE DEL EVENTO) Y ASISTENCIA -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="ValorEntrada" class="font-weight-bold">
                                        Valor de la Entrada*
                                    </label>
                                    <input type="number" name="ValorEntrada" id="ValorEntrada" class="form-control mb-3" value="<?php print $fila['ValorEntrada'] ?>" placeholder="Costo de entrada para ingresar al evento" min="0" max="99999999" required>
                                </div>   

                                <div class="col-md-6 col-sm-12">
                                    <label for="asistencia" class="font-weight-bold">
                                        Asistencia*
                                    </label>
                                    <input type="number" name="asistencia" id="asistencia" class="form-control mb-3" value="<?php print $fila['Asistencia'] ?>" min="0" max="999999" placeholder="Cantidad de personas que asistieron" required>
                                </div> 
                            </div>

                            <!-- COSTOS OPERACIONALES -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="costo" class="font-weight-bold">
                                        Costos Operacionales*
                                    </label>
                                    <input type="number" name="costo" id="costo" class="form-control mb-3" value="<?php print $fila['Costo'] ?>" placeholder="Valor($) que se necesito para llevar a cabo el evento" min="0" max="999999999" required>
                                </div>
                            </div>

                            <!-- INGRESOS ADICIONALES (INSUMOS) -->
                            <div class="row">    
                                <div class="col-md-12 col-sm-12">
                                    <label for="ingresosadicionales" class="font-weight-bold">
                                        Ingresos Adicionales*
                                    </label>
                                    <input type="number" name="ingresosadicionales" id="ingresosadicionales" class="form-control mb-3" value="<?php print $fila['IngresosAdicionales'] ?>" placeholder="Ganancia obtenida por los servicios 'secundarios'" min="0" max="999999999" required>
                                </div>
                            </div>

                            <!-- VALORACIÓN ASIGNADA -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="valoracion" class="font-weight-bold">
                                        Valoración Concluida*
                                    </label>
                                    <input type="number" name="valoracion" id="valoracion" class="form-control mb-3" value="<?php print $fila['Valoracion'] ?>" placeholder="Ingrese un número entre el 1 - 5 para calificar el evento" min="1" max="5" required>
                                </div>
                            </div>

                            <!-- DESCRIPCIÓN (OBSERVACIONES) -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="descripcion" class="font-weight-bold">
                                        Descripción
                                    </label>
                                    <textarea name="descripcion" id="descResultado" class="form-control mb-3" cols="30" rows="10"><?php print $fila['Descripcion'] ?></textarea>
                                </div>
                            </div>

                            <!-- BOTON DE ACCIÓN -->
                            <div class="row mt-3">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-menu mb-0" name="Actualizar" Value="Actualizar"><b>Actualizar</b></button>
                                </div>
                            </div>
                        </form>
                        <!-- FIN DEL FORMULARIO -->

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ACTIVAR EL CKEDITOR EN EL TEXTAREA DEL FORMULARIO -->
    <script>
        CKEDITOR.replace('descResultado', {
            extraPlugins: 'editorplaceholder',
            editorplaceholder: 'Agrega los factores positivos o a mejorar que se observaron durante la realización del evento y puedan ser tenidos en cuenta posteriormente...'
        });                                 
    </script>

<!-- INVOCO EL FOOTER DEL USUARIO -->
<?php include('includes/footerUsuario.php') ?>
</body>
</html>