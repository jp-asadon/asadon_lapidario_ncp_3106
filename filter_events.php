<?php
require_once("config.php");

$currentDateTime = date('Y-m-d H:i:s');
$filter = $_GET['filter'] ?? 'all'; // Default to 'all' if no filter is passed

$sql = "SELECT * FROM create_event WHERE delete_event = 0";

// Switch based on filter type
switch ($filter) {
    case 'today':
        $sql .= " AND event_date = CURDATE()";
        break;
    case 'week':
        $sql .= " AND YEARWEEK(event_date, 1) = YEARWEEK(CURDATE(), 1)";
        break;
    case 'month':
        $sql .= " AND YEAR(event_date) = YEAR(CURDATE()) AND MONTH(event_date) = MONTH(CURDATE())";
        break;
    case 'all': 
    default:
        // Show all upcoming events
        $sql .= " AND CONCAT(event_date, ' ', event_start_time) > '$currentDateTime'";
        break;
}

// Order events by date and time
$sql .= " ORDER BY CONCAT(event_date, ' ', event_start_time) ASC";

if ($result = $mysqli->query($sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $eventDateTime = strtotime($row['event_date'] . ' ' . $row['event_start_time']);
            $remainingTime = $eventDateTime - time();
            $days = floor($remainingTime / 86400);
            $hours = floor(($remainingTime % 86400) / 3600);
            $minutes = floor(($remainingTime % 3600) / 60);

            if ($remainingTime > 0) { // Ensure the event is still upcoming
                echo "<div class='activity-item d-flex'>
                        <div class='activite-label'>";
                if ($days > 0) {
                    echo $days . " Day" . ($days > 1 ? "s" : "");
                } else {
                    echo $hours . "h " . $minutes . "m";
                }
                echo "</div>
                      <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                      <div class='activity-content'>
                        <strong>" . htmlspecialchars($row['event_name']) . "</strong> &ensp;" . htmlspecialchars($row['event_venue']) . "
                      </div>
                    </div>";
            }
        }
    } else {
        echo "<p>No upcoming events found.</p>";
    }
} else {
    echo "<p>Error: Could not execute query.</p>";
}
?>
