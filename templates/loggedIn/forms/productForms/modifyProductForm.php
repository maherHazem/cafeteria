<form action="services/modifyProductService.php" method="post">
    <fieldset>
        <input type="hidden" name="id" value="<?=$id?>">
        <legend>Modificando el producto "<?=$product['nombre_producto']?>"</legend>
        <div class="formDiv">
            <label for="productName" class="formLabel">
                Nombre del producto:
                <input type="text" name="productName" id="productName" value="<?=$product['nombre_producto']?>" required>
            </label>
            <label for="productClass" class="formLabel">
                Clase:
                <select name="productClass" id="productClass" required>
                <?php
$class = $pdo->query("SELECT id, nombre FROM t_clases");
while ($fila = $class->fetch(PDO::FETCH_ASSOC)) {
    ?>  
    <option value="<?=$fila['id']?>" <?=$product['clase_id']==$fila['id']?'selected':''?>><?=$fila['nombre']?></option>
    <?php
}
?>
                </select>
            </label>
            <label for="productSubClass" class="formLabel">
                Subclase:
                <select name="productSubClass" id="productSubClass" required>
<?php
$subclass = $pdo->query("SELECT id, nombre FROM t_subclases");
while ($fila = $subclass->fetch(PDO::FETCH_ASSOC)) {
    ?>  
    <option value="<?=$fila['id']?>" <?=$product['subclase_id']==$fila['id']?'selected':''?>><?=$fila['nombre']?></option>
    <?php
}
?>
                </select>
            </label>
            <label for="price" class="formLabel">
                Precio:
                <input type="number" name="price" id="price" step="0.01" min="0.01" value="<?=$product['precio_unitario']?>" required>
            </label>
            <label for="stock" class="formLabel">
                Stock:
                <input type="number" name="stock" id="stock" step="1" min="1" value="<?=$product['stock']?>" required>
            </label>
        </div>
        <label for="submit" class="formLabel">
            Enviar:
            <input type="submit" value="Enviar" id="submit">
        </label>
    </fieldset>
</form>