<?php 

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesEvento.php');
    include('../includes/funcionesUsuario.php');

    // Llenar el select categoria
    $filasCategoriaEvento = ListarSelectCategoriaEvento();

    $id = ValidarSesionUsuario();

    // Recupero el codigo del evento seleccionado a modificar
    $codEvento = $_REQUEST['cod'];

    // Función que contiene la información del evento
    $fila = InformacionEventoModificar($codEvento);

    // Formatos de fechas y horas
    $fechaInicio = date("Y-m-d\TH:i", strtotime($fila['FechaHora_inicio']));
    $fechaFinal = date("Y-m-d\TH:i", strtotime($fila['FechaHora_final']));

    // Zona Horaria
    date_default_timezone_set('America/Bogota');

    // Si se presiona el boton enviar, llama la funcion que modifica los datos del evento
    if(isset($_POST['enviar'])){
        ModificarEventoUsuarioSesion($codEvento, $id);
    }
 
?>

<!-- INVOCO EL HEADER DEL USUARIO -->
<?php include('includes/headerUsuario.php') ?>

    <!-- FORMULARIO DEL EVENTO -->
    <section class="bg-grey">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-8 my-3">
                <input type="button" value="Atrás" class="btn btn-menu my-3" onClick="history.go(-1);">
                <div class="card rounded-2 border border-warning">
                    <div class="card-header container-info">
                        <h6 class="font-weight-bold mb-0">Modificar Información del Evento</h6>
                    </div>
                    <div class="card-body">

                        <!-- INICIO FORMULARIO -->
                        <form action="" method="post" enctype="multipart/form-data" class="carta-formulario">

                            <div class="row">
                                <!-- CATEGORIA DEL EVENTO. SE LLENA CON LA CONSULTA QUE REALIZAMOS -->
                                <div class="col-md-6 col-sm-12">
                                    <label for="categoria" class="font-weight-bold">
                                        Categoría del Evento*
                                    </label>
                                    <select name="categoria" id="categoria" class="form-control mb-4" required>
                                        <option value="<?= $fila['codCategoria'] ?>"> <?= $fila['Categoria'] ?> </option>
                                        <?php foreach($filasCategoriaEvento as $op): ?>
                                            <option value="<?= $op['Codigo'] ?>"> <?= $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>  
                                
                                <!-- NOMBRE DEL EVENTO -->
                                <div class="col-md-6 col-sm-12">
                                    <label for="nombre" class="font-weight-bold">
                                        Nombre del Evento*
                                    </label>
                                    <input type="text" name="nombre" id="nombre" class="form-control mb-4" placeholder="Nombre" value="<?php echo $fila['Nombre'] ?>" minlength="5" maxlength="500" required>
                                </div> 
                            </div>


                            <!-- FECHA / HORA DE INICIO Y FINALIZACIÓN -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="fhinicio" class="font-weight-bold">
                                        Fecha y Hora de Inicio*
                                    </label>
                                    <input type="datetime-local" name="fhinicio" id="fhinicio" class="form-control mb-4" min="<?php echo  date('Y-m-d\TH:i'); ?>" value="<?php print $fechaInicio ?>" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="fhfinal" class="font-weight-bold">
                                        Fecha y Hora de Finalización*
                                    </label>
                                    <input type="datetime-local" name="fhfinal" id="fhfinal" class="form-control mb-4" min="<?php echo  date('Y-m-d\TH:i'); ?>" value="<?php print $fechaFinal ?>" required>
                                </div>
                            </div>

                            
                            <!-- LUGAR DE REALIZACIÓN Y COSTO DE ENTRADA -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="lugar" class="font-weight-bold">
                                        Lugar de Realización*
                                    </label>
                                    <input type="text" name="lugar" id="lugar" class="form-control mb-4" placeholder="Dirección" value="<?php echo $fila['Lugar'] ?>" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="valor" class="font-weight-bold">
                                        Costo de Entrada
                                    </label>
                                    <input type="number" name="valor" id="valor"  class="form-control mb-4" placeholder="Valor" value="<?php echo $fila['Valor'] ?>" min="0" max="99999999">
                                </div>
                            </div>


                            <!-- IMAGEN REPRESENTATIVA -->
                            <div class="row mb-4">
                                <div class="col-md-12 col-sm-12">
                                    <label for="imagen" class="font-weight-bold">
                                        Imagen Representativa del Evento*
                                    </label>
                                    <input type="file" name="imagen" id="imagenEvento" class="form-control-file border mb-4" onchange="return validarImgEventos()" accept="image/gif,image/jpeg,image/jpg,image/png">

                                    <!-- REVIEW DE LA IMAGEN BD Y LA NUEVA -->
                                    <div id="visorArchivo">
                                        <img src="<?php print $fila['Imagen'] ?>" alt="" class="img-fluid img-thumbnail img-avatar">
                                            
                                    </div>
                                </div>
                            </div>


                            <!-- DESCRIPCIÓN DEL EVENTO -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="descripcion" class="font-weight-bold">
                                        Descripción
                                    </label>
                                    <textarea name="descripcion" id="descEvento" class="form-control mb-4" cols="35" rows="10" required><?php echo $fila['Descripcion'] ?></textarea>
                                </div>
                            </div>


                            <!-- BOTON -->
                            <div class="row my-3">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-menu" name="enviar" Value="enviar"><b>Modificar</b></button>
                                </div>
                            </div>
                        </form>
                        <!-- FIN FORMULARIO -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FIN SECCION QUE CONTIENE EL FORMULARIO -->
                                            
    
    <!-- ACTIVA EL CKEDITOR PARA EL TEXTAREA DEL FORMULARIO -->
    <script>
        CKEDITOR.replace('descEvento', {
            extraPlugins: 'editorplaceholder',
            editorplaceholder: 'Agregue toda la información pertinente del evento...'
        });                                 
    </script>


<!-- INVOCO EL FOOTER DEL USUARIO -->
<?php include('includes/footerUsuario.php') ?>
</body>
</html>