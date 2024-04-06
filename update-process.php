<?php

include_once 'config.php';

$id = '';
$message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Ensure that the ID is received via POST
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';

        // Check if a file was uploaded
        if (isset($_FILES['photo']) && $_FILES['photo']['name']) {
            $targetDir = "images/";
            $fileName = basename($_FILES['photo']['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                // Upload file to the server
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
                    // Update database with new photo path
                    mysqli_query($db, "UPDATE users SET name='$name', phone='$phone', address='$address', email='$email', photo='$targetFilePath' WHERE id='$id'");
                    $message = "Record Modified Successfully";
                } else {
                    $message = "Error uploading photo";
                }
            } else {
                $message = "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
            }
        } else {
            // No photo uploaded, update database without changing photo
            mysqli_query($db, "UPDATE users SET name='$name', phone='$phone', address='$address', email='$email' WHERE id='$id'");
            $message = "Record Modified Successfully";
        }

        // Update database with user data
        $updateQuery = $db->prepare("UPDATE users SET name=?, phone=?, address=?, email=? WHERE id=?");
        $updateQuery->bind_param("ssssi", $name, $phone, $address, $email, $id);
        if ($updateQuery->execute()) {
            $message = "Record Modified Successfully";
        } else {
            $message = "Error updating record: " . $db->error;
        }
    } else {
        $message = "Error: ID not received via POST";
    }
} else {
    // If the form is not submitted, retrieve user data
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = mysqli_query($db, "SELECT * FROM users WHERE id='$id'");
        $row = mysqli_fetch_array($result);

        // Assign retrieved values to variables
        $name = $row['name'];
        $phone = $row['phone'];
        $address = $row['address'];
        $email = $row['email'];
    } else {
        $message = "Error: ID not provided";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update User Data</title>
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

    .form label{
        font-size: 20px;
        text-align: center;
        justify-content: center;
        font-size: 22px;
        font-family: "Barlow Condensed";
    }

    .form{
        margin: 25px auto;
        font-size: 18px;
        text-align: center;
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
        margin-top: 25px;
        text-align: center;
        font-family: "Cinzel";
    }

    .col-md-12 p{
        text-align: center;
        font-size: 18px;
        margin-top: -30px;
    }

    .update-container {
        background-color: white;
        padding: 20px 40px;
        border-radius: 16px;
        box-shadow: 0 0 20px #000000;
        width: 500px;
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

    .file-field {
        margin-bottom: 20px;
        position: relative;
    }

    .file-input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-label {
        background-color: #93C572;
        color: black;
        padding: 5px 30px;
        margin-top: 10px;
        border-width:  2px;
        border: #355E3B;
        cursor: pointer;
        display: inline-block;
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

</head>
<body>
<div class="update-container">
<p><a href="profile.php" style="font-size: 20px; text-decoration: none; color: blue;">&larr; See Profile</a></p>
    <div class="row">
        <div class="col-md-12">
            <h2>Update Profile</h2>
            <p>Please fill this form to update your profile.</p>
            <div class="form">
                <form name="frmUser" method="post" action="" enctype="multipart/form-data">
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
                    <label>Select Photo: </label>
                    <div class="file-field">
                        <!-- Style the label for the file input -->
                        <label class="file-label">Choose File
                            <!-- Input for selecting a file -->
                            <input type="file" name="photo" class="file-input" accept="image/*">
                        </label>
                    </div>
                    <br>
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
            </div>
            <br>
        </div>
    </div>
</div>
</body>
</html>