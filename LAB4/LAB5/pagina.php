<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js"></script>
    
    <link rel="stylesheet" href="css/pagina.css">
</head>
<body>
    <?php
    include("conexion.php");
    session_start();
    require("verificarsesion.php");
    require("verificarnivel.php");

    ?>


   <div class="navbar">
        <div class="links">

            <?php if ($_SESSION['nivel'] == 0) { ?>
                <a class="menu" href="javascript:cargarContenido('Uread.php')">Panel Administrador</a>

            <?php } ?>
            <a class="menu" href="cerrar.php">Cerrar sesión</a>
        </div>
    </div>

<br>

<br><br>






        
<div id="contenido">


</div>









<div id="modalRedactar" style="display:none">
  <div class="modal-contenido">
    <h3>Redactar Mensaje</h3>
    <form id="formRedactar">
      <label>Asunto:</label><br>
      <input type="text" name="asunto" required><br><br>

      <label>Mensaje:</label><br>
      <textarea name="descripcion" rows="5" required></textarea><br><br>

      <button type="submit">Enviar a todos</button>
      <button type="button" onclick="cerrar_modal()">Cancelar</button>
    </form>
  </div>
</div>


<div id="modalResultado" style="display:none; background:#00000088; position:fixed; top:0; left:0; width:100%; height:100%;">
  <div style="background:white; padding:20px; width:40%; margin:20% auto; text-align:center;">
    <p id="mensaje_resultado"></p>
    <button onclick="cerrar_modal_resultado()">Aceptar</button>
  </div>
</div>


<!-- MODAL: CREAR USUARIO -->
<div id="myModalCreate" class="modal" style="display: none;">
    <div class="modal-content">
        <h2 id="tituloModalCreate"></h2>
        <div id="mensajeModalCreate"></div>
        <input type="hidden" id="idElemento">
        <button id="btnUltimos" style="display: none;">Últimos</button>
        <div style="text-align: right; margin-top: 10px;">
      <button onclick="cerrarModalPorId('myModalCreate')">Cerrar</button>
    </div>
    </div>
</div>

<!-- MODAL: EDITAR USUARIO -->
<div id="myModalUpdate" class="modal" style="display: none;">
    <div class="modal-content">
        
        <h2 id="tituloModalUpdate"></h2>
        <div id="mensajeModalUpdate"></div>
        <input type="hidden" id="idElemento">
        <button id="btnUltimos" style="display: none;">Últimos</button>
        <div style="text-align: right; margin-top: 10px;">
      <button onclick="cerrarModalPorId('myModalUpdate')">Cerrar</button>
    </div>
    </div>
</div>

<!-- MODAL: ELIMINAR USUARIO -->
<div id="myModalDelete" class="modal" style="display: none;">
    <div class="modal-content">
        <h2 id="tituloModalDelete"></h2>
        <div id="mensajeModalDelete"></div>
        <input type="hidden" id="idElemento">
        <button id="btnUltimos" style="display: none;">Últimos</button>
        <div style="text-align: right; margin-top: 10px;">
      <button onclick="cerrarModalPorId('myModalDelete')">Cerrar</button>
    </div>
    </div>
</div>





<!-- Modal para enviar mensaje individual -->
<div id="modalMensajeIndividual" class="modal" style="display:none;">
  <div class="modal-content">
    <h2>Enviar mensaje individual</h2>
    <form id="formMensajeIndividual">
      <label for="destinatario">Seleccionar usuario:</label><br>
      <select name="id_destinatario" id="destinatario" required></select><br><br>

      <label for="asunto">Asunto:</label><br>
      <input type="text" name="asunto" id="asunto" required><br><br>

      <label for="mensaje">Mensaje:</label><br>
      <textarea name="descripcion" id="mensaje" rows="5" required></textarea><br><br>

      <button type="submit">Enviar</button>
      <button type="button" onclick="guardarBorrador()">Guardar</button>
      <div style="text-align: right; margin-top: 10px;">
      <button type="button" formnovalidate onclick="cerrarModalPorId('modalMensajeIndividual')">Cerrar</button>
    </div>
    </form>
    <div id="respuestaEnvio"></div>
  </div>
</div>





<!-- Modal para ver mensaje en bandeja con boton ver -->
<div id="modalVerMensaje" class="modal" style="display: none;">
  <div class="modal-content">

    <h2 id="tituloModalMensaje"></h2>
    <p><strong>Asunto:</strong> <span id="asuntoMensaje"></span></p>
    <p><strong>Descripción:</strong> <span id="descripcionMensaje"></span></p>
    <p><strong>Estado:</strong> <span id="estadoMensaje"></span></p>
    
    <!-- Botón cerrar al final -->
    <div style="text-align: right; margin-top: 10px;">
      <button onclick="cerrarModalPorId('modalVerMensaje')">Cerrar</button>
    </div>
  </div>
</div>



<!-- Modal para ver mensaje en bandeja de borrador -->

<div id="modalEditarBorrador" style="display: none;" class="modal">
  <div class="modal-contenido">
    <h2>Editar Borrador</h2>
    <form id="formEditarBorrador">
      <input type="hidden" name="id" id="idBorrador">

      <label for="destinatarioBorrador">Destinatario:</label>
      <select name="id_destinatario" id="destinatarioBorrador" required></select>

      <label for="asuntoBorrador">Asunto:</label>
      <input type="text" name="asunto" id="asuntoBorrador" required>

      <label for="descripcionBorrador">Descripción:</label>
      <textarea name="descripcion" id="descripcionBorrador" required></textarea>

      <br>
      <button type="button" onclick="guardarBorrador()">Guardar</button>
      <button type="button" onclick="enviarBorrador()">Enviar</button>
      <button type="button" onclick="cerrarModalBorrador()">Cancelar</button>
    </form>
  </div>
</div>




</body>
</html>