<?php
	// Encodage de la page — impératif
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="ex-appli.css">
</head>
<body>
    <header>
        <h1>User exemple test</h1>
    </header>
    <nav>
        <p><a href="ex-appli-index.html"></a></p>
    </nav>
    <main>
        <?php
            // 1) Connexion à la base de données

            include('ex-appli-connexion.php');
            $bdd = new PDO("mysql:host=$bdd_Hote;dbname=$bdd_Base",
                $bdd_Utilisateur, $bdd_MotDePasse,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"));

            // 2) Préparation de la requête

            $requete_refs = $bdd->prepare('SELECT * FROM bibliographie_refs ORDER BY annee_nombre LIMIT 25;');

            // 3) Exécution de la requête principale

			$requete_refs->execute(Array());

            // 4) Présentation des résultats
        ?>
        <ul>
            
boucle
<?php foreach($requete_refs as $ligne) { ?>
                <li>
                    <a href="ex-appli-fiche.php?id=<?= $ligne['id'] ?>">📄 <?= $ligne['id'] ?></a>
                    <span class="auteur"><?= $ligne['auteur'] ?></span>
                    (<?= $ligne['annee_texte']? htmlspecialchars($ligne['annee_texte']): $ligne['annee_nombre'] ?>),
                    <cite class="titre"><?= $ligne['titre'] ?></cite><?php
						if ( $ligne['complement'] ) { echo ', ', $ligne['complement']; }
					?>
                </li>
            <?php } ?>
        </ul>
    </main>
</body>
</html>