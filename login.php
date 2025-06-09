<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $virtual_id = $_POST['virtual-id'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE virtual_id = ?");
    $stmt->bind_param("s", $virtual_id);
    $stmt->execute();
    $stmt->bind_result($hash);
    
    if ($stmt->fetch() && password_verify($password, $hash)) {
        echo "Login successful!";
        // session_start(); $_SESSION['user'] = $virtual_id;
    } else {
        echo "Invalid Virtual ID or Password.";
    }

    $stmt->close();
    $conn->close();
}
?>
