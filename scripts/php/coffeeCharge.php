<?php
/**
 * PROCESS: Charge an occupied table
 * DESCRIPTION: The user wants to charge and free a table. The script shows all the occupied tables to the user so he
 * can decide which table he wants to free and charge all pending commands associated with it.
 * INPUT: None
 * OUTPUT: All the occupied tables
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
        <span>Elija una mesa a la que cobrar</span>
        <div class="tables">
<?php
        $count=0; //Variable to count how many tables are occupied
        $mesas=$pdo->query("SELECT id, detalles, fecha_cambio, n_mesa FROM t_mesas WHERE id_estado='2'"); //Get tables
        while($fila=$mesas->fetch(PDO::FETCH_ASSOC)) {
            $count++;
?>
            <span class="tableItem occupied"><a href="coffeeChargeTable.php?id=<?=$fila['id']?>" class="navLink"><?=$fila['n_mesa']?></a></span>
<?php
        }
?>
        </div>
<?php
        if ($count==0) { //No tables
?>
        <span>No hay ninguna mesa ocupada</span>
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