<?php
/**
 * PROCESS: Adding command
 * DESCRIPTION: The formulary in the script "coffeeAddCommandToTable.php" has been sent and has to be processed.
 * The script validates the given data for security reasons and begins a transaction in the database if the data
 * is correct, or sends an error message otherwise. A transaction is done in case the table isn't occupied in the
 * database and needs to be modified, alongside with inserting the given data into the commands table. If the
 * service is done correctly with no errors, the user is redirected to the script "coffeeManageCommands.php"
 * located in "../*".
 * INPUT: Id of the selected table, id of the chosen product for the command, details of the command
 * OUTPUT: An error message if the process encounters a problem, redirect to ../coffeeManageCommands.php otherwise
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SERVER['REQUEST_METHOD']!='POST') { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        $tablesId=[];
        $productsId=[];
        $table=$pdo->query("SELECT id FROM t_mesas");
        while ($fila=$table->fetch(PDO::FETCH_ASSOC)) { //Get all possible values from database for tables
            array_push($tablesId, $fila['id']);
        }
        $product=$pdo->query("SELECT id FROM t_productos");
        while ($fila=$product->fetch(PDO::FETCH_ASSOC)) { //Get all possible values from database for products
            array_push($productsId, $fila['id']);
        }
        if (!in_array($_POST['tableId'], $tablesId)||!in_array($_POST['pedido'], $productsId)||strlen($_POST['detalles'])>255) { //Verify given data
?>
    <span>Alguno de los datos no coinciden con la base de datos o los detalles son demasiado largos, contacte con su administrador</span> <br>
    <span><a href="../pdoCoffeeOptions.php">Volver al panel</a></span>
<?php
        } else {
            $transaction=true;
            $pdo->beginTransaction(); //Begin transaction
            if ($_POST['tableState']!=2) { //Open table if it wasn't open
                $openTable=$pdo->prepare("UPDATE t_mesas SET id_estado=? WHERE id=?");
                $openTable->execute([2, $_POST['tableId']]);
            }
            if ($_POST['para']=='cocina') { //Query for kitchen
                $command=$pdo->prepare("INSERT INTO t_comanda (id_mesa, id_camarero, pedido, detalles_pedido, cocina) VALUES (?,?,?,?,?)");
            } else { //Query for bar
                $command=$pdo->prepare("INSERT INTO t_comanda (id_mesa, id_camarero, pedido, detalles_pedido, barra) VALUES (?,?,?,?,?)");
            }
            $command->execute([$_POST['tableId'], $_SESSION['id'], $_POST['pedido'], $_POST['detalles'], 1]);
            $pdo->commit(); //Commit 
            header('Location: ../coffeeManageCommands.php'); //Go back
        }
    } catch (PDOException $e) {
        if (isset($transaction)) $pdo->rollBack(); //Rollback in case the error is triggered in the transaction
?>
    <span><a href="../pdoCoffeeOptions.php">Volver atrás</a></span> <br>
    <span>Ha habido un error, contacte con su administrador del sistema</span> <br>
<?php
        echo "Error: ".$e->getMessage();
    }
    $pdo=null; //End connections
}
?>