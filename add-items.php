<?php

require_once "config.php";
require_once "session.php";

$success = '';
$error = '';

// Check if user is logged in
if (!isset($_SESSION["userid"])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Get the user ID of the logged-in user
$userId = $_SESSION["userid"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $itemName = trim($_POST['name']);
    $weight = trim($_POST['weight']);
    $quantity = trim($_POST['qty']);

    // Validate inputs
    if (empty($itemName) || empty($weight) || empty($quantity)) {
        $error .= '<p class="error">Please fill in all fields.</p>';
    } else {
        // Prepare and execute the INSERT statement
        $insertQuery = $db->prepare("INSERT INTO list (name, weight, qty, user_id) VALUES (?, ?, ?, ?)");
        $insertQuery->bind_param("sdis", $itemName, $weight, $quantity, $userId);
        if ($insertQuery->execute()) {
            $success .= '<p class="success">Your item was added successfully!</p>';
        } else {
            $error .= '<p class="error">Something went wrong!</p>';
        }
    }
}

// Close the database connection
mysqli_close($db);

?>

<!DOCTYPE html>
<html lang="en">
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
        background-image: url('images/bg.png');
        background-repeat: repeat;
        background-size: contain;
        background-blend-mode: soft-light;
    }

    .error-msg{
        color: brown;
    }

    .success-msg{
        color: green;
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
        font-family: "Barlow Condensed";
    }

    .form-group label{
        font-size: 22px;
    }

    .form-control{
        height: 20px;
        width:  60%;
        font-size: 18px;
        justify-content: end;
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

    .add-container {
    background-color: white;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 0 20px #000000;
    width: 500px;
    text-align: center;
    }

    .add-btn {
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
    .add-container {
        width: 300px;
    }
    }

    /* Media query for screens with a maximum width of 480px */
    @media only screen and (max-width: 480px) {
        .add-container {
        width: 225px;
    }
    }

</style>

<head>
<meta charset="UTF-8">
<title>Add Items</title>
</head>
<body>
<div class="add-container">
<div class="row">
<div class="col-md-12">
<h2>Add Item</h2>
<p>Please fill this form to add an item to the list.</p>
<br>

<div class="success-msg">
<?php echo $success; ?>
</div>
<div class="error-msg">
<?php echo $error; ?>
</div>

<div class="form">
<form action="" method="post">
<div class="form-group">
<label>Item Name:</label>
<input type="text" name="name" class="form-control" required>
</div>
<div class="form-group">
<label>One unit Weight(kgs):</label>
<input type="weight" name="weight" class="form-control" required>
</div>
<div class="form-group" style="margin-bottom: 40px;">
<label>Quantity: </label>
<input type="qty" name="qty" class="form-control" required>
</div>
<div class="form-group" style="justify-content: center;">
<input type="submit" name="submit" class="add-btn" value="Add">
</div>
<div class="profile-section">
<p style="margin-top: 0">Want to see your list? <a href="profile.php" style="text-decoration: none; color: blue;">Go to Profile Page</a></p>
</div>
</form>
</div>
</div>
</div>
</div>
</body>
</html>
