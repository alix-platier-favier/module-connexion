<?php include 'conn.php';?>

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
    <div class="wrapper_admin">
        <span class="icon_close">
            <a href="logout.php"><i class="fas fa-times"></i></a>
        </span>        
        <div class="form_box admin">
            <h2>admin</h2>
            <?php
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->query("SELECT * FROM utilisateurs");
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
            }

            $conn = null;
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Login</th>
                        <th>name</th>
                        <th>Last Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['login']; ?></td>
                            <td><?php echo $user['prenom']; ?></td>
                            <td><?php echo $user['nom']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="profil.php" class="btn">Modify Admin Profil</a>
        </div>
    </div>
</body>
<script src="script.js"></script>
</html>
