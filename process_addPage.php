<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include 'db.php'; // Plik z połączeniem do bazy danych

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['pageTitle'];
    $content = $_POST['pageContent'];

    // Sprawdź, czy połączenie z bazą danych jest aktywne
    if ($conn) {
        $stmt = $conn->prepare("INSERT INTO pages (title, content) VALUES (?, ?)");
        if ($stmt) {
            $stmt->bind_param("ss", $title, $content);
            $stmt->execute();
            echo "Strona została dodana.";
            $stmt->close();
        } else {
            echo "Błąd przygotowania zapytania: " . $conn->error;
        }
    } else {
        echo "Błąd połączenia z bazą danych.";
    }

    $conn->close();
}
?>
