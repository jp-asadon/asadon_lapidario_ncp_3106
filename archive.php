<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include your database connection
    require_once 'config.php';

    // Get the ID from the POST request
    $id = intval($_POST['id']);

    // Prepare and execute the SQL statement
    $sql = "UPDATE create_event SET delete_event = 1 WHERE id = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Redirect or provide feedback after successful update
            header("Location: index.php?status=success");
        } else {
            echo "Error updating record: " . $mysqli->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }

    $mysqli->close();
}
?>
