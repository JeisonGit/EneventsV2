<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('../includes/funcionesUsuario.php');

    $id = ValidarSesionUsuario();

    $usuarios = ListarUsuariosAdmin();

?>

<!-- INVOCO EL HEADER DEL USUARIO -->
<?php include('includes/headerAdmin.php') ?>

    <!-- SECCION QUE CONTIENE LA TABLA CON LOS DATOS DE TODOS LOS ADMINISTRADORES -->
    <section class="bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 my-3">
                    <div class="card rounded-2">

                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Administradores</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">

                                <!-- INCIA TABLA -->
                                <table id="tablas-eventos" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tipo de Documento</th>
                                            <th scope="col">Documento/NIT</th>
                                            <th scope="col">Nombres</th>
                                            <th scope="col">Apellidos</th>
                                            <th scope="col">Correo Empresarial</th>
                                            <th scope="col">Área de Trabajo</th>
                                            <th scope="col">Información Completa</th>
                                            <th scope="col">Eventos del Administrador</th>
                                            <th scope="col">Modificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($fila = $usuarios -> fetch_assoc())
                                            {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php print $fila['tipoId'] ?>
                                            </td>
                                            <td>
                                                <?php print $fila['Documento'] ?>
                                            </td>
                                            <td>
                                                <?php print $fila['Nombres'] ?>
                                            </td>
                                            <td>
                                                <?php print $fila['Apellidos'] ?>
                                            </td>
                                            <td>
                                                <?php print $fila['Correo_empresarial'] ?>
                                            </td>
                                            <td>
                                                <?php print $fila['Area_trabajo'] ?>
                                            </td>
                                            <td>
                                                <a href="selectInfoUsuario.php?id=<?php print $fila['Documento']; ?>" class="btn btn-secondary">Visualizar</a>
                                            </td>
                                            <td>
                                                <a href="selectEventosUsuario.php?id=<?php print $fila['Documento']; ?>" class="btn btn-success">Revisar</a>
                                            </td>
                                            <td>
                                                <a href="updateUsuario.php?id=<?php print $fila['Documento'] ?>" class="btn btn-info">Modificar</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- FIN TABLA -->

                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <!-- ACTIVO EL DATATABLE EN LA TABLA -->
    <script src="js/DataTable.js"></script>

<!-- INVOCO EL FOOTER DEL ADMIN -->
<?php include('includes/footerAdmin.php') ?>
</body>
</html>