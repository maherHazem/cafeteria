# cafeteria
CRUD coffee shop proyect done while self-training in php and mysql.

# INSTRUCTIONS
The project begins in the script "pdoLoginCoffee.php" where a user and a password are required to log in and use the functions of the app. The user and password provided are then checked with the  database and, if it checks out, the user is presented with their options associated with their user role.

# WHAT IS THIS PROJECT FOR
This project was done as a self-training project to test my acquired skills with PhP and managing databases from within it. It's a simple project aimed as an app for a coffee shop where the waiters can add commands to the bar or kitchen, reserve tables for the same day, check out, etc. 

# HOW DOES IT WORK
The app works with registered users in the database, and these users have roles (waiter, in charge, manager and admin). The app presents different options depending on the role of the logged in user and, by extension, works with restrictions. The admin works with the most privileges while the waiter has the least amount.

# MANAGE COMMANDS, RESERVATIONS AND CLOSE TABLES (EVERY ROLE)
These options are available to all roles, as are the most basic for a coffee shop. 

## MANAGE COMMANDS
The user can add a new command to a table, and when doing so, the table is set as occupied if it was free before. Then, the command is in a "waiting" state, where it hasn't been served or canceled, and in this state, the command can be modified by the user. 

The user then can change the state to either "canceled" or "served". If served, the used product for the command has a -1 to its stock. Then, the command state can then be changed to "paid" and an invoice register is added to the respective table. This function is added in the case that a table has multiple people and some of them want to leave early, paying only their respective meals.

A command can't be removed by any means, only canceled.
## RESERVATIONS
The user can reserve a table by selecting one that is currently free. If there are no free tables, the user can't make a reservation. When a table is selected, a form is presented so the user can fill in the necessary data for a reservations. The reservations, as well as the commands, are for the *current day*, so you can't make a reservation weeks before nor for the next day.

Managing a reservation works the same way, the user is presented with the tables that are currently reserved and can modify the reservation if needed, or cancel it.
## CLOSE TABLES
Closing a table works similarly like the reservations, but with occupied tables. The user is presented with all current occupied tables, and when selecting one, a table with all pending payments for the selected table are presented. Then, the user can clic a button to make a transaction where all the commands that were served are changed to a "paid" state, any pending commands for that table are canceled and each individual command is inserted as an invoice to the respective table.

# CLOSE DAY AND SHOW STOCK (EVERY ROLE BUT WAITER)
These options are available to all roles except for the waiter role

## CLOSE DAY
If there are no occupied or reserved tables, the user is presented with a list with all given commands, the amount of units given and the total money collected from the products, as well as the total money collected from all the commands. Then, the user can clic a button to close the day, which sets all commands as disabled. This works as a restart of the day as any disabled command won't appear while managing commands. The commands aren't deleted to mantain the integrity of the database with the invoices table.
## SHOW STOCK
The user is presented with a list of the currently registered products of the app and their current stock.

# CHANGE PRICES (ADMIN AND MANAGER ONLY)
The user is presented with a list of products and their current price. The user can then set a new price for a selected product, updating the register in the database.

# MANAGE PRODUCTS, MANAGE EMPLOYEES AND MANAGE TABLES (ADMIN ONLY)
These options are only available for the admin user

## MANAGE PRODUCTS
The user is presented with a detailed list of all products registered in the database. Here, the user can add a new product or remove/modify an existent one.
## MANAGE EMPLOYEES
The user is presented with all current registered users of the app (excepting the admin user itself). Here, the user can remove/modify a user or add a new one.
## MANAGE TABLES
The user is presented with a list of all registered tables in the database. The user can add a new table or remove an existent one. To remove an existent table, the table *must* be free.

# AUTHENTICATION
The app authentication isn't anything fancy, just the use of hashes.

# IMPROVEMENTS
The app can have more improvements to it, like adding Js to make it more dinamic, restrictions to the products, changing a bit the style to make it responsive, etc. There are also more changes that can be made to the database so it's even safer and more atomic, as making another table for reservations so the reservations aren't only for the current day. I'll be working on these as I'm having free time for it.
# DATABASE
There is a structure in this repository named "cafeteria2.sql" that you can use to restore the database if you want to have a try at the app. Remember to check the database connection script located at "scripts/php/database/crudPDODatabase.php" and modify it so it can work on your end. The password for all given users is "123qwe".
