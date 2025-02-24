<?php
/**
 * PROCESS: Select an option of the app
 * DESCRIPTION: The user is logged in and is presented with their available options of the app depending on their role.
 * Except for the log in script "pdoLoginCoffee.php", the rest of the scripts are restricted to logged in users.
 * INPUT: None
 * OUTPUT: Available options for the current user of the session
 */
session_start();
if (!isset($_SESSION['loggedIn'])) { //Check authorized access
    include_once('../../templates/unlogged/accessRestringed.php');
} else { //Show options for logged user
    include_once('../../templates/loggedIn/headers/plantillaHeader.php');
    switch ($_SESSION['rol']) {
        case 1:
            include_once('../../templates/loggedIn/forms/cPannels/coffeeAdminOptions.php');
            break;
        case 2:
            include_once('../../templates/loggedIn/forms/cPannels/coffeeManagerOptions.php');
            break;
        case 3:
            include_once('../../templates/loggedIn/forms/cPannels/coffeeInChargeOptions.php');
            break;
        case 4:
            include_once('../../templates/loggedIn/forms/cPannels/coffeeWaiterOptions.php');
            break;
    }
}
include_once('../../templates/global/plantillaFooter.php');
?>