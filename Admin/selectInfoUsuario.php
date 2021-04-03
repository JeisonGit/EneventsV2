<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    // Recupero el documento del usuario seleccionado
    $documento = $_REQUEST['id'];

    // Informacion del usuario
    $fila = InformacionUsuarioSeleccionado($documento);
    
    // Cantidad de eventos segun el estado
    $eventos = CantidadEventosUsuarioSeleccionado($documento);

    // Funciones para modificar el estado del usuario
    if(isset($_POST['tipoSolicitud'])){
        EstadoUsuario($documento);
    }

?>

<!-- INVOCO EL HEADER DEL ADMIN -->
<?php include('includes/headerAdmin.php') ?>

    <section class="bg-grey">
        <div class="container">

            <input type="button" value="Atrás" class="btn btn-menu mt-3" onClick="history.go(-1);">

            <div class="row">
                <div class="col-lg-12 my-3">
                    <div class="card rounded-2">

                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Información Completa del Usuario</h6>
                        </div>

                        <div class="card-body">

                            <!-- INFORMACIÓN DEL USUARIO -->
                            <div class="row">
                                <div class="col-lg-8">

                                    <div class="row">
                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Tipo de Documento:</b> <?php print $fila['tipoId'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Documento:</b> <?php print $fila['Documento'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Nombres:</b> <?php print $fila['Nombres'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Apellidos:</b> <?php print $fila['Apellidos'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Correo Empresarial:</b><br> <?php print $fila['Correo_empresarial'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Correo Personal:</b><br> <?php print $fila['Correo_personal'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Teléfono Móvil:</b><br> <?php print $fila['Telefono_movil'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Teléfono Fijo:</b><br> <?php print $fila['Telefono_fijo'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Departamento:</b><br> <?php print $fila['Departamento'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Ciudad:</b><br> <?php print $fila['Ciudad'] ?>
                                            </p>
                                            
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Dirección:</b><br> <?php print $fila['Direccion'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-6 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Área de Trabajo:</b><br> <?php print $fila['Area_trabajo'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="row">

                                        <div class="col-lg-12 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Tipo de usuario:</b> <?php print $fila['TipoUsuario'] ?>
                                            </p>
                                        </div>

                                        <div class="col-lg-12 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Estado del Usuario:</b> <?php print $fila['EstadoUsuario'] ?>
                                            </p>
                                        </div>

                                        <?php
                                            while($row = $eventos -> fetch_assoc())
                                            {
                                        ?>
                                        <div class="col-lg-12 my-2">
                                            <p class="card-text">
                                                <b class="font-weight-bold">Eventos <?php print $row['Nombre'] ?>:</b> <?php print $row['cantidad'] ?>
                                            </p>
                                        </div>
                                        <?php
                                            }
                                        ?>

                                        <div class="col-lg-12">
                                            <img src="<?php print $fila['Imagen_entidad'] ?>" alt="" class="img-fluid img-thumbnail img-avatar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FIN INFORMACIÓN DEL USUARIO -->
                            
                            <!-- ACCIONES CON EL USUARIO (BOTONES) -->
                            <div class="row">
                                <div class="col-lg-12 my-3">
                                    <?php
                                        if($fila['EstadoUsuario'] == "Espera"){
                                    ?>

                                        <form method="post" onclick="return confirmActivacion()">
                                            <button type="submit" name="tipoSolicitud" value="Activar" class="btn btn-danger float-right my-3 mx-3">Activar</button>
                                        </form>

                                        <form method="post" onclick="return confirmRechazar()">
                                            <button type="submit" name="tipoSolicitud" value="Rechazar" class="btn btn-danger float-right my-3 mx-3">Rechazar Solicitud</button>
                                        </form>

                                    <?php
                                        }
                                        else if($fila['EstadoUsuario'] == "Activo"){
                                    ?>
                                        <form method="post" onclick="return confirmDesactivacion()">
                                            <button type="submit" name="tipoSolicitud" value="Desactivar" class="btn btn-danger float-right my-3 mx-3 ">Inhabilitar Usuario</button>
                                        </form>
                                    <?php
                                        }
                                        else if($fila['EstadoUsuario'] == "Inactivo"){
                                    ?>
                                        <form method="post" onclick="return confirmActivacion()">
                                            <button type="submit" name="tipoSolicitud" value="Activar" class="btn btn-danger float-right my-3 mx-3">Activar</button>
                                        </form>
                                    <?php
                                        }
                                    ?>

                                    <a href="updateUsuario.php?id=<?php print $fila['Documento'] ?>" class="btn btn-info my-3 mx-3">Modificar Datos</a>

                                    <a href="selectEventosUsuario.php?id=<?php print $fila['Documento']; ?>" class="btn btn-success my-3 mx-3">Eventos Registrados</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FUNCIONES DE VALIDACION DE ACCION -->
    <script type="text/javascript">

        function confirmActivacion(){
            var respuesta = confirm("¿Esta seguro que desea ACTIVAR al usuario y permitirle acceder a las funcionalidades de un creador?");
            if (respuesta == true){
                return true;
            }else{
                return false;
            }
        }

        function confirmRechazar(){
            var respuesta = confirm("¿Esta seguro que desea RECHAZAR la solicitud del usuario?");
            if (respuesta == true){
                return true;
            }else{
                return false;
            }
        }

        function confirmDesactivacion(){
            var respuesta = confirm("¿Esta seguro que desea INHABILITAR al usuario y negarle el acceso a las funcionalidades de un creador?");
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



                                    
                    