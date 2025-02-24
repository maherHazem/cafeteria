<?php
/**
 * PROCESS: Modify the price of a product
 * DESCRIPTION: The user wants to change the price of a selected product, coming from the script 
 * "coffeeModifyPrices.php". The script  shows the user the formulary to do so, with the price value filled with the 
 * previous price to ease the change. Restricted to the admin and manager users.
 * INPUT: Id of the product
 * OUTPUT: Formulary to change the price of the product
 */
session_start();
if (!isset($_SESSION['loggedIn'])||($_SESSION['rol']!=1&&$_SESSION['rol']!=2)||!isset($_GET['id'])) { //Check authorized access
    header('Location: pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('database/crudPDODatabase.php'); //Connection
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
?>
    <button><a href="coffeeModifyPrices.php" class="navLink">Volver atrás</a></button>
<?php
    $id=$_GET['id']; //Get product ID
    try {
        //Get product information
        $product = $pdo->query("SELECT nombre_producto, precio_unitario FROM t_productos WHERE id=$id");
        $product = $product->fetch(PDO::FETCH_ASSOC); //Get product
        include_once('../../templates/loggedIn/forms/productForms/modifyPricesForm.php'); //Formulary
    } catch (PDOException $e) {
        echo "Ha habido un error, avise a su encargado";
        echo "Error: ".$e->getMessage();
    }
}
include_once('../../templates/global/plantillaFooter.php');
?>