<?php 

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');

    // Validacion de sesion
    $id = ValidarSesionUsuario();

    // Obtengo la información del usuario a modificar
    $usuario = InformacionUsuarioSesionModificar($id);
    if($fila = $usuario -> fetch_assoc()){}

    // Selects del formulario
    $filasTipoDocumento = listarSelectTipoDocumento();
    $filasAreaTrabajo = listarSelectAreaTrabajo();
    $filasDepartamento = listarSelectDepartamento();

    // Si se presiona el boton Actualizar, llama a la funcion de modificar
    if(isset($_POST['Actualizar'])){
        ModificarInformacionUsuarioSesion($id);
    }

?>

<!-- INVOCO EL HEADER DEL USUARIO -->
<?php include('includes/headerUsuario.php') ?>

<!-- LIBRERIAS REQUERIDAS PARA REALIZAR LOS SELECT DEPENDIENTES (DEPARTAMENTO - CIUDAD) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <section class="bg-grey">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-10 my-3">
                <input type="button" value="Atrás" class="btn btn-menu my-3" onClick="history.go(-1);">
                <div class="card rounded-2 border border-warning">
                    <div class="card-header container-info">
                        <h6 class="font-weight-bold mb-0">Información Del Usuario</h6>
                    </div>
                    <div class="card-body">

                        <!-- FORMULARIO DATOS DEL USUARIO -->
                        <form action="" method="post" onsubmit="return updateUsuario();" enctype="multipart/form-data" class="carta-formulario">

                            <!-- DOCUMENTO - RELLENO EL SELECT TIPO DE DOCUMENTO CON EL ARRAY CORRESPONDIENTE -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="documento" class="font-weight-bold">
                                        Documento*
                                    </label>
                                    <input type="text" class="form-control mb-4" id="documento" value="<?php print $id ?>" disabled="">
                                </div>   

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
                            </div>

                            <!-- NOMBRES Y APELLIDOS DEL USUARIO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="nombres" class="font-weight-bold">
                                        Nombres*
                                    </label>
                                    <input type="text" name="nombres" id="nombres" class="form-control mb-4" value="<?php print $fila['Nombres'] ?>" placeholder="Nombres" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="apellidos" class="font-weight-bold">
                                        Apellidos
                                    </label>
                                    <input type="text" name="apellidos" id="apellidos" class="form-control mb-4" value="<?php print $fila['Apellidos'] ?>" placeholder="Apellidos">
                                </div>
                            </div>

                            <!-- CORREO EMPRESARIAL Y PERSONAL -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="correo_empresarial" class="font-weight-bold">
                                        Correo Empresarial*
                                    </label>
                                    <input type="email" name="correo_empresarial" id="correo_empresarial" class="form-control mb-4" value="<?php print $fila['Correo_empresarial'] ?>" placeholder="Correo Empresarial" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="correo_personal" class="font-weight-bold">
                                        Correo Personal
                                    </label>
                                    <input type="email" name="correo_personal" id="correo_personal" class="form-control mb-4" value="<?php print $fila['Correo_personal'] ?>" placeholder="Correo Personal">
                                </div>
                            </div>

                            <!-- TELÉFONO MOVIL Y FIJO -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="telefono_movil" class="font-weight-bold">
                                        Teléfono Móvil*
                                    </label>
                                    <input type="number" name="telefono_movil" id="telefono_movil" class="form-control mb-4" value="<?php print $fila['Telefono_movil'] ?>" placeholder="Teléfono Móvil" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="telefono_fijo" class="font-weight-bold">
                                        Teléfono Fijo
                                    </label>
                                    <input type="text" name="telefono_fijo" id="telefono_fijo" class="form-control mb-4" value="<?php print $fila['Telefono_fijo'] ?>" placeholder="Teléfono Fijo">
                                </div>
                            </div>

                            <!-- DEPARTAMENTO Y CIUDAD, SELECTS DEPENDIENTE RELLENADOS CON LA CONSULTA -->
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

                            <!-- AREA DE TRABAJO(SELECT RELLENADO CON CONSULTA) Y DIRECCIÓN DE RESIDENCIA  -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="area_trabajo" class="font-weight-bold">
                                        Área de Trabajo*
                                    </label>
                                    <select name="area_trabajo" id="area_trabajo" class="form-control mb-4" required>
                                        <option value="<?php print $fila['codArea'] ?>"> <?php print $fila['Area_trabajo'] ?> </option>
                                        <?php foreach($filasAreaTrabajo as $op): ?>
                                            <option value="<?php print $op['Codigo'] ?>"> <?php print $op['Nombre'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="direccion" class="font-weight-bold">
                                        Dirección de Residencia
                                    </label>
                                    <input type="text" name="direccion" id="direccion" class="form-control mb-4" value="<?php print $fila['Direccion'] ?>" placeholder="Dirección">
                                </div>
                            </div>

                            <!-- BOTON DE ACCIÓN -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-menu mb-2" name="Actualizar" Value="Actualizar"><b>Modificar</b></button>
                                </div>
                            </div>
                        </form>
                        <!-- FIN FORMULARIO -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JS Y AJAX PARA SELECTS DEPENDIENTES DEPARTAMENTO - MUNICIPIO -->
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
                        url: 'getMunicipios.php'
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
    <!-- FIN AJAX SELECTS DEPENDIENTES -->


<!-- INVOCO EL FOOTER DEL USUARIO -->
<?php include('includes/footerUsuario.php') ?>
</body>
</html>
