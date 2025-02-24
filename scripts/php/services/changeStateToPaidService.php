<?php
/**
 * PROCESS: Change state of a served command to paid
 * DESCRIPTION: The user wants to change the state of a selected served command to paid, coming from 
 * "coffeeManageCommands.php" located in "../*". The script begins a transaction to set the selected command as
 * paid and insert a new value into the invoice table. The user then is redirected to "coffeeManageCommands.php"
 * if it encounters no problems, otherwise, it sends an error message.
 * INPUT: Id of the command
 * OUTPUT: An error message if the script encounters a problem, redirects to "coffeeManageCommands.php" otherwise
 */
session_start();
if (!isset($_SESSION['loggedIn'])||!isset($_GET['id'])) { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        $commandId=$_GET['id'];
        $pdo->beginTransaction(); //Begin transaction
        // UPDATE COMMAND AS PAID
        $command=$pdo->prepare("UPDATE t_comanda SET cancelado=?, servido=?, pagado=? WHERE id=?");
        $command->execute([0,0,1,$commandId]);
        // GET PRICE OF THE COMMAND
        $commandPrice=$pdo->query("SELECT precio_unitario FROM t_comanda tc JOIN t_productos tp ON tc.pedido=tp.id WHERE tc.id='$commandId'");
        $commandPrice=$commandPrice->fetch(PDO::FETCH_ASSOC);
        // INSERT COMMAND AND PRICE VALUE INTO TABLE
        $paid=$pdo->prepare("INSERT INTO t_pagos (id_comanda, total_pagar) VALUES (?,?)");
        $paid->execute([$commandId,$commandPrice['precio_unitario']]);
        $pdo->commit();
        header('Location: ../coffeeManageCommands.php'); //Go back
    } catch (PDOException $e) {
        $pdo->rollBack(); //Roll back
?>
    <span><a href="../pdoCoffeeOptions.php">Volver atrás</a></span> <br>
    <span>Ha habido un error, contacte con su administrador del sistema</span> <br>
<?php
        echo "Error: ".$e->getMessage();
    }
    $pdo=null; //End connections
}
?>