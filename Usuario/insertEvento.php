<?php 

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesEvento.php');
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    // Llenar el select categoria
    $filasCategoriaEvento = ListarSelectCategoriaEvento();

    // Zona Horaria
    date_default_timezone_set('America/Bogota');

?>

<!-- INVOCO HEADER DEL USUARIO -->
<?php include('includes/headerUsuario.php') ?>


    <!-- SECCION QUE CONTIENE EL FORMULARIO QUE SOLICITA LOS DATOS DEL EVENTO -->
    <section class="bg-grey">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-10 my-3">


            <!-- BOTON ATRAS -> REGRESA EN EL HISTORIAL UNA PÁGINA -->
            <input type="button" value="Atrás" class="btn btn-menu my-3" onClick="history.go(-1);">


                <!-- CARD DEL FORMULARIO -->
                <div class="card rounded-2 border">

                
                    <!-- TITULO CARD -->
                    <div class="card-header container-info">
                        <h6 class="font-weight-bold mb-0">Ingresa la Información del Evento</h6>
                    </div>


                    <!-- CUERPO CARD -->
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" class="carta-formulario" >

                            <!-- CATEGORIA Y NOMBRE DEL EVENTO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="categoria" class="font-weight-bold">
                                        Categoría del Evento*
                                    </label>
                                    <!-- SE RELLENA EL SELECT CON LOS DATOS DEL ARRAY CORRESPONDIENTE -->
                                    <select name="categoria" id="categoria" class="form-control mb-4" required>
                                        <option value="">-----Seleccione-----</option>
                                        <?php foreach($filasCategoriaEvento as $op): ?>
                                            <option value="<?= $op['Codigo'] ?>"> <?= $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>   

                                <div class="col-md-6 col-sm-12">
                                    <label for="nombre" class="font-weight-bold">
                                        Nombre del Evento*
                                    </label>
                                    <input type="text" name="nombre" id="nombre" class="form-control mb-4" placeholder="Nombre" minlength="5" maxlength="500" required>
                                </div> 
                            </div>


                            <!-- FECHA / HORA DE INICIO Y FINALIZACIÓN (TIENEN UN MINIMO DE LA FECHA ACTUAL) -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="fechahoraI" class="font-weight-bold">
                                        Fecha y Hora de Inicio*
                                    </label>
                                    <input type="datetime-local" name="fhinicio" id="fhinicio" class="form-control mb-4" min="<?php echo  date('Y-m-d\TH:i'); ?>" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="fechahoraF" class="font-weight-bold">
                                        Fecha y Hora de Finalización*
                                    </label>
                                    <input type="datetime-local" name="fhfinal" id="fhfinal" class="form-control mb-4" min="<?php echo  date('Y-m-d\TH:i'); ?>" required>
                                </div>
                            </div>


                            <!-- LUGAR DONDE SE REALIZARÁ Y EL COSTO PARA INGRESAR(SI CUENTA CON UNO) -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="lugar" class="font-weight-bold">Lugar / Dirección donde se Realizará*</label>
                                    <input type="text" name="lugar" id="lugar" class="form-control mb-4" placeholder="Dirección" minlength="3" maxlength="100" required>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="valor" class="font-weight-bold">Costo de Entrada</label>
                                    <input type="number" name="valor" id="valor"  class="form-control mb-4" placeholder="Valor($) Entero" min="0" max="99999999">
                                </div>
                            </div>


                            <!-- IMAGEN REPRESENTATIVA DEL EVENTO -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="imagen" class="font-weight-bold">Imagen Representativa del Evento*</label>
                                    <input type="file" name="imagen" id="imagenEvento" class="form-control-file border mb-4" onchange="return validarImgEventos()" accept="image/gif,image/jpeg,image/jpg,image/png" required>

                                    <!-- REVIEW DE LA IMAGEN SELECCIONADA -->
                                    <div id="visorArchivo">   
                                    </div>
                                </div>
                            </div>


                            <!-- DESCRIPCION, CUENTA CON LA HERRAMIENTA CKEDITOR -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="descripcion" class="font-weight-bold">Descripción*</label>
                                    <textarea name="descripcion" id="descEvento" class="form-control mb-4" cols="35" rows="10" required></textarea>
                                </div>
                            </div>


                            <!-- BOTON PARA ENVIAR LA INFORMACION. VALUE = ENVIAR -->
                            <div class="row mt-3">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-menu mb-2" name="enviar" Value="enviar"><b>Enviar Evento</b></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section> 
    <!-- FIN SECCION FORMULARIO -->

    <script>
        Swal.fire({
            icon: 'info',
            title: 'Información!!',
            html: '<b>Importante</b><br><br>Recuerda enviar los siguientes documentos al correo xxx@xxx. Está información es requerida por la <b>Secretaría de Cultura</b> para la óptima aprobación del evento.<br><br>1. Texto Requisito 1. <br>2. Texto Requisito 2. <br>3. Texto Requisito 3. <br>4. Texto Requisito 4. <br>5. Texto Requisito 5. <br>6. Texto Requisito 6. <br>X. Texto Requisito x.',
            width: '700px'
        });
    </script>

    <!-- SCRIPT PARA ACTIVAR EL CKEDITOR EN EL TEXTAREA DEL FORMULARIO -->
    <script>
        CKEDITOR.replace('descEvento', {
            extraPlugins: 'editorplaceholder',
            editorplaceholder: 'Agregue toda la información pertinente del evento...'
        });                                 
    </script>         


<!-- INVOCO EL FOOOTER DEL USUARIO -->
<?php include('includes/footerUsuario.php') ?>
</body>
</html>

<?php
    if(isset($_POST['enviar'])){
        AgregarEventoUsuarioSesion($id);
    }
?>