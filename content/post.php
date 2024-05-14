<?php
include 'db.php';

$sql = "SELECT post_id, title, LEFT(content, 200) AS snippet, header_image, gallery_id, created_at FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="post-preview">';
        echo '<h2>' . htmlspecialchars($row["title"]) . '</h2>';
        
        // Usunięcie tagów <img> z fragmentu treści
        $snippetWithoutImages = preg_replace('/<img[^>]+\>/i', '', $row["snippet"]);

        // Wyświetlenie przefiltrowanego fragmentu treści
        echo '<p>' . htmlspecialchars($snippetWithoutImages) . '...</p>';
        echo '<a href="post.php?post_id=' . urlencode($row["post_id"]) . '" class="btn btn-primary">Czytaj więcej</a>';
        echo '</div><hr>';
    }
} else {
    echo "Brak postów do wyświetlenia.";
}
?>
