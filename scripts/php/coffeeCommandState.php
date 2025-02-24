<?php
/**
 * PROCESS: Modify state of command
 * DESCRIPTION: The user wants to change the state of a command that hasn't been served yet, coming from 
 * "coffeeManageCommands.php". The script allows the user to either cancel the selected command or set it as 
 * "served" with a formulary.
 * INPUT: Id of the command
 * OUTPUT: Formulary to change the state of the selected command.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||!isset($_GET['id'])) { //Check authorized access
    header('Location: coffeeManageCommands.php');
} else {
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
    include_once('database/crudPDODatabase.php');
?>
<button><a href="coffeeManageCommands.php" class="navLink">Volver atrás</a></button>
<?php
    try {
        $commandId=$_GET['id'];
        $command=$pdo->query("SELECT nombre_producto, n_mesa FROM t_comanda tc JOIN t_mesas tm ON tc.id_mesa=tm.id JOIN t_productos tp ON tc.pedido=tp.id WHERE tc.id='$commandId'"); //Get command information
        $command=$command->fetch(PDO::FETCH_ASSOC);
        include_once('../../templates/loggedIn/forms/commandForms/modifyCommandStateForm.php');
    } catch (PDOException $e) {
        echo "Ha habido un error, contacte con su administrador <br>";
        echo "Error: ".$e->getMessage();
    }
    $pdo=null;
    include_once('../../templates/global/plantillaFooter.php');
}