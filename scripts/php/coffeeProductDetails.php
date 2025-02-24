<?php
/**
 * PROCESS: Modify a product
 * DESCRIPTION: The user wants to modify a selected product, coming from the script "coffeeModifyProducts.php". The 
 * script shows the formulary to modify all the relevant values of a product, such as name, class, subclass, etc. These
 * inputs are already filled with the previous values to ease the changes. Restricted to the admin user.
 * INPUT: Id of the product
 * OUTPUT: A formulary to modify the selected product
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1||!isset($_GET['id'])) { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('database/crudPDODatabase.php'); //Connection
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
?>
    <button><a href="coffeeModifyProducts.php" class="navLink">Volver atrás</a></button>
<?php
    $id=$_GET['id'];
    try {
        $product = $pdo->query("SELECT nombre_producto, clase_id, subclase_id, precio_unitario, stock FROM t_productos WHERE id=$id");
        $product = $product->fetch(PDO::FETCH_ASSOC); //Get product
        include_once('../../templates/loggedIn/forms/productForms/modifyProductForm.php');
    } catch (PDOException $e) {
        echo "Ha habido un error, avise a su encargado";
        echo "Error: ".$e->getMessage();
    }
}
include_once('../../templates/global/plantillaFooter.php');
?>