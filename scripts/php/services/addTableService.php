<?php
/**
 * PROCESS: Add a new table
 * DESCRIPTION: The user sent a formulary to register a new table to the database. The given data is first verified to
 * check the number is correct and is not already registered. Then, the script adds a register to the database with
 * a new table with the given number and setting it free. Restricted to the admin user.
 * INPUT: Number of the table
 * OUTPUT: An error message if it encounters a problem, redirects to "coffeeManageTables.php" otherwise.
 */
session_start();
if (!isset($_SESSION['loggedIn'])||$_SESSION['rol']!=1||$_SERVER['REQUEST_METHOD']!='POST') { //Check authorized access
    header('Location: ../pdoCoffeeOptions.php'); //Go back to pannel if not authorized
} else {
    include_once('../database/crudPDODatabase.php'); //Connection
    try {
        if (!filter_var($_POST['n_mesa'], FILTER_VALIDATE_INT)||$_POST['n_mesa']<0) { //Verify given data
?>
    <span>El número de la mesa debe ser positivo y entero</span> <br>
    <span><a href="../coffeeAddTable.php">Volver a añadir mesa</a></span> <br>
    <span><a href="../pdoCoffeeOptions.php">Volver al panel</a></span>
<?php
        } else { //Data is correct
            $mesas=[];
            $tables=$pdo->query("SELECT n_mesa FROM t_mesas");
            //Get all used numbers in database
            while ($fila=$tables->fetch(PDO::FETCH_ASSOC)) {
                array_push($mesas,$fila['n_mesa']);
            }
            if (in_array($_POST['n_mesa'], $mesas)) { //Check if is unique
?>
    <span>El número de la mesa ya se encuentra registrada</span> <br>
    <span><a href="../coffeeAddTable.php">Volver a añadir mesa</a></span> <br>
    <span><a href="../pdoCoffeeOptions.php">Volver al panel</a></span>
<?php                
            } else { //Given number isn't already used
                $mesa = $pdo->prepare("INSERT INTO t_mesas (id_estado, n_mesa) VALUES(1,?)");
                $mesa->execute([$_POST['n_mesa']]); //Add table with given number
                header('Location: ../coffeeManageTables.php'); //Go back   
            }
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