<?php
/**
 * PROCESS: Add a new product
 * DESCRIPTION: The user wants to register a new product to the database, coming from the script 
 * "coffeeModifyProducts.php". The script shows a formulary to fill and select the required values for a product.
 * Restricted to the admin user.
 * INPUT: None
 * OUTPUT: A formulary to add a new product
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1) { //Check authorized access
    header('Location: ./pdoCoffeeOptions.php');
} else {
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
?>
    <button><a href="coffeeModifyProducts.php" class="navLink">Volver atrás</a></button>
<?php
    include_once('database/crudPDODatabase.php');
    try {
        include_once('../../templates/loggedIn/forms/productForms/addProductForm.php'); //Reservation formulary
    } catch (PDOException $e) {
        echo "Ha habido un error, avise a su encargado";
        echo "Error: ".$e->getMessage();
    }
    include_once('../../templates/global/plantillaFooter.php');
}
?>