<form action="services/modifyEmployeeService.php" method="post">
    <fieldset>
        <legend>Modificando al empleado "<?=$employee['nombre_usuario']?>"</legend>
        <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <div class="formDiv">
            <label for="nombre_usuario" class="formLabel">
                Nombre de usuario:
                <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?=$employee['nombre_usuario']?>" required>
            </label>
            <label for="clave_usuario" class="formLabel">
                Nueva clave:
                <input type="text" name="clave_usuario" id="clave_usuario" required>
            </label>
            <label for="id_rol" class="formLabel">
                Rol del usuario:
                <select name="id_rol" id="id_rol">
<?php
while ($fila=$roles->fetch(PDO::FETCH_ASSOC)) {
?>
                    <option value="<?=$fila['id']?>" <?=$employee['id_rol']==$fila['id']?'selected':''?>><?=$fila['nombre_rol']?></option>
<?php
}
?>
                </select>
            </label>
        </div>
        <label for="submit" class="formLabel">
            Enviar:
            <input type="submit" value="Enviar" id="submit">
        </label>
    </fieldset>
</form>