<?php
/**
 * PROCESS: Log in to the app
 * DESCRIPTION: The user is presented with the user log in formulary. The script unsets and destroys all session data
 * in case the user wanted to close the session. If the log in is succesful, both the id and role of the user from the
 * database are placed in a session variable, as well as a boolean variable that helps us restrict the rest of the 
 * scripts to only logged in users. The script manages both the sent formulary or a new arrival to the page.
 * INPUT: Username, password
 * OUTPUT: An error message if the log in isn't sucessful, redirect to "pdoCoffeeOptions.php" otherwise
 */
session_start();
session_unset();
session_destroy();
include_once('../../templates/global/plantillaHeader.php');
if ($_SERVER['REQUEST_METHOD']!=='POST') {
    include_once('../../templates/unlogged/forms/pdoLoginForm.php');
} else {
    try{
        include_once('database/crudPDODatabase.php');
        $username=$_POST['username'];
        $result= $pdo->query("SELECT id, nombre_usuario, clave_usuario, id_rol FROM t_usuarios WHERE nombre_usuario='$username'");
        if($fila=$result->fetch(PDO::FETCH_ASSOC)){
            if (password_verify($_POST['password'], $fila['clave_usuario'])) {
                session_start();
                $_SESSION['loggedIn']=true;
                $_SESSION['rol']=$fila['id_rol'];
                $_SESSION['id']=$fila['id'];
                header('Location: ./pdoCoffeeOptions.php');
            } else include_once('../../templates/unlogged/forms/pdoLoginFormError.php');
        } else include_once('../../templates/unlogged/forms/pdoLoginFormError.php');
    } catch (PDOException $e) {
        echo "Error:".$e->getMessage();
    }
}
include_once('../../templates/global/plantillaFooter.php');
?>