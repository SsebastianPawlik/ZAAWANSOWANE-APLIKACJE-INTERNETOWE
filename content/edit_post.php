<?php
// edit_post.php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session only if not already started
}

$relativePath = realpath(dirname(__FILE__) . '/../db.php'); // More reliable way to include files
if (file_exists($relativePath)) {
    include $relativePath;
} else {
    die('Błąd: Nie można znaleźć pliku konfiguracyjnego bazy danych.');
}

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];
    $query = "SELECT * FROM posts WHERE post_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($post = $result->fetch_assoc()) {
        // Load the post data into the form below
    } else {
        echo "Nie znaleziono posta o podanym ID.";
        exit;
    }
    $stmt->close();
} else {
    echo "Nie określono ID posta.";
    exit;
}
?>

<form id="editPostForm" action="/blog2/admin/edit_post_submit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
    <div class="form-group">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
    </div>
    <div class="form-group">
        <label for="content">Treść:</label>
        <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
    </div>
    <div class="form-group">
        <label for="header_image">Obrazek Nagłówkowy (opcjonalnie):</label>
        <input type="file" id="header_image" name="header_image">
        <p>Obecny obraz: <?php echo $post['header_image'] ? "<img src='../assets/images/" . htmlspecialchars($post['header_image']) . "' alt='Obraz nagłówkowy' style='max-width: 200px;'>" : 'Brak'; ?></p>
    </div>
    <div class="form-group">
        <label for="images">Dodatkowe obrazy (opcjonalnie):</label>
        <input type="file" id="images" name="images[]" multiple>
        <p>Obecne obrazy: <?php echo $post['images'] ?: 'Brak'; ?></p>
    </div>
    <button type="submit">Zapisz zmiany</button>
</form>

