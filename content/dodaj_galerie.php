<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include __DIR__ . '/../db.php';  // Włączenie pliku z konfiguracją bazy danych

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nazwa = $_POST['nazwa'] ?? 'Brak nazwy'; 
    $opis = $_POST['opis'] ?? 'Brak opisu';
    $link = $_POST['link'] ?? null;

    if ($stmt = $conn->prepare("INSERT INTO galerie (nazwa, opis, link) VALUES (?, ?, ?)")) {
        $stmt->bind_param("sss", $nazwa, $opis, $link);
        $stmt->execute();
        $id_galerii = $stmt->insert_id;
        $stmt->close();
    }

    if (!empty($link)) {
        echo "Dodano galerię z linkiem: $link";
    } else {
        foreach ($_FILES['zdjecia']['name'] as $key => $name) {
            $target = "uploads/gallery/" . basename($name);
            if (move_uploaded_file($_FILES['zdjecia']['tmp_name'][$key], $target)) {
                if ($stmt = $conn->prepare("INSERT INTO zdjecia (id_galerii, sciezka) VALUES (?, ?)")) {
                    $stmt->bind_param("is", $id_galerii, $target);
                    $stmt->execute();
                    $stmt->close();
                    echo "Plik $name został przesłany pomyślnie i zapisany w bazie danych.<br>";
                } else {
                    echo "Błąd przygotowania zapytania na zdjęcia: " . $conn->error . "<br>";
                }
            } else {
                echo "Nie udało się przesłać pliku: $name<br>";
            }
        }
        echo "Dodano galerię z przesłanymi zdjęciami.";
    }
    
    $conn->close();
} else {
    echo "Metoda formularza to nie POST";
}
?>

<form id="galleryForm" method="post" enctype="multipart/form-data">
    <label for="nazwa">Nazwa galerii:</label>
    <input type="text" id="nazwa" name="nazwa" required>
    <label for="opis">Opis galerii:</label>
    <textarea id="opis" name="opis" required></textarea>
    <label for="zdjecia">Wybierz zdjęcia:</label>
    <input type="file" id="zdjecia" name="zdjecia[]" multiple>
    <label for="link">lub podaj link do galerii zdjęć:</label>
    <input type="url" id="link" name="link">
    <input type="submit" value="Dodaj galerię">
</form>
<div id="galleryMessage"></div> <!-- Div dla komunikatu -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    console.log("Form submission script loaded");
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
                $('#galleryMessage').empty().html(response);
            },
            error: function() {
                $('#galleryMessage').empty().html('Wystąpił błąd przy dodawaniu galerii.');
            }
        });
    });
});
</script>
