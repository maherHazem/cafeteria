<?php
/**
 * PROCESS: Modify state of command
 * DESCRIPTION: The user sent a formulary to change the state of a command from "coffeeCommandState.php",
 * located in "../*". The given data is first verified, and if the values are correct, a transaction begins
 * to change the database. If the state is changed to "served", one unit of stock is removed from the products
 * table, the command state is changed to served.  If it's canceled, it only changes the command state to
 * canceled without touching the stock of the product. The user is then redirected to "coffeeManageCommands.php" if
 * the script doesn't encounter any problems, otherwise, an error message is sent.
 * INPUT: Id of the command, state of the command
 * OUTPUT: An error message if the script encounters a problem, redirects to "coffeeManageCommands.php" otherwise
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SERVER['REQUEST_METHOD']!='POST') { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        $stateValues=['servido','cancelado'];
        if (!in_array($_POST['estado'],$stateValues)) { //Verify given data
?>
    <span>Los datos dados no son válidos, contacte con su administrador</span> <br>
    <span><a href="../pdoCoffeeOptions.php">Volver al panel</a></span>
<?php
        } else {
            $commandId=$_POST['commandId']; //Place command id in a variable
            $transaction=true; //Boolean to check if the transaction has began or not
            $pdo->beginTransaction(); //Begin transaction
            if ($_POST['estado']=='servido') {
                //Remove 1 from stock of products, prepare state of the command for served if it was selected
                $productId=$pdo->query("SELECT tp.id AS productId FROM t_comanda tc JOIN t_productos tp ON tc.pedido=tp.id WHERE tc.id='$commandId'");
                $productId=$productId->fetch(PDO::FETCH_ASSOC);
                $command=$pdo->prepare("UPDATE t_comanda SET servido=? WHERE id=?");
                $product=$pdo->prepare("UPDATE t_productos SET stock=stock-'1' WHERE id=?");
                $product->execute([$productId['productId']]);
            } else {
                //Only prepare state of the command to canceled if it was selected
                $command=$pdo->prepare("UPDATE t_comanda SET cancelado=? WHERE id=?");
            }
            $command->execute([1,$commandId]); //execute query for command
            $pdo->commit();
            header('Location: ../coffeeManageCommands.php'); //Go back
        }
    } catch (PDOException $e) {
        if (isset($transaction)) $pdo->rollBack(); //Rollback if transaction began
?>
    <span><a href="../pdoCoffeeOptions.php">Volver atrás</a></span> <br>
    <span>Ha habido un error, contacte con su administrador del sistema</span> <br>
<?php
        echo "Error: ".$e->getMessage();
    }
    $pdo=null; //End connections
}
?>