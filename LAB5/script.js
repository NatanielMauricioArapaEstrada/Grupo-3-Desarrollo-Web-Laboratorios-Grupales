function cargarContenido(abrir) {
	var contenedor;
	contenedor = document.getElementById('contenido');
	fetch(abrir)
		.then(response => response.text())
		.then(data => contenedor.innerHTML=data);
}

function mostrarModalCreate() {
    const modal = document.getElementById("myModalCreate");
    document.getElementById('tituloModalCreate').innerHTML = "CREAR USUARIO";
    
    fetch("UcreateForm.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("mensajeModalCreate").innerHTML = data;
            document.getElementById('btnUltimos').style.display = "none";
            modal.style.display = "flex";
        });
}
window.onload = function () {
  cargarContenido('inicio.html');
};
function mostrarModalUpdate(id) {
    const modal = document.getElementById("myModalUpdate");
    document.getElementById('tituloModalUpdate').innerHTML = "EDITAR USUARIO";
    fetch(`UUpdateForm.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById("mensajeModalUpdate").innerHTML = data;
            document.getElementById('btnUltimos').style.display = "none";
            modal.style.display = "flex";
        });
} 
function MInsertar() {
  const formulario = document.getElementById("FormCreate");
  const parametros = new FormData(formulario);
  const datos = document.getElementById("contenido");
  const datos2 = document.getElementById("mensajeModalCreate");

  // Limpiar zonas de respuesta antes de enviar
  datos.innerHTML = "";
  datos2.innerHTML = ""; 

  fetch("Ucreate.php", {
    method: "POST",
    body: parametros
  })
  .then(response => response.text())
  .then(resultado => {
    datos.innerHTML = resultado;
    datos2.innerHTML = resultado;
    actualizarListaMensajes();

    // Cerrar modal y resetear formulario
    document.getElementById("myModalCreate").style.display = "none";
    formulario.reset();
  })
  .catch(error => {
    console.error("Error al insertar:", error);
    datos2.innerHTML = "Error al insertar el usuario.";
  });
}

function actualizarListaMensajes() {
    fetch("Uread.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("contenido").innerHTML = data;
        });
}

function cerrarModalPorId(idModal) {
  const modal = document.getElementById(idModal);
  if (modal) modal.style.display = "none";
}


function mostrarModalDelete(id) {
    const modal = document.getElementById("myModalDelete");
    document.getElementById('tituloModalDelete').innerHTML = "USUARIO ELIMINADO";

    fetch(`Udelete.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById("mensajeModalDelete").innerHTML = data;
            document.getElementById('btnUltimos').style.display = "none";
            modal.style.display = "flex";
            actualizarListaMensajes();
        });
}

function mostrarModalUpdate(id) {
    const modal = document.getElementById("myModalUpdate");
    document.getElementById('tituloModalUpdate').innerHTML = "EDITAR USUARIO";
    fetch(`UUpdateForm.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById("mensajeModalUpdate").innerHTML = data;
            document.getElementById('btnUltimos').style.display = "none";
            modal.style.display = "flex";
        });
}
function UEditar() {
    const formulario = document.getElementById("FormUpdate");
    const parametros = new FormData(formulario);
    const datos = document.getElementById("mensajeModalUpdate");
    const id = formulario.id.value;

    datos.innerHTML = "";

    fetch(`UUpdate.php?id=${id}`, {
        method: "POST",
        body: parametros
    })
    .then(response => response.text())
    .then(data => {
        datos.innerHTML = data;
        actualizarListaMensajes();
    });
}

/*funciones de la CRUD HABITACIONES */

function cerrarModalH() {
    console.log("Cerrar modal");
    document.getElementById("myModal").style.display = "none";
}

function mostrarTabla() {
   var tabla = document.getElementById("tabla");
    fetch("HRead.php")
        .then((response) => response.text())
	    .then((data) => {
            tabla.innerHTML = data;
        });
}

function formCrear() {
   fetch("Hform.php")
       .then((response) => response.text())
       .then((data) => {
            document.querySelector("#titulo-modal").innerHTML = "Crear"
		    document.querySelector("#contenido-modal").innerHTML = data
		    document.getElementById("myModal").style.display = "block";
       });
}

function Hinsertar(){
    var form = document.getElementById("formulario");
    var formData = new FormData(form);
    fetch("HCreate.php", {
        method: "POST",
        body: formData
    })
    .then((response) => response.text())
    .then((data) => {
        mostrarTabla();
    });
}

function confirmarEliminacion(id) {
    document.querySelector("#titulo-modal").innerHTML = "Confirmar eliminación";
    document.querySelector("#contenido-modal").innerHTML = `
        <p>¿Estás seguro de que quieres eliminar este elemento?</p>
        <button onclick="eliminar(${id})">Sí, eliminar</button>
        <button onclick="cerrarModalH()">Cancelar</button>
    `;
    document.getElementById("myModal").style.display = "block";
}

function eliminar(id) {
    fetch("HDelete.php?id=" + id)
        .then((response) => response.text())
        .then((data) => {
            mostrarTabla();
        });
}

function editar(id) {
    fetch("HformActualizar.php?id=" + id)
       .then((response) => response.text())
       .then((data) => {
           document.querySelector("#titulo-modal").innerHTML = "Editar"
		   document.querySelector("#contenido-modal").innerHTML = data
		   document.getElementById("myModal").style.display = "block";
       });
}

function Hactualizar() {
    var form = document.getElementById("formulario");
    var formData = new FormData(form);
    fetch("HUpdate.php", {
        method: "POST",
        body: formData
    })
    .then((response) => response.text())
    .then((data) => {
        mostrarTabla();
    });
}

function mostrarVistaPrevia() {
            let selectImagen = document.getElementById('imagen');
            let vistaPrevia = document.getElementById('vistaPrevia');

            let imagenSeleccionada = selectImagen.options[selectImagen.selectedIndex].text;

            if (imagenSeleccionada) {
                vistaPrevia.src = 'imagenes/' + imagenSeleccionada;
                vistaPrevia.style.display = 'block';
            } else {
                vistaPrevia.style.display = 'none';
            }
}
// --------------------------------------------------------------------

function abrirModal(contenido) {
    fetch(contenido)
        .then(res => res.text())
        .then(html => {
            document.getElementById("modal-global").style.display = "block";
            document.getElementById("modal-body").innerHTML = html;
        });
}

function cerrarModal(event, id) {
    event.preventDefault(); 
    document.getElementById(id).style.display = "none"; 
}

function abrirModalReserva(idHabitacion) {
    fetch('modal_reservar.php?id=' + idHabitacion)
        .then(res => res.text())
        .then(html => {
            document.getElementById("modal-global").style.display = "block";
            document.getElementById("modal-body").innerHTML = html;
        });
}

function seleccionarYBuscar(tipo, event) {
    event.preventDefault(); 

    const select = document.getElementById("tipo");
    select.value = tipo;

   
    buscarHabitaciones(new Event("submit"));
}



function buscarHabitaciones(event) {
    event.preventDefault(); 

    const tipo = document.getElementById("tipo").value;

  
    if (!tipo) {
        alert("Por favor, selecciona un tipo de habitación.");
        return;
    }

    const formData = new FormData();
    formData.append("tipo", tipo);

    fetch("buscar.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById("contenido").innerHTML = html;
    })
    .catch(err => {
        console.error("Error al buscar habitaciones:", err);
        document.getElementById("contenido").innerHTML = "<p>Ocurrió un error al buscar habitaciones.</p>";
    });
}




function confirmarReserva(event, idHabitacion) {
    event.preventDefault();

    const form = event.target;
    const fechaIngreso = form.fecha_ingreso.value;
    const fechaSalida = form.fecha_salida.value;

    const datos = new FormData();
    datos.append("id_habitacion", idHabitacion);
    datos.append("fecha_ingreso", fechaIngreso);
    datos.append("fecha_salida", fechaSalida);

    fetch("guardar_reserva.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.text())
    .then(html => {
      
        document.getElementById("modal-body").innerHTML = html;
    })
    .catch(error => {
        console.error("Error al reservar:", error);
        document.getElementById("modal-body").innerHTML = `
            <div style="text-align: center; color: red;">
                <h3>Error</h3>
                <p>No se pudo contactar al servidor.</p>
                <button onclick="cerrarModal(event, 'modal-global')">Cerrar</button>
            </div>`;
    });
}

function editarReserva(id) {
    abrirModal(`editar_reserva.php?id=${id}`);
}




function cancelarReserva(idReserva, idHabitacion) {
    const datos = new FormData();
    datos.append("id_reserva", idReserva);
    datos.append("id_habitacion", idHabitacion);

    fetch("eliminar_reserva.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById("modal-global").style.display = "block";
        document.getElementById("modal-body").innerHTML = html;

        setTimeout(() => {
            cerrarModal(new Event("click"), "modal-global");
            cargarContenido("misReservas.php");
        }, 2000);
    });
}



function guardarCambiosReserva(event, idReserva) {
    event.preventDefault();
    const form = event.target;

    const datos = new FormData(form);
    datos.append("id_reserva", idReserva);

    fetch("Qeditar_reserva.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById("modal-body").innerHTML = html;
    });
}


function eliminarReserva(event, idReserva) {
    event.preventDefault();

    const datos = new FormData();
    datos.append("id_reserva", idReserva);

    fetch("eliminar_reserva.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById("modal-body").innerHTML = html;
        setTimeout(() => {
            cargarContenido('misReservas.php');
            cerrarModal(new Event("click"), "modal-global");
        }, 2000);
    });
}