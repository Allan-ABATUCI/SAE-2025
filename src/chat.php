<?php
// Démarrer la session
session_start();
require_once 'connexion.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté

    header("Location: login.php");
    exit(); // Arrêter l'exécution du script
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Page d'accueil - Application d'Annotation</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }

        header {
            background-color: #128C7E;
            color: white;
            padding: 20px;
            text-align: center;
        }

        main {
            padding: 10px;
        }

        #profil {
            text-decoration: none;
            /*padding-left : 700px;*/
            color: grey;


        }

        .contacts {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-bar {
            padding: 10px;
        }

        .search-bar input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .contact-list {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .contact-item {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid #f0f2f5;
            cursor: pointer;
        }

        .contact-item:hover {
            background-color: #f0f0f0;
        }

        .contact-info {
            flex-grow: 1;
        }

        .contact-name {
            font-weight: bold;
            justify-content: space-between;
        }

        .timestamp {
            font-size: 0.9em;
            color: gray;
        }

        #message {
            color: black;
        }
    </style>
</head>

<body>
    <header>
        <h1>Messagerie Instantanée</h1>
        <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['prenom']); ?> !</p>
        <a href="logout.php">Déconnexion</a> <!-- Lien pour se déconnecter -->
    </header>
    <main>
        <div class="contacts">
            <div class="search-bar">
                <input type="text" placeholder="Rechercher un contact...">
            </div>
            <ul class="contact-list">
                <?php $sql = "SELECT user_id,prenom, email FROM users";
                $requete = $bdd->query($sql);

                // Récupérer tous les résultats sous forme de tableau associatif
                $user = $requete->fetchAll(PDO::FETCH_ASSOC); ?>
                <?php foreach ($user as $usere): ?>
                    <li class="contact-item">
                        <div class="contact-info">
                            <div class="contact-name"><?php echo htmlspecialchars($usere['prenom']); ?> <a href="profil/profil.php?id=<?php echo $usere['user_id']; ?>"> Voir son profil </a></div>
                            <div class="last-message"><a href="message.php?uid=<?php echo $_SESSION['id']; ?>&id=<?php echo $usere['user_id'] ?>" id="message"> Cliquer ici pour continuer la discussion...</a></div>

                        </div>
                    </li>
                <?php endforeach;
                ?>
            </ul>
        </div>
    </main>
</body>

</html>