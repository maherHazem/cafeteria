<?php
/**
 * PROCESS: Add a new table
 * DESCRIPTION: The user wants to register a new table to the database. The script presents the user a formulary to
 * fill in the necessary data for a table (which is only the number). Restricted to the admin user.
 * INPUT: None
 * OUTPUT: Formulary for adding a new table
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1) { //Check authorized access
    header('Location: ./pdoCoffeeOptions.php');
} else {
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
?>
    <button><a href="coffeeManageTables.php" class="navLink">Volver atrás</a></button>
<?php
    include_once('database/crudPDODatabase.php');
    try {
        include_once('../../templates/loggedIn/forms/tableForms/addTableForm.php'); //Reservation formulary
    } catch (PDOException $e) {
        echo "Ha habido un error, avise a su encargado";
        echo "Error: ".$e->getMessage();
    }
    include_once('../../templates/global/plantillaFooter.php');
}
?>