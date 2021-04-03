<?php 

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('includes/funcionesPoblacion.php');

    $eventosDesactivar = BuscarEventosDesactivar();
    $eventosHoy = EventosHoyIndex();
    $eventosSemana = EventosSemanaIndex();

    // Asignamos zona horario
    date_default_timezone_set('America/Bogota');

    // Recuperamos fecha actual
    $hoy = date("Y-m-d H:i:s");

    // Mediante el ciclo se desactivan los eventos que finalizaron (Fecha Final < Fecha Hoy)
    while($row = $eventosDesactivar -> fetch_assoc()){

        // Asignamos el codigo del evento a una variable
        $evento = $row['Codigo'];

        // Validamos si la Fecha Final es MENOR a la Fecha Hoy
        if($row['FechaHora_final'] < $hoy){
            
            include('includes/conexion.php');

                $DesactivarEvento = $conn -> query("CALL sp_DesactivarAutomaticamenteEventos('$evento')");

            mysqli_close($conn);
        }
    } 
    
    // Cuento la cantidad de registros traidos de la consulta eventos de hoy y semana
    $countHoy = mysqli_num_rows($eventosHoy);
    $countSemana = mysqli_num_rows($eventosSemana);

?>

<!-- INVOCO EL HEADER PRINCIPAL -->
<?php include('includes/header.php') ?>

    <!-- CARRUSEL DE IMAGENES -->
    <div class="container w-100 carrusel-principal">
        
        <div id="carouselExampleCaptions" class="carousel slide div-carrusel" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="archivos/principio/carrusel4.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h4 class="font-weight-bold">PARTICIPA DE NUESTROS EVENTOS!!!</h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="archivos/principio/carrusel5.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="font-weight-bold">NO DEJES PASAR LA OPORTUNIDAD!!!</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="archivos/principio/carrusel3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="font-weight-bold">ENCUENTRA TODA LA INFORMACIÓN A CERCA DE ESTOS</h5>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </div>
    <!-- FIN CARRUSEL -->


    <div class="container bg-white mt-3">

        <!-- SECCION DONDE ESTA UBICADO EL BUSCADOS Y LOS FILTROS -->
        <section class="ml-5 section-filtros">
            <div class="container mt-5">
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
        </section>
        <!-- FIN BUSCADOR Y FILTROS -->
        

        <!-- LINEA SEPARADORA -->
        <hr width="90%" style="border: 1px solid #4F565D;">
        

        <!-- SECCION QUE CONTIENE LOS EVENTOS DE HOY OBTENIDOS MEDIANTE LA CONSULTA -->
        <section class="ml-5 pb-4">
            <div class="container" data-aos="fade-up">
                <h4 class='font-weight-bold'>Eventos para hoy</h4> <br>
                <div class="row" data-aos="zoom-in" data-aos-delay="100">
                    <?php

                        //VALIDO QUE SI NO HAY REGISTROS, MUESTRE MENSAJE 
                        if($countHoy == 0){   
                            print "<div class='col-lg-12 col-md-12 text-center text-muted caja-carta'>
                                <h2>No hay Eventos para Hoy</h2>
                            </div>";
                        }

                    ?>    
                    <?php  

                        // INICIA CICLO PARA IMPRIMIR POR CADA REGISTRO UNA CARD CON LA INFORMACIÓN
                        while($fila = $eventosHoy -> fetch_assoc())
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
            </div>
        </section>
        <!-- FIN EVENTOS DE HOY -->
        

        <!-- LINEA SEPARADORA -->
        <hr width="90%" style="border: 1px solid #4F565D;">


        <!-- SECCION QUE CONTIENE LOS EVENTOS QUE SE REALIZARAN DURANTE LA SEMAN (HOY + 8 DIAS) OBTENIDOS DE LA CONSULTA -->
        <section class="ml-5 pb-4">
            <div class="container" data-aos="fade-up">
                <h4 class='font-weight-bold'>Próximos Eventos (Semanal)</h4> <br>
                <div class="row" data-aos="zoom-in" data-aos-delay="100">
                    <?php

                        //VALIDO QUE SI NO HAY REGISTROS, MUESTRE MENSAJE 
                        if($countSemana == 0){   
                            print "<div class='col-lg-12 col-md-12 text-center text-muted caja-carta'>
                                <h2>No hay Eventos para la Próxima Semana</h2>
                            </div>";
                        }
                    ?>    
                    <?php  

                        // INICIA CICLO PARA IMPRIMIR POR CADA REGISTRO UNA CARD CON LA INFORMACIÓN
                        while($fila = $eventosSemana -> fetch_assoc())
                        {         

                            //ASIGNANDO FORMATOS DE FECHAS PARA FECHA Y HORA DE INICIO 
                            $fila['FechaHora_inicio'] = date_create($fila['FechaHora_inicio']);
                            $fila['FechaHora_inicio'] = date_format($fila['FechaHora_inicio'], "d-m-Y g:i a");        

                    ?>
                    <div class="col-lg-4 col-md-4 d-flex mb-5 align-items-stretch">
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

                            <div class="card-footer bg-transparent border-white">
                                <form action="infoEvento.php" method="post">
                                    <button type="submit" name="Evento" value="<?php print $fila['Codigo'] ?>" class="btn btn-carta">Ver Más</button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <?php 
                        }  
                        // TERMINA CICLO CARDS EVENTOS SEMANAL
                    ?>
                </div>
            </div>
        </section>
        <!-- FIN EVENTOS SEMANALES -->

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

