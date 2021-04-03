<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');
    include('../includes/funcionesEvento.php');

    $id = ValidarSesionUsuario();

    // Recupero el estado de los eventos a mostrar
    $estado = $_REQUEST['Estado'];

    $array = ListarEventosAdmin($estado);
    $eventos = $array[0];
    $titulo = $array[1];

?>

<!-- INVOVO EL HEADER DEL ADMIN -->
<?php include('includes/headerAdmin.php') ?>

    <!-- SECCION QUE CONTENDRA TODAS LAS TABLAS DE ACUERDO AL ESTADO DELE EVENTO -->
    <section class="bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 my-3">

                    <!-- INICIA TABLA EVENTOS SEGUN LA OPCION SELECCIONADA -->
                    <div class="card rounded-2 mb-5">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0"><?php print $titulo ?></h6>
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
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Información Completa</th>
                                            <th scope="col">Modificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($fila = $eventos -> fetch_assoc())
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
                                                <?php echo $fila['Usuario'] ?>
                                            </td>
                                            <td>
                                                <a href="selectInfoEvento.php?cod=<?php print $fila['Codigo']; ?>" class="btn btn-secondary">Visualizar</a>
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
                            </div>  
                        </div>
                    </div>  
                    <!-- FIN TABLA EVENTOS -->

                </div>
            </div>
        </div>
    </section>

    <!--ACTIVAR DATATABLE EN TODAS LAS TABLAS -->
    <script src="js/DataTable.js"></script>

<!-- INVOCO EL FOOTER DEL ADMIN -->
<?php include('includes/footerAdmin.php') ?>
</body>
</html>