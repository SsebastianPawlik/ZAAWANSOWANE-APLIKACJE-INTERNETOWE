<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/../db.php';  // Upewnij się, że ścieżka do pliku db.php jest poprawna.

$id_galerii = isset($_GET['id_galerii']) ? (int) $_GET['id_galerii'] : 0;

if ($id_galerii > 0) {
    $stmt = $conn->prepare("SELECT nazwa, opis, link, data_dodania FROM galerie WHERE id = ?");
    $stmt->bind_param("i", $id_galerii);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($galeria = $result->fetch_assoc()) {
        echo "<h2>" . htmlspecialchars($galeria['nazwa']) . "</h2>";
        echo "<p>" . htmlspecialchars($galeria['opis']) . "</p>";
        echo "<p>Dodano: " . date('Y-m-d', strtotime($galeria['data_dodania'])) . "</p>";
        
        if (!empty($galeria['link'])) {
            echo "<a href='" . htmlspecialchars($galeria['link']) . "' target='_blank'>Otwórz galerię w nowej karcie</a>";
        } else {
            $folderPath = "/blog2/content/uploads/gallery/" . urlencode($galeria['nazwa']);
            if (is_dir($_SERVER['DOCUMENT_ROOT'] . $folderPath)) {
                $files = scandir($_SERVER['DOCUMENT_ROOT'] . $folderPath);
                foreach ($files as $file) {
                    if (!in_array($file, ['.', '..'])) {
                        echo "<a href='" . htmlspecialchars($folderPath . "/" . $file) . "' data-lightbox='gallery' data-title='" . htmlspecialchars($file) . "'><img src='" . htmlspecialchars($folderPath . "/" . $file) . "' alt='" . htmlspecialchars($file) . "' style='width: 100px; height: auto;'></a><br>";
                    }
                }
            } else {
                echo "Brak zdjęć w galerii.";
            }
        }
    } else {
        echo "Galeria nie została znaleziona.";
    }
    $stmt->close();
} else {
    echo "Nieprawidłowe ID galerii.";
}
$conn->close();
?>
