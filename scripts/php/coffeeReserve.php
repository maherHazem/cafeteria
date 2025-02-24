<?php
/**
 * PROCESS: Reserve a table
 * DESCRIPTION: The user can see all the tables that are currently free so he can make a reserve on them. If the user
 * clicks on any of them, he will be presented with a formulary to fill the necessary data for a reservation. 
 * Reservations are only for the day, so it only needs a name and an hour.
 * INPUT: None
 * OUTPUT: All free tables available for a reservation
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
        <span>Elija una mesa para reservar</span>
        <div class="tables">
<?php
        $count=0; //Variable to count how many tables are free
        $mesas=$pdo->query("SELECT id, id_estado, detalles, fecha_cambio, n_mesa FROM t_mesas WHERE id_estado='1'"); //Get free tables
        while($fila=$mesas->fetch(PDO::FETCH_ASSOC)) {
            $count++;
?>
            <span class="tableItem"><a href="coffeeReserveDetails.php?id=<?=$fila['id']?>" class="navLink"><?=$fila['n_mesa']?></a></span>
<?php
        }
?>
        </div>
<?php
        if ($count==0) { //No tables eligible for reservation
?>
        <span>No quedan mesas libres</span>
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