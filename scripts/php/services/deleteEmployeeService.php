<?php
/**
 * PROCESS: Delete a user from the app
 * DESCRIPTION: The user wants to delete an employee (user) from the app, coming from "coffeeManageEmployees.php" located
 * in "../*". The script deletes the user with the given id and redirects the user to "coffeeManageEmployees.php" if
 * it doesn't encounter any problem, or sends an error message otherwise. Restricted to the admin user.
 * INPUT: Id of the user
 * OUTPUT: An error message if the script encounters a problem, redirects to "coffeeManageEmployees.php" otherwise.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1||!isset($_GET['id'])) { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        $id = $_GET['id'];
        $pdo->query("DELETE FROM t_usuarios WHERE id=$id"); //Delete selected user
        header('Location: ../coffeeManageEmployees.php'); //Go back
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