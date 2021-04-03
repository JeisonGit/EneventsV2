<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');
    include('../includes/funcionesEvento.php');

    // Valido la sesion
    $id = ValidarSesionUsuario();

    // Llamo la funcione que contienen las consultas
    $filasCategoria = ListarSelectCategoriaEvento();
    $filasEstado = ListarSelectEstadoEvento();

    // Recupero el documento del usuario seleccionado
    $usuario = $_REQUEST['id'];

    // Si se oprime el boton del formularia llama la funcion
    if(isset($_POST['enviar'])){
        AgregarEventoAdmin($usuario);
    }

    // Zona Horaria
    date_default_timezone_set('America/Bogota');

?>

<!-- INVOCO EL HEADER DEL ADMIN -->
<?php include('includes/headerAdmin.php') ?>

    <!-- SECCION QUE CONTIENE EL FORMULARIO PARA ASOCIAR UN NUEVO EVENTO A UN USUARIO SELECCIONADO -->
    <section class="bg-grey">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-10 my-3">

                <input type="button" value="Atrás" class="btn btn-menu my-3" onClick="history.go(-1);">

                <div class="card rounded-2 border">

                    <div class="card-header container-info">
                        <h6 class="font-weight-bold mb-0">Ingresa la Información del Evento</h6>
                    </div>

                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" class="carta-formulario" >

                            <!-- CATEGORIA Y NOMBRE DEL EVENTO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="categoria" class="font-weight-bold">
                                        Categoría del Evento*
                                    </label>
                                    <select name="categoria" id="categoria" class="form-control mb-4" required>
                                        <option value="">-----Seleccione-----</option>
                                        <?php foreach($filasCategoria as $op): ?>
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

                            <!-- FECHA Y HORA DE INICIO Y FINALIZACIÓN -->
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

                            <!-- LUGAR Y COSTO DE ENTRADA AL EVENTO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="lugar" class="font-weight-bold">
                                        Lugar de Realización*
                                    </label>
                                    <input type="text" name="lugar" id="lugar" class="form-control mb-4" placeholder="Dirección" minlength="3" maxlength="100" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="valor" class="font-weight-bold">
                                        Costo de Entrada
                                    </label>
                                    <input type="number" name="valor" id="valor"  class="form-control mb-4" placeholder="Valor" min="0" max="99999999">
                                </div>
                            </div>

                            <!-- IMAGEN REPRESENTATIVA CON REVIEW Y ESTADO DEL EVENTO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="imagen" class="font-weight-bold">
                                        Imagen Representativa del Evento*
                                    </label>
                                    <input type="file" name="imagen" id="imagenEvento" class="form-control-file border mb-4" onchange="return validarImgEventos()" accept="image/gif,image/jpeg,image/jpg,image/png" required>
                                    <div id="visorArchivo">
                                            <!-- Se despliega el review de la img -->
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="Estado" class="font-weight-bold">
                                        Estado del Evento*
                                    </label>
                                    <select name="estado" id="estado" class="form-control mb-4" required>
                                        <option value="">-----Seleccione-----</option>
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
                                        Descripción*
                                    </label>
                                    <textarea name="descripcion" id="descEvento" class="form-control mb-4" cols="35" rows="10" required></textarea>
                                </div>
                            </div>
                            
                            <!-- BOTON DE AGREGAR ELE EVENTO -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-menu mb-2" name="enviar" Value="enviar"><b>Agregar Evento</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>    

    <!-- ACTIVAR EL CKEDITOR EN EL TEXTAREA DEL FORMULARIO -->
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