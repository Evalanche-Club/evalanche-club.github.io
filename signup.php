<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $virtual_id = $_POST['virtual-id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE virtual_id = ?");
    $check->bind_param("s", $virtual_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "Virtual ID already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (virtual_id, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $virtual_id, $password);
        if ($stmt->execute()) {
            echo "Signup successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    $check->close();
    $conn->close();
}
?>
