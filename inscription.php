<?php
$host = 'localhost';
$dbname = 'portail_etudiant';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $date_naissance = $_POST["date_naissance"];

        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, email, password, date_naissance) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $password, $date_naissance]);

        echo "Inscription réussie ! <a href='connexion.php'>Se connecter</a>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
<form method="post">
  Nom : <input type="text" name="nom" required><br>
  Prénom : <input type="text" name="prenom" required><br>
  Email : <input type="email" name="email" required><br>
  Mot de passe : <input type="password" name="password" required><br>
  Date de naissance : <input type="date" name="date_naissance"><br>
  <input type="submit" value="S'inscrire">
</form>