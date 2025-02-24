<?php
/**
 * PROCESS: Modify a user of the app
 * DESCRIPTION: The user wants to modify a user of the app, coming from "coffeeManageEmployees.php". The script lets
 * the user modify the data of the user with a formulary where all values (except the password) are filled with the
 * previous data. Restricted to the admin user.
 * INPUT: Id of the user
 * OUTPUT: Formulary with the previous data of the user
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1||!isset($_GET['id'])) { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('database/crudPDODatabase.php'); //Connection
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
?>
    <button><a href="coffeeManageEmployees.php" class="navLink">Volver atrás</a></button>
<?php
    $id=$_GET['id'];
    try {
        $roles=$pdo->query("SELECT id, nombre_rol FROM t_roles WHERE id!=1 ORDER BY id DESC");
        $employee = $pdo->query("SELECT nombre_usuario, id_rol FROM t_usuarios WHERE id='$id'");
        $employee = $employee->fetch(PDO::FETCH_ASSOC); //Get employee
        include_once('../../templates/loggedIn/forms/employeeForms/modifyEmployeeForm.php');
    } catch (PDOException $e) {
        echo "Ha habido un error, avise a su encargado";
        echo "Error: ".$e->getMessage();
    }
}
include_once('../../templates/global/plantillaFooter.php');
?>