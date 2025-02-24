<?php
/**
 * PROCESS: Manage commands
 * DESCRIPTION: The user can see all the commands done in the day. In this page he is allowed to add more commands,
 * modify commands that haven't been served yet and change states of the commands (served, canceled or paid). The user
 * can't remove any commands registered, only cancel them. This is done to mantain the integrity of the database with
 * the commands registered.
 * INPUT: None
 * OUTPUT: The commands registered in the day with their state, the user that made the register, details, who is
 * it for (kitchen or bar) and the associated table number.
 */
session_start();
if (!isset($_SESSION['loggedIn'])) { //Check authorized access
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
        <button><a href="coffeeAddCommand.php" class="navLink">Añadir comanda</a></button>
    </span>
<?php
    try {
?>
    <div class="commandsTable">
        <span class="productsItem productsHeader">Mesa</span>
        <span class="productsItem productsHeader">Camarero</span>
        <span class="productsItem productsHeader">Producto</span>
        <span class="productsItem productsHeader">Detalles</span>
        <span class="productsItem productsHeader">Para</span>
        <span class="productsItem productsHeader">Estado</span>
<?php
        $count=0; //Variable to count how many commands are
        $comandas=$pdo->query("SELECT tc.id AS comandaId ,n_mesa, nombre_usuario AS nombreCamarero, nombre_producto, detalles_pedido, 
        CASE 
            WHEN barra='1' THEN 'Barra'
            ELSE 'Cocina'
        END AS para,
        CASE 
            WHEN servido='1' THEN 'Servido'
            ELSE 
                CASE WHEN cancelado='1' THEN 'Cancelado'
                ELSE 
                    CASE WHEN pagado='1' THEN 'Pagado'
                    ELSE 'Por servir'
                END
            END
        END AS estado
        FROM t_comanda tc JOIN t_mesas tm ON tc.id_mesa=tm.id
        JOIN t_usuarios tu ON tu.id=tc.id_camarero
        JOIN t_productos tp ON tp.id=tc.pedido 
        WHERE deshabilitado IS NULL
        ORDER BY comandaId DESC"); //Get commands
        while($fila=$comandas->fetch(PDO::FETCH_ASSOC)) {
            $count++;
?>
        <span class="productsItem"><?=$fila['n_mesa']?></span>
        <span class="productsItem"><?=$fila['nombreCamarero']?></span>
        <span class="productsItem">
<?php
            if ($fila['estado']=='Por servir') { //Can only modify the command product if it hasn't been served yet
?>
        <a href="coffeeCommandDetails.php?id=<?=$fila['comandaId']?>"><?=$fila['nombre_producto']?></a>
<?php
            } else echo $fila['nombre_producto'];
?>
        </span>
        <span class="productsItem"><?=$fila['detalles_pedido']?></span>
        <span class="productsItem"><?=$fila['para']?></span>
        <span class="productsItem">
<?php
            if ($fila['estado']=='Por servir') { //Can only change state of command to any if it's not served
?>
            <a href="coffeeCommandState.php?id=<?=$fila['comandaId']?>"><?=$fila['estado']?></a>
<?php
            } else if ($fila['estado']=='Servido') { //Can only change to 'Paid' once it's been served
?>
            <a href="services/changeStateToPaidService.php?id=<?=$fila['comandaId']?>"><?=$fila['estado']?></a>
<?php
            } else echo $fila['estado']; //State is either canceled or paid, and shouldn't be changed
?>
        </span>
<?php
        }
?>
        </div>
<?php
        if ($count==0) { //No commands
?>
    <span>No hay comandas registradas</span>
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