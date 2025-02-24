<form action="services/addCommandService.php" method="post">
    <fieldset>
<?php
if ($table['id_estado']==2) { //Change legend if the table is occupied or not
?>
        <legend>Añadiendo una comanda a la mesa <?=$table['n_mesa']?></legend>
<?php
} else {
?>
        <legend>Abriendo la mesa <?=$table['n_mesa']?></legend>
<?php
}
?>
        <input type="hidden" name="tableId" value="<?=$tableId?>">
        <input type="hidden" name="tableState" value="<?=$table['id_estado']?>">
        <div class="formDiv">
            <label for="pedido" class="formLabel">
                Producto:
                <select name="pedido" id="pedido" required>
<?php
while ($fila=$products->fetch(PDO::FETCH_ASSOC)) { //Set all available products
?>
                    <option value="<?=$fila['productId']?>" <?=$fila['stock']==0?'disabled':''?>><?=$fila['stock']==0?'AGOTADO | ':''?><?=$fila['nombre_producto']?> | <?=$fila['subclase']?> | <?=$fila['precio_unitario']?>€</option>
<?php
}
?>
                </select>
            </label>
            <label for="paraBarra" class="formLabel">
                Para barra:
                <input type="radio" name="para" id="paraBarra" value="barra" checked>
            </label>
            <label for="paraCocina" class="formLabel">
                Para cocina:
                <input type="radio" name="para" id="paraCocina" value="cocina">
            </label>
            <label for="detalles" class="formLabel">
                Detalles adicionales:
                <textarea name="detalles" id="detalles"></textarea>
            </label>
        </div>
        <label for="submit" class="formLabel">
            Enviar:
            <input type="submit" value="Enviar" id="submit">
        </label>
    </fieldset>
</form>