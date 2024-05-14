<?php
// Rozpoczęcie sesji, jeśli nie jest jeszcze rozpoczęta
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Upewnienie się, że użytkownik jest zalogowany jako admin
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login.php");
    exit;
}

include '../db.php';

$isEditing = isset($_GET['edit']) && $_GET['edit'] == 'true';
$post = ['post_id' => '', 'title' => '', 'content' => '', 'images' => '', 'header_image' => ''];

if ($isEditing && isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];
    $query = "SELECT * FROM posts WHERE post_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!($post = $result->fetch_assoc())) {
        echo "Nie znaleziono posta o podanym ID.";
        exit;
    }
    $stmt->close();
} elseif ($isEditing) {
    echo "Nie określono ID posta.";
    exit;
}

$actionURL = $isEditing ? "/blog2/admin/edit_post_submit.php" : "admin/add_post_submit.php";
$submitButtonText = $isEditing ? "Zapisz zmiany" : "Dodaj Post";
?>

<h2><?php echo $isEditing ? 'Edytuj Post' : 'Dodaj Nowy Post'; ?></h2>
<form action="<?php echo $actionURL; ?>" method="post" enctype="multipart/form-data">
    <?php if ($isEditing): ?>
        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
    <?php endif; ?>
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
        <?php if ($isEditing && $post['header_image']): ?>
            <p>Obecny obraz: <img src='../assets/images/<?php echo htmlspecialchars($post['header_image']); ?>' alt='Obraz nagłówkowy' style='max-width: 200px;'></p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="images">Zdjęcia wyświetlane w tekście (opcjonalnie):</label>
        <input type="file" id="images" name="images[]" multiple>
        <?php if ($isEditing && $post['images']): ?>
            <p>Obecne obrazy: <?php echo $post['images']; ?></p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="gallery_id">Link do Galerii (opcjonalnie):</label>
        <input type="text" id="gallery_id" name="gallery_id" value="<?php echo htmlspecialchars($post['gallery_id'] ?? ''); ?>">
    </div>
    <button type="submit" name="submit"><?php echo $submitButtonText; ?></button>
</form>
