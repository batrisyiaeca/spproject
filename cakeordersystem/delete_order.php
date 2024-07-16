<?php require_once "controllerUserData.php"; ?>

<?php
// Ensure this script is accessed via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the order_id
    $order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;

    // Validate if $order_id is greater than 0 (to prevent invalid deletion attempts)
    if ($order_id > 0) {

        // Prepare a DELETE statement
        $deleteQuery = "DELETE FROM orders WHERE id = ?";

        // Prepare the statement
        $stmt = mysqli_prepare($con, $deleteQuery);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "i", $order_id);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Check if deletion was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Deletion successful
            echo json_encode(['success' => true]);
        } else {
            // Deletion failed
            echo json_encode(['success' => false]);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}
?>
