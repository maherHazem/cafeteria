<?php
/**
 * PROCESS: Add a new user to the app
 * DESCRIPTION: The user wants to add a new employee, coming from the script "coffeeManageEmployees.php". The page
 * presents a formulary to let the user fill in the necessary data to register a new user. Restricted to the 
 * admin user only.
 * INPUT: None
 * OUTPUT: Formulary to add a new user.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1) { //Check authorized access
    header('Location: ./pdoCoffeeOptions.php');
} else {
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
?>
    <button><a href="coffeeManageEmployees.php" class="navLink">Volver atrás</a></button>
<?php
    include_once('database/crudPDODatabase.php');
    try {
        $roles=$pdo->query("SELECT id, nombre_rol FROM t_roles WHERE id!=1 ORDER BY id DESC");
        include_once('../../templates/loggedIn/forms/employeeForms/addEmployeeForm.php'); //Reservation formulary
    } catch (PDOException $e) {
        echo "Ha habido un error, avise a su encargado";
        echo "Error: ".$e->getMessage();
    }
    include_once('../../templates/global/plantillaFooter.php');
}
?>