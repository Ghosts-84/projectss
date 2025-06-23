<?php
$host = 'localhost';
$dbname = 'portail_etudiant';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            echo "Bienvenue " . htmlspecialchars($user['prenom']) . " " . htmlspecialchars($user['nom']) . " !";
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
<form method="post">
  Email : <input type="email" name="email" required><br>
  Mot de passe : <input type="password" name="password" required><br>
  <input type="submit" value="Se connecter">
</form>