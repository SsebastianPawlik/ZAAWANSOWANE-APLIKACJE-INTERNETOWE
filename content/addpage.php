<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj Nową Stronę</title>
    <!-- Załącz CKEditor 5 z CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
</head>
<body>
    <h2>Dodaj Nową Stronę</h2>
    <form method="post" action="process_addPage.php">
        <label for="pageTitle">Tytuł Strony:</label>
        <input type="text" id="pageTitle" name="pageTitle" required><br>

        <label for="pageContent">Treść Strony:</label>
        <textarea name="pageContent" id="pageContent" rows="10" cols="80"></textarea>

        <input type="submit" value="Dodaj Stronę">
    </form>

    <!-- Skrypt inicjalizujący CKEditor 5 -->
    <script>
        ClassicEditor
            .create(document.querySelector('#pageContent'))
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error('There was a problem initializing the editor:', error);
            });
    </script>
</body>
</html>
