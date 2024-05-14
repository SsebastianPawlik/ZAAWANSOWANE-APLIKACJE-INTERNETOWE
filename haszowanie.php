<?php
include 'db.php';

$username = "admin";
$password = "haslo";

// Haszowanie hasła
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Dodanie użytkownika do bazy danych
$query = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username, $hashedPassword);

if ($stmt->execute()) {
    echo "Użytkownik dodany pomyślnie.";
} else {
    echo "Błąd przy dodawaniu użytkownika: " . $conn->error;
}

$stmt->close();
$conn->close();
?>