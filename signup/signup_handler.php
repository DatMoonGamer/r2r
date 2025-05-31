<?php
// signup_handler.php

$servername = "localhost";
$username = "root";  // or your DB username
$password = "loungerat";  // your DB password
$dbname = "r2r_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO signups (first_name, last_name, gender, ticket_type, email) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $first_name, $last_name, $gender, $ticket_type, $email);

// Set parameters and execute
$first_name = $_POST['firstName'] ?? '';
$last_name = $_POST['lastName'] ?? '';
$gender = $_POST['gender'] ?? '';
$ticket_type = $_POST['ticket'] ?? '';
$email = $_POST['email'] ?? '';

$stmt->execute();

$stmt->close();
$conn->close();

// Redirect back to signup page after submission
header("Location: /signup/signup.html");
exit();
?>
