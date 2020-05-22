<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        //Starting session.
        session_start();


        if($_SESSION['auth'] != true){
            header("Location: index.php");
        }

        function getData($usrID){
            //Creating variables to store connection data.
            $dbuser = "root";
            $dbaddress = "localhost";
            $dbpass = "renan000";
            $dbname = "guarana_socialnetwork";
            $conn = new mysqli($dbaddress, $dbuser, $dbpass, $dbname);

            //Checking if user is in database.
            $query = "SELECT firstName,secondName FROM users WHERE userID = '$usrID'";
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
                    <form method="POST" id="signup-form" class="signup-form">
                        <div class="profile">
                            <h2 class="form-title" style="color: purple">Guarana - Profile</h2>
                            <h1><?php echo strtoupper(getData($_SESSION['userID'])[0] . " " . getData($_SESSION['userID'])[1])  ?></h1>
                            <img src="images/naruto_avatar.jpeg" width="200px" height="200px" alt="profile pic">
                            <p style="color: orange">PLEASE INSERT A 200x200 IMAGE!</p>
                            <input class="input101" type="file" name="image">
                            <input class="input101" type="text" name="bio" placeholder="Enter Your Bio (Max 180 characters)" maxlength = "180"/>
                            <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit-purple" value="Submit"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>