<?php
/**
 * PROCESS: Manage a reservation
 * DESCRIPTION: The user can see all the tables that are currently reserved so he can manage them. If the user
 * clicks on any of them, he will be presented with a formulary to modify data for the reservation. 
 * Reservations are only for the day, so it only needs a name and an hour.
 * INPUT: None
 * OUTPUT: All reserved tables
 */
session_start();
if (!isset($_SESSION['loggedIn'])) { //Check authorized access
    include_once('../../templates/unlogged/accessRestringed.php');
} else {
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
    include_once('database/crudPDODatabase.php');
?>
<button><a href="pdoCoffeeOptions.php" class="navLink">Volver atrás</a></button>
<?php
    try {
?>
        <span>Elija una mesa para gestionar su reserva</span>
        <div class="tables">
<?php
        $count=0; //Variable to count how many tables are reserved
        $mesas=$pdo->query("SELECT id, id_estado, detalles, fecha_cambio, n_mesa FROM t_mesas WHERE id_estado='3'"); //Get reserved tables
        while($fila=$mesas->fetch(PDO::FETCH_ASSOC)) {
            $count++;
?>
            <span class="tableItem reserved"><a href="coffeeReserveDetails.php?id=<?=$fila['id']?>&modify=1" class="navLink"><?=$fila['n_mesa']?></a></span>
<?php
        }
?>
        </div>
<?php
        if ($count==0) { //No tables reserved
?>
        <span>No hay mesas reservadas</span>
<?php
        }
    } catch (PDOException $e) {
        echo "Ha habido un error, avise a su encargado";
        echo "Error: ".$e->getMessage();
    }
}
$pdo=null;
$mesas=null; //End connections
include_once('../../templates/global/plantillaFooter.php');
?>