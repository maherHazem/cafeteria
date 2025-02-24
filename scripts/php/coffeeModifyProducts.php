<?php
/**
 * PROCESS: Manage products
 * DESCRIPTION: The user wants to manage the products of the database. The script shows the user a table with all the
 * relevant information regarding the registered products and the option to either modify, delete or add new product.
 * Restricted to the admin user.
 * INPUT: None
 * OUTPUT: A table with all the products registered in the database and the buttons to make a CRUD of them.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1) { //Check authorized access
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
        <button><a href="coffeeAddProduct.php" class="navLink">Añadir producto</a></button>
    </span>
<?php
    try {
?>
    <div class="products">
        <span class="productsItem productsHeader">Nombre</span>
        <span class="productsItem productsHeader">Clase</span>
        <span class="productsItem productsHeader">Subclase</span>
        <span class="productsItem productsHeader">Precio</span>
        <span class="productsItem productsHeader">Stock</span>
        <span class="productsItem productsHeader">Eliminar producto</span>
<?php
        $count=0; //Variable to count how many products are
        $mesas=$pdo->query("SELECT p.id, nombre_producto, c.nombre claseNombre, s.nombre subclaseNombre, precio_unitario, stock FROM t_productos p JOIN t_clases c ON p.clase_id=c.id JOIN t_subclases s ON p.subclase_id=s.id"); //Get products
        while($fila=$mesas->fetch(PDO::FETCH_ASSOC)) {
            $count++;
?>
        <span class="productsItem"><a href="coffeeProductDetails.php?id=<?=$fila['id']?>"><?=$fila['nombre_producto']?></a></span>
        <span class="productsItem"><?=$fila['claseNombre']?></span>
        <span class="productsItem"><?=$fila['subclaseNombre']?></span>
        <span class="productsItem"><?=$fila['precio_unitario']?>€</span>
        <span class="productsItem"><?=$fila['stock']?></span>
        <span class="productsItem"><a href="services/deleteProductService.php?id=<?=$fila['id']?>">Eliminar</a></span>
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