<?php

require_once "config.php";
require_once "session.php";

$query = $db->prepare("SELECT * FROM users");
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();

$queryItems = $db->prepare("SELECT * FROM list");
$queryItems->execute();
$resultItems = $queryItems->get_result();
$items = [];
while ($rowItem = $resultItems->fetch_assoc()) {
    $items[] = $rowItem;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile Page</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|Barlow Condensed|Cinzel">
<style>
    body {
        font-family: "Montserrat";
        background-color: #2ea27b;
        margin: 0;
        padding: 0;
        align-items: center;
        justify-content: center;
        background-image: url('images/bg.png');
        background-repeat: repeat;
        background-size: contain;
        background-blend-mode: soft-light;
    }

    .home-section p a{
        color: blue;
        font-size: 17px;
        text-decoration: none;
    }

    .profile-container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-info{
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .min-max{
        display: flex;
        justify-content: space-between;
        margin-top: -25px;
        font-family: Arial, sans-serif;
        font-weight: bold;
    }

    .profile-photo {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 2px solid #ccc;
        overflow: hidden;
        position: relative;
        margin-bottom: 20px;
    }

    .profile-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-details {
        display: flex;
        align-items: center;
    }

    .profile-details .info {
        margin-left: 20px;
        font-size: 18px;
    }

    .profile-btns {
        display: flex;
        align-items: center;
        gap: 75px;
        justify-content: space-between;
    }

    .item {
        margin-bottom: 10px;
        color: ;
        padding: 10px;
        background-color: #BEE6D1;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .item .quantity-btn {
        cursor: pointer;
    }

    h2{
        font-family: "Cinzel";
        text-align: center;
        font-size: 36px;
    }

    .info strong{
        font-family: "Barlow Condensed";
        font-size: 24px;
        font-weight: "bold";
    }

    .btns{
        display: flex;
        justify-content: space-around;
    }

    .request-btn, .add-btn {
        padding: 14px 30px;
        background-color: green;
        border: none;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        font-family: "Montserrat";  
    }

    .edit-btn{
        padding: 10px 20px;
        background-color: green;
        border: none;
        border-radius: 4px;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        font-family: "Montserrat";
    }

    .delete-btn, .logout-btn{
        padding: 10px 20px;
        background-color: red;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 16px;
        font-family: "Montserrat";
    }

    .delete-btn:hover,  .logout-btn:hover{
        background-color: #cc4c37;
    }

    /* Adjust margin or padding as needed */
    .delete-btn, .logout-btn {
        margin-right: 8px;
    }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<section class="profile-container">
    <div class="home-section" style="margin-bottom: -15px;">
        <p><a href="home.php">&larr; Back to Home</a></p>
    </div>
    <h2>Profile Info</h2><br/>
<div class="profile-info">
    <div class="profile-photo">
        <img id="profileImage" src="<?php echo $row['photo']; ?>">
    </div>
    <div class="profile-details">
        <div class="info">
            <p><strong>Name:</strong>
            <?php
            echo $row['name'];
            ?>
            </p>
            <p><strong>Email:</strong>
            <?php
            echo $row['email'];
            ?>
            </p>
            <p><strong>Phone:</strong>
            <?php
            echo $row['phone'];
            ?>
            </p>
            <p><strong>Address:</strong>
            <?php
            echo $row['address'];
            ?>
            </p>
            <div class="profile-btns">
                <div>
            <form method="post" action="update-process.php?id=<?php echo $row["id"];?>">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button class="edit-btn" type="submit" name="submit">Edit</button>
                </div>
                </form>
                <div><button class="logout-btn" onclick="location.href='login.php'">Log Out</button></div>
            </div>
        </div>
    </div>
</div>
<br><br>
<h2>Items List</h2>
<div class="item-list" id="itemList">
        <!-- PHP will populate the item list here -->
        <?php foreach ($items as $index => $item): ?>
            <div class="item" id="item_<?php echo $item['id']; ?>">
                <p><strong>Name:</strong> <?php echo $item['name']; ?></p>
                <p><strong>Weight:</strong> <?php echo $item['weight']; ?> kg</p>
                <p><strong>Quantity:</strong> <?php echo $item['qty']; ?> qty</p>
                <div>
                    <button class="delete-btn" onclick="deleteItem(<?php echo $item['id']; ?>)">Delete</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <div class="btns">
    <button class="request-btn" onclick="requestNow()">Request Now</button>
    <button class="add-btn" onclick="location.href='add-items.php'">Add Item</button>
    </div>
</section>

<script>
    // Function to handle deleting an item
    function deleteItem(itemId) {
        console.log("Deleting item:", itemId);
        $.ajax({
            type: "POST",
            url: "delete-item.php", // PHP script to handle deletion
            data: { itemId: itemId },
            success: function(response) {
                console.log("Item deleted successfully:", response);
                // Remove the item from the DOM
                $("#item_" + itemId).remove();
            },
            error: function(xhr, status, error) {
                console.error("Error deleting item:", error);
            }
        });
    }

    // Function to handle requesting now
    function requestNow() {
        console.log("Requesting now...");
        // Add your request now functionality here
        // For example, redirect to another page
        window.location.href = "ordered.html";
    }
</script>
</body>
</html>