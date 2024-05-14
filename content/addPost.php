<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kod PHP do sprawdzania zalogowania
$isLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'];

if (!$isLoggedIn) {
    echo '<p>Musisz być zalogowany, aby dodać post.</p>';
    return; // Zatrzymaj dalsze przetwarzanie skryptu, jeśli użytkownik nie jest zalogowany
}
?>
<h2>Dodaj Nowy Post</h2>
    <form action="admin/add_post_submit.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="content">Treść:</label>
        <textarea id="content" name="content" required></textarea>
    </div>
    <div class="form-group">
        <label for="header_image">Obrazek Nagłówkowy (opcjonalnie):</label>
        <input type="file" id="header_image" name="header_image">
    </div>
    <div class="form-group">
        <label for="images">Zdjęcia wyświetlane w tekście (opcjonalnie):</label>
        <input type="file" id="images" name="images[]" multiple>
    </div>
    <div class="form-group">
        <label for="gallery_id">Link do Galerii (opcjonalnie):</label>
        <input type="text" id="gallery_id" name="gallery_id">
    </div>
    <button type="submit" name="submit">Dodaj Post</button>
</form>