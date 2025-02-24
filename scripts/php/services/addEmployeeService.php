<?php
/**
 * PROCESS: Add a new user to the app
 * DESCRIPTION: The user sent a formulary to add a new user to the app from "coffeeAddEmployee", located in "../*". 
 * The given data is first validated to ensure the values are correctly formated with the database. If the data is 
 * valid, the given user is inserted with the password encrypted and the user is then redirected to 
 * "coffeManageEmployees.php". Otherwise, an error message is sent. Restricted to the admin user.
 * INPUT: New user name, new password to be used, rol of the new user
 * OUTPUT: An error message if the script encounters a problem, redirect to "coffeeManageEmployees.php" otherwise
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1||$_SERVER['REQUEST_METHOD']!='POST') { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        $roles=[];
        $usuarios=[];
        $role=$pdo->query("SELECT id FROM t_roles WHERE id!='1'");
        while ($fila=$role->fetch(PDO::FETCH_ASSOC)) { //Get all possible values from database for employee role
            array_push($roles, $fila['id']);
        }
        $names=$pdo->query("SELECT nombre_usuario FROM t_usuarios");
        while ($fila=$names->fetch(PDO::FETCH_ASSOC)) { //Get all used names in database
            array_push($usuarios, $fila['nombre_usuario']);
        }
        if (empty(htmlspecialchars($_POST['nombre_usuario']))||empty(htmlspecialchars($_POST['nombre_usuario']))||!in_array($_POST['id_rol'], $roles)||in_array($_POST['nombre_usuario'], $usuarios)) { //Verify given data
?>
    <span>El nombre de usuario ya está registrado, o uno o más datos no siguen el formato adecuado</span> <br>
    <span><a href="../coffeeAddEmployee.php">Volver a añadir empleado</a></span> <br>
    <span><a href="../pdoCoffeeOptions.php">Volver al panel</a></span>
<?php
        } else { //Data is correctly formated
            $producto = $pdo->prepare("INSERT INTO t_usuarios (nombre_usuario, clave_usuario, id_rol) VALUES(?,?,?)");
            $producto->execute([$_POST['nombre_usuario'], password_hash($_POST['clave_usuario'], PASSWORD_BCRYPT), $_POST['id_rol']]); //add employee with given data
            header('Location: ../coffeeManageEmployees.php'); //Go back
        }
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