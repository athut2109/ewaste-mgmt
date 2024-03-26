<?php

require_once "config.php";

// Check if itemId is set and is a valid integer
if (isset($_POST['itemId']) && filter_var($_POST['itemId'], FILTER_VALIDATE_INT)) {
    $itemId = $_POST['itemId'];

    // Prepare and execute the delete query
    $query = $db->prepare("DELETE FROM list WHERE id = ?");
    $query->bind_param("i", $itemId);
    
    if ($query->execute()) {
        // Deletion successful
        echo "Item deleted successfully";
    } else {
        // Error occurred during deletion
        echo "Error deleting item: " . $query->error;
    }
} else {
    // Invalid or missing itemId
    echo "Invalid item ID";
}
?>
