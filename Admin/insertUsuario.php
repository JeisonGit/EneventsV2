<?php 

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    // Funciones que llenan los selects del formulario
    $filasTipoDocumento = listarSelectTipoDocumento();
    $filasAreaTrabajo = listarSelectAreaTrabajo();
    $filasDepartamento = listarSelectDepartamento();
    $filasTipoUsuario = listarSelectTipoUsuario();
    $filasEstadoUsuario = listarSelectEstadoUsuario();

    if(isset($_POST['Agregar'])){
        AgregarUsuario();
    }

?>

<!-- INVICO EL HEADER DEL ADMIN -->
<?php include('includes/headerAdmin.php') ?>

    <!-- LIBRERIAS NECESARIAS PARA LOS SELECTS DEPENDIENTES (DEPARTAMENTO - MUNICIPIO) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- SECCION QUE CONTIENE EL FORMULARIO PARA INGRESAR LOS DATOS DEL USUARIO -->
    <section class="bg-grey">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-10 my-3">

                <div class="card rounded-2 border border-warning">

                    <div class="card-header container-info">
                        <h6 class="font-weight-bold mb-0">Ingresa los Datos del Nuevo Usuario</h6>
                    </div>
                    
                    <!-- FORMULARIO -->
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" class="carta-formulario" onsubmit="return agregarUsuario();">

                            <!-- TIPO DE DOCUMENTO Y DOCUMENTO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="tipo_documento" class="font-weight-bold">
                                        Tipo de Documento*
                                    </label>
                                    <select name="tipo_documento" id="tipoId" class="form-control mb-4" required>
                                        <?php foreach($filasTipoDocumento as $op): ?>
                                            <option value="<?php print $op['Codigo'] ?>"> <?php print $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>      
                                    </select>
                                </div> 

                                <div class="col-md-6 col-sm-12">
                                    <label for="documento" class="font-weight-bold">
                                        Documento*
                                    </label>
                                    <input type="number" name="documento" id="documento" class="form-control mb-4" placeholder="Documento - Nit" required>
                                </div>  
                            </div>

                            <!-- NOMBRES Y APELLIDOS -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="nombres" class="font-weight-bold">
                                        Nombres*
                                    </label>
                                    <input type="text" name="nombres" id="nombres" class="form-control mb-4" placeholder="Nombres" required>
                                </div>
                                
                                <div class="col-md-6 col-sm-12">
                                    <label for="apellidos" class="font-weight-bold">
                                        Apellidos
                                    </label>
                                    <input type="text" name="apellidos" id="apellidos" class="form-control mb-4" placeholder="Apellidos">
                                </div>
                            </div>

                            <!-- CORREO EMPRESARIAL Y PERSONAL -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="correo_empresarial" class="font-weight-bold">
                                        Correo Empresarial*
                                    </label>
                                    <input type="email" name="correo_empresarial" id="correo_empresarial" class="form-control mb-4" placeholder="Correo Empresarial" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="correo_personal" class="font-weight-bold">
                                        Correo Personal
                                    </label>
                                    <input type="email" name="correo_personal" id="correo_personal" class="form-control mb-4" placeholder="Correo Personal">
                                </div>
                            </div>

                            <!-- TELEFONO MOVIL Y FIJO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="telefono_movil" class="font-weight-bold">
                                        Teléfono Móvil*
                                    </label>
                                    <input type="number" name="telefono_movil" id="telefono_movil" class="form-control mb-4" placeholder="Teléfono Móvil" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="telefono_fijo" class="font-weight-bold">
                                        Teléfono Fijo
                                    </label>
                                    <input type="text" name="telefono_fijo" id="telefono_fijo" class="form-control mb-4" placeholder="Teléfono Fijo">
                                </div>
                            </div>

                            <!-- DEPARTAMENTO Y MUNICIPIO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="departamento" class="font-weight-bold">
                                        Departamento*
                                    </label>
                                    <select name="departamento" id="departamento" class="form-control mb-4" required>
                                        <option value="">- Seleccione -</option>
                                        <?php foreach($filasDepartamento as $op): ?>
                                            <option value="<?= $op['Codigo'] ?>"> <?= $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>    
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="ciudad" class="font-weight-bold">
                                        Ciudad*
                                    </label>
                                    <select name="ciudad" id="ciudad" class="form-control mb-4" disabled="" required>
                                        <option value="">- Seleccione -</option>
                                    </select>
                                </div>
                            </div>

                            <!-- AREA DE TRABAJO Y DIRECCION DE RESIDENCIA -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="area_trabajo" class="font-weight-bold">
                                        Área De Trabajo*
                                    </label>
                                    <select name="area_trabajo" id="area_trabajo" class="form-control mb-4" required>
                                        <?php foreach($filasAreaTrabajo as $op): ?>
                                            <option value="<?php print $op['Codigo'] ?>"> <?php print $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="direccion" class="font-weight-bold">
                                        Dirección
                                    </label>
                                    <input type="text" name="direccion" id="direccion" class="form-control mb-4"  placeholder="Dirección">
                                </div>
                            </div>

                            <!-- TIPO DE USUARIO Y ESTADO DEL USUARIO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="tipo_usuario" class="font-weight-bold">
                                        Tipo de Usuario*
                                    </label>
                                    <select name="tipo_usuario" id="tipo_usuario" class="form-control mb-4" required>
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
                                        <?php foreach($filasEstadoUsuario as $op): ?>
                                            <option value="<?php print $op['Codigo'] ?>"> <?php print $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>      
                                    </select>
                                </div> 
                            </div>

                            <!-- IMAGEN DE LA ENTIDAD CON REVIEW -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="imagen" class="font-weight-bold">Imagen Representativa de la Entidad</label>
                                    <input type="file" name="imagen" id="imagenEvento" class="form-control-file border mb-4" onchange="return validarImgEventos()" accept="image/gif,image/jpeg,image/jpg,image/png">
                                    <div id="visorArchivo">
                                            <!-- Se despliega el review de la img -->
                                    </div>
                                </div>
                            </div>

                            <!-- CONTRASEÑA Y CONFIRMAR CONTRASEÑA -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="password" class="font-weight-bold">
                                        Contraseña*
                                    </label>
                                    <input type="password" name="password" id="password" class="form-control mb-4" placeholder="Contraseña" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="confirmpass" class="font-weight-bold">
                                        Confirmar Contraseña*
                                    </label>
                                    <input type="password" name="confirmpass" id="confirmpass" class="form-control mb-4" placeholder="Confirmar Contraseña" required>
                                </div>
                            </div>

                            <!-- BOTON -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-menu mb-2" name="Agregar" Value="Agregar"><b>Agregar</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- FIN FORMULARIO -->

                </div>
            </div>
        </div>
    </section>
            
    <!-- JS Y AJAX PARA LOS SELECTS DEPENDIENTES (DEPARTAMENTO - MUNICIPIO) -->
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
