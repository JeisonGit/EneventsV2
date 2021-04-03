<?php

    // Llamo el archivo que contiene las funciones a utilizar en la interfaz
    include('includes/funcionesUsuario.php');

    // Si se oprime el boton Ingresar se llama a la funcion de iniciar sesion
    if(isset($_POST['Ingresar'])){
        IniciarSesion();
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
                            <form method="POST" onsubmit="return login();">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3 mt-4">
                                        <h4 class="font-weight-bold titulo-login">Iniciar Sesión</h4>
                                    </div>

                                    <div class="col-md-12 col-sm-12 mb-3 px-5 input-login">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Correo Empresarial" required>
                                    </div>

                                    <div class="col-md-12 col-sm-12 mb-4 px-5 input-login">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                                    </div>

                                    <div class="col-md-12 col-sm-12 text-center">
                                        <p class="font-weight-bold p-links">
                                            <a href="recuperarContrasena.php">¿Has olvidado tu contraseña?</a>
                                        </p>
                                        <p class="p-links">¿No tienes una cuenta?
                                            <a href="registrarse.php" class="font-weight-bold"> Regístrate</a>
                                        </p>
                                    </div>

                                    <div class="col-md-12 col-sm-12 div-btnLogin mb-4">
                                        <button type="submit" name="Ingresar" value="Ingresar" class="btn-lg btn-login font-weight-bold">Ingresar</button>
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

<!-- Evitar que puedan utilizar el boton de atras y volver a la sesion -->
<script>    
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
    history.pushState(null, null, document.URL);
    });
</script>    

<!-- INVOCO EL FOOTER PRINCIPAL -->
<?php include('includes/footer.php') ?>
</body>
</html>