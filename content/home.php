<?php
include 'db.php';

$posts = []; // Tablica na posty

$query = "SELECT * FROM posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
}
?>

<?php foreach ($posts as $post): ?>
    <div class="post mb-4">
        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        <?php if (!empty($post['header_image'])): ?>
            <img src="/blog2/assets/images/<?php echo htmlspecialchars($post['header_image']); ?>" alt="Zdjęcie do postu" class="img-fluid">
        <?php endif; ?>

        <?php
        // Czyszczenie treści z [zdj] i podobnych znaczników przed wyświetleniem
        $cleanContent = preg_replace('/\[\w+\]/', '', $post['content']);
        // Wyświetlanie skróconej wersji treści
        echo '<p>' . substr(htmlspecialchars($cleanContent), 0, 200) . '...</p>';
        ?>

        <a href="index.php?page=single_post&post_id=<?php echo $post['post_id']; ?>" class="btn btn-primary">Czytaj więcej</a>
        <hr>
    </div>
<?php endforeach; ?>

