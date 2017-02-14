<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link href="<?php echo WEBROOT; ?>content/css/style.css" rel="stylesheet" type="text/css">
        <title>Presentation</title>
    </head>
    <body>
        <div class="box">
            <h1>API: Readme</h1>
        </div>

        <div class="core">
            <div class="prerequis">
                <h2>Prequis</h2>
                <ul>
                    <li>Base de donnée: rush2_db</li>
                    <li>Navigateur</li>
                    <li>IP locale</li>
                </ul>
            </div>

            <div class="utilisation">
                <h2>Utilisation</h2>
                <p>Cette API sert à afficher des informations de la base de donnée. La base de donnée contient diffrents
                artistes, leur albums, leur musiques et differents details supplémentaire comme les images des artistes et des albums
                </p>

                <p>noté dans l'url votre demande:</p>
                <ul>
                    <li>/artists/
                        <ol>
                            <li>/artists/name/ %nom de l'artiste%</li>
                            <li>/artists/details/ %id de l'atiste%</li>
                        </ol>
                    </li>
                    <li>/albums/
                        <ol>
                            <li>/albums/details/%id de l'album%</li>
                        </ol>
                    </li>
                    <li>/tracks/</li>
                    <li>/genres/
                        <ol>
                            <li>/genres/id/%id de l'album%</li>
                        </ol>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>