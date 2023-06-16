<?php include 'conn.php';?>

<?php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: connexion.php");
    exit;
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $login = $_SESSION['login'];
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $hashedPassword = $user['password'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if (!password_verify($oldPassword, $hashedPassword)) {
            echo "<script>alert('Old Password is incorrect');</script>";
            exit;
        }

        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];

        $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("UPDATE utilisateurs SET prenom = :prenom, nom = :nom, password = :password WHERE login = :login");
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':password', $hashedNewPassword);
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;

        echo "<script>alert('Profil Info updated with success!');</script>";
    }
} catch(PDOException $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
}

$conn = null;
?>

<!-- ----------------------------------------------------------------- -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonMoon</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="topnav">
        <div class="logo">
            <a href="index.php">
            <img src="img\LogoW.png" alt="Logo" height="150px"></a>
        </div>
            <a href="connexion.php" class="btnLogin_popup">Login</a>
        <div class="social_arc">
            <a href="#"><i class="fab fa-steam"></i></a>
            <a href="https://github.com/alix-platier-favier"><i class="fab fa-github"></i></a>
            <a href="https://www.linkedin.com/in/alix-platier-favier/"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="https://alix-platier-favier.students-laplateforme.io/"><i class="fas fa-regular fa-globe"></i></a>
        </div>
    </div>
    <div class="container">
        <p class="letter letter-M">M</p>
        <div class="moon">
            <div class="orbit">
                <p>O</p>
            </div>
        </div>
        <p class="letter letter-N">N</p>
    </div>
    <div class="stars"></div>
    <div class="twinkling"></div>
    <div class="wrapper_profil">
    <span class="icon_close">
        <a href="logout.php"><i class="fas fa-times"></i></a>
    </span>
    <div class="form_box profil">
            <h2>My Profil</h2>
                <form action="" method="POST">
                    <div class="input_box">
                        <span class="icon"><i class="fas fa-user"></i></span>
                        <input type="text" name="login" value="<?php echo $_SESSION['login']; ?>">
                        <label class="active">Username</label>
                    </div>
                    <div class="input_box">
                        <span class="icon"><i class="fas fa-pen"></i></span>
                        <input type="text" name="prenom" value="<?php echo $_SESSION['prenom']; ?>">
                        <label class="active">Name</label>
                    </div>
                    <div class="input_box">
                        <span class="icon"><i class="fas fa-pen"></i></span>
                        <input type="text" name="nom" value="<?php echo $_SESSION['nom']; ?>">
                        <label class="active">Last Name</label>
                    </div>
                    <div class="input_box">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="old_password" required>
                        <label class="active">Old Password</label>
                    </div>
                    <div class="input_box">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password">
                        <label class="active">New Password</label>
                    </div>
                    <div class="input_box">
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="confirm_password">
                        <label class="active">Confirm New Password</label>
                    </div>
                    <button type="submit" class="btn">Update Info</button>
                </form>
            </div>
        </div>       
    </div>
</div>
</body>
<script src="script.js"></script>
</html>
