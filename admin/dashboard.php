<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Tutaj możesz dodać treść dashboardu, np. linki do zarządzania treścią, użytkownikami itp.
echo "<h1>Witaj, " . $_SESSION['admin_username'] . "</h1>";
echo "<a href='logout.php'>Wyloguj</a>";
?>
