<?php
/**
 * PROCESS: Adding command
 * DESCRIPTION: A table has been selected in the script "coffeeAddCommand.php", leading to a formulary that lets the
 * user add a command to the selected table. The formulary leads to the service "addCommandService.php" located in 
 * "./services/".
 * INPUT: Id of the selected table
 * OUTPUT: Formulary to add a command to selected table
 */
session_start();
if (!isset($_SESSION['loggedIn'])||!isset($_GET['id'])) { //Check authorized access
    header('Location: coffeeManageCommands.php');
} else {
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
    include_once('database/crudPDODatabase.php');
?>
<button><a href="coffeeAddCommand.php" class="navLink">Volver atrás</a></button>
<?php
    try {
        $tableId=$_GET['id'];
        $products=$pdo->query("SELECT tp.id as productId, nombre_producto, nombre AS subclase, precio_unitario, stock FROM t_productos tp JOIN t_subclases ts ON subclase_id=ts.id ORDER BY nombre_producto"); //Query for products
        $table=$pdo->query("SELECT n_mesa, id_estado FROM t_mesas WHERE id=$tableId"); //Get table information
        $table=$table->fetch(PDO::FETCH_ASSOC);
        include_once('../../templates/loggedIn/forms/commandForms/addCommandForm.php');
    } catch (PDOException $e) {
        echo "Ha habido un error, contacte con su administrador <br>";
        echo "Error: ".$e->getMessage();
    }
    include_once('../../templates/global/plantillaFooter.php');
}