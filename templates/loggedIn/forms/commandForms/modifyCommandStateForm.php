<form action="services/modifyCommandState.php" method="post">
    <fieldset>
        <legend>Modificando estado de la comanda "<?=$command['nombre_producto']?>" de la mesa <?=$command['n_mesa']?></legend>
        <input type="hidden" name="commandId" value="<?=$commandId?>">
        <div class="formDiv">
            <label for="estado" class="formLabel">
                Estado:
                <select name="estado" id="estado">
                    <option value="servido">Servido</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </label>
        </div>
        <label for="submit" class="formLabel">
            Enviar:
            <input type="submit" value="Enviar" id="submit">
        </label>
    </fieldset>
</form>