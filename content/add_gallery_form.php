<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'];

if (!$isLoggedIn) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj galerię zdjęć</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h2>Dodaj Nową Galerię Zdjęć</h2>
<form id="galleryForm" method="post" enctype="multipart/form-data">
    <label for="nazwa">Nazwa galerii:</label>
    <input type="text" id="nazwa" name="nazwa" required><br>

    <label for="opis">Opis galerii:</label>
    <textarea id="opis" name="opis" required></textarea><br>

    <label for="link">Link do galerii (opcjonalnie):</label>
    <input type="url" id="link" name="link"><br>

    <label for="zdjecia">Wybierz zdjęcia lub plik ZIP:</label>
    <input type="file" id="zdjecia" name="zdjecia[]" multiple accept=".zip, image/*"><br>

    <input type="submit" value="Dodaj galerię">
</form>

<div id="galleryMessage"></div>

<script>
$(document).ready(function() {
    $('#galleryForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'content/process_gallery.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#galleryMessage').html(response);
            },
            error: function() {
                $('#galleryMessage').html('Wystąpił błąd przy dodawaniu galerii.');
            }
        });
    });
});
</script>
</body>
</html>
