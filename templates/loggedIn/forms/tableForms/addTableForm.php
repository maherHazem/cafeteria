<form action="services/addTableService.php" method="post">
    <fieldset>
        <legend>Añadiendo nueva mesa</legend>
        <div class="formDiv">
            <label for="n_mesa" class="formLabel">
                Número de la mesa:
                <input type="number" name="n_mesa" id="n_mesa" step="1" min="1">
            </label>
        </div>
        <label for="submit" class="formLabel">
            Enviar:
            <input type="submit" value="Enviar" id="submit">
        </label>
    </fieldset>
</form>