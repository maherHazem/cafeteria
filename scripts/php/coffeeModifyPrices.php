<?php
/**
 * PROCESS: Manage prices of products
 * DESCRIPTION: The user wants to change the price tag of a product. The script shows a table with all available
 * products registered in the database with their respective price, and the price can then be modified if clicked.
 * Restricted to the admin and manager users.
 * INPUT: None
 * OUTPUT: Table with all registered products with their respective price.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||($_SESSION['rol']!=1&&$_SESSION['rol']!=2)) { //Check authorized access
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
        <span class="productsItem productsHeader">Precio</span>
<?php
        $count=0; //Variable to count how many products are
        $mesas=$pdo->query("SELECT p.id AS productId, nombre_producto, s.nombre subclaseNombre, precio_unitario FROM t_productos p JOIN t_subclases s ON s.id=p.subclase_id"); //Get products
        while($fila=$mesas->fetch(PDO::FETCH_ASSOC)) {
            $count++;
?>
        <span class="productsItem"><?=$fila['nombre_producto']?></span>
        <span class="productsItem"><?=$fila['subclaseNombre']?></span>
        <span class="productsItem"><a href="coffeePriceDetails.php?id=<?=$fila['productId']?>"><?=$fila['precio_unitario']?>€</a></span>
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