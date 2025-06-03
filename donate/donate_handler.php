<?php
$servername = "localhost";
$username = "root"; // or your created MariaDB username
$password = "loungerat"; // replace with actual password
$dbname = "r2r_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data safely
$firstName = $conn->real_escape_string($_POST['firstName'] ?? '');
$lastName = $conn->real_escape_string($_POST['lastName'] ?? '');
$amount = floatval($_POST['amount'] ?? 0);
$comments = $conn->real_escape_string($_POST['comments'] ?? '');

// Validate donation amount
if ($amount <= 0) {
    die("Invalid donation amount.");
}

// Insert data
$sql = "INSERT INTO donations (first_name, last_name, amount, comments)
        VALUES ('$firstName', '$lastName', $amount, '$comments')";

if ($conn->query($sql) === TRUE) {
    header("Location: /donate/donate.html");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
