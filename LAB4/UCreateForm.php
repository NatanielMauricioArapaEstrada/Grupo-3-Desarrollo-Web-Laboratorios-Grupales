<body>
    <form action="javascript:MInsertar()" method="post" id="FormCreate">
        <label>Nombre</label>
        <input type="text" name="nombre" required><br>

        <label>Correo</label>
        <input type="email" name="correo" required><br>

        <label>Contraseña</label>
        <input type="password" name="password" required><br>

        <label>Nivel</label>
        <select name="nivel" required>
            <option value="0">Administrador</option>
            <option value="1">Usuario</option>
        </select><br>

        <label>Estado</label>
        <select name="estado" required>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select><br>

        <input type="submit" value="Insertar">
    </form>
</body>
