<?php
/**
 * PROCESS: Modify a user of the app
 * DESCRIPTION: The user sent a formulary to modify a user of the app from "coffeeEmployeDetails.php". The given data 
 * is first verified, and if the values are correct, the selected user is updated in the database with the new 
 * given values and the user is redirected to "coffeeManageEmployees.php" located in "../*". Otherwise, an error
 * message is sent. Restricted to the admin user.
 * INPUT: New user name, new user password, new user role, id of the user.
 * OUTPUT: An error message if the script encounters a problem, redirect to "coffeeManageEmployees.php" otherwise.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1||$_SERVER['REQUEST_METHOD']!='POST') { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        $roles=[];
        $usuarios=[];
        $id=$_POST['id'];
        //Get all possible values from database for employee role
        $role=$pdo->query("SELECT id FROM t_roles WHERE id!='1'");
        while ($fila=$role->fetch(PDO::FETCH_ASSOC)) { 
            array_push($roles, $fila['id']);
        }
        //Get all used names in database
        $names=$pdo->query("SELECT nombre_usuario FROM t_usuarios WHERE id!='$id'");
        while ($fila=$names->fetch(PDO::FETCH_ASSOC)) { 
            array_push($usuarios, $fila['nombre_usuario']);
        }
        if (empty(htmlspecialchars($_POST['nombre_usuario']))||!in_array($_POST['id_rol'], $roles)||in_array($_POST['nombre_usuario'], $usuarios)) { //Verify given data
?>
    <span>El nombre de usuario ya está registrado, o uno o más datos no siguen el formato adecuado</span> <br>
    <span><a href="../coffeeManageEmployees.php">Volver al panel</a></span>
<?php
        } else { //Given data is correct
            $employee = $pdo->prepare("UPDATE t_usuarios SET nombre_usuario=?, clave_usuario=?, id_rol=? WHERE id=?");
            $employee->execute([$_POST['nombre_usuario'], password_hash($_POST['clave_usuario'], PASSWORD_BCRYPT), $_POST['id_rol'], $id]); //Update employee with given data
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