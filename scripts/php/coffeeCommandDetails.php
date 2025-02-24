<?php
/**
 * PROCESS: Modify command
 * DESCRIPTION: The user wants to modify a command that hasn't been served yet, coming from "coffeeManageCommands.php".
 * The script shows a formulary that lets the user modify his previous selections in the selected command.
 * INPUT: Id of the command
 * OUTPUT: Formulary to modify the command
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
        $products=$pdo->query("SELECT tp.id as productId, nombre_producto, nombre AS subclase, precio_unitario, stock FROM t_productos tp JOIN t_subclases ts ON subclase_id=ts.id ORDER BY nombre_producto"); //Query for products
        $table=$pdo->query("SELECT n_mesa, pedido, barra, cocina, detalles_pedido FROM t_mesas tm JOIN t_comanda tc ON tm.id=tc.id_mesa WHERE tc.id='$commandId'"); //Get table command information
        $table=$table->fetch(PDO::FETCH_ASSOC);
        include_once('../../templates/loggedIn/forms/commandForms/modifyCommandForm.php');
    } catch (PDOException $e) {
        echo "Ha habido un error, contacte con su administrador <br>";
        echo "Error: ".$e->getMessage();
    }
    include_once('../../templates/global/plantillaFooter.php');
}