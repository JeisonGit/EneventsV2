<?php 
    
    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('includes/funcionesUsuario.php');

    // Funciones que llenan los selects del formulario
    $filasTipoDocumento = listarSelectTipoDocumento();
    $filasAreaTrabajo = listarSelectAreaTrabajo();
    $filasDepartamento = listarSelectDepartamento();

?>

<!-- INVOCO EL HEADER DEL PRINICIPAL -->
<?php include('includes/header.php') ?>

    <!-- LIBRERIA NECESARIAS SELECTS DEPENDIENTES (DEPARTAMENTO - MUNICIPIO) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    <!-- SECCION QUE CONTIENE EL REGISTRO-->
    <div class="container w-100 div-contenido formularios-principales">
        <section class="bg-grey">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10 my-3">
                    <div class="card rounded-2 border border-warning">

                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Información del Usuario</h6>
                        </div>

                        <!-- FORMULARIO -->
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data" class="carta-formulario" onsubmit="return registrarse();">

                                <!-- TIPO DE DOCUMENTO - DOCUMENTO / NIT -->
                                <div class="row">  
                                    <div class="col-md-6 col-sm-12">
                                        <label for="tipoId" class="font-weight-bold">
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
                                        <input type="number" class="form-control mb-4" name="documento" id="documento" placeholder="Cedula / NIT" required>
                                    </div> 
                                </div>
                                
                                <!-- NOMBRES - APELLIDOS -->
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

                                <!-- TELÉFONO MÓVIL Y FIJO -->
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="telefono_movil" class="font-weight-bold">
                                            Teléfono Móvil*
                                        </label>
                                        <input type="number" name="telefono_movil" id="telefono_movil" class="form-control mb-4" placeholder="Telefono Móvil" required>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <label for="telefono_fijo" class="font-weight-bold">
                                            Teléfono Fijo
                                        </label>
                                        <input type="text" name="telefono_fijo" id="telefono_fijo" class="form-control mb-4" placeholder="Teléfono Fijo">
                                    </div>
                                </div>

                                <!-- DEPARTAMENTO -> CIUDAD - AREA DE TRABAJO  -->
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

                                <!-- DIRECCIÓN - AREA DE TRABAJO -->
                                <div class="row mb-3">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="direccion" class="font-weight-bold">
                                            Dirección de Residencia
                                        </label>
                                        <input type="text" name="direccion" id="direccion" class="form-control mb-4" placeholder="Dirección de residencia">
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-12">
                                        <label for="area_trabajo" class="font-weight-bold">
                                            Área de Trabajo*
                                        </label>
                                        <select name="area_trabajo" id="area_trabajo" class="form-control mb-4" required>
                                            <?php foreach($filasAreaTrabajo as $op): ?>
                                                <option value="<?php print $op['Codigo'] ?>"> <?php print $op['Nombre'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                </div>

                                <!-- CONTRASEÑA - CONFIRMAR CONTRASEÑA -->
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

                                <!-- MENSAJE DE POLITICAS - INICIAR SESION - ENVIAR DATOS -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="p-terminos">
                                            <p class="font-weight-bold p-links">Al registrarte, aceptas nuestras Políticas de privacidad y Condiciones de uso <a href="politicas.php" target="_blank">Ver</a> </p>
                                        </div>

                                        <div class="p-login">
                                            <p>¿Ya tienes una cuenta?<a href="iniciarSesion.php" class="font-weight-bold"> Iniciar Sesión</a></p>
                                        </div>

                                        <button type="submit" class="btn btn-buscar mb-2 mt-2" name="Agregar" Value="Agregar"><b>Enviar Registro</b></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- FIN FORMULARIO -->

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- FIN DE LA SECCION DEL REGISTRO -->

    <!-- MENSAJE INFORMATIVO DEL FORMULARIO -->
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Información!!',
            html: '<b>Importante</b><br><br>Por favor, diligenciar el formulario <b>Sólo</b> si desea iniciar un proceso de afiliación con la Secretaría de Cultura para publicar tus eventos.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
    </script>

    <!-- JS Y AJAX PARA LOS SELECTS DEPARTAMENTO - MUNICIPIO -->
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
    <!-- FIN JS Y AJAX -->
   
<!-- INVOCO EL FOOTER PRINCIPAL -->
<?php include('includes/footer.php') ?>
</body>
</html> 

<?php

    // Si se presiona el boton de agregar llamamos la funcion de agregar usuario
    if(isset($_POST['Agregar'])){
        AgregarUsuarioPaginaPrincipal();
    }

?>