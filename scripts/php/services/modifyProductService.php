<?php
/**
 * PROCESS: Modify a product
 * DESCRIPTION: The user sent a formulary to modify a product, coming from the script "coffeeProductDetails.php"
 * located in "../*". The script validates the given data in the formulary and updates the product with the new values
 * if successful, redirecting the user to the script "coffeeModifyProducts.php". Otherwise, it sends an error message.
 * Restriced to the admin user.
 * INPUT: Id of the product, new name, class, subclass, price and stock of the product.
 * OUTPUT: An error message if it encounters a problem, redirects to "coffeeModifyProducts.php" otherwise.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1||$_SERVER['REQUEST_METHOD']!='POST') { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    $clases=[];
    $subclases=[];
    $classes=$pdo->query("SELECT id FROM t_clases");
    //Get all possible values from database for class and subclass
    while ($fila=$classes->fetch(PDO::FETCH_ASSOC)) { 
        array_push($clases, $fila['id']);
    }
    $classes=$pdo->query("SELECT id FROM t_subclases");
    while ($fila=$classes->fetch(PDO::FETCH_ASSOC)) {
        array_push($subclases,$fila['id']);
    }
    try {
        if (empty(htmlspecialchars($_POST['productName']))||!in_array($_POST['productClass'], $clases)||!in_array($_POST['productSubClass'], $subclases)||!is_numeric($_POST['price'])||!filter_var($_POST['stock'], FILTER_VALIDATE_INT)||$_POST['stock']<0) { //Verify given data
?>
    <span>Uno o más datos no siguen el formato adecuado</span> <br>
    <span><a href="../coffeeAddProduct.php">Volver a añadir producto</a></span> <br>
    <span><a href="../pdoCoffeeOptions.php">Volver al panel</a></span>
<?php
        } else { //Given data is correct
            $producto = $pdo->prepare("UPDATE t_productos SET nombre_producto=?, clase_id=?, subclase_id=?, precio_unitario=?, stock=? WHERE id=?");
            $producto->execute([$_POST['productName'], $_POST['productClass'], $_POST['productSubClass'], $_POST['price'], $_POST['stock'], $_POST['id']]); //Modify product with given data
            header('Location: ../coffeeModifyProducts.php'); //Go back
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