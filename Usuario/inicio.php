<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    // Consulta de la información del usuario que inicio sesion y la agrego a un array
    $usuario = InformacionUsuarioSesion($id);
    if($fila = $usuario -> fetch_assoc()){}

    // Cantidad de eventos que tiene el usuario clasificados por Estado
    $eventos = CantidadEventosEstadoUsuario($id); 
    
?>

<!-- INVOCO EL HEADER DEL USUARIO -->
<?php include('includes/headerUsuario.php') ?>

        <!-- ESTA SECCION CONTIENE EL MENSAJE DE BIENVENIDA Y EL BOTON PARA VISUALIZAR EL MANUAL DE USUARIO -->
        <section class="py-3 bg-white">
            <div class="container">
                <div class="row">

                    <!-- MENSAJE BIENVENIDA -->
                    <div class="col-lg-9">
                        <h1 class="font-weight-bold mb-0">Bienvenido <?php print $fila['Nombres'] ?></h1>
                        <p class="lead text-muted">Revisa tu información</p>
                    </div>

                    <!-- MANUAL DEL USUARIO -->
                    <div class="col-lg-3 d-flex">
                        <a href="../archivos/pdf/ManualUsuario.pdf" class="btn btn-menu w-100 align-self-center" target="_blank">Manual de Usuario</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- FIN MENSAJE DE BIENVENIDA - MANUAL DE USUARIO -->


        <!-- ESTA SECCION CONTIENE LA INFORMACION DEL USUARIO Y LA CANTIDAD DE EVENTOS -->
        <section class="bg-grey">
            <div class="container">
                <div class="row">

                    <!-- CARD QUE CONTIENE LA INFORMACIÓN DEL USUARIO -->
                    <div class="col-lg-8 my-3">
                        <div class="card rounded-2">

                            <div class="card-header container-info">
                                <h6 class="font-weight-bold mb-0">Información Personal</h6>
                            </div>

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <b class="font-weight-bold">Tipo de Documento:</b> <?php print $fila['tipoId'] ?>
                                        </p>
                                    </div>  
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <b class="font-weight-bold">Documento:</b> <?php print $fila['Documento'] ?>
                                        </p>
                                    </div>  
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <b class="font-weight-bold">Nombres:</b> <?php print $fila['Nombres'] ?>
                                        </p>
                                    </div>  
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <b class="font-weight-bold">Apellidos:</b> <?php print $fila['Apellidos'] ?>
                                        </p>
                                    </div>  
                                </div>   

                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <b class="font-weight-bold">Correo Empresarial:</b><br> <?php print $fila['Correo_empresarial'] ?>
                                        </p>
                                    </div>  
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <b class="font-weight-bold">Correo Personal:</b><br> <?php print $fila['Correo_personal'] ?>
                                        </p>
                                    </div>  
                                </div>    

                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <b class="font-weight-bold">Teléfono Móvil:</b> <?php print $fila['Telefono_movil'] ?>
                                        </p>
                                    </div>  
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <b class="font-weight-bold">Teléfono Fijo:</b> <?php print $fila['Telefono_fijo'] ?>
                                        </p>
                                    </div>  
                                </div>    

                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <b class="font-weight-bold">Área de Trabajo:</b><br> <?php print $fila['Area_trabajo'] ?>
                                        </p>
                                    </div>  
                                    <div class="col-lg-6">
                                        <p class="card-text">
                                            <b class="font-weight-bold">Dirección de Residencia:</b><br> <?php print $fila['Direccion'] ?>
                                        </p>
                                    </div>  
                                </div> 

                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <a href="updateUsuario.php" class="btn btn-menu">Modificar Información</a>
                                    </div>  
                                </div>   
                            </div>

                        </div>
                    </div>
                    <!-- FIN CARD INFORMACIÓN DEL USUARIO -->

                    
                    <!-- CARD QUE CONTIENE LA CANTIDAD DE EVENTOS DEL USUARIO -->
                    <div class="col-lg-4 my-3">
                        <div class="card rounded-2">

                            <div class="card-header container-info">
                                <h6 class="font-weight-bold mb-0">Cantidad de Eventos</h6>
                            </div>

                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <p class="card-text">
                                            <?php
                                                while($row = $eventos -> fetch_assoc())
                                                {
                                            ?>
                                            <p class="card-text">
                                                <b class="font-weight-bold">Eventos <?php print $row['Nombre'] ?>: </b><?php print $row['cantidad'] ?>
                                            </p>
                                            <?php
                                                }
                                            ?>
                                        </p>
                                    </div>  
                                </div>  
                            </div>
                        </div>
                    </div>
                    <!-- FIN CARD CANTIDAD DE EVENTOS - USUARIO -->

                </div>
            </div>
        </section>
        <!-- FIN SECCION INFORMACIÓN DEL USUARIO - CANTIDAD DE EVENTOS -->


    <!-- Evitar que puedan utilizar el boton de atras -->
    <script>    
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
        history.pushState(null, null, document.title);
    });
    
    </script>

    <!-- INVOCO EL FOOTER DEL USUARIO -->
    <?php include('includes/footerUsuario.php') ?>
</body>
</html>


    
