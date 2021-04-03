<?php 

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');

    // Valida la sesion
    $id = ValidarSesionUsuario();
    
    // Recupero el documento del usuario seleccionado
    $documento = $_REQUEST['id'];

    // Funciones que llenan los selects del formulario
    $filasTipoDocumento = listarSelectTipoDocumento();
    $filasAreaTrabajo = listarSelectAreaTrabajo();
    $filasDepartamento = listarSelectDepartamento();
    $filasTipoUsuario = listarSelectTipoUsuario();
    $filasEstadoUsuario = listarSelectEstadoUsuario();

    // Informacion del usuario
    $fila = InformacionUsuarioModificar($documento);

    if(isset($_POST['Modificar'])){
        ModificarUsuario($documento);
    }

?>

<!-- INVOCO EL HEADER DEL ADMIN -->
<?php include('includes/headerAdmin.php') ?>

    <!-- LIBRERIAS PARA LOS SELECTS DEPENDIENTES (DEPARTAMENTO - MUNICIPIO) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <section class="bg-grey">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-10 my-3">

                <input type="button" value="Atrás" class="btn btn-menu my-3" onClick="history.go(-1);">

                <div class="card rounded-2 border border-warning">

                    <div class="card-header container-info">
                        <h6 class="font-weight-bold mb-0">Modifica los Datos del Usuario</h6>
                    </div>

                    <!-- FORMULARIO -->
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" onsubmit="return updateUsuario();" class="carta-formulario">

                            <!-- TIPO DE DOCUMENTO Y DOCUMENTO / NIT -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="tipo_documento" class="font-weight-bold">
                                        Tipo de Documento*
                                    </label>
                                    <select name="tipo_documento" id="tipoId" class="form-control mb-4" required>
                                        <option value="<?php print $fila['codTipoId'] ?>"> <?php print $fila['tipoId'] ?> </option>
                                        <?php foreach($filasTipoDocumento as $op): ?>
                                            <option value="<?php print $op['Codigo'] ?>"> <?php print $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>      
                                    </select>
                                </div> 

                                <div class="col-md-6 col-sm-12">
                                    <label for="documento" class="font-weight-bold">
                                        Documento*
                                    </label>
                                    <input type="number" id="documento" class="form-control mb-4" value="<?php print $fila['Documento'] ?>" placeholder="Documento - Nit" disabled>
                                </div>   
                            </div>

                            <!-- NOMBRES Y APELLIDOS -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="nombres" class="font-weight-bold">
                                        Nombres*
                                    </label>
                                    <input type="text" name="nombres" id="nombres" value="<?php print $fila['Nombres'] ?>" class="form-control mb-4" placeholder="Nombres" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="apellidos" class="font-weight-bold">
                                        Apellidos
                                    </label>
                                    <input type="text" name="apellidos" id="apellidos" value="<?php print $fila['Apellidos'] ?>" class="form-control mb-4" placeholder="Apellidos">
                                </div>
                            </div>

                            <!-- CORREO EMPRESARIAL Y PERSONAL -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="correo_empresarial" class="font-weight-bold">
                                        Correo Empresarial*
                                    </label>
                                    <input type="email" name="correo_empresarial" id="correo_empresarial" value="<?php print $fila['Correo_empresarial'] ?>" class="form-control mb-4" placeholder="Correo Empresarial" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="correo_personal" class="font-weight-bold">
                                        Correo Personal
                                    </label>
                                    <input type="email" name="correo_personal" id="correo_personal" value="<?php print $fila['Correo_personal'] ?>" class="form-control mb-4" placeholder="Correo Personal">
                                </div>
                            </div>

                            <!-- TELEFONO MOVIL Y FIJO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="telefono_movil" class="font-weight-bold">
                                        Teléfono Móvil*
                                    </label>
                                    <input type="number" name="telefono_movil" id="telefono_movil" value="<?php print $fila['Telefono_movil'] ?>" class="form-control mb-4" placeholder="Teléfono Móvil" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="telefono_fijo" class="font-weight-bold">
                                        Teléfono Fijo
                                    </label>
                                    <input type="text" name="telefono_fijo" id="telefono_fijo" value="<?php print $fila['Telefono_fijo'] ?>" class="form-control mb-4" placeholder="Teléfono Fijo">
                                </div>
                            </div>

                            <!-- DEPARTAMENTO Y MUNICIPIO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="departamento" class="font-weight-bold">
                                        Departamento*
                                    </label>
                                    <select name="departamento" id="departamento" class="form-control mb-4" required>
                                        <option value="<?php print $fila['codDepart'] ?>"> <?php print $fila['Departamento'] ?> </option>
                                        <?php foreach($filasDepartamento as $op): ?>
                                            <option value="<?= $op['Codigo'] ?>"> <?= $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>    
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="ciudad" class="font-weight-bold">
                                        Ciudad*
                                    </label>
                                    <select name="ciudad" id="ciudad" class="form-control mb-4" required>
                                        <option value="<?php print $fila['codCiudad'] ?>"> <?php print $fila['Ciudad'] ?> </option>
                                    </select>
                                </div>
                            </div>

                            <!-- AREA DE TRABAJO Y DIRECCION DE RESIDENCIA -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="area_trabajo" class="font-weight-bold">
                                        Área de Trabajo*
                                    </label>
                                    <select name="area_trabajo" id="area_trabajo"  class="form-control mb-4" required>
                                        <option value="<?php print $fila['codArea'] ?>"> <?php print $fila['Area_trabajo'] ?> </option>
                                        <?php foreach($filasAreaTrabajo as $op): ?>
                                            <option value="<?php print $op['Codigo'] ?>"> <?php print $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="direccion" class="font-weight-bold">
                                        Dirección
                                    </label>
                                    <input type="text" name="direccion" id="direccion" value="<?php print $fila['Direccion'] ?>" class="form-control mb-4"  placeholder="Dirección">
                                </div>
                            </div>

                            <!-- TIPO DE USUARIO Y ESTADO DEL USUARIO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="tipo_usuario" class="font-weight-bold">
                                        Tipo de Usuario*
                                    </label>
                                    <select name="tipo_usuario" id="tipo_usuario" class="form-control mb-4" required>
                                        <option value="<?php print $fila['codTipo'] ?>"> <?php print $fila['TipoUsuario'] ?> </option>
                                        <?php foreach($filasTipoUsuario as $op): ?>
                                            <option value="<?php print $op['Codigo'] ?>"> <?php print $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>      
                                    </select>
                                </div> 

                                <div class="col-md-6 col-sm-12">
                                    <label for="estado_usuario" class="font-weight-bold">
                                        Estado del Usuario*
                                    </label>
                                    <select name="estado_usuario" id="estado_usuario" class="form-control mb-4" required>
                                        <option value="<?php print $fila['codEstado'] ?>"> <?php print $fila['EstadoUsuario'] ?> </option>
                                        <?php foreach($filasEstadoUsuario as $op): ?>
                                            <option value="<?php print $op['Codigo'] ?>"> <?php print $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>      
                                    </select>
                                </div> 
                            </div>

                            <!-- IMAGEN RESPRESENTATIVA DE LA ENTIDAD CON REVIEW -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="imagen" class="font-weight-bold">Imagen Representativa de la Entidad</label>
                                    <input type="file" name="imagen" id="imagenEvento" class="form-control-file border mb-4" onchange="return validarImgEventos()" accept="image/gif,image/jpeg,image/jpg,image/png">
                                    
                                    <div id="visorArchivo">
                                        <img src="<?php print $fila['Imagen_entidad'] ?>" alt="" class="img-fluid img-thumbnail img-avatar">
                                        <!-- Se despliega el review de la img -->
                                    </div>
                                </div>
                            </div>

                            <!-- SI EL USUARIO A MODIFICAR ES CREADOR, SE LE PUEDE MODIFICAR LA CONTRASEÑA -->
   
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mt-4">
                                    <label for="password" class="font-weight-bold">Contraseña</label>
                                    <input type="password" name="password" id="password" class="form-control mb-4" placeholder="Contraseña">
                                </div>

                                <div class="col-md-6 col-sm-12 mt-4">
                                    <label for="confirmpass" class="font-weight-bold">Confirmar Contraseña</label>
                                    <input type="password" name="confirmpass" id="confirmpass" class="form-control mb-4" placeholder="Confirmar Contraseña">
                                </div>
                            </div>  


                            <!-- BOTON ENVIAR -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-menu mb-2" name="Modificar" Value="Modificar"><b>Modificar</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- FIN FORMULARIO -->

                </div>
            </div>
        </div>
    </section>
            
    <!-- JS Y AJAX PARA DEPARTAMENTO MUNICIPIO -->
    <script type="text/javascript">
        $(document).ready(function(){
            var ciudad = $('#ciudad');

            $('#departamento').change(function(){
                var Departamento = $(this).val();

                if(Departamento !== ''){

                    $.ajax({
                        data: {Departamento:Departamento},
                        dataType: 'html',
                        type: 'POST',
                        url: 'get_municipios.php'
                    }).done(function(data){
                        ciudad.html(data);
                        ciudad.prop('disabled', false);
                    });
                } else{
                    ciudad.val('');
                    ciudad.prop('disabled', true);
                }
            });
        })
    </script>

    <!-- INVOCO EL FOOTER DEL ADMIN -->
    <?php include('includes/footerAdmin.php') ?>
</body>
</html>

