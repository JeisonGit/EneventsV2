<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');
    include('../includes/funcionesEvento.php');

    $id = ValidarSesionUsuario();

    // Recupero el documento del usuario seleccionado
    $documento = $_REQUEST['id'];

    // Consulto el nombre y los eventos del usuario seleccionado
    $row = NombreUsuarioSeleccionEventos($documento);
    $eventosActivos = ListarEventosActivosUsuarioSeleccionAdmin($documento);
    $eventosInactivos = ListarEventosInactivosUsuarioSeleccionAdmin($documento);
    $eventosEspera = ListarEventosEsperaUsuarioSeleccionAdmin($documento); 

?>

<!-- INVOCO EL HEADER DEL ADMIN -->
<?php include('includes/headerAdmin.php') ?>

    <!-- SECCION QUE CONTIENE BOTONES PARA MOSTRAR DE ACUERDO AL SELECCIONADO LA TABLA QUE CORRESPONDE -->
    <section class="bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 my-3">

                    <input type="button" value="Atrás" class="btn btn-menu mt-2" onClick="history.go(-1);">

                    <!-- DIV QUE CONTIENE LOS BOTONES CON LAS OPCIONES -->
                    <div class="container text-center justify-content-center w-100">
                        <p>Eventos del usuario <?php print $row['Nombres']?>  <?php print $row['Apellidos'] ?></p>
                        <h5><p class="font-weight-bold">Selecciona alguna de las opciones:</p></h5>

                        <!-- BOTON QUE DESPLIEGA SEGÚN LO SELECCIONADO -->
                        <div class="container">

                            <!-- AGREGAR EVENTO - MOSTRAR TODAS LAS TABLAS - OCULTAR TODAS LAS TABLAS -->
                            <div class="row text-center justify-content-center">
                                <a href="insertEventoUsuario.php?id=<?php print $documento ?>" class="btn btn-menu mb-4 font-weight-bold">Agregar Nuevo Evento</a>

                                <div class="col-lg-12 d-flex justify-content-center">
                                    <button type="button" id="btnMostrarEventos" onclick="mostrarTodosEventos();" class="btn btn-secondary mx-3 mb-4 font-weight-bold">Mostrar Todos</button>
                                </div>

                                <div class="col-lg-12 d-flex justify-content-center">
                                    <button type="button" id="btnOcultarEventos" onclick="ocultarTodosEventos();" class="btn btn-secondary mx-3 mb-4 font-weight-bold">Ocultar Todos</button>
                                </div> 
                            </div>

                            <!-- BOTONES QUE MUESTRAN SOLO LA TABLA SELECCIONADO Y OCULTA SI HAY OTRA "ACTIVA" -->
                            <div class="row text-center justify-content-center">
                                <div class="col-lg-3">
                                    <button type="button" onclick="mostrarEventosActivos();" class="btn btn-secondary mx-3 mb-4 font-weight-bold">Eventos Activos</button>
                                </div>

                                <div class="col-lg-3">
                                    <button type="button" onclick="mostrarEventosEspera();" class="btn btn-secondary mx-3 mb-4 font-weight-bold">Eventos Solicitados</button>
                                </div>

                                <div class="col-lg-3">
                                    <button type="button" onclick="mostrarEventosInactivos();" class="btn btn-secondary mx-3 mb-4 font-weight-bold">Eventos Inactivos</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TABLA DE EVENTOS ACTIVOS -->
                    <div class="card rounded-2 mb-5" id="tablaEventosActivosUsuario">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Eventos Activos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablas-eventosActivos" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Categoría</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Fecha - Hora Inicio</th>
                                            <th scope="col">Fecha - Hora Final</th>
                                            <th scope="col">Valor Ingreso</th>
                                            <th scope="col">Información Completa</th>
                                            <th scope="col">Resultados</th>
                                            <th scope="col">Modificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($fila = $eventosActivos -> fetch_assoc())
                                            {
                                                //FORMATO USD PARA EL VALOR DE ENTRADA
                                                $fila['Valor'] = number_format($fila['Valor']);

                                                //ASIGNANDO FORMATOS DE FECHAS PARA FECHA INICIO Y FECHA FINAL
                                                $fila['FechaHora_inicio'] = date_create($fila['FechaHora_inicio']);
                                                $fila['FechaHora_inicio'] = date_format($fila['FechaHora_inicio'], "d-m-Y g:i a");

                                                $fila['FechaHora_final'] = date_create($fila['FechaHora_final']);
                                                $fila['FechaHora_final'] = date_format($fila['FechaHora_final'], "d-m-Y g:i a");
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $fila['nombre_cat'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['Nombre'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['FechaHora_inicio'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['FechaHora_final'] ?>
                                            </td>
                                            <td>
                                                <?php echo "$".$fila['Valor'] ?>
                                            </td>
                                            <td>
                                                <a href="selectInfoEvento.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-secondary">Visualizar</a>
                                            </td>
                                            <td>
                                                <a href="selectResultadosEvento.php?cod=<?php echo $fila['Codigo'] ?>" class="btn btn-success">Revisar</a>
                                            </td>
                                            <td>
                                                <a href="updateEventoUsuario.php?cod=<?php print $fila['Codigo'] ?>" class="btn btn-info">Modificar</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <a href="javascript:void(0);" class="btn btn-warning mt-3" onclick="ocultarEventosActivos()">Ocultar Tabla</a>   
                            </div>  
                        </div>
                    </div>

                    
                    <!-- TABLA DE EVENTOS EN ESPERA-->
                    <div class="card rounded-2 mb-5" id="tablaEventosEsperaUsuario">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Eventos que Solicitan Aprobación</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablas-eventosEspera" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Categoría</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Fecha - Hora Inicio</th>
                                            <th scope="col">Fecha - Hora Final</th>
                                            <th scope="col">Valor Ingreso</th>
                                            <th scope="col">Información Completa</th>
                                            <th scope="col">Resultados</th>
                                            <th scope="col">Modificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($fila = $eventosEspera -> fetch_assoc())
                                            {
                                                //FORMATO USD PARA EL VALOR DE ENTRADA
                                                $fila['Valor'] = number_format($fila['Valor']);

                                                //ASIGNANDO FORMATOS DE FECHAS PARA FECHA INICIO Y FECHA FINAL
                                                $fila['FechaHora_inicio'] = date_create($fila['FechaHora_inicio']);
                                                $fila['FechaHora_inicio'] = date_format($fila['FechaHora_inicio'], "d-m-Y g:i a");

                                                $fila['FechaHora_final'] = date_create($fila['FechaHora_final']);
                                                $fila['FechaHora_final'] = date_format($fila['FechaHora_final'], "d-m-Y g:i a");
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $fila['nombre_cat'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['Nombre'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['FechaHora_inicio'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['FechaHora_final'] ?>
                                            </td>
                                            <td>
                                                <?php echo "$".$fila['Valor'] ?>
                                            </td>
                                            <td>
                                                <a href="selectInfoEvento.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-secondary">Visualizar</a>
                                            </td>
                                            <td>
                                                <a href="selectResultadosEvento.php?cod=<?php echo $fila['Codigo'] ?>" class="btn btn-success">Revisar</a>
                                            </td>
                                            <td>
                                                <a href="updateEventoUsuario.php?cod=<?php print $fila['Codigo'] ?>" class="btn btn-info">Modificar</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <a href="javascript:void(0);" class="btn btn-warning mt-3" onclick="ocultarEventosEspera()">Ocultar Tabla</a>   
                            </div>  
                        </div>
                    </div>


                    <!-- TABLA DE EVENTOS INACTIVOS-->
                    <div class="card rounded-2 mb-5" id="tablaEventosInactivosUsuario">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Eventos Inactivos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablas-eventosInactivos" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Categoría</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Fecha - Hora Inicio</th>
                                            <th scope="col">Fecha - Hora Final</th>
                                            <th scope="col">Valor Ingreso</th>
                                            <th scope="col">Información Completa</th>
                                            <th scope="col">Resultados</th>
                                            <th scope="col">Modificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($fila = $eventosInactivos -> fetch_assoc())
                                            {
                                                //FORMATO USD PARA EL VALOR DE ENTRADA
                                                $fila['Valor'] = number_format($fila['Valor']);

                                                //ASIGNANDO FORMATOS DE FECHAS PARA FECHA INICIO Y FECHA FINAL
                                                $fila['FechaHora_inicio'] = date_create($fila['FechaHora_inicio']);
                                                $fila['FechaHora_inicio'] = date_format($fila['FechaHora_inicio'], "d-m-Y g:i a");

                                                $fila['FechaHora_final'] = date_create($fila['FechaHora_final']);
                                                $fila['FechaHora_final'] = date_format($fila['FechaHora_final'], "d-m-Y g:i a");
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $fila['nombre_cat'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['Nombre'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['FechaHora_inicio'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['FechaHora_final'] ?>
                                            </td>
                                            <td>
                                                <?php echo "$".$fila['Valor'] ?>
                                            </td>
                                            <td>
                                                <a href="selectInfoEvento.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-secondary">Visualizar</a>
                                            </td>
                                            <td>
                                                <a href="selectResultadosEvento.php?cod=<?php echo $fila['Codigo'] ?>" class="btn btn-success">Revisar</a>
                                            </td>
                                            <td>
                                                <a href="updateEventoUsuario.php?cod=<?php print $fila['Codigo'] ?>" class="btn btn-info">Modificar</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <a href="javascript:void(0);" class="btn btn-warning mt-3" onclick="ocultarEventosInactivos()">Ocultar Tabla</a>   
                            </div>  
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ACTIVAR DATATABLE EN TODAS LAS TABLAS -->
    <script src="js/DataTable.js"></script>

<!-- INVOCO EL FOOTER DEL ADMIN -->
<?php include('includes/footerAdmin.php') ?>
</body>
</html>
                            