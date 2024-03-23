<?php

require_once "config.php";
require_once "session.php";

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

$fullname = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST["confirm_password"]);
$password_hash = password_hash($password, PASSWORD_BCRYPT);

if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
$error = '';

// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use 's'
$query->bind_param('s', $email);
$query->execute();

// Store the result so we can check if the account exists in the database.
$query->store_result();
if ($query->num_rows > 0) {
$error .= '<p class="error">The email address is already registered!</p>';
} else {
// Validate password
if (strlen($password ) < 8) {
$error .= '<p class="error">Password must have atleast 8 characters.</p>';
}

// Validate confirm password
if (empty($confirm_password)) {
$error .= '<p class="error">Please enter confirm password.</p>';
} else {
if (empty($error) && ($password != $confirm_password)) {
$error .= '<p class="error">Password did not match .</p>';
}
}
if (empty($error) ) {
$insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?);");
$insertQuery->bind_param("sss", $fullname, $email, $password_hash);
$result = $insertQuery->execute();
if ($result) {
$success .= '<p class="success">Your registration was successful!</p>';
} else {
    $error .= '<p class="error">Something went wrong!</p>';
}
}
}
}
$query->close();
$insertQuery->close();

// Close DB connection
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
        margin-right:  0px;
    }

    h2{
        font-size: 48px;
        margin-top: 0px;
    }

    .col-md-12 p{
        font-size: 18px;
        margin-top: -30px;
    }

    .register-container {
    background-color: #2ea27b;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 0 20px #000000;
    width: 500px;
    text-align: center;
    }

    .signup-btn {
    background-color: #00710b;
    color: white;
    padding: 14px 36px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin: 5px;
    font-size: 18px;
    }

    .login-section {
    margin-top: 20px;
    }

    .login-section a {
    text-decoration: none;
    }

    /* Media query for screens with a maximum width of 768px */
    @media only screen and (max-width: 768px) {
    .register-container {
        width: 300px;
    }
    }

    /* Media query for screens with a maximum width of 480px */
    @media only screen and (max-width: 480px) {
        .register-container {
        width: 225px;
    }
    }

</style>

<head>
<meta charset="UTF-8">
<title>Sign Up</title>
</head>
<body>
<div class="register-container">
<div class="row">
<div class="col-md-12">
<h2>Register</h2>
<p>Please fill this form to create an account.</p>

<?php echo $success; ?>
<?php echo $error; ?>

<div class="form">
<form action="" method="post">
<div class="form-group">
<label>Full Name</label>
<input type="text" name="name" class="form-control" required>
</div>
<div class="form-group">
<label>Email Address</label>
<input type="email" name="email" class="form-control" required>
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>
<div class="form-group" style="margin-bottom: 40px;">
<label>Confirm Password</label>
<input type="password" name="confirm_password" class="form-control" required>
</div>
<div class="form-group" style="justify-content: center;">
<input type="submit" name="submit" class="signup-btn" value="Submit">
</div>
<div class="login-section">
<p style="margin-top: 0">Already have an account? <a href="login.php">Login here</a></p>
</div>
</form>
</div>
</div>
</div>
</div>
</body>
</html>