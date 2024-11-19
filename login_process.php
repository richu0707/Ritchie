<?php
session_start();

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
$userType = $_POST['user-type'];
$username = $_POST['username'];
$password = $_POST['password'];
$dob = $_POST['dob'];
$captcha = $_POST['captcha'];
$enteredCaptcha = $_POST['textinput'];

// Validate Captcha
if ($captcha !== $enteredCaptcha) {
    echo "Invalid Captcha. Please try again.";
    exit();
}

// Protect against SQL injection
$username = mysqli_real_escape_string($conn, $username);
$dob = mysqli_real_escape_string($conn, $dob);

// Prepare and execute SQL query using prepared statements
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND dob=?");
$stmt->bind_param("ss", $username, $dob);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Login successful
        $_SESSION['username'] = $username;
        header("Location: student_dashboard.html ");
        exit();
    } else {
        // Invalid password
        echo "Invalid username, password, or date of birth.";
    }
} else {
    // Invalid username or DOB
    echo "Invalid username, password, or date of birth.";
}

$stmt->close();
$conn->close();
?>
