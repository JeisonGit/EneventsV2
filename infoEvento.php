<?php  

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('includes/funcionesPoblacion.php');

    $filaEvento = InformacionEvento();
    $filaUsuario = InformacionUsuarioEvento();
    $eventosAdicionalesUsuario = InformacionEventosAdicionalesUsuario();

?>

<!-- INVOCO EL HEADER PRINCIPAL -->
<?php include('includes/header.php') ?>
    
    <!-- SECCION QUE CONTENDRA TODA LA INFORMACIÓN -->
    <div class="container w-100 div-infoEvento">
        <section class="bg-grey">
            <div class="row">

                <!-- CARD INFORMACIÓN DEL EVENTO -->
                <div class="col-lg-8 my-3">
                    <div class="card rounded-2 border">

                        <div class="card-header text-center">
                            <img src="<?php print $filaEvento['Imagen'] ?>" alt="" class="img-fluid img-thumbnail img-avatar">
                        </div>

                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-lg-12 my-2">
                                    <p class="card-text lead">
                                        <?php print $filaEvento['Nombre']; ?>
                                    </p>
                                </div>
                                <div class="col-lg-12 my-2">
                                    <p class="card-text">
                                        <b class="font-weight-bold">Categoría:</b> <?php print $filaEvento['cat']; ?>
                                    </p>
                                </div>
                                <div class="col-lg-6 my-2">
                                    <p class="card-text">
                                        <b class="font-weight-bold">Fecha y Hora de Inicio:</b><br> <?php print $filaEvento['FechaHora_inicio'] ?>
                                    </p>
                                </div>
                                <div class="col-lg-6 my-2">
                                    <p class="card-text">
                                        <b class="font-weight-bold">Fecha y Hora de Finalización:</b><br> <?php print $filaEvento['FechaHora_final'] ?>
                                    </p>
                                </div>
                                <div class="col-lg-6 my-2">
                                    <p class="card-text">
                                        <b class="font-weight-bold">Dirección del Evento:</b> <?php print $filaEvento['Lugar'] ?>
                                    </p>
                                </div>
                                <div class="col-lg-6 my-2">
                                    <p class="card-text">
                                        <b class="font-weight-bold">Costo de Entrada:</b> <?php print "$".$filaEvento['Valor'] ?>
                                    </p>
                                </div>
                                <div class="col-lg-12 my-3">
                                    <button class="btn btn-carta mb-3 font-weight-bold" type="button" data-toggle="collapse" data-target="#mostrarDescripcion" aria-expanded="false" aria-controls="mostrarDescripcion">Mostrar / Ocultar Descripción</button>

                                    <div class="collapse mr-4" id="mostrarDescripcion">
                                        <p class="card-text">
                                            <b class="font-weight-bold">Descripción:</b><br> <?php print $filaEvento['Descripcion'] ?>
                                        </p>   
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- FIN CARD INFORMACION DEL EVENTO -->

                <!-- CARD INFORMACIÓN DEL USUARIO Y EVENTOS ADICIONALES -->
                <div class="col-lg-4 my-3">
                    <div class="card rounded-2 border mb-2">

                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">Realizado por:</h6>
                        </div>
                        
                        <div class="card-body text-center">
                            <p class="card-text">
                                <b class="font-weight-bold"><?php print $filaUsuario['Nombres'] ?> <?php print $filaUsuario['Apellidos'] ?></b>
                            </p>
                            <p class="card-text">
                                <b class="font-weight-bold">Área de Trabajo:</b><br> <?php print $filaUsuario['area'] ?>
                            </p>
                            <p class="card-text">
                                <b class="font-weight-bold">Contacto:</b><br> <?php print $filaUsuario['Correo_empresarial'] ?> <br> Teléfono: <?php print $filaUsuario['Telefono_movil'] ?>
                            </p>
                            <p class="card-text">
                                <b class="font-weight-bold">Ciudad: </b><?php print $filaUsuario['ciudad'] ?>
                            </p>
                        </div>
                    </div>
                    <!-- FIN INFORMACIÓN DEL USUARIO -->


                    <!-- EVENTOS ADICIONALES -->
                    <div class="card rounded-2 border">

                        <div class="card-header container-info">
                            <h6 class="font-weight-bold mb-0">También te puede interesar</h6>
                        </div>
                        
                        <div class="card-body">
                            <ul>
                                <?php
                                    // CICLO RESULTADO DE CONSULTA
                                    while($filaEventoAdicional = $eventosAdicionalesUsuario -> fetch_assoc())
                                    {
                                ?>
                                <li class="mb-4">
                                    <p class="card-text">
                                        <?php print $filaEventoAdicional['Nombre'] ?>
                                    </p> 
                                    <form action="infoEvento.php" method="post">
                                        <button type="submit" name="Evento" value="<?php print $filaEventoAdicional['Codigo'] ?>" class="btn btn-carta">Ver Más</button>
                                    </form>
                                </li>
                                <?php
                                    }
                                    // FIN CICLO
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- FIN EVENTOS ADICIONALES -->

                </div>

                <!-- COMENTARIOS DISQUS -->
                <div class="col-lg-12">
                    <div class="card rounded-2 border mb-2">
                        <div id="disqus_thread" class="mx-5 my-3">
                            <script>
                                (function () { // DON'T EDIT BELOW THIS LINE
                                var d = document, s = d.createElement('script');
                                s.src = 'https://enevents-comments.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                                })();
                            </script>
                            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                        </div>
                            
                    </div>
                </div>
                <!-- FIN COMENTARIOS DISQUS -->
            </div>    
        </section>
    </div>
    <!-- FIN SECCION QUE MUESTRA LA INFORMACIÓN -->


<!-- INVOCO EL FOOTER PRINCIPAL -->
<?php include('includes/footer.php') ?>
</body>
</html>
