<?php
$host = 'localhost'; // Host bazy danych
$username = 'root'; // Użytkownik bazy danych
$password = ''; // Hasło do bazy danych
$database = 'blog'; // Nazwa bazy danych

// Tworzenie połączenia
$conn = new mysqli($host, $username, $password, $database);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}
?>
