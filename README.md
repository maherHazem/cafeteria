# Cafeteria Management System

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

A CRUD (Create, Read, Update, Delete) coffee shop management system developed as a self-training project in PHP and MySQL. This application is designed to simulate the operations of a coffee shop, allowing users to manage commands, reservations, tables, and more based on their roles.

---

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [How It Works](#how-it-works)
- [Getting Started](#getting-started)
- [Database Setup](#database-setup)
- [Authentication](#authentication)
- [Improvements](#improvements)
- [License](#license)

---

## Introduction

This project was developed as a self-training exercise to test and improve my skills in PHP and MySQL. It simulates a coffee shop management system where users with different roles (waiter, in-charge, manager, and admin) can perform various tasks such as managing commands, reservations, and tables.

---

## Features

### Role-Based Access Control
- **Waiter**: Manage commands, reservations, and close tables.
- **In-Charge**: Close the day, show stock
- **Manager**: Change prices.
- **Admin**: Manage products, employees, and tables.

### Core Functionalities
- **Manage Commands**: Add, modify, and cancel commands. Track stock and generate invoices.
- **Reservations**: Reserve tables for the current day and manage existing reservations.
- **Close Tables**: Finalize payments and clear occupied tables.
- **Close Day**: Summarize daily transactions and reset the system for the next day.
- **Show Stock**: View current product stock levels.
- **Change Prices**: Update product prices (admin/manager only).
- **Manage Products, Employees, and Tables**: Add, remove, or modify records (admin only).

---

## How It Works

1. **Login**: The application starts at `pdoLoginCoffee.php`, where users log in with their credentials. The system checks the credentials against the database and grants access based on the user's role.
2. **Role-Based Interface**: Each role has access to specific functionalities. For example:
   - Waiters can manage commands and reservations.
   - Managers can close the day and view stock.
   - Admins have full control over products, employees, and tables.
3. **Database Interaction**: All actions are recorded in the MySQL database, ensuring data integrity and persistence.

---

## Getting Started

### Prerequisites
- PHP (version 7.0 or higher)
- MySQL
- Web server (e.g., Apache, Nginx)

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/maherHazem/cafeteria.git
2. Import the database structure using the provided cafeteria2.sql file.
3. Create a user that is able to work with the database (or use root).
4. Update the database connection settings in scripts/php/database/crudPDODatabase.php:
   ```bash
   $host = 'your_host';
   $dbname = 'your_database_name';
   $username = 'your_username';
   $password = 'your_password';
5. Start your local server and navigate to the project directory.
## Database Setup

The database structure is provided in the cafeteria2.sql file. Import it into your MySQL server to set up the necessary tables and initial data. Default user passwords are set to 123qwe.

## Authentication

The application uses basic authentication with password hashing for security. While it is functional, future improvements could include more advanced authentication mechanisms like OAuth or JWT.

## Improvements

This project is a work in progress, and several enhancements are planned:

**-Dynamic Frontend:** Add JavaScript for a more interactive user experience.

**-Responsive Design:** Improve the UI to be mobile-friendly.

**-Advanced Database Features:** Add support for multi-day reservations and stricter data validation.

**-Security Enhancements:** Implement stronger authentication and authorization mechanisms.

## License

This project is open-source and available under the MIT License. Feel free to use, modify, and distribute it as needed.

## Acknowledgments

· This project was developed as part of my self-training in PHP and MySQL.

· Special thanks to the open-source community for providing valuable resources and tools.
