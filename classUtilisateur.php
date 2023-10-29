<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('Authentification.php');
// require('baseDedonner2.php');
class Utilisateur {
                private $nom;
                private $prenom;
                private $email;
                private $motDepasse;
                private $telephone;
                public $date_inscription;
            // constructeur
                public function __construct($nom,$prenom,$email,$motDepasse,$telephone,$date_inscription)
                {
                    $this->setNom($nom);
                    $this->setPrenom($prenom);
                    $this->email=$email;
                    $this->motDepasse= $motDepasse;
                    $this->setTelephone($telephone);
                    $this->date_inscription=$date_inscription;
                }
                // les mthode getter
            public function getNom(){
            return $this->nom;
            }
            public function getPrenom(){
                return $this->prenom;
            }
            public function getEmail(){
                return $this->email;
            }
            public function getMotdepasse(){
                return $this->motDepasse;
            }
            public function getTelephone(){
                return $this->telephone;
            }
            public function getDate(){
                return $this->date_inscription;
            }
            // les methode  setter pour efectuer les validation
            public function setNom($nom)
            {
                if (preg_match('/^[A-Za-z\s]+$/', $nom)) {
                    return $this->nom = $nom;
                }else {
                    echo ('Le nom d\'utilisateur doit contenir uniquement des lettres et des espaces.');
                }
            }
            public function setPrenom($prenom)
            {
                if (preg_match('/^[A-Za-z\s]+$/', $prenom)) {
                    return $this->prenom = $prenom;
                }else {
                    echo ('Le nom d\'utilisateur doit contenir uniquement des lettres et des espaces.');
                }
            }
            public function setEmail($email)
            {
                return  $this->email = $email;
            }
            public function setMotDepasse($motDepasse)
            {
                 if (is_string($this->motDepasse) && preg_match("/^(?=.*[A-Z])(?=.*[0-9!@#$%^&*]).{8,30}$/", $motDepasse)) {
                     $this->motDepasse = $motDepasse;
                }else {
                    echo ('Commencer par une lettre majuscule,metre des chiffres,caractères spéciaux <br> ne dépasser pas 30 caractére.');
                }
            }
            public function setTelephone($telephone)
            {
                if (preg_match('/^\d{9}$/', $telephone)) {
                    return $this->telephone = $telephone;
                } else {
                    echo ('Le numéro de téléphone doit contenir exactement 9 chiffres.');
                } 
            }
            // method pour faire la validation des chanps
            public function valider() {
                return !empty($this->nom) && !empty($this->prenom) && !empty($this->email)  && !empty($this->motDepasse) && !empty($this->telephone);
            }
            // method pour la validation de l'email
            public function validerEmail($email)
            {
                return filter_var($email, FILTER_VALIDATE_EMAIL);
            }
}
$auth = new Auth();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <title>Utilisateur-Incrit</title>
</head>
<body>
<header>
    <nav>
    <div class="navbar">
    <a href="version2.php">Accueil</a>
    <a href="#">À propos</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
</div>
    </nav>
    </header>
   <h3>Felicitation vous faite désormer partis de la communauter! </h3>
<div class="infos-utilisateur">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['inscrire'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $motDepasse = $_POST['motDepasse'];
        $telephone = $_POST['numero'];
        $date_inscription = date('Y-m-d');
        
        $utilisateur1 = new Utilisateur($nom, $prenom, $email, $motDepasse, $telephone, $date_inscription);
        
        if (!$utilisateur1->valider()) {
            echo "veuillez saisir tout les champs";
        } elseif (!$utilisateur1->validerEmail($email)) {
            echo "veuillez saisir un email valide!";
        } else {
            echo "<div class='echo'>Inscription réussie!</div> ";
            echo "<div class='infos'> Nom:$nom</div>" ;
            echo "<div class='infos'>Prenom:$prenom</div>" ;
            echo "<div class='infos'>Email:$email</div>" ;
            echo "<div class='infos'>Mot de passe:$motDepasse</div>" ;
            echo "<div class='infos'>Telephone:$telephone</div>" ;
            $auth->registerUser($nom, $prenom, $email, $motDepasse, $telephone, $date_inscription);
        }
    }
    ?>
</div>
<div class="para">
   <p class="para">Veuilez cliquer sur acceuil pour vous rediriger <br> vers la page de connection et commencer dés maintenant vos course ! </p>
   </div>

<!-- Reste de votre code HTML ici -->

</body>
</html>