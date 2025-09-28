# Apex_task2

## Project Overview
```
APEX_TASK2 is a simple and professional PHP-based user authentication system with a login, registration, and dashboard functionality. It uses MySQL for the database and sessions to manage logged-in users. The project features a modern, responsive UI with a navy blue & pale blue theme, making it visually appealing and user-friendly.

```

## Features
```
->User registration with full name, username, email, and password

->Secure password hashing using password_hash()

->User login using username or email

->Session-based authentication for protected dashboard access

->Dashboard page displaying the logged-in user

->Logout functionality

->Responsive and modern navy blue & pale blue UI

->Duplicate username/email validation

```
## Folder Structure
```
APEX_TASK2/
├─ index.html           ← Registration page
├─ login.html           ← Login page
├─ css/
│   └─ styles.css       ← Styling for all pages
├─ js/
│   └─ app.js           ← (Optional JS for enhancements)
├─ php/
│   ├─ config.php       ← Database connection
│   ├─ register.php     ← Handles registration
│   ├─ login.php        ← Handles login
│   ├─ dashboard.php    ← Protected dashboard page
│   └─ logout.php       ← Logs out the user

```

## Technologies Used

```
->Frontend: HTML5, CSS3

->Backend: PHP 8+

->Database: MySQL

->Server: XAMPP (Apache + MySQL)
```


## Installation & Setup
```
->Clone the repository

git clone https://github.com/yourusername/APEX_TASK2.git


->Copy the project into your XAMPP htdocs folder:

C:\xampp\htdocs\APEX_TASK2


->Create the database in MySQL (phpMyAdmin):

CREATE DATABASE interactive_ui;


->Create users table:

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


->Update php/config.php with your database credentials:

<?php
$servername = "localhost";
$dbusername = "root";     // Your MySQL username
$dbpassword = "";         // Your MySQL password
$dbname = "interactive_ui";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


->Start XAMPP and run Apache and MySQL.

->Open your browser and navigate to:

 Registration: http://localhost/APEX_TASK2/index.html

```

## How to Use
```
->Register a new account on the registration page.

->Login with your username/email and password.

->Access the dashboard after login.

->Logout using the button on the dashboard.

```
