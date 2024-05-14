<?php 
include 'includes/header.php';  // Zakładam, że header może już zawierać sesję start.
include 'db.php';  // Dodaj tę linijkę tutaj, aby połączenie było dostępne globalnie.
?>

<div class="container mt-4">
    <div class="row">
        <!-- Main content -->
        <div class="col-md-8" id="main-content">
            <?php
            $allowed_pages = ['home', 'single_post', 'pokaz_galerie', 'contact', 'statute', 'gallery_page', 'addPage', 'add_gallery_form'];
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            $path = "content/{$page}.php";

            if (in_array($page, $allowed_pages) && file_exists($path)) {
                include $path;
            } else {
                // Sprawdzanie, czy $page jest ID strony z bazy danych
                if (ctype_digit($page)) {
                    $stmt = $conn->prepare("SELECT title, content FROM pages WHERE id = ?");
                    $stmt->bind_param("i", $page);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($row = $result->fetch_assoc()) {
                        echo "<h1>" . htmlspecialchars($row['title']) . "</h1>";
                        echo $row['content']; // Przemyśl sanitację HTML, jeżeli treść zawiera HTML
                    } else {
                        include 'content/404.php'; // Strona nie znaleziona
                    }
                    $stmt->close();
                } else {
                    include 'content/404.php'; // Strona nie znaleziona dla niewłaściwych URLi
                }
            }
            ?>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <?php include 'includes/sidebar.php'; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    // Event handler for edit post links
    $(document).on('click', '.edit-post-link', function(e) {
        e.preventDefault();
        var postId = $(this).data('post-id');
        $.ajax({
            url: 'content/edit_post.php',
            type: 'GET',
            data: { post_id: postId },
            success: function(response) {
                $('#main-content').html(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
            }
        });
    });
});
</script>
</body>
</html>
