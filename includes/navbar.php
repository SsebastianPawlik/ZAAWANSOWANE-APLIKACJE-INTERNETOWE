<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php?page=home">Strona główna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=pokaz_galerie">Galeria</a>
        </li>
        <?php
        // Wymagane jest połączenie z bazą danych
        include 'db.php'; // Załóżmy, że plik db.php zawiera połączenie z bazą danych
        $query = "SELECT id, title FROM pages";
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li class="nav-item"><a class="nav-link" href="index.php?page='.$row['id'].'">'.$row['title'].'</a></li>';
            }
        }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=contact">Kontakt</a>
        </li>
        <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']): ?>
            <!-- Przyciski dostępne tylko dla zalogowanego admina -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=addPost">Dodaj post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=add_gallery_form">Dodaj nową galerię</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=addPage">Dodaj stronę</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../blog2/admin/logout.php" id="logoutLink">Wyloguj się</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Zaloguj się</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
