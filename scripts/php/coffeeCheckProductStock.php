<?php
/**
 * PROCESS: Check the stock of the products
 * DESCRIPTION: The user wants to check the current stock of the products. The script shows a table with the name of
 * the products, their subclass and how many are currently in stock. Restricted to the admin, manager and in charge 
 * user.
 * INPUT: None
 * OUTPUT: A table with the products and their current stock
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']==4) { //Check authorized access
?>
    <span><a href="pdoCoffeeOptions.php">Volver atrás</a></span>
<?php
    include_once('../../templates/unlogged/accessRestringed.php');
} else {
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
    include_once('database/crudPDODatabase.php');
?>
    <span class="formLabel">
        <button><a href="pdoCoffeeOptions.php" class="navLink">Volver atrás</a></button>
    </span>
<?php
    try {
?>
    <div class="stockTable">
        <span class="productsItem productsHeader">Producto</span>
        <span class="productsItem productsHeader">Subclase</span>
        <span class="productsItem productsHeader">Stock</span>
<?php
        $count=0; //Variable to count how many products are
        $mesas=$pdo->query("SELECT nombre_producto, nombre, stock FROM t_productos p JOIN t_subclases s ON p.subclase_id=s.id"); //Get products
        while($fila=$mesas->fetch(PDO::FETCH_ASSOC)) {
            $count++;
?>
        <span class="productsItem"><?=$fila['nombre_producto']?></span>
        <span class="productsItem"><?=$fila['nombre']?></span>
        <span class="productsItem"><?=$fila['stock']?></span>
        <?php
        }
?>
        </div>
<?php
        if ($count==0) { //No products
?>
    <span>No hay productos registrados</span>
<?php
        }
    } catch (PDOException $e) {
        echo "Ha habido un error, avise a su encargado";
        echo "Error: ".$e->getMessage();
    }
}
$pdo=null;
$mesas=null;
include_once('../../templates/global/plantillaFooter.php');
?>