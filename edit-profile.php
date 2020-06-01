<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        //Starting session.
        session_start();

        //getting logged in user id.
        $usr_id = $_SESSION['userID'];

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
            $query = "SELECT users.firstName, users.secondName, profilePage.bio, profilePage.picture FROM users LEFT JOIN profilePage ON users.userID = profilePage.userID WHERE users.userID = '$usrID';";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            //creating array with results from database.
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
    <?php 
    //Connection credentials
        $dbuser = "root";
        $dbaddress = "localhost";
        $dbpass = "renan000";
        $dbname = "guarana_socialnetwork";
        $conn = new mysqli($dbaddress, $dbuser, $dbpass, $dbname);

        $query = "SELECT * FROM profilePage WHERE userID = '$usr_id'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $count = mysqli_num_rows($result);
    ?>
    <div class="main">
        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form" enctype="multipart/form-data">
                        <div class="profile">
                        <h2 class="form-title" style="color: purple">Guarana - Profile</h2>
                        <h1><?php echo strtoupper(getData($usr_id)[0] . " " . getData($usr_id)[1])  ?></h1>
                            <?php 
                            //If user has a profile page already created, sets hasprofilepage to true and shows his page to be edited.
                                if($count == 1){
                                    $hasProfilePage = true;
                                    echo '<img width="200px" height="200px" alt="profile pic" src="data:image/jpeg;base64,'.base64_encode( getData($usr_id)[3] ).'"/>';
                                    echo '<input class="input101" type="file" name="image" id="image"/>';
                                    echo '<p style="color: orange">PLEASE INSERT A 200x200 IMAGE!</p>';
                                    echo '<textarea class="input101" type="text" name="bio" maxlength = "180" rows="3">'. strtoupper(getData($usr_id)[2]) .'</textarea>';
                                    echo '<div class="form-group">
                                        <input type="submit" name="submit" id="submit" class="form-submit-purple" value="Submit"/>
                                        </div>';
                                //If user doesn't have a profile page shows a sample profile page to him/her.
                                }else{
                                    $hasProfilePage = false;
                                    echo '<img src="images/naruto_avatar.jpeg" width="200px" height="200px" alt="profile pic">';
                                    echo '<input class="input101" type="file" name="image" id="image"/>';
                                    echo '<p style="color: orange">PLEASE INSERT A 200x200 IMAGE!</p>';
                                    echo '<input class="input101" type="text" name="bio" placeholder="Enter Your Bio (Max 180 characters)" maxlength = "180"/>';
                                    echo '<div class="form-group">
                                        <input type="submit" name="submit" id="submit" class="form-submit-purple" value="Submit"/>
                                        </div>';
                                }
                            ?>
                        </div>
                    </form>
                    <?php
                    //Printing the elements gotten from page.
                        // echo '<pre>';
                        // print_r($_POST);
                        // print_r($_FILES);
                        // echo '</pre>';
                        //Checking if form is submited.
                        if(isset($_POST['submit'])){
                            //If fields bio and image are not empty, do.
                            if(isset($_FILES['image']) && isset($_POST['bio'])){
                                //Creating variables using scape string and getData generated array.
                                $biography = mysqli_real_escape_string($conn, $_POST['bio']);
                                $image = file_get_contents($_FILES['image']['tmp_name']);
                                $profileID = getData($usr_id)[3];
                                $sql = "";

                                $picture = mysqli_real_escape_string($conn, $image);

                                // echo $picture . " " . $biography; 
                               
                                // echo 'both set';
                                //Updating profile page in case user has one already.
                                if($hasProfilePage){
                                    $sql = "UPDATE profilePage SET bio = '$biography', picture = '$picture' WHERE profileID = '$profileID'; ";
                                //Creating profile page in case user doesn't have one.
                                }else{
                                    $sql = "INSERT INTO profilePage(bio, picture) VALUES
                                    ('$biography', '$picture');";
                                }
                                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                            }else{
                                echo 'Please insert image';
                            }
                        }  
                ?>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>