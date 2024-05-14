<?php
// Rozpoczęcie buforowania, aby uniknąć problemów z wysyłaniem nagłówków
ob_start();

include __DIR__ . '/../db.php';  // Powinno działać jeśli db.php jest jeden katalog wyżej

echo "<h1>Galerie</h1><div id='gallery-links'>";

$query = "SELECT id, nazwa, data_dodania FROM galerie ORDER BY data_dodania DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<button class='gallery-btn' data-id='" . $row['id'] . "'>" . htmlspecialchars($row['nazwa']) . " - Dodano: " . date('Y-m-d', strtotime($row['data_dodania'])) . "</button><br>";
    }
} else {
    echo "Brak galerii do wyświetlenia.";
}
echo "</div><div id='gallery-details'></div><button id='back-button' style='display:none;'>Powrót</button>";

// Ukończenie buforowania i wysłanie treści
ob_end_flush();

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.gallery-btn').on('click', function() {
        var galleryId = $(this).data('id');
        $.ajax({
            url: '/blog2/content/show_gallery.php', // Upewnij się, że ścieżka jest poprawna
            type: 'GET',
            data: { id_galerii: galleryId },
            success: function(data) {
                $('#gallery-details').html(data);
                $('#gallery-links').hide(); // Ukryj przyciski galerii
                $('#back-button').show(); // Pokaż przycisk powrotu
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Błąd: ' + textStatus + ', ' + errorThrown);
            }
        });
    });

    $('#back-button').on('click', function() {
        $('#gallery-details').empty();
        $('#gallery-links'). show(); // Pokaż przyciski galerii
        $(this).hide(); // Ukryj przycisk powrotu
    });
});
</script>
