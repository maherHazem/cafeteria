<?php
/**
 * PROCESS: Reserve a table
 * DESCRIPTION: The user selected a table to make a reservation in "coffeeReserve.php" or "coffeManageReserves.php". 
 * The script presents a formulary so the user can fill in or modify all the details needed for the reservation.
 * INPUT: Id of the table.
 * OUTPUT: Formulary to make a reservation for the table in the day.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||!isset($_GET['id'])) { //Check authorized access
    header('Location: ./pdoCoffeeOptions.php');
} else {
    include_once('database/crudPDODatabase.php'); //Connection
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
    if (isset($_GET['modify'])) { //Enters modifying a reserve
?>
<span><button><a href="coffeeManageReserves.php" class="navLink">Volver atrás</a></button></span>
<?php
    } else { //Enters a new reserve
?>
<span><button><a href="coffeeReserve.php" class="navLink">Volver atrás</a></button></span>
<?php
    }
    try {
        $id=$_GET['id'];
        $mesa = $pdo->query("SELECT id, id_estado, detalles, n_mesa, hora_reserva, nombre_reserva FROM t_mesas WHERE id='$id'"); //Get table with given ID
        $mesa = $mesa->fetch(PDO::FETCH_ASSOC); //Get register in array
        include_once('../../templates/loggedIn/forms/tableForms/reserveTableForm.php'); //Reservation formulary
    } catch (PDOException $e) {
        echo "Ha habido un error, avise a su encargado";
        echo "Error: ".$e->getMessage();
    }
    $pdo=null;
    $mesa=null; //End connections
    include_once('../../templates/global/plantillaFooter.php');
}
?>