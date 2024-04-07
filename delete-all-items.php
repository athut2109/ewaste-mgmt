<?php
require_once "config.php";

// Check if itemIds data is received
if(isset($_POST['itemIds']) && is_array($_POST['itemIds']) && !empty($_POST['itemIds'])) {
    // Sanitize item IDs to prevent SQL injection
    $itemIds = array_map('intval', $_POST['itemIds']);

    // Construct the SQL query to delete items
    $placeholders = implode(',', array_fill(0, count($itemIds), '?'));
    $query = "DELETE FROM list WHERE id IN ($placeholders)";

    // Prepare the delete query
    $stmt = $db->prepare($query);

    if($stmt) {
        // Bind item IDs to the placeholders
        $bindParams = array_merge(array(str_repeat('i', count($itemIds))), $itemIds);
        call_user_func_array(array($stmt, 'bind_param'), $bindParams);

        // Execute the delete query
        $stmt->execute();

        // Check if any rows were affected
        if($stmt->affected_rows > 0) {
            // Items deleted successfully
            echo "Items deleted successfully.";
        } else {
            // No rows affected, possibly items were not found
            echo "No items were deleted.";
        }

        // Close statement
        $stmt->close();
    } else {
        // Error in preparing statement
        echo "Error: Unable to prepare statement.";
    }
} else {
    // No itemIds data received
    echo "Error: No item IDs received.";
}
?>
