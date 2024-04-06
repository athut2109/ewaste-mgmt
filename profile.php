<?php

require_once "config.php";
require_once "session.php";

// Check if user is logged in
if (!isset($_SESSION["userid"])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Fetch data for the logged-in user
$userId = $_SESSION["userid"];
$query = $db->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param("i", $userId);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();

// Fetch items for the logged-in user
$queryItems = $db->prepare("SELECT * FROM list WHERE user_id = ?");
$queryItems->bind_param("i", $userId);
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
        flex-wrap: wrap;
    }

    .item p {
        flex: 1; /* Distribute the space evenly among paragraphs */
        margin: 0; /* Remove default margin */
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
        border: solid;
        border-width: 2px;
        border-color: #000000;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        font-family: "Montserrat";  
    }

    .edit-btn{
        padding: 10px 20px;
        background-color: green;
        border: solid;
        border-width: 2px;
        border-color: #000000;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        font-family: "Montserrat";
    }

    .quantity-btn{
        padding: 0px 8px;
        margin-right: 10px;
        background-color: #ffffff;
        color: #000000;
        border: solid;
        border-radius: 50px;
        border-width: 2px;
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
        font-family: "Montserrat";
    }

    .delete-btn, .logout-btn{
        padding: 10px 20px;
        background-color: red;
        color: #ffffff;
        border: solid;
        border-width: 2px;
        border-color: #000000;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 16px;
        font-weight: bold;
        font-family: "Montserrat";
    }

    .delete-btn:hover,  .logout-btn:hover{
        background-color: #cc4c37;
    }

    .delete-btn, .logout-btn {
        margin-right: 8px;
    }

    /*For Tablet*/
    @media only screen and (max-width: 768px) {
        .profile-container {
            padding: 10px;
        }

        .profile-info {
            flex-direction: column;
            align-items: center;
        }

        .profile-photo {
            margin-bottom: 20px;
        }

        .profile-details .info {
            text-align: center;
        }

        .profile-btns {
            flex-direction: column;
            gap: 20px;
            justify-content: center;
        }

        item p {
            font-size: 12px; /* Set font size for smaller screens */
        }

        .delete-btn{
            font-size: 14px;
        }

        .quantity-btn{
            padding: 0px 7px;
            font-size: 16px;
        }

        .btns {
            flex-direction: column;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }
    }

    /*For Mobile*/
    @media only screen and (max-width: 480px) {
        .profile-info {
            flex-direction: column;
            align-items: center;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
        }

        .profile-details .info {
            text-align: center;
            font-size: 16px;
        }

        .item p {
            font-size: 10px; /* Set font size for smaller screens */
        }

        .delete-btn{
            font-size: 12px;
        }

        .quantity-btn{
            margin-right: 4px;
            padding: 0px 5px;
            font-size: 14px;
        }

        .btns {
            flex-direction: column;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }
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
                <div><button class="logout-btn" onclick="logout()">Log Out</button></div>
            </div>
        </div>
    </div>
</div>
<br><br>
<h2>Items List</h2>
<div class="item-list" id="itemList">
        <?php foreach ($items as $index => $item): ?>
            <div class="item" id="item_<?php echo $item['id']; ?>">
                <p><strong>Name:</strong> <?php echo $item['name']; ?></p>
                <p><strong>Weight:</strong> <?php echo $item['weight']; ?>kg</p>
                <p><strong>Quantity:</strong> <?php echo $item['qty']; ?>qty</p>
                <div>
                    <!-- Plus button to increase quantity -->
                    <button class="quantity-btn" onclick="updateQuantity(<?php echo $item['id']; ?>, 'increase')">+</button>
                    <!-- Minus button to decrease quantity -->
                    <button class="quantity-btn" onclick="updateQuantity(<?php echo $item['id']; ?>, 'decrease')">-</button>
                    <!-- Delete button to remove item -->
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

    function logout() {
            // Send an AJAX request to logout.php to destroy the session
            $.ajax({
                type: "POST",
                url: "logout.php", // PHP script to handle logout
                success: function(response) {
                    console.log("Logged out successfully:", response);
                    // Redirect the user to the login page
                    window.location.href = "login.php";
                },
                error: function(xhr, status, error) {
                    console.error("Error logging out:", error);
                }
            });
    }

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

    // Function to handle updating quantity
    function updateQuantity(itemId, action) {
        console.log("Updating quantity for item:", itemId, "Action:", action);
        $.ajax({
            type: "POST",
            url: "update-quantity.php", // PHP script to handle quantity update
            data: { itemId: itemId, action: action },
            success: function(response) {
                console.log("Quantity updated successfully:", response);
                // Refresh the page to reflect updated quantity
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error updating quantity:", error);
            }
        });
    }

    // Function to handle requesting now
    function requestNow() {
        console.log("Requesting now...");
        window.location.href = "ordered.html";
    }
</script>
</body>
</html>
