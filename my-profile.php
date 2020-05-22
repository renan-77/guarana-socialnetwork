<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        session_start();
        function getData($usrID){
            //Creating variables to store connection data.
            $dbuser = "root";
            $dbaddress = "localhost";
            $dbpass = "renan000";
            $dbname = "guarana_socialnetwork";
            $conn = new mysqli($dbaddress, $dbuser, $dbpass, $dbname);

            //Checking if user is in database.
            $query = "SELECT users.firstName, users.secondName, profilePage.bio, profilePage.picture FROM users LEFT JOIN profilePage ON users.userID = profilePage.userID WHERE users.userID = '$usrID';";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            while($row = mysqli_fetch_array($result)) {
                return $row;
            }
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GUARANA</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth">

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                        <div class="profile">
                            <h2 class="form-title" style="color: purple">Guarana - Profile</h2>
                            <?php echo '<img width="200px" height="200px" alt="profile pic" src="data:image/jpeg;base64,'.base64_encode( getData($_SESSION['userID'])[3] ).'"/>'; ?>
                            <!-- <img src="images/naruto_avatar.jpeg" width="200px" height="200px" alt="profile pic"> -->
                            <h1><?php echo strtoupper(getData($_SESSION['userID'])[0] . " " . getData($_SESSION['userID'])[1])  ?></h1>
                            <p style="text-align: justify"><?php echo strtoupper(getData($_SESSION['userID'])[2]) ?></p>
                        </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>