<?php
include 'db.php';

if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];

    // Aktualizacja licznika wyświetleń
    $updateQuery = "UPDATE posts SET view_count = view_count + 1 WHERE post_id = ?";
    if ($updateStmt = $conn->prepare($updateQuery)) {
        $updateStmt->bind_param("i", $postId);
        $updateStmt->execute();
        $updateStmt->close();
    }

    // Pobieranie danych posta
    $query = "SELECT * FROM posts WHERE post_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($post = $result->fetch_assoc()) {
            echo "<h1>" . htmlspecialchars($post['title']) . "</h1>";

            if (!empty($post['header_image'])) {
                echo "<img src='assets/images/" . htmlspecialchars($post['header_image']) . "' alt='Zdjęcie do postu' class='img-fluid'>";
            }

            // Rozdzielanie nazw plików obrazów na tablicę, jeśli kolumna images istnieje i nie jest pusta
            $images = !empty($post['images']) ? explode(',', $post['images']) : [];
            $content = $post['content'];

            // Zamiana każdego znacznika [zdj] na tag <img> z kolejnym obrazem
            foreach ($images as $image) {
                $content = preg_replace('/\[zdj\]/', "<img src='assets/images/$image' alt='Zdjęcie' class='img-fluid'>", $content, 1);
            }

            // Usuwanie pozostałych znaczników [zdj], jeśli istnieją
            $content = preg_replace('/\[zdj\]/', '', $content);

            echo "<p>" . $content . "</p>";
            echo "<p>Liczba wyświetleń: " . $post['view_count'] . "</p>";

            if (!empty($post['gallery_id'])) {
                echo "<a href='gallery_page.php?galleryId=" . htmlspecialchars($post['gallery_id']) . "' class='btn btn-secondary'>Przejdź do galerii</a>";
            }

            if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
                echo "<a href='#' class='edit-post-link btn btn-secondary' data-post-id='" . $postId . "'>Edytuj post</a> ";
                echo "<a href='content/delete_post.php?post_id=" . $postId . "' onclick='return confirm(\"Czy na pewno chcesz usunąć ten post?\");' class='btn btn-danger'>Usuń post</a>";
            }

            echo "<a href='index.php' class='btn btn-primary'>Powrót do postów</a>";
        } else {
            echo "Post nie został znaleziony.";
        }
        $stmt->close();
    }
} else {
    echo "Brak ID posta.";
}
?>
