<?php
session_start();

$email = $password = "";
$emailErr = $passwordErr = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    
    if (!$emailErr || !$passwordErr) {
        
        if (isset($_SESSION["auth"])) {
            if (in_array($email, $_SESSION["auth"]) && password_verify($password, $_SESSION["auth"]["password"])) {
                echo "Yay! you're good to go";
            }else {
                $emailErr = "Your details are incorrect";
            }
        }else {
            echo "Who are you?";
        }
       
    }

}
?>

<!DOCTYPE html>
<html>

<head></head>

<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        Email
        <input type="email" name="email" id="email">
        <span style="color: red;">*<?php echo $emailErr ?></span><br /><br />
        Password
        <input type="password" name="password" id="password">
        <span style="color: red;">*<?php echo $passwordErr ?></span><br /><br />
        <input type="submit" name="Submit" value="Login">

    </form>
</body>

</html>