<?php
/**
 * PROCESS: Charge an occupied table
 * DESCRIPTION: The user has sent a formulary to free an occupied table, charging all remaining commands, coming from
 * the script "coffeeChargeTable.php" located in "../*". The script begins a transaction to update all the remaining
 * commands associated with the selected table and set them to "paid" while inserting the payments into the invoices
 * table. Then, the table is set as "free" and any remaining commands that weren't served are automatically set as
 * "canceled". The user is then redirected to "coffeeCharge.php" if everything went smoothly, or an error message 
 * otherwise.
 * INPUT: Id of the table
 * OUTPUT: An error message if it encounters a problem, redirects to "coffeeCharge.php" otherwise.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SERVER['REQUEST_METHOD']!='POST') { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        $tableId=$_POST['tableId'];
        $pdo->beginTransaction(); //Begin transaction
        //GET COMMANDS ASSOCIATED WITH TABLE THAT ARE SERVED
        $commands=$pdo->query("SELECT tc.id as comandaId, precio_unitario FROM t_comanda tc JOIN t_productos tp ON tp.id=tc.pedido WHERE id_mesa='$tableId' AND servido='1'");
        while($fila=$commands->fetch(PDO::FETCH_ASSOC)) {
            //UPDATE ASSOCIATED TABLES OF DATABASE
            $setPaid=$pdo->prepare("UPDATE t_comanda SET pagado='1', servido='0' WHERE id=?");
            $setPaid->execute([$fila['comandaId']]);
            $insertPay=$pdo->prepare("INSERT INTO t_pagos (id_comanda, total_pagar) VALUES (?,?)");
            $insertPay->execute([$fila['comandaId'],$fila['precio_unitario']]);
        }
        //TABLE IS NO LONGER OCCUPIED
        $freeTable=$pdo->prepare("UPDATE t_mesas SET id_estado='1' WHERE id=?");
        $freeTable->execute([$tableId]);
        //CANCEL ANY ASSOCIATED COMMANDS THAT WERE NEVER SERVED
        $cancelCommands=$pdo->prepare("UPDATE t_comanda SET cancelado='1' WHERE id_mesa='$tableId' AND servido='0' AND pagado='0' AND cancelado='0'");
        $cancelCommands->execute();
        $pdo->commit(); //Commit changes
        header('Location: ../coffeeCharge.php'); //Go back
    } catch (PDOException $e) {
        $pdo->rollBack(); //Rollback in case of error
?>
    <span><a href="../pdoCoffeeOptions.php">Volver atrás</a></span> <br>
    <span>Ha habido un error, contacte con su administrador del sistema</span> <br>
<?php
        echo "Error: ".$e->getMessage();
    }
    $pdo=null; //End connections
}
?>