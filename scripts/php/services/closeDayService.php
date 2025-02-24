<?php
/**
 * PROCESS: Closing the day
 * DESCRIPTION: The user wants to close the day, removing all commands done of that day, coming from the script
 * "coffeeCheckRegister.php" located in "../*". The script sets *ALL* commands to disabled and redirects to
 * "pdoCoffeeOptions.php". The commands are not removed to ensure the database integrity with the payments table.
 * Restricted to the admin, manager and in charge user.
 * INPUT: None
 * OUTPUT: An error message if it encounters a problem, redirects to "pdoCoffeeOptions.php" otherwise.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']==4) { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        //Set all commands of the day as disabled, as the shop is closed
        $disableCommands=$pdo->prepare("UPDATE t_comanda SET deshabilitado=1");
        $disableCommands->execute();
        header('Location: ../pdoCoffeeOptions.php'); //Go back
    } catch (PDOException $e) {
?>
    <span><a href="../pdoCoffeeOptions.php">Volver atrás</a></span> <br>
    <span>Ha habido un error, contacte con su administrador del sistema</span> <br>
<?php
        echo "Error: ".$e->getMessage();
    }
    $pdo=null; //End connections
}
?>