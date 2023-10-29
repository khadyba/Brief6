<?php
require_once 'baseDedonner2.php';
// Classe pour gérer l'authentification et l'inscription
class Auth  extends Databases{
    // private $db;

    public function __construct() {
        parent::__construct();
        // $this->db = new Database();
    }

    // Méthode pour enregistrer un nouvel utilisateur
    public function registerUser($nom, $prenom, $email, $motDePasse, $telephone,$date_inscription) {
        // $conn = $this->db->getConnection();
        //  var_dump($conn);

        $sql = "INSERT INTO utilisateur (nom, prenom, email, motDepasse, telephone,date_inscription) VALUES (:nom, :prenom, :email, :motDePasse, :telephone,:date_inscription)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':motDePasse', $motDePasse);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':date_inscription', $date_inscription);

            if ($stmt->execute()) {
                // echo "on est bon";
            }else{
                echo "c'est la cata";
            }
        
    }
public function AficherUtilisateur(){
    $sql= "SELECT * FROM utilisateur";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetchAll();
    return $user;
}
    // Méthode pour authentifier un utilisateur
    public function authenticateUser($email, $motDePasse) {
        // $conn = $this->db->getConnection();

        $sql = "SELECT email, motDepasse FROM utilisateur WHERE email = :email AND motDepasse=:motDepasse";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':motDepasse', $motDePasse);
        $stmt->execute();
        $user = $stmt->fetch();
        return $user;
    }
}
if (isset($_POST['connecter'])) {
    $email = $_POST['email'];
    $motDePasse = $_POST['motDepasse'];
    $auth = new Auth(); // Instanciez la classe Auth
    if ($auth->authenticateUser($email, $motDePasse)) {
      

        header('location:utilisateurInscrit.php');
    } else {
        echo "Identifiants incorrects!";
    }
}

