<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion Ad'mns</title>
    <link rel="stylesheet" href="./assets/style/login.css" />
</head>

<body>
    <main id="container">
        <section id="containerInt">
            <header>
                <img id="logo" src="./assets/img/ad'mns.png" alt="Logo mns admin" />
            </header>
            <form action="admin/php/login.php" method="POST">
                <div class="marge">
                    <label for="userMail" class="space">Adresse mail </label>
                    <input type="email" autocomplete="email" class="input" name="userMail"
                    id="userMail" required />
                </div>
                <div class="marge">
                    <label for="userPwd" class="space">Mot de passe </label>
                    <input type="password" class="input" name="userPwd" id="userPwd" required />
                </div>
                <div>
                    <input type="submit" id="button" class="marginBot" value="Se connecter" />
                </div>
            </form>
        </section>
    </main>
</body>

</html>
