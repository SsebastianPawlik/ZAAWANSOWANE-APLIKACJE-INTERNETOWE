<?php
session_start();

// Usuwanie danych sesji
if (isset($_SESSION['admin_logged_in'])) {
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['admin_username']);
    // Zniszczenie sesji
    session_destroy();
    echo 'logged_out'; // Można użyć do potwierdzenia w AJAX.
} else {
    echo 'error'; // W przypadku, gdy próba wylogowania nastąpi bez zalogowanego użytkownika.
}
?>
