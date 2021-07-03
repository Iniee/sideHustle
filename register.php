<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <?php

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $fname = $lname = $email = $password = $gender = "";
        $fnameErr = $lnameErr = $emailErr = $passwordErr = "";

       
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["fname"])){
                $fnameErr = "First Name is required";
            }else{
                $fname = test_input($_POST["fname"]);
            }
            if(empty($_POST["lname"])){
                $lnameErr = "Last Name is required";
            } else{
                $lname = test_input($_POST["lname"]);
            }
            if(empty($_POST["email"])){
                $emailErr = "Email is required";
            }else{
                $email = test_input($_POST["email"]);
            }if(empty($_POST["password"])){
                $passwordErr = "Password is required";
            }else{
                $password = test_input($_POST["password"]);
            }if(empty($_POST["gender"])){
                $gender = test_input($_POST["gender"]);
            }

           
            if (!$fnameErr || !$lnameErr || !$emailErr || !$passwordErr) {
                $_SESSION["auth"] = [];
    
                $user = [
                    "fname" => $fname,
                    "lname" => $lname,
                    "email" => $email,
                    'gender' => $gender, 
                    "password" => password_hash($password, PASSWORD_DEFAULT)
                ];
                
                $_SESSION["auth"] = $user;
            }
        } ?>
    
       <?php 
        if (isset($_SESSION["auth"])) { ?>
            <script>
                alert("You have registered successfully. You may now login");
            </script>
       <?php }
       ?>
        <h2>Register</h2>
        <span style="color: red;">* required field</span>
        <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>">
            First Name<br/>
            <input type="text" name="fname" id="fname">
            <span style="color: red;">*<?php echo $fnameErr?></span><br/><br/>
            Last Name<br/>
            <input type="text" name="lname" id="lname">
            <span style="color: red;">*<?php echo $lnameErr?></span><br/><br/>
            Email<br/>
            <input type="email" name="email" id="email">
            <span style="color: red;">*<?php echo $emailErr?></span><br/><br/>
            Gender<br/>
            <input type="radio" name="gender" value="male">Male
            <input type="radio" name="gender" value="female">Female<br/><br/>
            Password<br/>
            <input type="password" name="password" id="password">
            <span style="color: red;">*<?php echo $passwordErr?></span><br/><br/>
            <input type="submit" name="Submit" value="Register">
           </form>
        <a href="Login.php">Sign In</a>
    </body>
</html>