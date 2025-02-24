<?php
/**
 * PROCESS: Modify the price of a product
 * DESCRIPTION: The user has sent a formulary to change the price of a product, coming from the script 
 * "coffeePriceDetails.php" located in "../*". The script validates the filled data in the formulary and updates the
 * register in the database with the new given value if successful, redirecting the user to the script 
 * "coffeeModifyPrices.php", or sends an error message otherwise.
 * INPUT: Id of the product, new price value for the product
 * OUTPUT: An error message if it encounters a problem, redirects to "coffeeModifyPrices.php" otherwise
 */
session_start();
if (!isset($_SESSION['loggedIn'])||($_SESSION['rol']!=1&&$_SESSION['rol']!=2)||$_SERVER['REQUEST_METHOD']!='POST') { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        if (!is_numeric($_POST['price'])||$_POST['price']<0.01) { //Verify given data
?>
    <span>El precio debe ser un número positivo mayor o igual a 0.01</span> <br>
    <span><a href="../pdoCoffeeOptions.php">Volver al panel</a></span>
<?php
        } else {
            $producto = $pdo->prepare("UPDATE t_productos SET precio_unitario=? WHERE id=?");
            $producto->execute([$_POST['price'], $_POST['id']]); //Modify product with given data
            header('Location: ../coffeeModifyPrices.php'); //Go back
        }
    } catch (PDOException $e) {
?>
    <span><a href="../pdoCoffeeOptions.php">Volver atrás</a></span> <br>
    <span>Ha habido un error, contacte con su administrador del sistema</span> <br>
<?php
        echo "Error: ".$e->getMessage();
    }
    $pdo=null; //End connections
}
?>