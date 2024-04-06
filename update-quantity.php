<?php

require_once "config.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the necessary data is received
    if (isset($_POST['itemId']) && isset($_POST['action'])) {
        // Sanitize and store the received data
        $itemId = mysqli_real_escape_string($db, $_POST['itemId']);
        $action = $_POST['action']; // 'increase' or 'decrease'

        // Fetch the current quantity from the database
        $query = "SELECT qty FROM list WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $itemId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $currentQty = $row['qty'];

        // Update quantity based on the action
        if ($action === 'increase') {
            $newQty = $currentQty + 1;
        } elseif ($action === 'decrease' && $currentQty > 0) {
            $newQty = $currentQty - 1;
        } else {
            // Invalid action or quantity already 0
            echo "Error: Invalid action or quantity already 0.";
            exit();
        }

        // Update the quantity in the database
        $updateQuery = "UPDATE list SET qty = ? WHERE id = ?";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bind_param("ii", $newQty, $itemId);

        if ($updateStmt->execute()) {
            if ($newQty == 0) {
                // Quantity is zero, remove the item from the database
                $deleteQuery = "DELETE FROM list WHERE id = ?";
                $deleteStmt = $db->prepare($deleteQuery);
                $deleteStmt->bind_param("i", $itemId);
                if ($deleteStmt->execute()) {
                    echo "Item removed from database.";
                } else {
                    echo "Error removing item from database.";
                }
                $deleteStmt->close();
            } else {
                echo "Quantity updated successfully.";
            }
        } else {
            echo "Error updating quantity.";
        }

        // Close prepared statements and database connection
        $stmt->close();
        $updateStmt->close();
        $db->close();
    } else {
        // Data not received
        echo "Error: Data not received.";
    }
} else {
    // Invalid request method
    echo "Error: Invalid request method.";
}

?>
