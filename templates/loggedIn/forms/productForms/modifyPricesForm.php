<form action="services/modifyPriceService.php" method="post">
    <fieldset>
        <input type="hidden" name="id" value="<?=$id?>">
        <legend>Modificando el precio del producto "<?=$product['nombre_producto']?>"</legend>
        <div class="formDiv">
            <label for="price" class="formLabel">
                Precio:
                <input type="number" name="price" id="price" step="0.01" min="0.01" value="<?=$product['precio_unitario']?>" required>
            </label>
        </div>
        <label for="submit" class="formLabel">
            Enviar:
            <input type="submit" value="Enviar" id="submit">
        </label>
    </fieldset>
</form>