<?php
session_start();
include '../db.php'; // Dołącz plik konfiguracyjny bazy danych

// Sprawdzenie, czy użytkownik jest zalogowany i ma uprawnienia administratora
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    $_SESSION['message'] = "Brak uprawnień do wykonania tej operacji.";
    $_SESSION['message_type'] = "error"; // Ustawienie typu komunikatu na "error"
    header("Location: ../index.php"); // Przekierowanie do strony głównej
    exit;
}

if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];

    // Usuwanie posta z bazy danych
    $query = "DELETE FROM posts WHERE post_id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        $_SESSION['message'] = "Błąd przygotowania zapytania: " . $conn->error;
        $_SESSION['message_type'] = "error";
        header("Location: ../index.php");
        exit;
    }

    $stmt->bind_param("i", $postId);
    if (!$stmt->execute()) {
        $_SESSION['message'] = "Błąd wykonania zapytania: " . $stmt->error;
        $_SESSION['message_type'] = "error";
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION['message'] = "Post został pomyślnie usunięty.";
        $_SESSION['message_type'] = "success"; // Ustawienie typu komunikatu na "success"
        header("Location: ../index.php"); // Przekierowanie do strony głównej
        exit;
    }
    $stmt->close();
} else {
    $_SESSION['message'] = "Nie określono ID posta.";
    $_SESSION['message_type'] = "error";
    header("Location: ../index.php");
    exit;
}

$conn->close();
?>
