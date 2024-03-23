<?php

require_once "config.php";
require_once "session.php";

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

$email = trim($_POST['email']);
$password = trim($_POST['password']);

// validate if email is empty
if (empty($email)) {
$error .= '<p class="error">Please enter email.</p>';
}

// validate if password is empty
if (empty($password)) {
$error .= '<p class="error">Please enter your password.</p>';
}

if (empty($error)) {
if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
$query->bind_param('s', $email);
$query->execute();

$result = $query->get_result();
$row = $result->fetch_assoc();
if ($row) {
if (password_verify($password, $row['password'])) {
$_SESSION["userid"] = $row['id'];
$_SESSION["user"] = $row;

// Redirect the user to home page
header("location: home.php");
exit;
} else {
$error .= '<p class="error">The password is not valid.</p>';
}
} else {
$error .= '<p class="error">No User exist with that email address.</p>';
}
}
$query->close();
}
// Close connection
mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="en">

<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: url('https://tcocertified.com/wp-content/uploads/2019/10/international-e-waste-day.jpg') center/cover no-repeat fixed;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    }

    .form-group label{
        font-size: 20px;
        margin-right:15px;
        text-align: start;
        justify-content: start;
    }

    .form-group{
        display: flex;
        align-items:  center;
        justify-content: space-between;
        margin: 25px auto;
        font-size: 18px;
        margin-left:15px;
    }

    .form-control{
        height: 20px;
        width:  60%;
        font-size: 18px;
        justify-content: end;
        margin-right:  20px;
    }

    h2{
        font-size: 48px;
        margin-top: 0px;
    }

    .col-md-12 p{
        font-size: 18px;
        margin-top: -30px;
    }

    .login-container {
    background-color: #2ea27b;
    padding: 40px 20px;
    border-radius: 16px;
    box-shadow: 0 0 20px #000000;
    width: 500px;
    text-align: center;
    }

    .login-btn{
    background-color: #00710b;
    color: white;
    padding: 14px 36px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin: 5px;
    font-size: 18px;
    }

    .signup-section {
    margin-top: 20px;
    }

    .signup-section a {
    text-decoration: none;
    }

    /* Media query for screens with a maximum width of 768px */
    @media only screen and (max-width: 768px) {
    .login-container {
        width: 300px;
    }
    }

    /* Media query for screens with a maximum width of 480px */
    @media only screen and (max-width: 480px) {
    .login-container {
        width: 225px;
    }
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
<div class="login-container">
<div class="row">
<div class="col-md-12">
<h2>Login</h2>
<p>Please fill in your email and password.</p>
<br>
<?php echo $error; ?>
<form action="" method="post">
<div class="form-group">
<label>Email Address</label>
<input type="email" name="email" class="form-control" required>
</div>
<div class="form-group" style="margin-bottom: 40px;">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>
<div class="form-group" style="justify-content: center;">
<input type="submit" name="submit" class="login-btn" value="Submit">
</div>
<div class="signup-section">
<p style="margin-top: 0">Don't have an account? <a href="register.php">Register here</a></p>
</div>
</form>
</div>
</div>
</div>
</body>
</html>