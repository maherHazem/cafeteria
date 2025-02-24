<?php
/**
 * PROCESS: Modify command
 * DESCRIPTION: The user sent a formulary to modify a command from the script "coffeeCommandDetails.php" and has to 
 * be processed. The script validates the given data, and if succesful,  modifies the command in the database with 
 * the given values and redirects the user to the script "coffeeManageCommands.php" located in "../*". 
 * Returns an error message otherwise.
 * INPUT: Id of the command, id of the chosen product, details of the command, who is it for (kitchen or bar)
 * OUTPUT: An error message if the script encounters a problem, redirects to "coffeManageCommands.php" otherwise
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SERVER['REQUEST_METHOD']!='POST') { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        $productsId=[];
        $product=$pdo->query("SELECT id FROM t_productos");
        while ($fila=$product->fetch(PDO::FETCH_ASSOC)) { //Get all possible values from database for products
            array_push($productsId, $fila['id']);
        }
        if (!in_array($_POST['pedido'], $productsId)||strlen($_POST['detalles'])>255) { //Verify given data
?>
    <span>Alguno de los datos no coinciden con la base de datos o los detalles son demasiado largos, contacte con su administrador</span> <br>
    <span><a href="../pdoCoffeeOptions.php">Volver al panel</a></span>
<?php
        } else { //Given data is correct
            $command=$pdo->prepare("UPDATE t_comanda SET id_camarero=?, pedido=?, detalles_pedido=?, cocina=?, barra=? WHERE id=?");
            //Change values for query if its for kitched or for bar
            if ($_POST['para']=='cocina') {
                $command->execute([$_SESSION['id'], $_POST['pedido'], $_POST['detalles'], 1, 0, $_POST['commandId']]);
            } else {
                $command->execute([$_SESSION['id'], $_POST['pedido'], $_POST['detalles'], 0, 1, $_POST['commandId']]);
            }
            header('Location: ../coffeeManageCommands.php'); //Go back
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