<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include __DIR__ . '/../db.php';

function sanitizeFolderName($folderName) {
    $folderName = preg_replace("/[^a-zA-Z0-9\s]/", "", $folderName);
    $folderName = str_replace(" ", "_", $folderName);
    return $folderName;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nazwa = $_POST['nazwa'] ?? 'Brak_nazwy';
    $nazwa = sanitizeFolderName($nazwa);
    $opis = $_POST['opis'] ?? 'Brak opisu';
    $link = $_POST['link'] ?? null;

    $folderPath = __DIR__ . "/uploads/gallery/" . $nazwa;

    if (!is_dir($folderPath)) {
        mkdir($folderPath, 0777, true);
    }

    // Dodawanie wpisu do galerii tylko raz
    if ($stmt = $conn->prepare("INSERT INTO galerie (nazwa, opis, link) VALUES (?, ?, ?)")) {
        $stmt->bind_param("sss", $nazwa, $opis, $link);
        $stmt->execute();
        $id_galerii = $stmt->insert_id; // Pobierz ID nowo utworzonej galerii
        $stmt->close();
    }

    if (isset($_FILES['zdjecia'])) {
        foreach ($_FILES['zdjecia']['name'] as $key => $name) {
            if (pathinfo($name, PATHINFO_EXTENSION) == 'zip' && class_exists('ZipArchive')) {
                $zip = new ZipArchive;
                if ($zip->open($_FILES['zdjecia']['tmp_name'][$key]) === TRUE) {
                    $zip->extractTo($folderPath);
                    $zip->close();
                    echo "Plik ZIP został rozpakowany.<br>";
                } else {
                    echo "Nie udało się rozpakować pliku ZIP.<br>";
                }
            } elseif (pathinfo($name, PATHINFO_EXTENSION) !== 'zip') {
                $target = $folderPath . "/" . basename($name);
                if (move_uploaded_file($_FILES['zdjecia']['tmp_name'][$key], $target)) {
                    if ($stmt = $conn->prepare("INSERT INTO zdjecia (id_galerii, sciezka) VALUES (?, ?)")) {
                        $stmt->bind_param("is", $id_galerii, $target);
                        $stmt->execute();
                        $stmt->close();
                        echo "Plik $name został przesłany pomyślnie.<br>";
                    } else {
                        echo "Błąd przygotowania zapytania na zdjęcia: " . $conn->error . "<br>";
                    }
                } else {
                    echo "Nie udało się przesłać pliku: $name<br>";
                }
            }
        }
    }
    $conn->close();
}
?>
