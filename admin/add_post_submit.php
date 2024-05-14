<?php
include '../db.php';

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    // Filtrujemy treść, usuwając tagi <img>
    $content = preg_replace('/<img[^>]+\>/i', '', $_POST['content']);
    $galleryId = !empty($_POST['gallery_id']) ? $_POST['gallery_id'] : NULL;

    // Obsługa przesyłania obrazów (jeśli jakieś są przesyłane)
    $imageNames = [];
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['name'] as $key => $name) {
            if ($_FILES['images']['error'][$key] == 0) {
                $target = "../assets/images/" . basename($name);
                if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $target)) {
                    $imageNames[] = $name; // Zbieramy nazwy przesłanych plików
                } else {
                    echo "Nie udało się przesłać obrazka: $name.";
                }
            }
        }
        // Tworzymy ciąg z nazwami plików, do zapisania w bazie danych
        $imagesString = implode(',', $imageNames);
    } else {
        $imagesString = ""; // Pusty ciąg, jeśli żadne obrazy nie zostały przesłane
    }

    // Przygotowanie zapytania SQL z uwzględnieniem nowego pola 'images'
    $sql = "INSERT INTO posts (title, content, gallery_id, images, created_at) VALUES (?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $content, $galleryId, $imagesString);
    
    if($stmt->execute()) {
        echo "Post dodany pomyślnie.";
    } else {
        echo "Wystąpił błąd: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
