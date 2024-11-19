<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management"; // Make sure this matches your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];
$dob = $_POST['dob'];
$phone = $_POST['phone'];

// Validate form data
if ($password !== $confirm_password) {
    echo "Passwords do not match.";
    exit();
}

// Protect against SQL injection
$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);
$dob = mysqli_real_escape_string($conn, $dob);
$phone = mysqli_real_escape_string($conn, $phone);

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute SQL query
$sql = "INSERT INTO users (name, email, password, dob, phone) VALUES ('$name', '$email', '$hashed_password', '$dob', '$phone')";

if ($conn->query($sql) === TRUE) {
    // Registration successful, redirect to login page
    header("Location: login.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
