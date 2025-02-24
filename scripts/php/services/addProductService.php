<?php
/**
 * PROCESS: Add a new product
 * DESCRIPTION: The user has sent a formulary to register a new product to the database, coming from 
 * "coffeeAddProduct.php" located in "../*". The script validates the given data and registers a new product to the 
 * database if sucessful, redirecting the user to "coffeeModifyProducts.php". Sends an error message otherwise.
 * INPUT: Name, class, subclass, price and stock of the new product
 * OUTPUT: An error message if it encounters a problem, redirects to "coffeeModifyProducts.php" otherwise.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1||$_SERVER['REQUEST_METHOD']!='POST') { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
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
        //Verify given data
        if (empty(htmlspecialchars($_POST['productName']))||!in_array($_POST['productClass'], $clases)||!in_array($_POST['productSubClass'], $subclases)||!is_numeric($_POST['price'])||!filter_var($_POST['stock'], FILTER_VALIDATE_INT)||$_POST['stock']<0) { 
?>
    <span>Uno o más datos no siguen el formato adecuado</span> <br>
    <span><a href="../coffeeAddProduct.php">Volver a añadir producto</a></span> <br>
    <span><a href="../pdoCoffeeOptions.php">Volver al panel</a></span>
<?php
        } else { //Data is correct
            $producto = $pdo->prepare("INSERT INTO t_productos (nombre_producto, clase_id, subclase_id, precio_unitario, stock) VALUES(?,?,?,?,?)");
            $producto->execute([$_POST['productName'], $_POST['productClass'], $_POST['productSubClass'], $_POST['price'], $_POST['stock']]); //Add product with given data
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