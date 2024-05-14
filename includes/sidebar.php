<!-- Sidebar start -->

<div class="sidebar">
    <h3>Menu</h3>
    <ul class="list-unstyled">
        <li><a href="index.php?page=pokaz_galerie">Galeria</a></li>
        <li><a href="index.php?page=contact">Kontakt</a></li>
        <li><a href="index.php?page=statute">Statut</a></li>
    </ul>

    <h3>Najpopularniejsze posty</h3>
    <ul class="list-unstyled">
    <?php
    $popularPostsQuery = "SELECT post_id, title FROM posts ORDER BY view_count DESC LIMIT 5";
    if ($result = $conn->query($popularPostsQuery)) {
        while ($post = $result->fetch_assoc()) {
            echo "<li><a href='index.php?page=single_post&post_id=" . $post['post_id'] . "'>" . htmlspecialchars($post['title']) . "</a></li>";
        }
        $result->close();
    } else {
        echo "<li>Brak dostępnych postów.</li>";
    }
    ?>
    </ul>

</div>
<!-- Sidebar end -->
