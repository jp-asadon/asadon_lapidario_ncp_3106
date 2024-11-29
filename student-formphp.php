<?php
// Include config file
require_once "config.php";

// Initialize variables
$surname = $first_name = $middle_initial = $student_number = $year_level = $program = $college = $age = $sex = "";
$program_flow = $time_management = $venue_and_fac = $speakers_performers = $topics = $facilitators = $overall_rating = "";
$comments_speaker = $comments_organizer = "";
$surname_err = $first_name_err = $middle_initial_err = $student_number_err = $year_level_err = $program_err = $college_err = $age_err = $sex_err = "";

// Check for the existence of the 'id' parameter and validate it
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $event_id = intval($_GET["id"]); // Ensure it's a valid integer

    // Fetch event details if needed
    $sql = "SELECT * FROM create_event WHERE id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $event_id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);

                // Populate variables with event details
                $event_name = $row["event_name"];
                $event_date = $row["event_date"];
                $event_time = $row["event_start_time"];
                $event_venue = $row["event_venue"];
                $event_speaker = $row["event_speaker"];
                $qrimage = $row["qrimage"];
            } else {
                // Redirect to error page if event not found
                header("location: error.php");
                exit();
            }
        } else {
            echo "Error fetching event details.";
        }
        $stmt->close();
    }
} else {
    // Redirect to error page if 'id' is missing or invalid
    header("location: error.php");
    exit();
}

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and assign form values
    $surname = $_POST['surname'] ?? "";
    $first_name = $_POST['first_name'] ?? "";
    $middle_initial = $_POST['middle_initial'] ?? "";
    $student_number = $_POST['student_number'] ?? "";
    $year_level = $_POST['year_level'] ?? "";
    $program = $_POST['program'] ?? "";
    $college = $_POST['college'] ?? "";
    $age = $_POST['age'] ?? "";
    $sex = $_POST['sex'] ?? "";
    $program_flow = $_POST['program_flow'] ?? "";
    $time_management = $_POST['time_management'] ?? "";
    $venue_and_fac = $_POST['venue_and_fac'] ?? "";
    $speakers_performers = $_POST['speakers_performers'] ?? "";
    $topics = $_POST['topics'] ?? "";
    $facilitators = $_POST['facilitators'] ?? "";
    $overall_rating = $_POST['overall_rating'] ?? "";
    $comments_speaker = $_POST['feedback_speakers'] ?? "";
    $comments_organizer = $_POST['feedback_organizers'] ?? "";

    // Prepare an INSERT statement for feedback_event
    $sql = "INSERT INTO feedback_event 
            (event_id, surname, first_name, middle_initial, student_number, year_level, program, college, age, sex, 
             program_flow, time_management, venue_and_fac, speakers_performers, topics, facilitators, overall_rating, 
             feedback_speakers, feedback_organizers) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param(
            "issssssssssssssssss",
            $event_id, $surname, $first_name, $middle_initial, $student_number, $year_level, $program, $college, $age, $sex,
            $program_flow, $time_management, $venue_and_fac, $speakers_performers, $topics, $facilitators, $overall_rating, 
            $comments_speaker, $comments_organizer
        );

        // Execute the statement
        if ($stmt->execute()) {
            header("location: index.html");
            exit();
        } else {
            echo "Error: Could not execute the query.";
        }
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>