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
<head>
    <title>Update Employee Data</title>
</head>
<body>
    <form name="frmUser" method="post" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div><?php echo $message; ?></div>
        <br>
        First Name: <br>
        <input type="text" name="name" class="txtField" value="<?php echo $name; ?>">
        <br>
        Phone:<br>
        <input type="text" name="phone" class="txtField" value="<?php echo $phone; ?>">
        <br>
        Address:<br>
        <input type="text" name="address" class="txtField" value="<?php echo $address; ?>">
        <br>
        Email:<br>
        <input type="text" name="email" class="txtField" value="<?php echo $email; ?>">
        <br>
        <input type="submit" name="submit" value="Submit" class="button">
    </form>
    <p style="margin-top: 0"><a href="profile.php">See Profile</a></p>
</body>
</html>