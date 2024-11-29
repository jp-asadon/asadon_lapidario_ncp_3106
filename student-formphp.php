<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM create_event WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // Fetch result row as an associative array
                $row = $result->fetch_array(MYSQLI_ASSOC);

                // Retrieve individual field values
                $event_name = $row["event_name"];
                $event_date = $row["event_date"];
                $event_time = $row["event_start_time"];
                $event_venue = $row["event_venue"];
                $event_speaker = $row["event_speaker"];
                $qrimage = $row["qrimage"]; // Add this to fetch the QR code image name
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();

    // Close connection
    $mysqli->close();
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
// end

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$surname = $first_name = $middle_initial = $student_number = $year_level = $program = $college = $age = $sex = $program_flow = $time_management = $venue = $speaker = $topic = $facilitator = $overall_rating = $comments_speaker = $comments_organizer = "";
$surname_err = $first_name_err = $middle_initial_err = $student_number_err = $year_level_err = $program_err = $college_err = $age_err = $sex_err = $program_flow_err = $time_management_err = $venue_err = $speaker_err = $topic_err = $facilitator_err = $overall_rating_err = $comments_speaker_err = $comments_organizer_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve values using $_POST
    $surname = $_POST['surname'];
    $first_name = $_POST['first_name'];
    $middle_initial = $_POST['middle_initial'];
    $student_number = $_POST['student_number'];
    $year_level = $_POST['year_level'];
    $program = $_POST['program'];
    $college = $_POST['college'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    
    // Check if program_flow is set and retrieve the selected value
    if (isset($_POST['program_flow'])) {
        $program_flow = $_POST['program_flow'];
    } else {
        $program_flow = null; // Set a default value if no option is selected
    }

    $time_management = $_POST['time_management'];
    $venue = $_POST['venue'];
    $speaker = $_POST['speaker'];
    $topic = $_POST['topic'];
    $facilitator = $_POST['facilitator'];
    $overall_rating = $_POST['overall_rating'];
    $comments_speaker = $_POST['comments_speaker'];
    $comments_organizer = $_POST['comments_organizer'];
    $event_id = $_GET["event_id"];

    // Prepare an insert statement
    $sql = "INSERT INTO feedback_event (event_id, surname, first_name, middle_initial, student_number, year_level, program, college, age, sex, program_flow, time_management, venue_and_fac, speakers_performers, topics, facilitators, overall_rating, feedback_speakers, feedback_organizers) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param(
            "ssssssssssssssssss",
            $param_event_id,
            $param_surname,
            $param_first_name,
            $param_middle_initial,
            $param_student_number,
            $param_year_level,
            $param_program,
            $param_college,
            $param_age,
            $param_sex,
            $param_program_flow,
            $param_time_management,
            $param_venue_and_fac,
            $param_speakers_performers,
            $param_topics,
            $param_facilitators,
            $param_overall_rating,
            $param_feedback_speakers,
            $param_feedback_organizers
        );

        // Set parameters
        $param_event_id = $event_id;
        $param_surname = $surname;
        $param_first_name = $first_name;
        $param_middle_initial = $middle_initial;
        $param_student_number = $student_number;
        $param_year_level = $year_level;
        $param_program = $program;
        $param_college = $college;
        $param_age = $age;
        $param_sex = $sex;
        $param_program_flow = $program_flow;
        $param_time_management = $time_management;
        $param_venue_and_fac = $venue;
        $param_speakers_performers = $speaker;
        $param_topics = $topic;
        $param_facilitators = $facilitator;
        $param_overall_rating = $overall_rating;
        $param_feedback_speakers = $comments_speaker;
        $param_feedback_organizers = $comments_organizer;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records created successfully. Redirect to landing page
            header("location: form-success.html");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close statement
    $stmt->close();

    // Close connection
    $mysqli->close();
}
?>
