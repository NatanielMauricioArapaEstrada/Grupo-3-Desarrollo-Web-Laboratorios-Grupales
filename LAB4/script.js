function abrir_modal() {
  document.getElementById("modalRedactar").style.display = "block";
}


function cerrar_modal() {
  document.getElementById("modalRedactar").style.display = "none";
}




function verificar_envio_a_todos(ok) {
  const modalResultado = document.getElementById("modalResultado");
  const mensaje = document.getElementById("mensaje_resultado");

  if (ok) {
    mensaje.innerText = "Mensaje enviado exitosamente a todos los usuarios.";
    cerrar_modal(); // Cierra el de redacción
  } else {
    mensaje.innerText = "Hubo un error al enviar el mensaje.";
  }

  modalResultado.style.display = "block";
}


function cerrar_modal_resultado() {
  document.getElementById("modalResultado").style.display = "none";
}




document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formRedactar");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const asunto = form.asunto.value;
    const descripcion = form.descripcion.value;

    const datos = { asunto, descripcion };

    fetch("enviar_a_todos.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(datos)
    })
    .then(res => res.json())
    .then(data => {
      verificar_envio_a_todos(data.exito);
      form.reset();
    })
    .catch(error => {
      console.error("Error:", error);
      verificar_envio_a_todos(false);
    });
  });
});

function cargarContenido(abrir) {
	var contenedor;
	contenedor = document.getElementById('contenido');
	fetch(abrir)
		.then(response => response.text())
		.then(data => contenedor.innerHTML=data);
}


function cargarTablas(abrir) {
	var contenedor;
	contenedor = document.getElementById('tabla');
	fetch(abrir)
		.then(response => response.text())
		.then(data => contenedor.innerHTML=data);
}

function cargarInicio() {
  cargarContenido("inicio.php");
    setTimeout(() => {
        
        cargarTablas("BEntrada.php");
    }, 20); // 0.2 segundos
}

// funcion de read usuarios con ajax
fetch("inicio.php")
    .then(response => response.text())
    .then(data => {
        document.getElementById("contenido").innerHTML = data;
    });
fetch("BEntrada.php")
    .then(response => response.text())
    .then(data => {
        document.getElementById("tabla").innerHTML = data;
    });

function mostrarModalCreate() {
    const modal = document.getElementById("myModalCreate");
    document.getElementById('tituloModalCreate').innerHTML = "CREAR USUARIO";
    
    fetch("UCreateForm.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("mensajeModalCreate").innerHTML = data;
            document.getElementById('btnUltimos').style.display = "none";
            modal.style.display = "flex";
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



function mostrarModalDelete(id) {
    const modal = document.getElementById("myModalDelete");
    document.getElementById('tituloModalDelete').innerHTML = "MENSAJE ELIMINADO";

    fetch(`UDelete.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById("mensajeModalDelete").innerHTML = data;
            document.getElementById('btnUltimos').style.display = "none";
            modal.style.display = "flex";
            actualizarListaMensajes();
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

  fetch("UCreate.php", {
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


function actualizarListaMensajes() {
    fetch("URead.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("contenido").innerHTML = data;
        });
}

function cambiarEstado(id) {
    fetch(`UCambiarEstado.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            console.log(data); 
            actualizarListaMensajes(); // Recarga la tabla
        })
        .catch(error => {
            console.error("Error al cambiar el estado:", error);
        });
}





function abrir_modal_mensaje() {
    // Mostrar el modal
    document.getElementById('modalMensajeIndividual').style.display = 'flex';
    // Limpiar campos
    document.getElementById('mensaje').value = "";
    document.getElementById('respuestaEnvio').innerHTML = "";



    // Cargar usuarios al select
    fetch("UUsuariosSelect.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById('destinatario').innerHTML = data;
        })
        .catch(error => console.error("Error cargando usuarios:", error));
}

// Enviar el formulario por fetch
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("formMensajeIndividual");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch("EnviarMensaje.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById("respuestaEnvio").innerHTML = data;
        cargarTablas("BEntrada.php");

        // Cerrar el modal después de unos segundos
  setTimeout(() => {
    document.getElementById("modalMensajeIndividual").style.display = "none";
    document.getElementById("formMensajeIndividual").reset();
  }, 1500);
      })
      .catch(error => {
        console.error("Error enviando mensaje:", error);
      });
    });
  } else {
    console.warn("Formulario de mensaje individual no encontrado");
  }
});





function guardarBorrador() {
  const mensaje = document.getElementById("mensaje").value;
  const destinatario = document.getElementById("destinatario").value;
  const asunto = document.getElementById("asunto").value.trim();

  if (!mensaje.trim()) {
    alert("El mensaje no puede estar vacío.");
    return;
  }

  const formData = new FormData();
  formData.append("mensaje", mensaje);
  formData.append("estado", "borrador");
  formData.append("id_destinatario", destinatario);
  formData.append("asunto", asunto);

  fetch("GuardarBorrador.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    document.getElementById("respuestaEnvio").innerHTML = data;

    setTimeout(() => {
      document.getElementById("modalMensajeIndividual").style.display = "none";
      document.getElementById("formMensajeIndividual").reset();
    }, 2000);
  })
  .catch(error => {
    console.error("Error guardando borrador:", error);
  });
}



function eliminarMensaje(abrir,id) {
   

    fetch(`MEliminar.php?id=${id}`, { method: "GET" })
        .then(response => response.text())
        .then(data => {
            alert(data); // Muestra mensaje de éxito o error
            cargarTablas(abrir);// Recarga la tabla de mensajes
        })
        .catch(error => console.error("Error eliminando mensaje:", error));
}

function eliminarMensaje(abrir,id) {
    fetch(`MEliminar.php?id=${id}`, { method: "GET" })
        .then(() => {
            cargarTablas(abrir); // Recarga la tabla sin ninguna interrupción
        })
        .catch(error => console.error("Error eliminando mensaje:", error));
}



function abrir_modal_mensaje_ver(tipo, id) {
  let archivo = tipo === 'entrada' ? 'MEntrada.php' : 'MSalida.php';

  fetch(`${archivo}?id=${id}`)
    .then(response => response.json())
    .then(data => {
      const modal = document.getElementById('modalVerMensaje');
      const titulo = tipo === 'entrada'
        ? `Remitente: ${data.nombre} (${data.correo})`
        : `Destinatario: ${data.nombre} (${data.correo})`;

      document.getElementById('tituloModalMensaje').innerText = titulo;
      document.getElementById('asuntoMensaje').innerText = data.asunto;
      document.getElementById('descripcionMensaje').innerText = data.descripcion;
      document.getElementById('estadoMensaje').innerText = data.estado;

      modal.style.display = 'flex';
      if (tipo === 'entrada' && data.estado === 'no_leido') {
        cambiarEstadoVer(id);
      }
    });
}


function cerrarModalPorId(idModal) {
  const modal = document.getElementById(idModal);
  if (modal) modal.style.display = "none";
}




function cambiarEstadoVer(id) {
  fetch('MCambiarEstado.php', {
    method: 'POST',
    body: new URLSearchParams({ id: id })
  })
  .then(response => response.text())
  .then(data => {
    if (data.trim() === "ok") {
      cargarTablas('BEntrada.php'); // actualiza la tabla
      abrir_modal_mensaje_ver('entrada', id); // recarga el modal con estado actualizado
    }
  });
}




function abrir_modal_borrador(id) {
  fetch('MBorrador.php?id=' + id)
    .then(res => res.json())
    .then(data => {
      document.getElementById('idBorrador').value = data.id;
      document.getElementById('asuntoBorrador').value = data.asunto;
      document.getElementById('descripcionBorrador').value = data.descripcion;

      // Cargar destinatarios disponibles
      fetch('MUsuarios.php') // este archivo debe devolver un <option> por usuario
        .then(res => res.text())
        .then(opciones => {
          const select = document.getElementById('destinatarioBorrador');
          select.innerHTML = opciones;
          select.value = data.id_destinatario; // selecciona el destinatario actual
        });

      document.getElementById('modalEditarBorrador').style.display = 'flex';
    });
}





function guardarBorradorUpdate() {
  enviarFormularioBorrador('borrador');
}

function enviarBorrador() {
  enviarFormularioBorrador('no_leido');
}

function enviarFormularioBorrador(estado) {
  const form = document.getElementById('formEditarBorrador');
  const datos = new FormData(form);
  datos.append('estado', estado);

  fetch('MUpdateBorrador.php', {
    method: 'POST',
    body: datos
  })
  .then(res => res.text())
  .then(data => {
    if (data.trim() === "ok") {
      cerrarModalBorrador();
      cargarTablas('BBorradores.php');
    }
  });
}

function cerrarModalBorrador() {
  document.getElementById('modalEditarBorrador').style.display = 'none';
  document.getElementById('formEditarBorrador').reset();
}

function abrir_modal_mensaje_ver_admin(id) {
  fetch(`MVerAdmin.php?id=${id}`)
    .then(res => res.json())
    .then(data => {
      // Cargar datos en el modal
      const titulo = `Remitente: ${data.remitente} (${data.correo_remitente})<br>Destinatario: ${data.destinatario} (${data.correo_destinatario})`;
      document.getElementById('tituloModalMensaje').innerHTML = titulo;
      document.getElementById('asuntoMensaje').innerText = data.asunto;
      document.getElementById('descripcionMensaje').innerText = data.descripcion;
      document.getElementById('estadoMensaje').innerText = data.estado;

      // Mostrar el modal
      document.getElementById('modalVerMensaje').style.display = 'flex';
    })
    .catch(error => {
      console.error('Error al cargar el mensaje:', error);
    });
}


