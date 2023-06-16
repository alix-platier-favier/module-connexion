<?php include 'conn.php';?>
<?php
   try {
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'];
        $password = $_POST['password'];

        
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['password'];

            
            if (password_verify($password, $hashed_password)) {
    
                $_SESSION['loggedin'] = true;
                $_SESSION['login'] = $row['login'];
                $_SESSION['prenom'] = $row['prenom'];
                $_SESSION['nom'] = $row['nom'];

                if ($_SESSION['login'] === 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: profil.php");
                }
                exit;
            } else {
                echo "<script>alert('Incorrect password');</script>";
            }
        } else {
            echo "<script>alert('Incorrect login');</script>";

        }
    }
} catch(PDOException $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
}

$conn = null;
?>

<!-- ----------------------------------------------------------------------- -->

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
    <div class="wrapper_login">
        <span class="icon_close">
            <a href="logout.php"><i class="fas fa-times"></i></a>
        </span>        
        <div class="form_box login">
            <h2>Login</h2>
            <form action="" method="POST">
                <div class="input_box">
                    <span class="icon"><i class="fas fa-user"></i></span>
                    <input type="text" name="login" required>
                    <label>Username</label>
                </div>
                <div class="input_box">
                    <span class="icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember_forgot">
                    <label><input type="checkbox">
                    Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login_register">
                    <p>Don't have an account? <a href ="inscription.php" class="register_link">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="script.js"></script>
</html>