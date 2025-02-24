<form action="services/chargeTableService.php" method="post">
    <fieldset>
        <legend>Cerrando la mesa <?=$tableNumber['n_mesa']?></legend>
        <input type="hidden" name="tableId" value="<?=$tableId?>">
        <div class="tableCommands">
            <span class="productsHeader productsItem">Producto</span>
            <span class="productsHeader productsItem">Precio</span>
<?php
    $sum=[];
    $commandsIds=[];
    $count=0;
    while ($tableData=$tableInfo->fetch(PDO::FETCH_ASSOC)) {
        $count++;
        array_push($sum, $tableData['precio_unitario']);
        array_push($commandsIds, $tableData['comandaId']);
?>
            <span class="productsItem"><?=$tableData['nombre_producto']?></span>
            <span class="productsItem"><?=$tableData['precio_unitario']?> €</span>
<?php
    }
    if ($count==0) {
?>
            <span class="productsItem">Sin información</span>
            <span class="productsItem">Sin información</span>
<?php
    } 
?>
        <span class="productsHeader productsItem">Total:</span>
        <span class="productsItem"><?=array_sum($sum)?> €</span>
        </div>
        <label for="submit" class="formLabel">
            Confirmar:
            <input type="submit" value="Confirmar y cerrar" id="submit">
        </label>
    </fieldset>
</form>