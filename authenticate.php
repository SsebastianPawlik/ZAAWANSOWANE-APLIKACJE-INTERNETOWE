<?php
session_start();

include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_logged_in'] = true;
        echo "success";
    } else {
        echo "Nieprawidłowe hasło.";
    }
} else {
    echo "Nieprawidłowa nazwa użytkownika.";
}

$stmt->close();
$conn->close();
?>
