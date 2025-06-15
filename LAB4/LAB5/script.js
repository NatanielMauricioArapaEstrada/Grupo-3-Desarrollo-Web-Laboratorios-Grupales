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


