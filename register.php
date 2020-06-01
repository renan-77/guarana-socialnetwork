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

        //Creating session boolean to verify login in pages that it is needed to be logged in.
        $_SESSION['auth'] = false;

        //Checking if fields are set.
        if(isset($_POST['email']) and isset($_POST['password']) and isset($_POST['firstName']) and isset($_POST['secondName'])){
            $firstName = $_POST['firstName'];
            $secondName = $_POST['secondName'];
            $email = $_POST['email'];
            $password = hash('md5',$_POST['password']);

            //Checking if email is already registered.
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            $count = mysqli_num_rows($result);
            
            //Checking for valid email.
            if($firstName != "" && $secondName != "" && $email != "" && $password != ""){
                if(strpos($email,'@') === false || strpos($email,'.') === false){
                    echo '<p style="text-align: center; color: red; font-size: 2em">Please insert a valid email</p>';
                }else{
                    //Checking if email is already registered in database.
                    if($count == 1){
                       echo  '<p style="text-align: center; color: red; font-size: 2em">Sorry, this email is already in use</p>';
                    //Creating new user based on his inputs in case email is not in use.
                    }else{
                        echo '<p style="text-align: center; color: blue; font-size: 2em">You have successfully registered.<p>';
                        $query = "INSERT INTO users(firstName, secondName, email, pass, isAdmin) VALUES
                        ('$firstName', '$secondName', '$email', '$password', 0);";

                        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    }
                }
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
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
            <!-- Form created to input new user values for sign up. -->
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title" style="color: purple">Guarana - Create account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="firstName" id="firstName" placeholder="First Name"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="secondName" id="secondName" placeholder="Last Name"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="index.php" class="loginhere-link">Login here</a>
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