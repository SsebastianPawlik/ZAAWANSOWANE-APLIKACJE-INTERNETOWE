<?php
// edit_post_submit.php w folderze admin
session_start();

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    // Użytkownik nie jest zalogowany lub nie ma odpowiednich uprawnień
    echo "Brak uprawnień.";
    exit;
}

require_once realpath(dirname(__FILE__) . '/../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobierz dane z $_POST oraz przetwarzanie przesłanych plików
    $postId = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    // Przykład przetwarzania przesłanych plików jest pominięty dla zwięzłości

    // Przygotuj i wykonaj zapytanie do bazy danych
    $query = "UPDATE posts SET title = ?, content = ? WHERE post_id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo "Błąd przygotowania zapytania: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssi", $title, $content, $postId);
    if ($stmt->execute()) {
        echo "Post został zaktualizowany.";
    } else {
        echo "Błąd aktualizacji posta: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Nieprawidłowe żądanie.";
}

$conn->close();
