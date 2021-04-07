<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    $eventos = CantidadEventosInicioPanel();
    $usuarios = CantidadUsuariosInicioPanel();

?>
<?php include('includes/headerAdmin.php') ?>

    <!-- MENSAJE Y MANUAL TECNICO -->
    <section class="py-3 bg-white">
        <div class="container">
            <div class="row">

                <!-- MENSAJE BIENVENIDA -->
                <div class="col-lg-9">
                    <h1 class="font-weight-bold mb-0">Bienvenido Administrador</h1>
                    <p class="lead text-muted">Gestiona la información de los usuarios y eventos.</p>
                </div>

                <!-- MANUAL DEL USUARIO -->
                <div class="col-lg-3 d-flex">
                    <a href="pdf/ManualUsuario.pdf" class="btn btn-menu w-100 align-self-center" target="_blank">Manual Técnico</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ESTA SECCION CONTIENE LA INFORMACION DEL USUARIO Y LA CANTIDAD DE EVENTOS -->
        <section class="bg-grey">
            <div class="container">
                <div class="row">

                    <!-- CARD QUE CONTIENE LA INFORMACIÓN DEL USUARIO -->
                    <div class="col-lg-4 my-3">
                        <div class="card rounded-2">

                            <div class="card-header container-info">
                                <h6 class="font-weight-bold mb-0">Estadisticas de Ingreso</h6>
                            </div>

                            <div class="card-body">
                                  
                            </div>

                        </div>
                    </div>
                    <!-- FIN CARD INFORMACIÓN DEL USUARIO -->

                    <div class="col-lg-4 my-3">
                        <div class="card rounded-2">

                            <div class="card-header container-info">
                                <h6 class="font-weight-bold mb-0">Cantidad de Usuarios</h6>
                            </div>

                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <p class="card-text">
                                            <?php
                                                while($row = $usuarios -> fetch_assoc())
                                                {
                                            ?>
                                                <?php
                                                    if($row['Nombre'] == "Activo")
                                                    {
                                                ?>
                                                    <p class="card-text">
                                                        <b class="font-weight-bold">Usuarios Activos: </b><?php print $row['cantidad'] ?>
                                                    </p>
                                                <?php
                                                    }
                                                    else if($row['Nombre'] == "Espera")
                                                    {  
                                                ?>
                                                    <p class="card-text">
                                                        <b class="font-weight-bold">Usuarios que Solicitan Cuenta: </b><?php print $row['cantidad'] ?>
                                                    </p>
                                                <?php
                                                    }
                                                    else if($row['Nombre'] == "Inactivo")
                                                    {
                                                ?>
                                                    <p class="card-text">
                                                        <b class="font-weight-bold">Usuarios Inhabilitados: </b><?php print $row['cantidad'] ?>
                                                    </p>   
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </p>
                                    </div>  
                                </div>        
                            </div>

                        </div>
                    </div>

                    
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
                                                <?php
                                                    if($row['Nombre'] == "Activo")
                                                    {
                                                ?>
                                                    <p class="card-text">
                                                        <b class="font-weight-bold">Eventos que están Activos: </b><?php print $row['cantidad'] ?>
                                                    </p>
                                                <?php
                                                    }
                                                    else if($row['Nombre'] == "Esperando")
                                                    {  
                                                ?>
                                                    <p class="card-text">
                                                        <b class="font-weight-bold">Eventos que solicitan Aprobación: </b><?php print $row['cantidad'] ?>
                                                    </p>
                                                <?php
                                                    }
                                                    else if($row['Nombre'] == "Inactivo")
                                                    {
                                                ?>
                                                    <p class="card-text">
                                                        <b class="font-weight-bold">Eventos que están Inactivos: </b><?php print $row['cantidad'] ?>
                                                    </p>   
                                            <?php
                                                    }
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

    <!-- Evitar que puedan utilizar el boton de atras -->
    <script>    
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
        history.pushState(null, null, document.title);
    });
    </script>

    <?php include('includes/footerAdmin.php') ?>
</body>
</html>