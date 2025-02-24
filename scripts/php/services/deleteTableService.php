<?php
/**
 * PROCESS: Remove a table 
 * DESCRIPTION: The user wants to remove a table register from the database, coming from the script
 * "coffeeManageTables.php" located in "../*". The script removes the selected table from the database and redirects
 * the user to "coffeeManageTables.php", or sends an error message if it encounters a problem.
 * INPUT: Id of the table
 * OUTPUT: An error message if it encounters a problem, redirects to "coffeeManageTables.php" otherwise
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1||!isset($_GET['id'])) { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        $id = $_GET['id'];
        $pdo->query("DELETE FROM t_mesas WHERE id=$id"); //Delete table
        header('Location: ../coffeeManageTables.php'); //Go back
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