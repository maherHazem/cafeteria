<?php
/**
 * PROCESS: Charge an occupied table
 * DESCRIPTION: The user has selected a table to charge all pending commands and free it, coming from the script
 * "coffeeCharge.php". The script shows all the remaining commands associated with the table with the total amount 
 * owed.
 * INPUT: Id of the table
 * OUTPUT: All served and non-paid commands associated with the table, with the total amount owed.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||!isset($_GET['id'])) { //Check authorized access
    header('Location: coffeeManageCommands.php');
} else {
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
    include_once('database/crudPDODatabase.php');
?>
<button><a href="coffeeCharge.php" class="navLink">Volver atrás</a></button>
<?php
    try {
        $tableId=$_GET['id'];
        $tableNumber=$pdo->query("SELECT n_mesa FROM t_mesas WHERE id='$tableId'");
        $tableNumber=$tableNumber->fetch(PDO::FETCH_ASSOC);
        $tableInfo=$pdo->query("SELECT tc.id AS comandaId, n_mesa, precio_unitario, nombre_producto FROM t_comanda tc JOIN t_productos tp ON tc.pedido=tp.id JOIN t_mesas tm ON tm.id=tc.id_mesa WHERE tm.id='$tableId' AND servido='1'"); //Get table information
        include_once('../../templates/loggedIn/forms/tableForms/chargeTableForm.php');
    } catch (PDOException $e) {
        echo "Ha habido un error, contacte con su administrador <br>";
        echo "Error: ".$e->getMessage();
    }
    include_once('../../templates/global/plantillaFooter.php');
}