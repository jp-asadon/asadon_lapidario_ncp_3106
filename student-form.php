<?php
// Include config file
require_once "config.php";
// Initialize variables
$event_name = $event_date = $event_time = $event_venue = $event_speaker = $qrimage = "";
// Check existence of ID parameter
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Prepare a SELECT statement
    $sql = "SELECT * FROM create_event WHERE id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $param_id);
        $param_id = trim($_GET["id"]);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $event_name = $row["event_name"];
                $event_date = $row["event_date"];
                $event_time = $row["event_start_time"];
                $event_venue = $row["event_venue"];
                $event_speaker = $row["event_speaker"];
                $qrimage = $row["qrimage"];
            } else {
                header("location: error.php");
                exit();
            }
        } else {
            echo "Error executing query.";
        }
        $stmt->close();
    }
} else {
    header("location: error.php");
    exit();
}
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = $_POST['surname'];
    $first_name = $_POST['first_name'];
    $middle_initial = $_POST['middle_initial'] ?? '';
    $student_number = $_POST['student_number'];
    $year_level = $_POST['year_level'];
    $program = $_POST['program'];
    $college = $_POST['college'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $program_flow = $_POST['program_flow'];
    $time_management = $_POST['time_management'];
    $venue_and_fac = $_POST['venue_and_fac'];
    $speakers_performers = $_POST['speakers_performers'];
    $topics = $_POST['topics'];
    $facilitators = $_POST['facilitators'];
    $overall_rating = $_POST['overall_rating'];
    $comments_speaker = $_POST['comments_speaker'] ?? '';
    $comments_organizer = $_POST['comments_organizer'] ?? '';

    $sql = "INSERT INTO feedback_event (event_id, surname, first_name, middle_initial, student_number, year_level, program, college, age, sex, program_flow, time_management, venue, speaker, topic, facilitator, overall_rating, comments_speaker, comments_organizer) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        // Adjust the type definition to match the number of variables and their types
        $stmt->bind_param(
            "isssisssissssssssss", // 18 type definitions
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
            $param_comments_speaker,
            $param_comments_organizer
        );

        $param_event_id = $_GET['id'];
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
        $param_venue_and_fac = $venue_and_fac;
        $param_speakers_performers = $speakers_performers;
        $param_topics = $topics;
        $param_facilitators = $facilitators;
        $param_overall_rating = $overall_rating;
        $param_comments_speaker = $comments_speaker;
        $param_comments_organizer = $comments_organizer;

        if ($stmt->execute()) {
            header("location: form-success.html");
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }
    $mysqli->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Satisfaction Survey</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="assets/css/student-form.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        .page { display: none; }
        .active { display: block; }
        .step-indicator { text-align: center; margin: 20px 0; }
        .step { display: inline-block; width: 20px; height: 20px; background-color: #ddd; border-radius: 50%; margin: 0 5px; line-height: 20px; text-align: center; font-size: 12px; }
        .step.active { background-color: #007bff; color: #fff; }
    </style>
</head>
<body>
    <div class="container mt-5"]>
        <div class="card shadow">
        <div class="card-header text-center text-white" style="background-color: rgba(0, 0, 0, 0.831);">

<img src="uelogo.png" alt="UE Logo" class="logo">
<img src="scpes-logo1.png" alt="SCPES Logo" class="logo">
<h2>Event Satisfaction Survey</h2>
<p>We value your feedback! Please take a moment to share your thoughts.</p>
</div>
<div class="card-body" style="padding: 0px;">


            <div class="card-body" style="padding: 0px;">
                <div class="card-body">
                <section>
                    <h1 style="text-align: center;"><?php echo $row["event_name"]; ?></h1>
                    <p style="text-align:center">SAO Evaluation</p>
                    <p style="text-align: justify;">Thank you for attending the Workshop. We would like to appreciate
                        your feedback and welcome any additional comments that you may have. Your response will be used
                        to enhance our events and activities and ensure that we meet your future needs. We value your
                        responses on this evaluation.</p>
                </section>
                <div class="page active" id="page-1">
                <div class="card">
                            <div class="card-body">
                                <p style="font-size: 20px; font-weight: bold;">Data Privacy Consent</p>
                                <p style="text-align: justify;">The collection of data is for the purpose of evaluating your activity. By signing this form, you are certifying that all information provided are true and correct and likewise authorizing this office to process your
                                    information. Your accomplished form will be kept in a secure place and will be disposed of within a reasonable time frame.</p>
                            </div>
                        </div>
                        </div>
                <div class="page" id="page-2">
                <div class="card">
                            <div class="card-body">
                                <p style="text-align: justify;">The Society of Computer Engineering Students would like to hear your feedback on the following event in order to improve our procedures on event management and facilitation to serve you better in future.</p>
                                <p style="text-align: center; font-weight: bold;"><?php echo $row["event_name"]; ?></p>
                                <p style="text-align: center; font-weight: bold;"><?php echo $row["event_date"]; ?>  |  <?php echo $row["event_venue"]; ?></p>

                                <p style="text-align: justify;"><b>Privacy Consent: </b> I understand and agree that byfilling-out this form, my personal data will be processed only for the purpose of evaluating the event and for contacting me for future initiatives that I may be interested in.
                                    Furthermore, I understand that my personal data will be kept confidential and stored in a secure location.
                                </p>
                                <p>For queries and concerns, please contact <b>soliven.alividale@ue.edu.ph</b>.</p><br>
                                <div id="consentForm">
                                    <label>
                                    <input type="radio" name="consent" value="Yes" required>Agree
                                    </label>
                                </div>
                            </div>
                        </div>
                        </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $_GET["id"]; ?>" method="post">

                <div class="page" id="page-3">

                <div class="card">
                    <div class="card-body">
                    <!-- Form Fields -->
                    <label for="surname" style="font-weight: bold;">Surname (in UPPERCASE)</label>
                    <input type="text" name="surname" class="form-control" placeholder="Enter your surname" style="padding: 10px; margin-bottom: 7px;"required>
                    <span id="surnameErr" class="error-message" style="color: red; font-size: 0.875em; display: block; margin-bottom: 10px;"></span>

                    <label for="first_name" style="font-weight: bold;">First Name (in UPPERCASE)</label>
                    <input type="text" name="first_name" class="form-control"  placeholder="Enter your first name" style="padding: 10px; margin-bottom: 7px;"required>
                    <span id="firstNameErr" class="error-message" style="color: red; font-size: 0.875em; display: block; margin-bottom: 10px;"></span>

                    <label for="middle_initial" style="font-weight: bold;">Middle Initial</label>
                    <input type="text" name="middle_initial" class="form-control" placeholder="Enter your middle initial" style="padding: 10px; margin-bottom: 7px;">
                    <span id="middleInitialErr" class="error-message" style="color: red; font-size: 0.875em; display: block; margin-bottom: 10px;"></span>

                    <label for="student_number" style="font-weight: bold;">Student Number</label>
                    <input type="text" name="student_number" class="form-control" placeholder="Enter your student number" style="padding: 10px; margin-bottom: 7px;" required>
                    <span id="studentNumberErr" class="error-message" style="color: red; font-size: 0.875em; display: block; margin-bottom: 10px;"></span>

                    <label for="year_level" style="font-weight: bold;">Year Level</label>
                    <select name="year_level" class="form-control" style="width: 100%; min-width: 200px; padding: 10px; margin-bottom: 7px;" required>
                        <option disabled selected>Choose Year Level</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <span id="yearLevelErr" class="error-message" style="color: red; font-size: 0.875em; display: block; margin-bottom: 10px;"></span>

                    <label for="program" style="font-weight: bold;">Program</label>
                    <input type="text" name="program" class="form-control" placeholder="Enter your Program" style="padding: 10px; margin-bottom: 7px;"  required>
                    <span id="programErr" class="error-message" style="color: red; font-size: 0.875em; display: block; margin-bottom: 10px;"></span>

                    <label for="college" style="font-weight: bold;">College</label>
                    <input type="text" name="college" class="form-control" placeholder="Enter your College" style="padding: 10px; margin-bottom: 7px;" required>
                    <span id="collegeErr" class="error-message" style="color: red; font-size: 0.875em; display: block; margin-bottom: 10px;"></span>

                    <label for="age" style="font-weight: bold;">Age</label>
                    <input type="number" name="age" class="form-control" placeholder="Enter your Age" style="padding: 10px; margin-bottom: 7px;"required>
                    <span id="ageErr" class="error-message" style="color: red; font-size: 0.875em; display: block; margin-bottom: 10px;"></span>

                    <label for="sex" style="font-weight: bold;">Sex</label>
                    <select name="sex" class="form-control" style="padding: 10px; margin-bottom: 7px;" required>
                        <option disabled selected>Choose Sex</option>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                    <span id="sexErr" class="error-message" style="color: red; font-size: 0.875em; display: block; margin-bottom: 10px;"></span>

                    <br>

                    </div>
                    </div>
                    </div>

                    <div class="page" id="page-4">
                    <div class="card">
                        <div class="card-body">

                        <p style="text-align: justify; font-weight: bold;">EVALUATION</p>
                                <p style="text-align: justify;">In our desire to provide quality student activities, we
                                    would like you to please rate the following items using the 5-point rating scale
                                    honestly and objectively: </p>
                                <p style="text-align: justify; ">
                                    5 - Excellent<br>
                                    4 - Very Satisfactory<br>
                                    3 - Satisfactory<br>
                                    2 - Poor<br>
                                    1 - Extremely Poor
                                </p>
                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Program Flow</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                            <input type="radio" name="program_flow" id="program_flow-star5" value="5" required>
                                            <label for="program_flow-star5">🤩<span class="label-text">Excellent</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="program_flow" id="program_flow-star4" value="4" required>
                                            <label for="program_flow-star4">😊<span class="label-text">Very Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="program_flow" id="program_flow-star3" value="3" required>
                                            <label for="program_flow-star3">😐<span class="label-text">Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="program_flow" id="program_flow-star2" value="2" required>
                                            <label for="program_flow-star2">😞<span class="label-text">Poor</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="program_flow" id="program_flow-star1" value="1" required>
                                            <label for="program_flow-star1">😡<span class="label-text">Extremely Poor</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Time Management</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                                <input type="radio" name="time_management" id="time_management-star5" value="5" required>
                                                <label for="time_management-star5">🤩<span class="label-text">Excellent</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                                <input type="radio" name="time_management" id="time_management-star4" value="4" required>
                                                <label for="time_management-star4">😊<span class="label-text">Very Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                                <input type="radio" name="time_management" id="time_management-star3" value="3" required>
                                                <label for="time_management-star3">😐<span class="label-text">Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                                <input type="radio" name="time_management" id="time_management-star2" value="2" required>
                                                <label for="time_management-star2">😞<span class="label-text">Poor</span></label>
                                            </div>
                                            <div class="emoji-container">
                                                <input type="radio" name="time_management" id="time_management-star1" value="1" required>
                                                <label for="time_management-star1">😡<span class="label-text">Extremely Poor</span></label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Venue and Facilities</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                                <input type="radio" name="venue_and_fac" id="venue_and_fac-star5" value="5" required>
                                                <label for="venue_and_fac-star5">🤩<span class="label-text">Excellent</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="venue_and_fac" id="venue_and_fac-star4" value="4" required>
                                                <label for="venue_and_fac-star4">😊<span class="label-text">Very Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="venue_and_fac" id="venue_and_fac-star3" value="3" required>
                                                <label for="venue_and_fac-star3">😐<span class="label-text">Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="venue_and_fac" id="venue_and_fac-star2" value="2" required>
                                                <label for="venue_and_fac-star2">😞<span class="label-text">Poor</span></label></div>
                                            <div class="emoji-container">
                                            <input type="radio" name="venue_and_fac" id="venue_and_fac-star1" value="1" required>
                                                <label for="venue_and_fac-star1">😡<span class="label-text">Extremely Poor</span></label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Speakers/Performers</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                            <input type="radio" name="speakers_performers"
                                                id="speakers_performers-star5" value="5" required>
                                                <label for="speakers_performers-star5">🤩<span class="label-text">Excellent</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="speakers_performers"
                                                id="speakers_performers-star4" value="4" required>
                                                <label for="speakers_performers-star4">😊<span class="label-text">Very Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="speakers_performers" id="speakers_performers-star3" value="3" required>
                                                <label for="speakers_performers-star3">😐<span class="label-text">Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="speakers_performers"
                                                id="speakers_performers-star2" value="2" required>
                                                <label for="speakers_performers-star2">😞<span class="label-text">Poor</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="speakers_performers" id="speakers_performers-star1" value="1" required>
                                                <label for="speakers_performers-star1">😡<span class="label-text">Extremely Poor</span></label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4> Topics/Quality of Performances</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                            <input type="radio" name="topics" id="topics-star5" value="5" required>
                                                <label for="topics-star5">🤩<span class="label-text">Excellent</span></label></div>
                                            <div class="emoji-container">
                                            <input type="radio" name="topics" id="topics-star4" value="4" required>
                                                <label for="topics-star4">😊<span class="label-text">Very Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="topics" id="topics-star3" value="3" required>
                                                <label for="topics-star3">😐<span class="label-text">Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="topics" id="topics-star2" value="2" required>
                                                <label for="topics-star2">😞<span class="label-text">Poor</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="topics" id="topics-star1" value="1" required>
                                                <label for="topics-star1">😡<span class="label-text">Extremely Poor</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Facilitators/Event Organizers</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                            <input type="radio" name="facilitators" id="facilitators-star5" value="5" required>
                                                <label for="facilitators-star5">🤩<span class="label-text">Excellent</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="facilitators" id="facilitators-star4" value="4" required>
                                                <label for="facilitators-star4">😊<span class="label-text">Very Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="facilitators" id="facilitators-star3" value="3" required>
                                                <label for="facilitators-star3">😐<span class="label-text">Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="facilitators" id="facilitators-star2" value="2" required>
                                                <label for="facilitators-star2">😞<span class="label-text">Poor</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="facilitators" id="facilitators-star1" value="1" required>
                                            <label for="facilitators-star1">😡<span class="label-text">Extremely Poor</span></label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Overall Rating for the Activity</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                            <input type="radio" name="overall_rating" id="overall_rating-star5" value="5" required>
                                                <label for="overall_rating-star5">🤩<span class="label-text">Excellent</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="overall_rating" id="overall_rating-star4" value="4" required>
                                                <label for="overall_rating-star4">  😊<span class="label-text">Very Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="overall_rating" id="overall_rating-star3" value="3" required>
                                                <label for="overall_rating-star3">😐<span class="label-text">Satisfactory</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="overall_rating" id="overall_rating-star2" value="2" required>
                                                <label for="overall_rating-star2">😞<span class="label-text">Poor</span></label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="overall_rating" id="overall_rating-star1" value="1" required>
                                                <label for="overall_rating-star1">😡<span class="label-text">Extremely Poor</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Comments and Suggestion for the Speakers</h4>
                                        <textarea name="comments_speaker" rows="4"
                                            placeholder="Kindly place your comments for our guest speaker here. (Optional)"
                                            style="width: 100%; padding: 10px;"></textarea>
                                    </div>
                                </div>

                                <div class="card" style="margin: 5px; margin-bottom: 10px;">
                                    <div class="card-body">
                                        <h4>Comments and Suggestion for the Organizers (SCpES and DCpE)</h4>
                                        <textarea name="comments_organizer" rows="4"
                                            placeholder="Kindly place your comments for our organizers here. (Optional)"
                                            style="width: 100%; padding: 10px;"></textarea>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary" id="submit_button">Submit</button>

                        </div>
                    </div>
</div>
                </form>


                                <!-- Step Indicator -->
                                <div class="step-indicator">
                    <span class="step active" id="step-1">1</span>
                    <span class="step" id="step-2">2</span>
                    <span class="step" id="step-3">3</span>
                    <span class="step" id="step-4">4</span>
                </div>
                  <!-- Navigation Buttons -->
                  <div class="text-center mt-4">
                    <button type="button" id="prevBtn" onclick="changePage(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="changePage(1)" style="background-color: #007bff;">Next</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    let currentPage = 1;
    const totalPages = 4;

    // Function to validate inputs on Page 3
    function validatePage3() {
        let isValid = true;

        // Validate Surname
        const surname = document.querySelector('input[name="surname"]').value.trim();
        const surnameErr = document.getElementById("surnameErr");
        if (surname === "") {
            surnameErr.textContent = "Please enter your Surname.";
            isValid = false;
        } else if (!/^[A-Z\s]+$/.test(surname)) {
            surnameErr.textContent = "Please enter a valid Surname in uppercase.";
            isValid = false;
        } else {
            surnameErr.textContent = "";
        }

        // Validate First Name
        const firstName = document.querySelector('input[name="first_name"]').value.trim();
        const firstNameErr = document.getElementById("firstNameErr");
        if (firstName === "") {
            firstNameErr.textContent = "Please enter your First Name.";
            isValid = false;
        } else if (!/^[A-Z\s]+$/.test(firstName)) {
            firstNameErr.textContent = "Please enter a valid First Name in uppercase.";
            isValid = false;
        } else {
            firstNameErr.textContent = "";
        }

        // Validate Middle Initial
        const middleInitial = document.querySelector('input[name="middle_initial"]').value.trim();
        const middleInitialErr = document.getElementById("middleInitialErr");
        if (middleInitial !== "" && (middleInitial.length !== 2 || !/^[A-Z]\.$/.test(middleInitial))) {
            middleInitialErr.textContent = "Please enter a valid Middle Initial (e.g., 'A.').";
            isValid = false;
        } else {
            middleInitialErr.textContent = "";
        }

        // Validate Student Number
        const studentNumber = document.querySelector('input[name="student_number"]').value.trim();
        const studentNumberErr = document.getElementById("studentNumberErr");
        if (studentNumber === "") {
            studentNumberErr.textContent = "Please enter your Student Number.";
            isValid = false;
        } else if (!/^\d{11}$/.test(studentNumber)) {
            studentNumberErr.textContent = "Student Number should be exactly 11 digits.";
            isValid = false;
        } else {
            studentNumberErr.textContent = "";
        }

        // Validate Year Level
        const yearLevel = document.querySelector('select[name="year_level"]').value;
        const yearLevelErr = document.getElementById("yearLevelErr");
        if (yearLevel === "Choose Year Level") {
            yearLevelErr.textContent = "Please select your Year Level.";
            isValid = false;
        } else {
            yearLevelErr.textContent = "";
        }

        // Validate Program
        const program = document.querySelector('input[name="program"]').value.trim();
        const programErr = document.getElementById("programErr");
        if (program === "") {
            programErr.textContent = "Please enter your Program.";
            isValid = false;
        } else if (!/^BS[A-Z]+$/.test(program)) {
            programErr.textContent = "Please enter a valid Program (e.g., BSCpE, BSCE).";
            isValid = false;
        } else {
            programErr.textContent = "";
        }

        // Validate College
        const college = document.querySelector('input[name="college"]').value.trim();
        const collegeErr = document.getElementById("collegeErr");
        if (college === "") {
            collegeErr.textContent = "Please enter your College.";
            isValid = false;
        } else if (!/^[A-Z\s]+$/.test(college)) {
            collegeErr.textContent = "Please enter a valid College name.";
            isValid = false;
        } else {
            collegeErr.textContent = "";
        }

        // Validate Age
        const age = document.querySelector('input[name="age"]').value.trim();
        const ageErr = document.getElementById("ageErr");
        if (age === "") {
            ageErr.textContent = "Please enter your Age.";
            isValid = false;
        } else if (!/^\d{1,2}$/.test(age)) {
            ageErr.textContent = "Age should be 1 or 2 digits.";
            isValid = false;
        } else {
            ageErr.textContent = "";
        }

        // Validate Sex
        const sex = document.querySelector('select[name="sex"]').value;
        const sexErr = document.getElementById("sexErr");
        if (sex === "Choose Sex") {
            sexErr.textContent = "Please select your Sex.";
            isValid = false;
        } else {
            sexErr.textContent = "";
        }

        return isValid;
    }

    // Modified changePage function
    function changePage(step) {
        // Validate page-specific logic
        if (currentPage === 2 && step === 1) {
            const consentRadio = document.querySelector('input[name="consent"]:checked');
            if (!consentRadio) {
                alert("Please provide your consent by selecting the radio option.");
                return;
            }
        }

        if (currentPage === 3 && step === 1) {
            if (!validatePage3()) {
                return; // Stop navigation if validation fails
            }
        }

        // Hide the current page
        document.getElementById(`page-${currentPage}`).classList.remove('active');
        document.getElementById(`step-${currentPage}`).classList.remove('active');

        // Update the current page number
        currentPage += step;

        // Show the new page
        document.getElementById(`page-${currentPage}`).classList.add('active');
        document.getElementById(`step-${currentPage}`).classList.add('active');

        // Disable/enable buttons
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = currentPage === totalPages;
    }

    // Initialize buttons
    document.getElementById('prevBtn').disabled = true;
</script>


</body>
</html>
