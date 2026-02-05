<?php
// Encodage
header('Content-Type: text/html; charset=utf-8');

// Connexion à la BDD
include('ex-appli-connexion.php');
$bdd = new PDO("mysql:host=$bdd_Hote;dbname=$bdd_Base",
    $bdd_Utilisateur, $bdd_MotDePasse,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"));

// JOIN the User table to get the Avatar
$requete_posts = $bdd->prepare('
    SELECT 
        Post.*, 
        User.Avatar, 
        User.Username
    FROM Post
    JOIN User ON Post.Author = User.ID
    ORDER BY Post.ID DESC
');

$requete_posts->execute();

$avatars = [
    1 => 'avatar/avatar1.png',
    2 => 'avatar/avatar2.png',
    3 => 'avatar/avatar3.png',
    4 => 'avatar/avatar4.png',
    5 => 'avatar/avatar5.png'
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil</title>
  <link rel="icon" href="images/logosanstexte.png" type="image/png">
  <link rel="apple-touch-icon" href="images/logosanstexte.png">
  <link rel="preload" as="image" href="images/logosanstexte.pngs">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/header.css">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Amarante&family=Cinzel+Decorative:wght@400;700;900&family=Henny+Penny&family=La+Belle+Aurore&family=MedievalSharp&family=Mystery+Quest&display=swap" rel="stylesheet">
</head>

<body>
  <div class="app-container">
    <!-- Navbar -->
    <header class="navbar">
      <h1 class="logo">
        <a href="home.php">
          <img src="images/logotextehori.png" alt="Scrappy logo" class="logo-img">
        </a>
      </h1>
      <input type="text" class="search-bar" placeholder="Rechercher...">
    </header>

    <!-- Main layout -->
    <div class="main-layout">

      <!-- Feed -->
      <main class="feed">
<?php foreach ($requete_posts as $post) { ?>
  <article class="post">
    <div class="post-header">
      <img src="<?= $avatars[$post['Avatar']] ?>" class="avatar">
      <span class="post-user"><?= htmlspecialchars($post['Username']) ?></span>
    </div>

    <img src="images/<?= $post['Image']?>" class="post-image">

    <div class="post-body">
      <p>
        <strong><?= htmlspecialchars($post['Username']) ?></strong>
        <?= htmlspecialchars($post['Description']) ?>
      </p>
    </div>
  </article>
<?php } ?>
</main>

    </div>
  </div>
  <footer class="footer-menu">
    <nav>
        <ul>
            <li><a href="home.php">Accueil</a></li>
            <li><a href="new_escrapade.html">Nouvelle escrapade</a></li>
            <li><a href="profil.html">Profil</a></li>
        </ul>
    </nav>
  </footer>
</body>
</html>