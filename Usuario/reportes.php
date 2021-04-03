<?php

    // OCULTA LOS ERRORES, DE MODO QUE EL USUARIO NO PUEDA APORVECHARSE DE ELLOS
    error_reporting(0);


    // TRAIGO EL ID MEDIANTE LA VARIABLE SESION
    session_start(); 
    $id = $_SESSION['id'];


    // VALIDO QUE EL USUARIO SI HAYA INICIADO SESION DE FORMA LEGITIMA
    if($id == null || $id == ''){
        print   "<script>
                    alert('DEBES INICIAR SESIÓN PRIMERO');
                    location.href = '../iniciarSesion.php';
                </script>";
        die();        
    }

?>

<!-- INVOCO EL HEADER DEL USUARIO -->
<?php include('includes/headerUsuario.php') ?>

    <section class="bg-grey">
        <div class="container">
            <div class="row">

                <!-- A CADA REPORTE SE LE ASIGNA UNA CARD DONDE ESTÁ LA INFORMACIÓN QUE EXPLICA EN QUE CONSISTE CADA REPORTE -->

                <!-- REPORTE #1 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #1</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Los 10 eventos que obtuvieron mayor Ganancia Bruta</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r1" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- FIN REPORTE #1 -->


                <!-- REPORTE #2 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #2</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Los 10 eventos que fueron más Costosos Operacionalmente.</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r2" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- FIN REPORTE #2 -->


                <!-- REPORTE #3 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #3</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Los 10 eventos que obtuvieron mayores Ingresos por Entrada al evento.</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r3" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- FIN REPORTE #3 -->


                <!-- REPORTE #4 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #4</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Ganancia Bruta Total obtenida por cada categoría de eventos realizados.</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r4" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- FIN REPORTE #4 -->


                <!-- REPORTE #5 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #5</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Ganancia Bruta Total por cada evento realizado.</p>
                            <form action="reporteSeleccionado.php" method="post">
                                <button type="submit" name="r" value="r5" class="btn btn-menu">Ver Más</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- FIN REPORTE #5 -->


                <!-- REPORTE #6 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #6</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Eventos que fueron realizados o se llevaran a cabo entre las fechas ___</p>
                            <a href="" type="button" class="btn btn-menu" data-toggle="modal" data-target="#modalReporte6">Desplegar</a>
                        </div>
                    </div>
                </div>
                <!-- FIN REPORTE #6 -->


                <!-- REPORTE #7 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #7</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Eventos que tuvieron una Asistencia mayor o igual a ___</p>
                            <a href="" type="button" class="btn btn-menu mb-2" data-toggle="modal" data-target="#modalReporte7">Desplegar</a>
                        </div>
                    </div>
                </div>
                <!-- FIN REPORTE #7 -->


                <!-- REPORTE #8 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #8</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Eventos que tuvieron una Asistencia menor o igual a ___</p>
                            <a href="" type="button" class="btn btn-menu mb-2" data-toggle="modal" data-target="#modalReporte8">Desplegar</a>
                        </div>
                    </div>
                </div>
                <!-- FIN REPORTE #8 -->


                <!-- REPORTE #9 -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Reporte #9</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Eventos que obtuvieron una Ganancia Bruta mayor o igual a ___ y sus Costos Operacionales fueron menores o iguales a ___</p>
                            <a href="" type="button" class="btn btn-menu mb-2 " data-toggle="modal" data-target="#modalReporte9">Desplegar</a>
                        </div>
                    </div>
                </div>
                <!-- FIN REPORTE #9 -->

                <!-- FIN DE LAS CARDS DE REPORTES -->

            </div>
        </div>
    </section>


<!-- ALGUNOS REPORTES REQUIEREN DE MODALES PARA ENVIAR PARAMETROS. -->

    <!-- MODAL REPORTE #6 -->
    <div class="modal fade" id="modalReporte6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="col-md-6 col-sm-6">
                            <label for="Fecha_Antigua" class="font-weight-bold">Fecha Más Antigua</label>
                            <input type="date" name="fecha_Antigua" id="Fecha_Antigua" class="form-control mb-4" required="">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="Fecha_Reciente" class="font-weight-bold">Fecha Más Reciente</label>
                            <input type="date" name="fecha_Reciente" id="Fecha_Reciente" class="form-control mb-4" required="">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-menu" name="r" value="r6">Obtener Resultado</button>
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
    <!-- FIN MODAL REPORTE #6 -->


    <!-- MODAL REPORTE 7 -->
    <div class="modal fade" id="modalReporte7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reporte Número 7</h5>
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
                            <button type="submit" class="btn btn-menu" name ="r" value="r7">Obtener Reporte</button>
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
    <!-- FIN MODAL REPORTE #7 -->


    <!-- MODAL REPORTE #8 -->
    <div class="modal fade" id="modalReporte8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reporte Número 8</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="reporteSeleccionado.php" method="post">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label for="asistenciaMenor" class="font-weight-bold">Asistencia Menor o Igual a</label>
                            <input type="number" name="asistenciaMenor" id="asistenciaMenor" class="form-control mb-4" required="">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-menu" name ="r" value="r8">Obtener Reporte</button>
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
    <!-- FIN MODAL REPORTE #8 -->


    <!-- MODAL REPORTE 9 -->
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
                            <label for="gananciaTotal" class="font-weight-bold">Ganancia Bruta Mayor o Igual a</label>
                            <input type="number" name="gananciaTotal" id="gananciaTotal" class="form-control mb-4" required="">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="costo" class="font-weight-bold">Costos Operacionales Menores o Iguales a</label>
                            <input type="number" name="costo" id="costo" class="form-control mb-4" required="">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-menu" name="r" value="r9">Obtener Resultado</button>
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
    <!-- FIN MODAL REPORTE #9 -->

<!-- FINAL DE MODALES ASIGNADOS A REPORTES -->


<!-- INVOCO EL FOOTER DEL USUARIO -->
<?php include('includes/footerUsuario.php') ?>
</body>
</html>