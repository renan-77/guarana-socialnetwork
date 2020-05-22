<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        //Starting session.
        session_start();

        //Creating variables to store connection data.
        $dbuser = "root";
        $dbaddress = "localhost";
        $dbpass = "renan000";
        $dbname = "guarana_socialnetwork";
        $conn = new mysqli($dbaddress, $dbuser, $dbpass, $dbname);

        //Creating session boolean to verify login in pages that it is needed to be logged in and a userID to see which user is logged in.
        $_SESSION['auth'] = false;
        $_SESSION['userID'] = 0;

        //Get data to collect userID for session variable
        function getData($mail){
            $dbuser = "root";
            $dbaddress = "localhost";
            $dbpass = "renan000";
            $dbname = "guarana_socialnetwork";
            $conn = new mysqli($dbaddress, $dbuser, $dbpass, $dbname);

            $query = "SELECT userID FROM users WHERE email = '$mail'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            while($row = mysqli_fetch_array($result)) {
                return $row;
            }
        }
        
        //Checking if fields are set.
        if(isset($_POST['email']) and isset($_POST['password'])){
            $email = $_POST['email'];
            $password = hash('md5',$_POST['password']);

            //Checking if user is in database.
            $query = "SELECT * FROM users WHERE email = '$email' and pass = '$password'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            $count = mysqli_num_rows($result);

            //Activating auth variable if login is successful.
            if($count == 1){
                $_SESSION['auth'] = true;
                $_SESSION['userID'] = getData($email)[0];
                header("Location: my-profile.php");
                
            }else{
                echo '<p style="text-align: center; color: red; font-size: 2em">Sorry, credentials are wrong.<p>';
            }

        }

        //Doing action in case login is successful.
        if($_SESSION['auth'] == true){
            echo '<p style="text-align: center; color: blue; font-size: 2em">Login Successful, redirecting...<p>';
            
            // header('Location: main.php');
        }else{
            
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
<body>
    <div class="main">
        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title" style="color: purple">Guarana - Login</h2>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Login"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Don't you have an account ? <a href="register.php" class="loginhere-link">Sign up here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>