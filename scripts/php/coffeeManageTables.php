<?php
/**
 * PROCESS: Manage tables
 * DESCRIPTION: The user wants to manage the tables of the coffee shop. The script presents the user all registered
 * tables, the state they're in and the possibility to either add a new table or delete one if it's not occupied 
 * or reserved. Restricted to the admin user.
 * INPUT: None
 * OUTPUT: All registered tables and their current state
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1) { //Check authorized access
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
        <button><a href="coffeeAddTable.php" class="navLink">Añadir mesa</a></button>
    </span>
<?php
    try {
?>
<div class="tablesCRUD">
        <span class="productsItem productsHeader">Número de mesa</span>
        <span class="productsItem productsHeader">Estado</span>
        <span class="productsItem productsHeader">Eliminar mesa</span>
<?php
        $count=0; //Variable to count how many products are
        $mesas=$pdo->query("SELECT tm.id, n_mesa, estado FROM t_mesas tm JOIN t_estados te ON id_estado=te.id ORDER BY n_mesa"); //Get products
        while($fila=$mesas->fetch(PDO::FETCH_ASSOC)) {
            $count++;
?>
        <span class="productsItem"><?=$fila['n_mesa']?></span>
        <span class="productsItem"><?=$fila['estado']?></span>
        <span class="productsItem">
<?php
            if ($fila['estado']=='Libre') {
?>
            <a href="services/deleteTableService.php?id=<?=$fila['id']?>">Eliminar</a>
<?php
            } else {
?>
            No disponible
<?php
            }
?>
        </span>
        <?php
        }
?>
        </div>
<?php
        if ($count==0) { //No products
?>
    <span>No hay mesas registrados</span>
<?php
        }
    } catch (PDOException $e) {
        echo "Ha habido un error, avise a su encargado";
        echo "Error: ".$e->getMessage();
    }
}
$pdo=null;
$mesas=null;
include_once('../../templates/global/plantillaFooter.php');
?>