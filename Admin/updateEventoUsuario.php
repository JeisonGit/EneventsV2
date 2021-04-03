<?php 
    
    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');
    include('../includes/funcionesEvento.php');

    // Valido la sesion
    $id = ValidarSesionUsuario();

    // Llamo la funcione que contienen las consultas
    $filasCategoria = ListarSelectCategoriaEvento();
    $filasEstado = ListarSelectEstadoEvento();

    // Recupero el codigo del evento seleccionado
    $cod = $_REQUEST['cod'];

    // Llamo la función que recupera los datos del evento seleccionado
    $fila = InformacionEventoModificarAdmin($cod);

    // Formatos de fechas y horas para los datos
    $fechaInicio = date("Y-m-d\TH:i", strtotime($fila['FechaHora_inicio']));
    $fechaFinal = date("Y-m-d\TH:i", strtotime($fila['FechaHora_final']));

    // Si se presiona el boton para modificar llama a la función
    if(isset($_POST['enviar'])){
        ModificarEventoAdmin($id, $cod);
    }

?>

<!-- INVOCO EL HEADER DEL ADMIN -->
<?php include('includes/headerAdmin.php') ?>

    <section class="bg-grey">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-8 my-3">

                <input type="button" value="Atrás" class="btn btn-menu my-3" onClick="history.go(-1);">

                <div class="card rounded-2 border border-warning">

                    <div class="card-header container-info">
                        <h6 class="font-weight-bold mb-0">Modifica los Datos del Evento</h6>
                    </div>

                    <!-- FORMULARIO PARA MODIFICAR LOS DATOS -->
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" class="carta-formulario">

                            <!-- CATEGORIA - NOMBRE DEL EVENTO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="categoria" class="font-weight-bold">
                                        Categoría del Evento*
                                    </label>
                                    <select name="categoria" id="categoria" class="form-control mb-4" required>
                                        <option value="<?= $fila['codCategoria'] ?>"> <?= $fila['Categoria'] ?> </option>
                                        <?php foreach($filasCat as $op): ?>
                                            <option value="<?= $op['Codigo'] ?>"> <?= $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>   

                                <div class="col-md-6 col-sm-12">
                                    <label for="nombre" class="font-weight-bold">
                                        Nombre del Evento*
                                    </label>
                                    <input type="text" name="nombre" id="nombre" class="form-control mb-4" placeholder="Nombre" value="<?php echo $fila['Nombre'] ?>" minlength="5" maxlength="500" required>
                                </div> 
                            </div>
                            
                            <!-- FECHAS Y HORAS DE INICIO Y FINALIZACIPON -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="fechahoraI" class="font-weight-bold">
                                        Fecha y Hora de Inicio*
                                    </label>
                                    <input type="datetime-local" name="fhinicio" id="fhinicio" class="form-control mb-4" min="<?php echo  date('Y-m-d\TH:i'); ?>" value="<?php print $fechaInicio ?>" required>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="fechahoraF" class="font-weight-bold">
                                        Fecha y Hora de Finalización*
                                    </label>
                                    <input type="datetime-local" name="fhfinal" id="fhfinal" class="form-control mb-4" min="<?php echo date('Y-m-d\TH:i'); ?>" value="<?php print $fechaFinal ?>" required>
                                </div>
                            </div>

                            <!-- LUGAR Y VALOR DE ENTRADA -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="lugar" class="font-weight-bold">
                                        Lugar de Realización*
                                    </label>
                                    <input type="text" name="lugar" id="lugar" class="form-control mb-4" placeholder="Dirección" value="<?php echo $fila['Lugar'] ?>" minlength="3" maxlength="100" required>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="valor" class="font-weight-bold">
                                        Costo de Entrada
                                    </label>
                                    <input type="number" name="valor" id="valor"  class="form-control mb-4" placeholder="Valor" value="<?php echo $fila['Valor'] ?>" min="0" max="99999999">
                                </div>
                            </div>

                            <!-- IMAGEN DEL EVENTO CON REVIEW Y ESTADO DEL EVENTO -->
                            <div class="row mb-4">
                                <div class="col-md-6 col-sm-12">
                                    <label for="imagen" class="font-weight-bold">
                                        Imagen Representativa del Evento*
                                    </label>
                                    <input type="file" name="imagen" id="imagen" class="form-control-file border mb-4" onchange="return validarImgEventos()" accept="image/gif,image/jpeg,image/jpg,image/png">
                                    <div id="visorArchivo">
                                        <img src="<?php print $fila['Imagen'] ?>" alt="" class="img-fluid img-thumbnail img-avatar">
                                            <!-- Se despliega el review de la img -->
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="Estado" class="font-weight-bold">Estado del Evento*</label>
                                    <select name="estado" id="estado" class="form-control mb-4" required>
                                        <option value="<?= $fila['codEstado'] ?>"> <?= $fila['estadoEvento'] ?> </option>
                                        <?php foreach($filasEstado as $op): ?>
                                            <option value="<?= $op['Codigo'] ?>"> <?= $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> 
                            </div>

                            <!-- DESCRIPCION CON CKEDITOR -->
                            <div class="row mb-3">
                                <div class="col-md-12 col-sm-12">
                                    <label for="descripcion" class="font-weight-bold">
                                        Descripción
                                    </label>
                                    <textarea name="descripcion" id="descEvento" class="form-control mb-4" cols="35" rows="10" required><?php echo $fila['Descripcion'] ?></textarea>
                                </div>
                            </div>

                            <!-- BOTON PARA ENVIAR -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-menu mb-2" name="enviar" Value="enviar"><b>Modificar</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- FIN FORMULARIO -->

                </div>
            </div>
        </div>
    </section>

    <!-- ACTIVAR CKEDITOR EN EL TEXTAREA DEL FORMULARIO -->
    <script>
        CKEDITOR.replace('descEvento', {
            extraPlugins: 'editorplaceholder',
            editorplaceholder: 'Agregue toda la información pertinente del evento...'
        });                                 
    </script>

<!-- INVOCO EL FOOTER DEL ADMIN -->
<?php include('includes/footerAdmin.php') ?>
</body>
</html>
