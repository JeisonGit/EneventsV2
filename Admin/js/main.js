//Funciones para mostrar los eventos de cada usuario 

//Mostrar todos los eventos
function mostrarTodosEventos() {
    document.getElementById('tablaEventosActivosUsuario').style.display = 'block';
    document.getElementById('tablaEventosInactivosUsuario').style.display = 'block';
    document.getElementById('tablaEventosEsperaUsuario').style.display = 'block';
    document.getElementById('btnOcultarEventos').style.display = 'block';
    document.getElementById('btnMostrarEventos').style.display = 'none';
}
//Ocultar todos los eventos
function ocultarTodosEventos() {
    document.getElementById('tablaEventosActivosUsuario').style.display = 'none';
    document.getElementById('tablaEventosInactivosUsuario').style.display = 'none';
    document.getElementById('tablaEventosEsperaUsuario').style.display = 'none';
    document.getElementById('btnOcultarEventos').style.display = 'none';
    document.getElementById('btnMostrarEventos').style.display = 'block';
}

//Eventos activos
function mostrarEventosActivos() {
    document.getElementById('tablaEventosActivosUsuario').style.display = 'block';
    document.getElementById('tablaEventosInactivosUsuario').style.display = 'none';
    document.getElementById('tablaEventosEsperaUsuario').style.display = 'none';
}

function ocultarEventosActivos() {
    document.getElementById('tablaEventosActivosUsuario').style.display = 'none';
}

//Eventos Inactivos
function mostrarEventosInactivos() {
    document.getElementById('tablaEventosInactivosUsuario').style.display = 'block';
    document.getElementById('tablaEventosActivosUsuario').style.display = 'none';
    document.getElementById('tablaEventosEsperaUsuario').style.display = 'none';
}

function ocultarEventosInactivos() {
    document.getElementById('tablaEventosInactivosUsuario').style.display = 'none';
}

//Eventos En Espera
function mostrarEventosEspera() {
    document.getElementById('tablaEventosEsperaUsuario').style.display = 'block';
    document.getElementById('tablaEventosActivosUsuario').style.display = 'none';
    document.getElementById('tablaEventosInactivosUsuario').style.display = 'none';
}

function ocultarEventosEspera() {
    document.getElementById('tablaEventosEsperaUsuario').style.display = 'none';
}

