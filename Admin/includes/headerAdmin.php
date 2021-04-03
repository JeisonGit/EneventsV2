<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Usuario</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../archivos/principio/favicon.png">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- ICONOS - TIPOGRAFIA -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;700&display=swap" rel="stylesheet">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

    <!-- Ckeditor (Para textarea) -->
    <script src="../ckeditor/ckeditor.js"></script>

    <!-- Sweet alerts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Estilos Admin -->
    <link rel="stylesheet" href="css/estilos.css">

    <!-- Validaciones -->
    <script src="../js/validaciones.js"></script>

    <!-- Funciones javascript -->
    <script src="js/main.js"></script>
    
</head>
<body>
    
    <!-- MENU -->
    <div class="d-flex" id="wrapper">

        <!-- MENU LATERAL -->
        <div class="bg-dark menu-principal" id="sidebar-wrapper">
            <div class="sidebar-heading text-logo font-weight-bold">
                <img src="../archivos/principio/Logo.png" height="60">
            </div>
            <div class="list-group list-group-flush">
                <ul class="lisst-unstyled components lista-menu">
                    <li>
                        <a href="inicio.php" class="d-block text-light p-3"><i class="far fa-home mr-2 lead"></i>Inicio</a>
                    </li>
                    <li>
                        <a href="#submenuusuarios" data-toggle="collapse" aria-expanded="false" class="d-block dropdown-togle text-light p-3"><i class="far fa-users mr-2 lead"></i>Usuarios <i class="fas fa-sort-down text-white lead ml-2"></i></a>
                        <ul class="collapse lisst-unstyled lista-menu" id="submenuusuarios">
                            <li>
                                <a href="insertUsuario.php" class="d-block text-light p-2"><i class="far fa-user-plus mr-2 lead"></i>Agregar Usuario</a>
                            </li>
                            <li>
                                <a href="selectUsuarios.php?Estado=Activos" class="d-block text-light p-2"><i class="far fa-user-check mr-2 lead"></i>Usuarios Activos</a>
                            </li>
                            <li>
                                <a href="selectUsuarios.php?Estado=Inactivos" class="d-block text-light p-2"><i class="far fa-user-lock mr-2 lead"></i>Usuarios Blockeados</a>
                            </li>
                            <li>
                                <a href="selectUsuarios.php?Estado=Espera" class="d-block text-light p-2"><i class="far fa-id-card-alt mr-2 lead"></i>Solicitud Usuarios</a>
                            </li>
                            <li>
                                <a href="selectAdmins.php" class="d-block text-light p-2"><i class="far fa-user-shield mr-2 lead"></i>Administradores</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenueventos" data-toggle="collapse" aria-expanded="false" class="d-block dropdown-togle text-light p-3"><i class="far fa-calendar-alt mr-2 lead"></i>Eventos <i class="fas fa-sort-down text-white lead ml-2"></i></a>
                        <ul class="collapse lisst-unstyled lista-menu" id="submenueventos">
                            <li>
                                <a href="insertEventoAdmin.php" class="d-block text-light p-2"><i class="far fa-calendar-plus mr-2 lead"></i>Agregar Evento Administrativo</a>
                            </li>
                            <li>
                                <a href="selectEventos.php?Estado=Activos" class="d-block text-light p-2"><i class="far fa-calendar-check mr-2 lead"></i>Eventos Activos</a>
                            </li>
                            <li>
                                <a href="selectEventos.php?Estado=Inactivos" class="d-block text-light p-2"><i class="far fa-calendar-times mr-2 lead"></i>Eventos Inactivos</a>
                            </li>
                            <li>
                                <a href="selectEventos.php?Estado=Espera" class="d-block text-light p-2"><i class="far fa-calendar-minus mr-2 lead"></i>Solicitud Eventos</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="reportesAdmin.php" class="d-block text-light p-3"><i class="far fa-clipboard mr-2 lead"></i> Reportes</a>
                    </li>
                    <li>
                        <a href="configAdmin.php" class="d-block text-light p-3"><i class="far fa-cogs mr-2 lead"></i> Configuración</a>
                    </li>
                    <li>
                        <a href="../sesion/logout.php" class="d-block text-light p-3"><i class="far fa-sign-out-alt mr-2 lead"></i> Cerrar Sesión</a>
                    </li>   
                </ul>
            </div>
        </div>
        <!-- /MENU LATERAL -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <!-- MENU HORIZONTAL -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
                <button class="btn btn-menu font-weight-bold" id="menu-toggle">Abrir/Cerrar Menú</button>

                <button class="navbar-toggler mr-5" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <!-- <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon ion-md-person mr-2 text-white lead"></i>Administrador</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="inicio.php">Mi Perfil</a>
                                <a class="dropdown-item" href="#">Notificaciones</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../sesion/logout.php">Cerrar Sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- /MENU HORIZONTAL -->

            <div class="container-fluid">

