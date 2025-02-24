<form action="services/modifyCommandService.php" method="post">
    <fieldset>
        <legend>Modificando comanda de la mesa <?=$table['n_mesa']?></legend>
        <input type="hidden" name="commandId" value="<?=$commandId?>">
        <div class="formDiv">
            <label for="pedido" class="formLabel">
                Producto:
                <select name="pedido" id="pedido" required>
<?php
while ($fila=$products->fetch(PDO::FETCH_ASSOC)) { //Set all available products, select the one that matches the command product ID
?>
                    <option value="<?=$fila['productId']?>" <?=$fila['stock']==0?'disabled':''?> <?=$table['pedido']==$fila['productId']?'selected':''?>><?=$fila['stock']==0?'AGOTADO | ':''?><?=$fila['nombre_producto']?> | <?=$fila['subclase']?> | <?=$fila['precio_unitario']?>€</option>
<?php
}
?>
                </select>
            </label>
            <label for="paraBarra" class="formLabel">
                Para barra:
                <!--Set to 'checked' the radio button that matches the command-->
                <input type="radio" name="para" id="paraBarra" value="barra" <?=$table['barra']==1?'checked':''?>>
            </label>
            <label for="paraCocina" class="formLabel">
                Para cocina:
                <input type="radio" name="para" id="paraCocina" value="cocina" <?=$table['cocina']==1?'checked':''?>>
            </label>
            <label for="detalles" class="formLabel">
                Detalles adicionales:
                <textarea name="detalles" id="detalles"><?=$table['detalles_pedido']?></textarea>
            </label>
        </div>
        <label for="submit" class="formLabel">
            Enviar:
            <input type="submit" value="Enviar" id="submit">
        </label>
    </fieldset>
</form>