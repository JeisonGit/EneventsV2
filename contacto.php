<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('includes/funcionesPoblacion.php');

    // Si se presiona el boton enviar llama a la funcion de enviar correo
    if(isset($_POST['Enviar'])){
        EnviarCorreoContacto();
    }

?>
<!-- INVOCO EL HEADER PRINCIPAL -->
<?php include('includes/header.php');  ?>

    <div class="container w-100 bg-white div-contenido formulario-contacto">
        <section class="bg-grey">
            <div class="container d-flex justify-content-center">
                
                <div class="row w-100">
                    <div class="container text-center my-4">
                        <h2 class="font-weight-bold titulo-contacto">Contacto</h2>
                    </div>
                    <div class="col-md-6 mb-4">
                        <p><i class="far fa-envelope titulo-contacto mr-2 lead"></i>eneventsceja@gmail.com</p>
                        <p><i class="far fa-map-marker-alt titulo-contacto mr-2 lead"></i>La Ceja - Antioquia. Punto Cien</p>
                        <p><i class="far fa-phone titulo-contacto mr-2 lead"></i>4 5531414 EXT-1943</p>
                        <div class="container ubicacion-contacto">   
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d963.695103276273!2d-75.43339382818662!3d6.031188363261974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e469753183b04fb%3A0xeb1741fda36ec9da!2sPunto%20CIEM!5e0!3m2!1ses!2sco!4v1614627890372!5m2!1ses!2sco" style="border:0;"></iframe>
                        </div>
                        
                    </div>
                    <div class="col-md-6 mb-3">
                        <form method="post" onsubmit="return contacto();">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <input type="text" name="nombre" id="nombre" class="form-control mb-4" placeholder="Ingresa tu nombre" maxlength="60" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <input type="email" name="correo" id="correo" class="form-control mb-4" placeholder="Ingresa tu correo" maxlength="80" required>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <input type="text" name="telefono" id="telefono" class="form-control mb-4" placeholder="Ingresa tu teléfono" maxlength="30" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <textarea name="mensaje" id="mensaje" cols="20" rows="8" class="form-control mb-3" placeholder="Mensaje" maxlength="500" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 ">
                                    <button type="submit" name="Enviar" value="Enviar" class="btn btn-contacto mb-2 float-right"><b class="font-weight-bold">Enviar</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


<!-- INVOCO EL FOOTER PRINCIPAL -->
<?php include('includes/footer.php') ?>
</body>
</html>