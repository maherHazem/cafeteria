<?php
/**
 * PROCESS: Check the register
 * DESCRIPTION: The user wants to close the day and check the register. The script shows all the served and payed 
 * commands done in the day and calculates the total amount of money that the register should have. With this 
 * information, the user can close the day by pressing a button if the information checks out and everything is ok.
 * Restricted to the admin, manager and in charge users. However, if there are occupied or reserved tables, the script
 * shows a information tag saying that there are still occupied tables and can't be used.
 * INPUT: None
 * OUTPUT: A table with all the commands, the amount given, the total recollected of each command group and the total
 * amount recollected of the day if there are no occupied or reserved tables. An information tag otherwise.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']==4) { //Check authorized access
?>
    <span><a href="pdoCoffeeOptions.php">Volver atrás</a></span>
<?php
    include_once('../../templates/unlogged/accessRestringed.php');
} else {
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
    include_once('database/crudPDODatabase.php');
?>
    <span class="formLabel">
        <button><a href="pdoCoffeeOptions.php" class="navLink">Volver atrás</a></button>
    </span>
<?php
    try {
        $occupiedTables=$pdo->query("SELECT id FROM t_mesas WHERE id_estado!='1'");
        if ($occupiedTables->fetch(PDO::FETCH_ASSOC)) {
?>
    <span>¡Aún quedan mesas ocupadas o reservadas!</span>
<?php
        } else {

?>
    <div class="stockTable">
        <span class="productsItem productsHeader">Producto</span>
        <span class="productsItem productsHeader">Recuento</span>
        <span class="productsItem productsHeader">Precio total</span>
<?php
            $count=0; //Variable to count how many commands on the day are
            $prices=[]; //Array to insert recolected money
            //GET ALL PAID COMMANDS DONE IN THE DAY
            $comandas=$pdo->query("SELECT nombre_producto, COUNT(*) as recuento, SUM(precio_unitario) as suma FROM t_comanda tc JOIN t_productos tp ON tc.pedido=tp.id WHERE deshabilitado IS NULL AND pagado='1' GROUP BY nombre_producto"); //Get products
            while($fila=$comandas->fetch(PDO::FETCH_ASSOC)) {
                $count++;
                array_push($prices,$fila['recuento']);
?>
        <span class="productsItem"><?=$fila['nombre_producto']?></span>
        <span class="productsItem"><?=$fila['recuento']?></span>
        <span class="productsItem"><?=$fila['suma']?> €</span>
<?php
            }
?>
        <span class="itemExpanded productsHeader productsItem">Recaudación total</span>
        <span class="productsItem"><?=array_sum($prices)?> €</span>
        </div>
        <button class="marginTop"><a href="services/closeDayService.php" class="navLink">Cerrar caja</a></button>
<?php
        }
    } catch (PDOException $e) {
        echo "Ha habido un error, avise a su encargado";
        echo "Error: ".$e->getMessage();
    }
}
$pdo=null; //End connections
include_once('../../templates/global/plantillaFooter.php');
?>