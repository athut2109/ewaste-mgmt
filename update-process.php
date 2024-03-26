<?php
include_once 'config.php';

$id = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';

        mysqli_query($db, "UPDATE users SET name='$name', phone='$phone', address='$address', email='$email' WHERE id='$id'");
        $message = "Record Modified Successfully";
    } else {
        $message = "Error: ID not received via POST";
    }
}

$result = mysqli_query($db, "SELECT * FROM users WHERE id='$id'");
$row = mysqli_fetch_array($result);

// Assign retrieved values to variables
$name = $row['name'];
$phone = $row['phone'];
$address = $row['address'];
$email = $row['email'];
?>

<html>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|Barlow Condensed|Cinzel">
<style>
    body {
    font-family: "Montserrat";
    margin: 0;
    padding: 0;
    background-color: #2ea27b;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    }

    .error-msg{
        color: brown;
    }

    .success-msg{
        color: green;
    }

    .form label{
        font-size: 20px;
        margin-right:15px;
        text-align: start;
        justify-content: start;
        font-size: 22px;
        font-family: "Barlow Condensed";
    }

    .form{
        margin: 25px auto;
        font-size: 18px;
        font-family: "Barlow Condensed";
    }

    .txtField{
        height: 20px;
        width:  60%;
        font-size: 18px;
        justify-content: start;
        margin-right:  0px;
        font-family: "Montserrat";
    }

    h2{
        font-size: 48px;
        margin-top: 0px;
        font-family: "Cinzel";
    }

    .col-md-12 p{
        font-size: 18px;
        margin-top: -30px;
    }

    .update-container {
    background-color: white;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 0 20px #000000;
    width: 500px;
    text-align: center;
    }

    .button {
    background-color: #00710b;
    color: white;
    padding: 14px 36px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin: 5px;
    font-size: 18px;
    font-family: "Montserrat";
    }

    .profile-section {
    margin-top: 20px;
    }

    .profile-section a {
    text-decoration: none;
    }

    /* Media query for screens with a maximum width of 768px */
    @media only screen and (max-width: 768px) {
    .update-container {
        width: 300px;
    }
    }

    /* Media query for screens with a maximum width of 480px */
    @media only screen and (max-width: 480px) {
        .update-container {
        width: 225px;
    }
    }

</style>
<head>
    <title>Update Employee Data</title>
</head>
<body>
<div class="update-container">
<div class="row">
<div class="col-md-12">
<h2>Update Profile</h2>
<p>Please fill this form to update your profile.</p>
<div class="form">
<form name="frmUser" method="post" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <br>
        <label>First Name: </label><br>
        <input type="text" name="name" class="txtField" value="<?php echo $name; ?>">
        <br>
        <label>Phone: </label><br>
        <input type="text" name="phone" class="txtField" value="<?php echo $phone; ?>">
        <br>
        <label>Address: </label><br>
        <input type="text" name="address" class="txtField" value="<?php echo $address; ?>">
        <br>
        <label>Email: </label><br>
        <input type="text" name="email" class="txtField" value="<?php echo $email; ?>">
        <br><br>
        <input type="submit" name="submit" value="Submit" class="button">
    </form>
</div>
<br><br>
<p><a href="profile.php" style="text-align: center; text-decoration: none; color: blue;">See Profile</a></p>
</div>
</div>
</div>
</body>
</html>