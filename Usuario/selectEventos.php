<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesEvento.php');
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    // Recupero el estado seleccionado para listar eventos
    $estado = $_REQUEST['Estado'];

    // Llama la funcion que devuelve los eventos segun el estado seleccionado
    $eventos = ListarEventosUsuarioSesion($id, $estado);

?>

<?php include('includes/headerUsuario.php') ?>

    <!-- SECCION QUE CONTIENE LAS TABLAS QUE A SU VEZ CONTIENEN LA INFORMACIÓN DE ACUERDO AL ESTADO SELECCIONADO -->
    <section class="bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 my-3">
                    <div class="card rounded-2 mb-5">
                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Eventos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablas-eventos" class="table table-striped table-bordered table-hover  text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Categoría</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Fecha y Hora de Inicio</th>
                                            <th scope="col">Fecha y Hora de Finalización</th>
                                            <th scope="col">Valor de Ingreso</th>
                                            <th scope="col">Información Completa</th>
                                            <th scope="col">Modificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                            // MEDIANTE UN CICLO SE VAN IMPRIMIENDO EN LA TABLA LOS RESULTADO DE LA CONSULTA
                                            while($fila = $eventos -> fetch_assoc())
                                            {
                                                //FORMATO USD PARA EL VALOR DE ENTRADA
                                                $fila['Valor'] = number_format($fila['Valor']);

                                                //ASIGNANDO FORMATOS DE FECHAS PARA FECHA INICIO Y FECHA FINAL
                                                $fila['FechaHora_inicio'] = date_create($fila['FechaHora_inicio']);
                                                $fila['FechaHora_inicio'] = date_format($fila['FechaHora_inicio'], "d-m-Y g:ia");

                                                $fila['FechaHora_final'] = date_create($fila['FechaHora_final']);
                                                $fila['FechaHora_final'] = date_format($fila['FechaHora_final'], "d-m-Y g:ia");
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
                                                <a href="updateEvento.php?cod=<?php print $fila['Codigo'] ?>" class="btn btn-info">Modificar</a>
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
                </div>
            </div>
        </div>
    </section>
    <!-- FIN SECCION TABLAS -->


    <!-- ACTIVAR DATATABLE EN LAS TABLAS -->
    <script src="js/DataTable.js"></script>


<!-- INVOCO EL FOOTER DEL USUARIO -->
<?php include('includes/footerUsuario.php') ?>
</body>
</html>