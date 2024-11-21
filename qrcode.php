<?php
require_once 'connection.php';
require_once 'phpqrcode/qrlib.php';

$path = 'images/';
if (isset($_GET['qrtext']) && isset($_GET['qrimage'])) {
    $qrtext = urldecode($_GET['qrtext']); // Get the QR text from the URL
    $qrimage = $_GET['qrimage'];
    $qrcode = $path . $qrimage;

    // Save the QR code data to the database
    $query = mysqli_query($connection, "INSERT INTO qrcode (qrtext, qrimage) VALUES ('$qrtext', '$qrimage')");
    if ($query) {
        // Generate the QR code
        QRcode::png($qrtext, $qrcode, 'H', 4, 4);
        echo "<p>QR code generated successfully!</p>";
        echo "<img src='" . $qrcode . "' alt='QR Code'>";
    } else {
        echo "Error: Unable to save QR code data.";
    }
} else {
    echo "Error: Missing QR code data.";
}
?>
