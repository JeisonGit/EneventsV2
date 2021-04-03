<?php 

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    // Imagen actual del usuario
    $imgUsuario = BuscarImagenUsuarioSesion($id);

    // Si se oprime el boton CambiarImagen llama la funcion que realiza el proceso
    if(isset($_POST['CambiarImagen'])){
        ModificarImagenUsuarioSesion($id);
    }

    // Si se oprime el boton CambiarContrasena llama la funcion que realiza el proceso
    if(isset($_POST['CambiarContrasena'])){
        ModificarContrasenaUsuarioSesion($id);
    }  
?>

<!-- INVOCO EL HEADER DEL USUARIO -->
<?php include('includes/headerUsuario.php') ?>

    <!-- ESTA SECCION CONTIENE LA CARD PARA CAMBIAR LA CONTRASEÑA Y EL FORM PARA CAMBIAR LA IMAGEN DEL USUARIO -->
    <section class="bg-grey">
        <div class="container">
            <div class="row">

                <!-- CARD INFORMACIÓN PARA CAMBIAR LA CONTRASEÑA -->
                <div class="col-lg-5 my-3">
                    <div class="card rounded-2">

                        <!-- TITULO CARD -->
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Cambiar contraseña</h6>
                        </div>

                        <!-- FORMULARIO -->
                        <form action="" method="post" onsubmit="return cambiarContrasena();">
                            <div class="card-body">

                                <!-- INPUT DONDE SE DEBE INGRESAR LA CONTRASEÑA QUE HAY ACTUAL EN LA BD -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label for="contrasena" class="font-weight-bold">Digite la Contraseña Antigua*</label>
                                        <input type="password" class="form-control mb-4" name="contrasenaA" placeholder="Digitela Aquí">
                                    </div> 
                                </div>

                                <!-- INPUT DONDE SE DEBE INGRESAR LA NUEVA CONTRASEÑA QUE REEMPLAZARÁ A LA QUE HAY ACTUALMENTE EN LA BD -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label for="contrasena" class="font-weight-bold">Digite la Contraseña Nueva*</label>
                                        <input type="password" class="form-control mb-4" name="contrasenaN" id="contrasenaN" placeholder="Digitela Aquí">
                                    </div> 
                                </div>

                                <!-- INPUT DONDE SE DEBE INGRESAR LA CONFIRMACIÓN DE LA NUEVA CONTRASEÑA -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label for="contrasena" class="font-weight-bold">Confirmar Contraseña Nueva*</label>
                                        <input type="password" class="form-control mb-4" name="confirmN" id="confirmN" placeholder="Digitela Aquí">
                                    </div> 
                                </div>

                                <!-- BOTON QUE ENVIA LOS DATOS -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-menu mb-2" name="CambiarContrasena" Value="CambiarContrasena"><b>Cambiar</b></button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- FIN CARD CAMBIAR LA CONTRASEÑA -->

                <!-- CARD INFORMACIÓN PARA CAMBIAR LA IMAGEN DE PERFIL DEL USUARIO -->
                <div class="col-lg-5 my-3">
                    <div class="card rounded-2">

                        <!-- TITULO CARD -->
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Cambiar Imagen de Perfil</h6>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <!-- DIV QUE CONTIENE LA IMAGEN ACTUAL DEL USUARIO -->
                                <div class="col-md-12 col-sm-12" align="center">
                                    <img src="<?php print $imgUsuario['Imagen_entidad'] ?>" class="img-fluid img-thumbnail img-avatar" alt="">
                                </div> 

                            </div>

                            <hr>

                            <!-- FORMULARIO PARA ENVIAR NUEVA IMAGEN -->
                            <form action="" method="post" enctype="multipart/form-data" onsubmit="return cambiarImagen();">
                                
                                <!-- INPUT TYPE FILE PARA AGREGAR LA IMAGEN -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label for="contrasena" class="font-weight-bold">
                                            Seleccionar Nueva Imagen
                                        </label>

                                        <input type="file" class="form-control-file mb-4" name="imagenUsuario" id="imagenEvento" onchange="return validarImgEventos()" accept="image/gif,image/jpeg,image/jpg,image/png">

                                        <!-- ESTE DIV DESPLIEGA UN REVIEW DE LA IMAGEN SELECCIONADA -->
                                        <div id="visorArchivo" align="center">
                                        </div>

                                    </div> 
                                </div>

                                <!-- BOTON PARA ENVIAR EL DATO -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-menu mb-2" name="CambiarImagen" Value="CambiarImagen"><b>Cambiar</b></button>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
                <!-- FIN CARD CAMBIAR IMAGEN PERFIL -->

            </div>
        </div>
    </section>

<!-- INVOCO EL FOOTER DEL USUARIO -->
<?php include('includes/footerUsuario.php') ?>
</body>
</html>

