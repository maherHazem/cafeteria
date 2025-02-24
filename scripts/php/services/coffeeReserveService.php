<?php
/**
 * PROCESS: Reserve a table
 * DESCRIPTION: The user sent a formulary to update or make a reservation, coming from "coffeReserveDetails.php"
 * located in "../*". If the user made an input to cancel the reservation, the script will update the table state
 * to free it and then redirect the user to "pdoCoffeOptions.php". If not, the given data is first validated and,
 * if the values are correct, the table is updated with the given information. If the script goes correctly, the
 * user is redirected to "pdoCoffeeOptions.php", if not, an error message is sent.
 * INPUT: Id of the table, hour of the reserve, name of the reserve, details of the reserve
 * OUTPUT: An error message if the script encounters a problem, redirect to "pdoCoffeeOptions.php" otherwise
 */
session_start();
if (!isset($_SESSION['loggedIn'])||!isset($_POST['id'])||$_SERVER['REQUEST_METHOD']!='POST') { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php');
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        if (isset($_POST['cancel'])) { //Canceling reservation
            $reserva = $pdo->prepare("UPDATE t_mesas SET id_estado=?, detalles=NULL, hora_reserva=NULL, nombre_reserva=NULL WHERE id=?");
            $reserva->execute([1, $_POST['id']]); //Free table
            header('Location: ../pdoCoffeeOptions.php'); //Go back
        } else {
            if (empty($_POST['date'])||empty($_POST['name'])) { //Verify given data
?>
    <span>La hora y nombre son datos obligatorios</span> <br>
    <span><a href="../coffeeReserveDetails.php?id=<?=$_POST['id']?>">Volver a la reserva</a></span> <br>
    <span><a href="../pdoCoffeeOptions.php">Volver al panel</a></span>
<?php
            } else {//Given data is correct
                $reserva = $pdo->prepare("UPDATE t_mesas SET id_estado=?, detalles=?, hora_reserva=?, nombre_reserva=? WHERE id=?");
                $reserva->execute([3, $_POST['details'], $_POST['date'], $_POST['name'], $_POST['id']]); //Reserve table with given data
                header('Location: ../pdoCoffeeOptions.php'); //Go back
            }
        }
    } catch (PDOException $e) {
?>
    <span><a href="../pdoCoffeeOptions.php">Volver atrás</a></span> <br>
    <span>Ha habido un error, contacte con su superior</span> <br>
<?php
        echo "Error: ".$e->getMessage();
    }
    $pdo=null;
    $reserva = null; //End connections
}
?>