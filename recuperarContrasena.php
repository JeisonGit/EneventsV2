<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('includes/funcionesUsuario.php');

    // Si se presiona el boton de enviar llamamos la funcion para enviar el correo con los pasos a seguir
    if(isset($_POST['Enviar'])){
        RecuperarContrasenaUsuario();
    }

?>

<!-- INVOCO EL HEADER PRINCIPAL -->
<?php include('includes/header.php');  ?>

    <div class="container w-100 div-contenido formularios-principales">
        <section class="bg-grey">
            <div class="container d-flex justify-content-center">
                <div class="col-lg-6 my-3">
                    <div class="card rounded-2 border border-warning">
                        <div class="card-body">

                            <!-- FORMULARIO LOGIN -->
                            <form method="POST" action="" onsubmit="return recuperarContrasena();">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3 mt-4 text-center">
                                        <p class="font-weight-bold">Ingresa los datos correspondientes para reestablecer tu contraseña</p>
                                    </div>

                                    <div class="col-md-12 col-sm-12 mb-4 px-5 input-login">
                                        <input type="number" name="documento" id="documento" class="form-control" placeholder="Número de Documento o NIT" required>
                                    </div>

                                    <div class="col-md-12 col-sm-12 mb-3 px-5 input-login">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Correo Empresarial Registrado" required>
                                    </div>

                                    <div class="col-md-12 col-sm-12 div-btnLogin mb-4">
                                        <button type="submit" name="Enviar" value="Enviar" class="btn-lg btn-login font-weight-bold">Enviar</button>
                                    </div>
                                </div>
                            </form>
                            <!-- FIN FORMULARIO LOGIN -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
  

<!-- INVOCO EL FOOTER PRINCIPAL -->
<?php include('includes/footer.php') ?>
</body>
</html>

