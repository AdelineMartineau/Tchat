<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat</title>
        <link href="main.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="grid">
            <div id="form">
                <form action="minichat_post.php" method="post">
                    <label for="pseudo">Pseudo</label> : <input required class="inputs" type="text" name="pseudo" id="pseudo" /><br />
                    <label for="message">Message</label> : <input required class="inputs" type="text" name="message" id="message" /><br />
                    <input id="btn" type="submit" value="Envoyer" />
                </form>
            </div>
            <div id="tchat">
                <?php
                // Connexion à la base de données
                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', 'root');
                } catch(Exception $e) {
                        die('Erreur : '.$e->getMessage());
                }

                try {
                    // Récupération des 10 derniers messages
                    $reponse = $bdd->query('SELECT minitchat.pseudo, minitchat.message FROM minitchat ORDER BY ID DESC LIMIT 0, 10');
                    
                    // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
                    while ($donnees = $reponse->fetch())
                    {
                        echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
                    }
                    
                    $reponse->closeCursor();
                } catch(Exception $e) {
                        die('Erreur : '.$e->getMessage());
                }
                ?>
            </div>
            <div id="video">
                <video autoplay loop muted playsinline src="video/pexels.mp4"></video>
            </div>
        </div>
    </body>
</html>