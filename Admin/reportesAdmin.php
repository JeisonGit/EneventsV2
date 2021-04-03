<?php

    // OCULTA LOS ERRORES, DE MODO QUE EL USUARIO NO PUEDA APORVECHARSE DE ELLOS
    error_reporting(0);


    // TRAIGO EL ID MEDIANTE LA VARIABLE SESION
    session_start(); 
    $idAdmin = $_SESSION['id'];

    // VALIDO QUE EL USUARIO SI HAYA INICIADO SESION DE FORMA LEGITIMA
    if($idAdmin == null || $idAdmin == ''){
        print   "<script>
                    alert('DEBES INICIAR SESIÓN PRIMERO');
                    location.href = '../iniciarSesion.php';
                </script>";
        die();        
    }

?>

<!-- INVOCO EL HEADER DEL ADMIN -->
<?php include('includes/headerAdmin.php') ?>

    <section class="bg-grey">
        <div class="container">
            <div class="row">

                <!-- Card Reporte #1 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #1</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Los 10 eventos que obtuvieron mayor ganancia bruta.</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r1" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card Reporte #2 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #2</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Los 10 eventos que fueron más costosos operacionalmente.</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r2" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card Reporte #3 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #3</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Los 10 eventos que obtuvieron mayores ingresos adicionales.</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r3" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card Reporte #4 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #4</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Ganancia Bruta Total obtenida por cada categoría de evento.</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r4" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card Reporte #5 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #5</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Ganancia Bruta Total obtenida por cada área de trabajo.</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r5" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card Reporte #6 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #6</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Ganancia Bruta Total obtenida por cada evento realizado.</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r6" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card Reporte #7 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #7</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Asistencia Total por cada categoría de evento.</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r7" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Nuevos Reportes: Asistencia Total por cada area de trabajo y Asistencia Total por cada Evento. -->

                <!-- Card Reporte #8 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #8</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Eventos que tuvieron una asistencia mayor o igual a ___</p>
                            <a href="" type="button" class="btn btn-menu mb-2" data-toggle="modal" data-target="#modalReporte8">Desplegar</a>
                        </div>
                    </div>
                </div>

                <!-- Card Reporte #9 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #9</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Eventos que fueron realizados o se llevaran a cabo entre las fechas ___</p>
                            <a href="" type="button" class="btn btn-menu mb-2 " data-toggle="modal" data-target="#modalReporte9">Desplegar</a>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </section>

    <!-- Modales De Reportes Que Lo Requieran -->

    <!-- REPORTE 8 -->
    <div class="modal fade" id="modalReporte8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reporte Número 6</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="reporteSeleccionado.php" method="post">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label for="asistenciaMayor" class="font-weight-bold">Asistencia Mayor o Igual a</label>
                            <input type="number" name="asistenciaMayor" id="asistenciaMayor" class="form-control mb-4" required="">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" name="r" value="r8" class="btn btn-menu">Obtener Resultado</button>
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

    <!-- REPORTE 9 -->
    <div class="modal fade" id="modalReporte9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reporte Número 9</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="reporteSeleccionado.php" method="post">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label for="fechaAntigua" class="font-weight-bold">Fecha Más Antigua</label>
                            <input type="date" name="fechaAntigua" id="fechaAntigua" class="form-control mb-4" required="">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="fechaReciente" class="font-weight-bold">Fecha Más Reciente</label>
                            <input type="date" name="fechaReciente" id="fechaReciente" class="form-control mb-4" required="">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" name="r" value="r9" class="btn btn-menu">Obtener Resultado</button>
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


<!-- INVOCO EL FOOTER DEL ADMIN -->
<?php include('includes/footerAdmin.php') ?>
</body>
</html>