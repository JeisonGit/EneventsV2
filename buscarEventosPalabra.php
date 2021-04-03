<?php

    // oculta los errores
    error_reporting(0);

    $palabra = $_POST['palabra'];

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('includes/funcionesPoblacion.php');

    $eventosActivos = BuscarEventosActivosPalabra();
    $eventosInactivos = BuscarEventosInactivosPalabra();
    
    // Cuento la cantidad de registros que regresaron de la consulta
    $countResultadoActivos = mysqli_num_rows($eventosActivos);
    $countResultadoInactivos = mysqli_num_rows($eventosInactivos);

?>

<!-- INVOCO EL HEADER PRINCIPAL -->
<?php include('includes/header.php') ?>

    <div class="container bg-white div-buscarEventos">

 
        <!-- SECCION QUE CONTIENE LOS EVENTOS OBTENIDOS DE LAS CONSULTAS -->
        <section class="pb-4">
            <div class="container" data-aos="fade-up">

                <!-- MENSAJE CATEGORIA POR LA CUAL SE ESTA FILTRANDO -->
                <p class="lead pt-3">Buscar eventos relacionados con la palabra: <b class="font-weight-bold"><?php print $palabra ?></b></p>

                <!-- FILTROS Y BUSCADOR -->
                <div class="container mt-4">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="btn-group dropright">

                                <button type="button" id="dropdownPrincipal" class="btn btn-filtros dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filtrar por
                                </button>
                                
                                <div class="dropdown-menu dropright" aria-labelledby="dropdownPrincipal">

                                    <button type="button" id="dropdownCategoria" class="btn btn-outline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Categoria
                                    </button>

                                    <div class="dropdown-menu" aria-labelledby="dropdownCategoria">
                                        <a class="dropdown-item" href="buscarEventosCategoria.php?categoria=Cultural">
                                            Cultural
                                        </a>
                                        <a class="dropdown-item" href="buscarEventosCategoria.php?categoria=Deportivo">
                                            Deportivo
                                        </a>
                                        <a class="dropdown-item" href="buscarEventosCategoria.php?categoria=Artístico">
                                            Artístico
                                        </a>
                                        <a class="dropdown-item" href="buscarEventosCategoria.php?categoria=Moda">
                                            Moda
                                        </a>
                                        <a class="dropdown-item" href="buscarEventosCategoria.php?categoria=Informática">
                                            Informática
                                        </a>
                                        <a class="dropdown-item" href="buscarEventosCategoria.php?categoria=LGBT">
                                            LGBT
                                        </a>
                                        <a class="dropdown-item" href="buscarEventosCategoria.php?categoria=Político">
                                            Político
                                        </a>
                                        <a class="dropdown-item" href="buscarEventosCategoria.php?categoria=Religioso">
                                            Religioso
                                        </a>
                                    </div>

                                    <a class="dropdown-item" data-toggle="modal" data-target="#modalBuscarFechas" href="">
                                        Fechas
                                    </a>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <form method="post" action="buscarEventosPalabra.php" class="form-inline ml-auto mt-2 mt-lg-0" onsubmit="return buscarPalabra();">
                                <input class="form-control mr-sm-2" type="search" name="palabra" id="palabra" placeholder="Ingresa una palabra" aria-label="Search" maxlength="15" required>
                                <button class="btn btn-buscar my-2 my-sm-0" type="submit">Buscar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- FIN FILTROS Y BUSCADOR -->


                <!-- LINEA SEPARADORA -->
                <hr width="100%" style="border: 1px solid #4F565D;">

                <div class="row ml-3" data-aos="zoom-in" data-aos-delay="100">
                    <?php

                        //VALIDO QUE SI NO HAY REGISTROS, MUESTRE MENSAJE 
                        if($countResultadoActivos == 0 && $countResultadoInactivos == 0){   
                            print "<div class='col-lg-12 col-md-12 text-center text-muted caja-carta'>
                                <h2>No se han encontrado resultados en la búsquedad.</h2>
                            </div>";
                        }
                        else{

                    ?>    
                    <?php  

                        // INICIA CICLO PARA IMPRIMIR POR CADA REGISTRO UNA CARD CON LA INFORMACIÓN
                        while($fila = $eventosActivos -> fetch_assoc())
                        {                        

                            //ASIGNANDO FORMATOS DE FECHAS PARA FECHA Y HORA DE INICIO 
                            $fila['FechaHora_inicio'] = date_create($fila['FechaHora_inicio']);
                            $fila['FechaHora_inicio'] = date_format($fila['FechaHora_inicio'], "d-m-Y g:i a");

                    ?>
                    <div class="col-lg-4 col-md-4 mb-5 d-flex align-items-stretch">
                        <div class="card" style="width: 18rem;">

                            <img src="<?php print $fila['Imagen'] ?>" alt="" class="img-fluid img-thumbnail img-avatar">

                            <div class="card-body">

                                <h5 class="card-title font-weight-bold">
                                    <?php echo $fila['Nombre'] ?>
                                </h5>
                                <p class="card-text">
                                    Categoría: <?php echo $fila['Categoria'] ?>
                                </p>
                                <p class="card-text">
                                    Fecha y Hora de Inicio: <br> <?php echo $fila['FechaHora_inicio'] ?>
                                </p>
                                

                            </div>
                            <div class="card-footer bg-transparent border-light">
                                <form action="infoEvento.php" method="post">
                                    <button type="submit" name="Evento" value="<?php print $fila['Codigo'] ?>" class="btn btn-carta">Ver Más</button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <?php 
                        }  
                        // TERMINA CICLO

                    ?>
                </div>

                <div class="row ml-3" data-aos="zoom-in" data-aos-delay="100">
 
                    <div class="container">
                        <p>
                            <b class="font-weight-bold">NOTA:</b> Los siguientes eventos ya finalizaron
                        </p>
                    </div>
                    <?php  

                        // INICIA CICLO PARA IMPRIMIR POR CADA REGISTRO UNA CARD CON LA INFORMACIÓN
                        while($fila = $eventosInactivos -> fetch_assoc())
                        {                        

                            //ASIGNANDO FORMATOS DE FECHAS PARA FECHA Y HORA DE INICIO 
                            $fila['FechaHora_inicio'] = date_create($fila['FechaHora_inicio']);
                            $fila['FechaHora_inicio'] = date_format($fila['FechaHora_inicio'], "d-m-Y g:i a");

                    ?>
                    <div class="col-lg-4 col-md-4 mb-5 d-flex align-items-stretch">
                        <div class="card eventos-inactivos text-muted" style="width: 18rem;">

                            <img src="<?php print $fila['Imagen'] ?>" alt="" class="img-fluid img-thumbnail img-avatar">

                            <div class="card-body">

                                <h5 class="card-title font-weight-bold">
                                    <?php echo $fila['Nombre'] ?>
                                </h5>
                                <p class="card-text">
                                    Categoría: <?php echo $fila['Categoria'] ?>
                                </p>
                                <p class="card-text">
                                    Fecha y Hora de Inicio: <br> <?php echo $fila['FechaHora_inicio'] ?>
                                </p>
                                

                            </div>
                            <div class="card-footer bg-transparent border-light">
                                <form action="infoEvento.php" method="post">
                                    <button type="submit" name="Evento" value="<?php print $fila['Codigo'] ?>" class="btn btn-carta">Ver Más</button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <?php 
                        }  
                        // TERMINA CICLO
                    }
                    // TERMINA CONDICIONAL
                    ?>
                </div>

            </div>
        </section>
        <!-- FIN EVENTOS DE LOS EVENTOS -->

    </div>

    <!-- MODAL DE FILTRAR POR FECHAS -->
    <div class="modal fade" id="modalBuscarFechas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filtrar por Fechas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="buscarEventosFechas.php" method="post" onsubmit="return filtrarFechas();">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label for="fechaAntigua" class="font-weight-bold">Fecha más Antigua</label>
                            <input type="date" name="fechaAntigua" id="fechaAntigua" class="form-control mb-4" required>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="fechaReciente" class="font-weight-bold">Fecha más Reciente</label>
                            <input type="date" name="fechaReciente" id="fechaReciente" class="form-control mb-4" required>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-info">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL FILTRAR POR FECHAS -->

<!-- INVOCO EL FOOTER PRINCIPAL -->
<?php include('includes/footer.php') ?>
</body>
</html>