<?php
ini_set('display_errors', 1); // Wyłączenie wyświetlania błędów
error_reporting(E_ALL); // Raportowanie wszystkich błędów PHP (te nadal będą zapisywane w logach serwera)
session_start();
include '../db.php'; // Dostosuj ścieżkę do swojego pliku konfiguracyjnego bazy danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Zapytanie do bazy danych, aby znaleźć użytkownika o danym username
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        error_log("Błąd przygotowania zapytania: " . $conn->error);
        echo '1';
        exit;
    }

    $stmt->bind_param("s", $username);
    if (!$stmt->execute()) {
        error_log("Błąd wykonania zapytania: " . $stmt->error);
        echo '2';
        exit;
    }

    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        // Weryfikacja hasła
        if (password_verify($password, $user['password'])) {
            // Ustawienie danych sesji
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['username'];
            
            echo 'success';
        } else {
            echo '3';
        }
    } else {
        echo '4';
    }
    $stmt->close();
    $conn->close();
} else {
    echo '5';
}
?>
