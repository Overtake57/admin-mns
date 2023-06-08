<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté, rediriger vers une page protégée si c'est le cas
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: page_protegee.php');
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier les identifiants de connexion
    $username = 'admin'; // Remplacez par votre nom d'utilisateur
    $password = 'password'; // Remplacez par votre mot de passe
    $role = 'admin'; // Remplacez par le rôle souhaité pour l'accès à la partie admin

    $submittedUsername = filter_input(INPUT_POST, 'userMail', FILTER_SANITIZE_EMAIL);
    $submittedPassword = filter_input(INPUT_POST, 'userPwd', FILTER_SANITIZE_STRING);

    if ($submittedUsername && $submittedPassword) {
        // Utiliser des requêtes préparées pour éviter les attaques par injection SQL
        // Remplacez les lignes de code suivantes par votre propre logique d'accès à la base de données

        // Exemple avec PDO :
        $dsn = 'mysql:host=localhost;dbname=nom_de_votre_base_de_donnees';
        $dbUsername = 'votre_nom_d_utilisateur';
        $dbPassword = 'votre_mot_de_passe';

        try {
            $pdo = new PDO($dsn, $dbUsername, $dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparez une requête pour récupérer l'utilisateur avec le nom d'utilisateur donné
            $stmt = $pdo->prepare('SELECT * FROM tblusers WHERE username = :username LIMIT 1');
            $stmt->bindParam(':username', $submittedUsername);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifiez si l'utilisateur existe et si le mot de passe correspond
            if ($user && password_verify($submittedPassword, $user['password'])) {
                // Vérifier le rôle de l'utilisateur
                if ($user['role'] === $role) {
                    // Enregistrer les informations de connexion dans la session
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    // Rediriger vers la partie admin
                    header('Location: page_admin.php');
                    exit;
                } else {
                    // L'utilisateur n'a pas le rôle requis pour accéder à la partie admin
                    $errorMessage = 'Vous n\'êtes pas autorisé à accéder à la partie admin.';
                }
            } else {
                // Authentification échouée, afficher un message d'erreur
                $errorMessage = 'Identifiant ou mot de passe incorrect.';
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de connexion à la base de données
            $errorMessage = 'Erreur de connexion à la base de données : ' . $e->getMessage();
        }
    } else {
        // Les données soumises sont invalides, afficher un message d'erreur
        $errorMessage = 'Veuillez fournir un nom d\'utilisateur et un mot de passe valides.';
    }
}
?>
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
    <div id="container">
        <div id="containerInt">
            <img id="logo" src="./assets/img/ad'mns.png" alt="Logo mns admin" />
            <form action="login.php" method="POST">
                <div class="marge">
                    <div>
                        <label for="userMail" class="space">Adresse mail </label>
                    </div>
                    <input type="email" class="input" name="userMail" id="userMail" required />
                </div>
                <div class="marge">
                    <div>
                        <label for="userPwd" class="space">Mot de passe </label>
                    </div>
                    <input type="password" class="input" name="userPwd" id="userPwd" required />
                </div>
                <div class="">
                    <span>
                        <input type="submit" id="button" class="marginBot" value="Se connecter" />
                    </span>
                </div>
            </form>
        </div>
        <a href="" id="mdpoublié">Mot de passe oublié ?</a>
    </div>
</body>

</html>
