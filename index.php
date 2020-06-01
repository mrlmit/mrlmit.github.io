<?php
    session_start();
    include('mysqlcon.php');
?>

<html> 
    <head>
        <title> MIT Login !</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    </head>

    <body> 
        <form class="login-form" action="" method="post">
            <div class="login-form__logo-container">
                <img class="login-form__logo" src="assets/img/MIT.png" alt="logo">
            </div>

            <div class="login-form__content"> 
                <div class="login-form__header"> LOG IN </div>
            </div>

            <div class="login-form__content">
                <input class="login-form__input" type="text" name="s_id" placeholder="Your ID" required>
                <input class="login-form__input" type="text" name="password" placeholder="Password" required>

                
                <input type="submit" name="logbtn" class="login-form__button" value="Log in">

                <div class="login-form__links"> 
                    Not Registered?? <a href="registration.php" class="login__link">Register</a>

                </div>
            </div>
            
            
        </form>
    </body>
</html>


<?php

    if(isset($_POST['logbtn']))
        {
            $s_id = $_POST['s_id'];
            $password = $_POST['password'];

            //check username and password from database 

            $query = "SELECT * FROM register WHERE s_id='$s_id' && password='$password' ";

            //run query 
            $run= mysqli_query($connection,$query);

            // matching or unmatching with database stored data 
            

            $usertypes = mysqli_fetch_array($run);


    if($usertypes['utype']=="admin")
                {
                    $_SESSION['s_id'] = $s_id;
                    header("location: admin/admin.html");
                }
    else if($usertypes['utype']=='user')
                {
                    $_SESSION['s_id'] = $s_id;
                    header("location: user.php");
                }    
            else
                {
                    $_SESSION['status'] = "Your ID  / Password is Invalid";
                    header("location: login.php");
                }

            
        }

?>
