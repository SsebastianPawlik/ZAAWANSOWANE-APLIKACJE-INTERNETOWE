<footer class="footer mt-auto py-3 bg-dark text-white">
    <div class="container text-center">
        &copy; 2024 Grupa Motocyklowa Miś. Wszelkie prawa zastrzeżone.
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="assets/ckeditor/ckeditor.js"></script>
<script>
$(document).ready(function() {
    // Logowanie
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "admin/login.php",
            data: $(this).serialize(),
            success: function(response) {
                if(response.trim() === "success") {
                    window.location.href = "index.php";
                } else {
                    $("#loginError").removeClass('d-none').text("Nieprawidłowa nazwa użytkownika lub hasło");
                }
            }
        });
    });

    // Wylogowanie
    $(document).on('click', '#logoutLink', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'admin/logout.php',
            success: function(response) {
                if (response.trim() === 'logged_out') {
                    alert('Wylogowano pomyślnie.');
                    window.location.href = 'index.php?page=home';
                } else {
                    alert('Błąd podczas wylogowywania.');
                }
            }
        });
    });

    // Dodawanie nowego pola obrazu
    $('#add-image-btn').click(function() {
        const container = $('#images-container');
        $('<input>', {
            type: 'file',
            name: 'post_images[]'
        }).appendTo(container);
    });

    // Edycja postu
    $(document).on('submit', '#editPostForm', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '/blog2/admin/edit_post_submit.php', // Upewnij się, że ścieżka jest poprawna
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                alert('Post został zaktualizowany.');
                location.reload(); // Opcjonalnie odśwież stronę
            },
            error: function() {
                alert('Wystąpił błąd podczas aktualizacji posta.');
            }
        });
    });

    // Ładowanie formularza edycji
    $('.edit-post-link').click(function(e) {
        e.preventDefault();
        var postId = $(this).data('post-id');
        $.ajax({
            url: 'content/edit_post.php',
            type: 'GET',
            data: { post_id: postId },
            success: function(response) {
                $('#main-content').html(response);
            },
            error: function() {
                alert('Błąd ładowania formularza edycji.');
            }
        });
    });
    $(document).on('click', '.gallery-link', function(e) {
        e.preventDefault();
        var url = $(this).attr('href'); // Pobierz URL do ładowanej strony galerii

        $('#main-content').load(url, function(response, status, xhr) {
            if (status === "error") {
                alert('Błąd ładowania galerii: ' + xhr.statusText);
            }
        });
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js"></script>
</body>
</html>
