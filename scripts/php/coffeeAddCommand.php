<?php
/**
 * PROCESS: Adding command
 * DESCRIPTION: All registered tables are shown to the user. User can then select a table to add a command to it.
 * The tables style change depending if they are free, occupied or reserved. When a table is selected, he is redirected
 * to the script "coffeeAddCommandToTable.php", where a formulary is shown to him to add the command.
 * INPUT: None
 * OUTPUT: Tables
 */
session_start();
if (!isset($_SESSION['loggedIn'])) { //Check authorized access
    include_once('../../templates/unlogged/accessRestringed.php');
} else {
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
    include_once('database/crudPDODatabase.php');
?>
<button><a href="coffeeManageCommands.php" class="navLink">Volver atrás</a></button>
<?php
    try {
?>
        <span>Elija una mesa a la que añadir la comanda</span>
        <div class="tables">
<?php
        $count=0; //Variable to count how many tables are registered
        $mesas=$pdo->query("SELECT id, id_estado, detalles, fecha_cambio, n_mesa FROM t_mesas"); //Get tables
        while($fila=$mesas->fetch(PDO::FETCH_ASSOC)) {
            $count++;
?>
            <span class="tableItem 
<?php
            if ($fila['id_estado']==2) echo "occupied"; //Add css depending on its state
            else if($fila['id_estado']==3) echo "reserved";
?>
            "><a href="coffeeAddCommandToTable.php?id=<?=$fila['id']?>" class="navLink"><?=$fila['n_mesa']?></a></span>
<?php
        }
?>
        </div>
<?php
        if ($count==0) { //No tables
?>
        <span>No hay ninguna mesa registrada</span>
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