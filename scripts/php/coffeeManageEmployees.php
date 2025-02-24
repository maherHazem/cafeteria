<?php
/**
 * PROCESS: Manage users
 * DESCRIPTION: The user can see all the employees (users) working at the company and their current roles. In this page,
 * the user can add new users with a selected rol (except for the admin rol, which is expected to be only for the
 * owner of the company), modify already existing users (their name, passwords or role) or delete them. The user can't
 * modify the admin user to ensure he can't softlock himself from the app. Any desired changed to the admin user should
 * be done in SQL instead of the app. This page is restricted to the admin user only.
 * INPUT: None
 * OUTPUT: All the users of the app with their roles.
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
        <button><a href="coffeeAddEmployee.php" class="navLink">Añadir empleado</a></button>
    </span>
<?php
    try {
?>
    <div class="tablesCRUD">
        <span class="productsItem productsHeader">Nombre</span>
        <span class="productsItem productsHeader">Rol</span>
        <span class="productsItem productsHeader">Eliminar usuario</span>
<?php
        $count=0; //Variable to count how many employees are there
        $mesas=$pdo->query("SELECT u.id as userId, nombre_usuario, nombre_rol FROM t_usuarios u JOIN t_roles r ON id_rol=r.id WHERE id_rol!=1 ORDER BY nombre_usuario"); //Get employees
        while($fila=$mesas->fetch(PDO::FETCH_ASSOC)) {
            $count++;
?>
        <span class="productsItem"><a href="coffeeEmployeeDetails.php?id=<?=$fila['userId']?>"><?=$fila['nombre_usuario']?></a></span>
        <span class="productsItem"><?=$fila['nombre_rol']?></span>
        <span class="productsItem"><a href="services/deleteEmployeeService.php?id=<?=$fila['userId']?>">Eliminar</a></span>
        <?php
        }
?>
        </div>
<?php
        if ($count==0) { //No employees
?>
    <span>No hay empleados registrados</span>
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