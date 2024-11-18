<?php
// require_once "config.php";


// $surname = $first_name = $middle_initial = $student_number = $year_level = $program = $college = $age = $sex = $program_flow = $time_management = $venue = $speaker = $topic = $facilitator = $overall_rating = $comments_speaker = $comments_organizer = "";
// $surname_err = $first_name_err = $middle_initial_err = $student_number_err = $year_level_err = $program_err = $college_err = $age_err = $sex_err = $program_flow_err = $time_management_err = $venue_err = $speaker_err = $topic_err = $facilitator_err = $overall_rating_err = $comments_speaker_err = $comments_organizer_err = "";


// // Processing form data when form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // Validate surname
//     $input_surname = trim($_POST["surname"]);
//     if (empty($input_surname)) {
//         $surname_err = "Please enter your Surname.";
//     } elseif (!filter_var($input_surname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
//         $surname_err = "Please enter a valid Surname.";
//     } else {
//         $surname = $input_surname;
//     }

//     // Validate first name
//     $input_first_name = trim($_POST["first_name"]);
//     if (empty($input_first_name)) {
//         $first_name_err = "Please enter your First Name.";
//     } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
//         $first_name_err = "Please enter a valid First Name.";
//     } else {
//         $first_name = $input_first_name;
//     }

//     // Validate Middle Initial
//     $input_middle_initial = trim($_POST["middle_initial"]);
//     // Check if the input is exactly one letter
//     if (strlen($input_middle_initial) !== 1) {
//         $middle_initial_err = "First Name should be exactly one letter.";
//     }
//     // Check if the input is followed by a period
//     elseif (!preg_match("/^[a-zA-Z]\.$/", $input_middle_initial)) {
//         $middle_initial_err = "First Name should be followed by a period (e.g., 'A.').";
//     } else {
//         $middle_initial = $input_middle_initial;
//     }

//     // Validate student number 
//     $input_student_number = trim($_POST["student_number"]);
//     // Check if the input is empty
//     if (empty($input_student_number)) {
//         $student_number_err = "Please enter your Student Number.";
//     }
//     // Check if the input contains only numbers and is exactly 11 characters long
//     elseif (!preg_match("/^\d{11}$/", $input_student_number)) {
//         $student_number_err = "Student Number should be exactly 11 digits and contain only numbers.";
//     } else {
//         $student_number = $input_student_number;
//     }

//     // Validate year-level
// $input_year_level = trim($_POST["year_level"]);
// if ($input_year_level == "Choose Sex") {
//     $year_level_err = "Please select your Year Level.";
// } else {
//     $sex = $input_year_level;
// }


// // Validate program
// $input_program = trim($_POST["program"]);
// if (empty($input_program)) {
//     $program_err = "Please enter your Program.";
// } elseif (!preg_match("/^BS[a-zA-Z]+$/", $input_program)) {
//     $program_err = "Please enter a valid Program Format e.g. (BSCpE, BSCE, BSME, BSEE).";
// } else {
//     $program = $input_program;
// }

//         // Validate college
// $input_college = trim($_POST["college"]);
// if (empty($input_college)) {
//     $college_err = "Please enter your Program.";
// } elseif  (!filter_var($input_college, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/"))))
// {
//     $college_err = "Please enter a valid Program Format e.g. (BSCpE, BSCE, BSME, BSEE).";
// } else {
//     $college = $input_college;
// }


//     // Validate age
//     $input_age = trim($_POST["age"]);
//     // Check if the input is empty
//     if (empty($input_age)) {
//         $age_err = "Please enter your Age.";
//     }
//     // Check if the input contains only numbers and is exactly 2 characters long
//     elseif (!preg_match("/^\d{2}$/", $input_age)) {
//         $age_err = "Student Number should be exactly 2 digits and contain only numbers.";
//     } else {
//         $student_number = $input_student_number;
//     }

//         // Validate sex
// $input_sex = trim($_POST["sex"]);
// if ($input_sex == "Choose Sex") {
//     $sex_err = "Please select your Sex.";
// } else {
//     $sex = $input_sex;
// }



    // Check input errors before inserting in database
    // if (
    //     empty($surname_err) && empty($first_name_err) && empty($middle_initial_err) && empty($student_number_err)
    //     && empty($college_err) && empty($program_err) && empty($year_level_err) && empty($age_err) && empty($sex_err)
    // )


        // // Prepare an insert statement
        // $sql = "INSERT INTO feedback_event (surname, first_name, middle_initial, student_number, year_level, program, college, age, sex, program_flow, time_management, venue_and_fac, speakers_performers, topics, facilitators, overall_rating, feedback_speakers, feedback_organizers) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // if ($stmt = $mysqli->prepare($sql)) {
        //     // Bind variables to the prepared statement as parameters
        //     $stmt->bind_param(
        //         "ssssssssssssssssss",
        //         $param_surname,
        //         $param_first_name,
        //         $param_middle_initial,
        //         $param_student_number,
        //         $param_year_level,
        //         $param_program,
        //         $param_college,
        //         $param_age,
        //         $param_sex,
        //         $param_program_flow,
        //         $param_time_management,
        //         $param_venue_and_fac,
        //         $param_speakers_performers,
        //         $param_topics,
        //         $param_facilitators,
        //         $param_overall_rating,
        //         $param_feedback_speakers,
        //         $param_feedback_organizers
        //     );


        //     // Set parameters
        //     $param_surname = $surname;
        //     $param_first_name = $first_name;
        //     $param_middle_inititial = $middle_initial;
        //     $param_student_number = $student_number;
        //     $param_year_level = $year_level;
        //     $param_program = $program;
        //     $param_college = $college;
        //     $param_age = $age;
        //     $param_sex = $sex;
        //     $param_program_flow = $program_flow;
        //     $param_time_management = $time_management;
        //     $param_venue_and_fac = $venue;
        //     $param_speakers_performers = $speaker;
        //     $param_topics = $topic;
        //     $param_facilitators = $facilitator;
        //     $param_overall_rating = $overall_rating;
        //     $param_feedback_speakers= $comments_speaker;
        //     $param_feedback_organizers = $comments_organizer;

        //     // Attempt to execute the prepared statement
        //     if ($stmt->execute()) {
        //         // Records created successfully. Redirect to landing page
        //         header("location: index.html");
        //         exit();
        //     } else {
        //         echo "Oops! Something went wrong. Please try again later.";
        //     }
        // }

        // // Close statement
        // $stmt->close();

    // // Close connection
    // $mysqli->close();
// Enable error reporting
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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
    $program_flow = $_POST['program_flow'];
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
    $sql = "INSERT INTO feedback_event (surname, first_name, middle_initial, student_number, year_level, program, college, age, sex, program_flow, time_management, venue_and_fac, speakers_performers, topics, facilitators, overall_rating, feedback_speakers, feedback_organizers) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param(
            "ssssssssssssssssss",
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
            header("location: index.html");
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










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Satisfaction Survey</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="student-form.css"> -->
    <link href="assets/css/student-form.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header text-center text-white" style="background-color: rgba(0, 0, 0, 0.831);">

                <img src="uelogo.png" alt="UE Logo" class="logo">
                <img src="scpes-logo1.png" alt="SCPES Logo" class="logo">
                <h2>Event Satisfaction Survey</h2>
                <p>We value your feedback! Please take a moment to share your thoughts.</p>
            </div>
            <div class="card-body">

                <section>
                    <h1 style="text-align: center;">Event Name (SAO Evaluation)</h1>
                    <p style="text-align: justify;">Thank you for attending the Workshop. We would like to appreciate
                        your feedback and welcome any additional comments that you may have. Your response will be used
                        to enhance our events and activities and ensure that we meet your future needs. We value your
                        responses on this evaluation.</p>
                </section>


                <formid="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


                    <!-- One "tab" for each step in the form: -->
                    <!-- <div class="tab">Name:
                  <p><input placeholder="First name..." oninput="this.className = ''" name="fname"></p>
                  <p><input placeholder="Last name..." oninput="this.className = ''" name="lname"></p>
                </div> -->

                    <div class="tab">
                        <div class="card">
                            <div class="card-body">
                                <p style="font-size: 20px; font-weight: bold;">Data Privacy Consent</p>
                                <p style="text-align: justify;">The collection of data is for the purpose of evaluating
                                    your activity. By signing this form, you are certifying that all information
                                    provided are true and correct and likewise authorizing this office to process your
                                    information. Your accomplished form will be kept in a secure place and will be
                                    disposed of within a reasonable time frame.</p>



                                <div style="overflow:auto;">
                                    <div style="float:right;">
                                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="tab">
                        <div class="card">
                            <div class="card-body">
                                <p style="text-align: justify;">The Society of Computer Engineering Students would like
                                    to hear your feedback on the following event in order to improve our procedures on
                                    event management and facilitation to serve you better in future.</p>
                                <p style="text-align: center; font-weight: bold;">Figma: An Introductory UI Development
                                    Workshop for Beginners </p>
                                <p style="text-align: center; font-weight: bold;">September 20, 2022</p>

                                <p style="text-align: justify;">Privacy Consent: I understand and agree that by
                                    filling-out this form, my personal data will be processed only for the purpose of
                                    evaluating the event and for contacting me for future initiatives that I may be
                                    interested in.
                                    Furthermore, I understand that my personal data will be kept confidential and stored
                                    in a secure location.
                                </p>
                                <p>For queries and concerns, please contact <b>esteban.dylann@ue.edu.ph</b>.</p>

                                <input type="radio" id="consentAnswer" name="consentRadio" value="Yes" required> I do
                                <label for="consentAnswer">I do</label>

                                <div style="text-align: center;">
                                    <label for="i-do">I do</label>
                                    <input type="radio" id="i-do" name="radio" required>
                                  </div>
                                <div style="overflow:auto;">
                                    <div style="float:right;">
                                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->


                    <div class="tab" id="second-tab">
                        <div class="card">
                            <div class="card-body">

                                <p style="text-align: justify;">The Society of Computer Engineering Students would like
                                    to hear your feedback on the following event in order to improve our procedures on
                                    event management and facilitation to serve you better in future.</p>
                                <p style="text-align: center; font-weight: bold;">Figma: An Introductory UI Development
                                    Workshop for Beginners </p>
                                <p style="text-align: center; font-weight: bold;">September 20, 2022</p>

                                <p style="text-align: justify;"><b>Privacy Consent: </b> I understand and agree that by
                                    filling-out this form, my personal data will be processed only for the purpose of
                                    evaluating the event and for contacting me for future initiatives that I may be
                                    interested in.
                                    Furthermore, I understand that my personal data will be kept confidential and stored
                                    in a secure location.
                                </p>
                                <p>For queries and concerns, please contact <b>esteban.dylann@ue.edu.ph</b>.</p><br>
                                <!-- <p contenteditable="true">esteban.dylann@ue.edu.ph. Click here to edit.</p> -->


                                <form id="consentForm">
                                    <label>
                                        <input type="radio" name="consent" value="Yes" required> I consent
                                    </label>

                                    <div style="overflow:auto;">
                                        <div style="float:right;">
                                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                        </div>
                                    </div>
                                </form>




                            </div>
                        </div>
                    </div>


<!-- ORIGINAL thrid-tab -->
                    <!-- <div class="tab" id="third-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">


                                    <label for="surname" style="font-weight: bold;">Surname (in UPPERCASE)</label>
                                    <input type="text" class="form-control" id="surname"
                                        placeholder="Enter your surname" style="padding: 10px;
  margin-bottom: 0px;" required >
                                        <span id="surnameErr" class="error-message" style="color: red;
  font-size: 0.875em;"></span>
                                </div>

                                <div class="form-group">
                                    <label for="first_name" style="font-weight: bold;">First Name (in UPPERCASE)</label>
                                    <input type="text" class="form-control" id="first_name"
                                        placeholder="Enter your first name" required>
                                        <span id="firstNameErr" class="error-message"></span>
                                </div>

                                <div class="form-group">
                                    <label for="middle_initial" style="font-weight: bold;">Middle Initial</label>
                                    <input type="text" class="form-control" id="middle_initial"
                                        placeholder="Enter your middle initial" required>
                                        <span id="middleInitialErr" class="error-message"></span>
                                </div>

                                <div class="form-group">
                                    <label for="student_number" style="font-weight: bold;">Student Number</label>
                                    <input type="text" class="form-control" id="student_number"
                                        placeholder="Enter your student number" required>
                                        <span id="studentNumberErr" class="error-message"></span>
                                </div>

                                <div class="form-group">
                                    <label for="college" style="font-weight: bold;">College</label>
                                    <input type="text" class="form-control" id="college"
                                        placeholder="Enter your College" required>
                                        <span id="collegeErr" class="error-message"></span>
                                </div>
                        
                                <div class="form-group">
                                    <label for="program" style="font-weight: bold;">Program</label>
                                    <input type="text" class="form-control" id="program"
                                        placeholder="Enter your Program" required>
                                        <span id="programErr" class="error-message"></span>
                                </div>

                                <div class="form-group">
                                    <label for="year_level" style="font-weight: bold;">Year Level</label>
                                    <select class="form-control" id="year-level" required>
                                        <option selected="true" disabled="disabled">Choose Year Level</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                    <span id="yearLevelErr" class="error-message"></span>
                                </div>


                                <div class="form-group">
                                    <label for="age" style="font-weight: bold;">Age</label>
                                    <input type="text" class="form-control" id="age" placeholder="Enter your Age"
                                        required>
                                        <span id="ageErr" class="error-message"></span>
                                </div>

                                <div class="form-group">
                                    <label for="sex" style="font-weight: bold;">Sex</label>
                                    <select class="form-control" id="sex" required>
                                    <option selected="true" disabled="disabled">Choose Sex</option>
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                    <span id="sexErr" class="error-message"></span>

                                </div>

                                <div style="overflow:auto;">
                                    <div style="float:right;">
                                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                </div>

                            </div>
                            </form>

                        </div>
                    </div> -->

                    <div class="tab" id="third-tab">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="surname" style="font-weight: bold;">Surname (in UPPERCASE)</label>
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter your surname" value="<?php echo $surname; ?>" style="padding: 10px; margin-bottom: 7px;" required>
                <span id="surnameErr" class="error-message" style="color: red; font-size: 0.875em;"></span>
            </div>

            <div class="form-group">
                <label for="first_name" style="font-weight: bold;">First Name (in UPPERCASE)</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" value="<?php echo $first_name; ?>" style="padding: 10px; margin-bottom: 7px;" required>
                <span id="firstNameErr" class="error-message" style="color: red; font-size: 0.875em;"></span>
            </div>

            <div class="form-group">
                <label for="middle_initial" style="font-weight: bold;">Middle Initial</label>
                <input type="text" class="form-control" id="middle_initial" name="middle_initial" placeholder="Enter your middle initial" value="<?php echo $middle_initial; ?>" style="padding: 10px; margin-bottom: 7px;" required>
                <span id="middleInitialErr" class="error-message" style="color: red; font-size: 0.875em;"></span>
            </div>

            <div class="form-group">
                <label for="student_number" style="font-weight: bold;">Student Number</label>
                <input type="text" class="form-control" id="student_number" name="student_number" placeholder="Enter your student number" value="<?php echo $student_number; ?>" style="padding: 10px; margin-bottom: 7px;" required>
                <span id="studentNumberErr" class="error-message" style="color: red; font-size: 0.875em;"></span>
            </div>

            <div class="form-group">
                <label for="college" style="font-weight: bold;">College</label>
                <input type="text" class="form-control" id="college" name="college" placeholder="Enter your College" value="<?php echo $college; ?>" style="padding: 10px; margin-bottom: 7px;" required>
                <span id="collegeErr" class="error-message" style="color: red; font-size: 0.875em;"></span>
            </div>

            <div class="form-group">
                <label for="program" style="font-weight: bold;">Program</label>
                <input type="text" class="form-control" id="program" name="program" placeholder="Enter your Program" value="<?php echo $program; ?>" style="padding: 10px; margin-bottom: 7px;" required>
                <span id="programErr" class="error-message" style="color: red; font-size: 0.875em;"></span>
            </div>

            <div class="form-group">
                <label for="year_level" style="font-weight: bold;">Year Level</label>
                <select class="form-control" id="year-level" name="year_level" value="<?php echo $year_level; ?>" style="padding: 10px; margin-bottom: 7px;" required>
                    <option selected="true" disabled="disabled">Choose Year Level</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
                <span id="yearLevelErr" class="error-message" style="color: red; font-size: 0.875em;"></span>
            </div>

            <div class="form-group">
                <label for="age" style="font-weight: bold;">Age</label>
                <input type="text" class="form-control" id="age" name="age" placeholder="Enter your Age" value="<?php echo $age; ?>" style="padding: 10px; margin-bottom: 7px;" required>
                <span id="ageErr" class="error-message" style="color: red; font-size: 0.875em;"></span>
            </div>

            <div class="form-group">
                <label for="sex" style="font-weight: bold;">Sex</label>
                <select class="form-control" id="sex" name="sex" value="<?php echo $sex; ?>" style="padding: 10px; margin-bottom: 7px;" required>
                    <option selected="true" disabled="disabled">Choose Sex</option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
                <span id="sexErr" class="error-message" style="color: red; font-size: 0.875em;"></span>
            </div>

            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>




                    <div class="tab">
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
                                    1 - Extremely Poor</p>

                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Program Flow</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                            <input type="radio" name="program_flow" id="program_flow-star5" value="5">
                                            <label for="program_flow-star5">
                                                🤩
                                                <span class="label-text">Excellent</span>
                                            </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="program_flow" id="program_flow-star4" value="4">
                                            <label for="program_flow-star4">
                                                😊
                                                <span class="label-text">Very Satisfactory</span>
                                            </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="program_flow" id="program_flow-star3" value="3">
                                            <label for="program_flow-star3">
                                                😐
                                                <span class="label-text">Satisfactory</span>
                                            </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="program_flow" id="program_flow-star2" value="2">
                                            <label for="program_flow-star2">
                                                😞
                                                <span class="label-text">Poor</span>
                                            </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="program_flow" id="program_flow-star1" value="1">
                                            <label for="program_flow-star1">
                                                😡
                                                <span class="label-text">Extremely Poor</span>
                                            </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Time Management</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                                <input type="radio" name="time_management" id="time_management-star5" value="5">
                                                <label for="time_management-star5">
                                                🤩
                                                <span class="label-text">Excellent</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                                <input type="radio" name="time_management" id="time_management-star4" value="4">
                                                <label for="time_management-star4">
                                                😊
                                                <span class="label-text">Very Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                                <input type="radio" name="time_management" id="time_management-star3" value="3">
                                                <label for="time_management-star3">
                                                😐
                                                <span class="label-text">Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                                <input type="radio" name="time_management" id="time_management-star2" value="2">
                                                <label for="time_management-star2">
                                                😞
                                                <span class="label-text">Poor</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                                <input type="radio" name="time_management" id="time_management-star1" value="1">
                                                <label for="time_management-star1">
                                                😡
                                                <span class="label-text">Extremely Poor</span>
                                                </label>
                                            </div>
                                                
                                        </div>
                                    </div>
                                </div>

                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Venue and Facilities</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                                <input type="radio" name="venue_and_fac" id="venue_and_fac-star5" value="5">
                                                <label for="venue_and_fac-star5">
                                                    🤩
                                                    <span class="label-text">Excellent</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="venue_and_fac" id="venue_and_fac-star4" value="4">
                                                <label for="venue_and_fac-star4">
                                                    😊
                                                    <span class="label-text">Very Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="venue_and_fac" id="venue_and_fac-star3" value="3">
                                                <label for="venue_and_fac-star3">
                                                    😐
                                                    <span class="label-text">Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="venue_and_fac" id="venue_and_fac-star2" value="2">
                                                <label for="venue_and_fac-star2">
                                                    😞
                                                    <span class="label-text">Poor</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="venue_and_fac" id="venue_and_fac-star1" value="1">
                                                <label for="venue_and_fac-star1">
                                                    😡
                                                    <span class="label-text">Extremely Poor</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Speakers/Performers</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                            <input type="radio" name="speakers_performers"
                                                id="speakers_performers-star5" value="5">
                                                <label for="peakers_performers-star5">
                                                    🤩
                                                    <span class="label-text">Excellent</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="speakers_performers"
                                                id="speakers_performers-star4" value="4">
                                                <label for="peakers_performers-star4">
                                                    😊
                                                    <span class="label-text">Very Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="speakers_performers"
                                                id="speakers_performers-star3" value="3">
                                                <label for="peakers_performers-star3">
                                                    😐
                                                    <span class="label-text">Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="speakers_performers"
                                                id="speakers_performers-star2" value="2">
                                                <label for="peakers_performers-star2">
                                                    😞
                                                    <span class="label-text">Poor</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="speakers_performers"
                                                id="speakers_performers-star1" value="1">
                                                <label for="peakers_performers-star1">
                                                    😡
                                                    <span class="label-text">Extremely Poor</span>
                                                </label>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>

                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4> Topics/Quality of Performances</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                            <input type="radio" name="topics" id="topics-star5" value="5">
                                                <label for="topics-star5">
                                                    🤩
                                                    <span class="label-text">Excellent</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="topics" id="topics-star4" value="4">
                                                <label for="topics-star4">
                                                    😊
                                                    <span class="label-text">Very Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="topics" id="topics-star3" value="3">
                                                <label for="topics-star3">
                                                    😐
                                                    <span class="label-text">Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="topics" id="topics-star2" value="2">
                                                <label for="topics-star2">
                                                    😞
                                                    <span class="label-text">Poor</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="topics" id="topics-star1" value="1">
                                                <label for="topics-star1">
                                                    😡
                                                    <span class="label-text">Extremely Poor</span>
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
                                            <input type="radio" name="facilitators" id="facilitators-star5" value="5">
                                                <label for="facilitators-star5">
                                                    🤩
                                                    <span class="label-text">Excellent</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="facilitators" id="facilitators-star4" value="4">
                                                <label for="facilitators-star4">
                                                    😊
                                                    <span class="label-text">Very Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="facilitators" id="facilitators-star3" value="3">
                                                <label for="facilitators-star3">
                                                    😐
                                                    <span class="label-text">Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="facilitators" id="facilitators-star2" value="2">
                                                <label for="facilitators-star2">
                                                    😞
                                                    <span class="label-text">Poor</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="facilitators" id="facilitators-star1" value="1">
                                            <label for="facilitators-star1">
                                                😡
                                                <span class="label-text">Extremely Poor</span>
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Overall Rating for the Activity</h4>
                                        <div class="survey-container">
                                            <div class="emoji-container">
                                            <input type="radio" name="overall_rating" id="overall_rating-star5" value="5">
                                                <label for="overall_rating-star5">
                                                    🤩
                                                    <span class="label-text">Excellent</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="overall_rating" id="overall_rating-star4" value="4">
                                                <label for="overall_rating-star4">
                                                    😊
                                                    <span class="label-text">Very Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="overall_rating" id="overall_rating-star3" value="3">
                                                <label for="overall_rating-star3">
                                                    😐
                                                    <span class="label-text">Satisfactory</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="overall_rating" id="overall_rating-star2" value="2">
                                                <label for="overall_rating-star2">
                                                    😞
                                                    <span class="label-text">Poor</span>
                                                </label>
                                            </div>
                                            <div class="emoji-container">
                                            <input type="radio" name="overall_rating" id="overall_rating-star1" value="1">
                                                <label for="overall_rating-star1">
                                                    😡
                                                    <span class="label-text">Extremely Poor</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" style="margin: 5px;">
                                    <div class="card-body">
                                        <h4>Comments and Suggestion for the Speakers</h4>
                                        <textarea name="feedback_speakers" rows="4"
                                            placeholder="Kindly place your comments for our guest speaker here. (Optional)"
                                            style="width: 100%; padding: 10px;"> <?php echo $comments_speaker; ?></textarea>
                                    </div>
                                </div>

                                <div class="card" style="margin: 5px; margin-bottom: 10px;">
                                    <div class="card-body">
                                        <h4>Comments and Suggestion for the Organizers (SCpES and DCpE)</h4>
                                        <textarea name="feedback_organizers" rows="4"
                                            placeholder="Kindly place your comments for our organizers here. (Optional)"
                                            style="width: 100%; padding: 10px;"><?php echo $comments_organizer; ?></textarea>
                                    </div>
                                </div>


                                <div style="overflow:auto;">
                                    <div style="float:right;">
                                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                        <!-- i should change this  to submit -->
                                        <!-- <button type="button" id="nextBtn" onclick="nextPrev(1)">Submit</button> -->
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>






                    <div class="tab">
                        <div class="card">
                            <div class="card-body">

                                <center>
                                    <p style="font-family: Courier New; font-size: 15px; font-weight: bold;"> Thank You
                                        for your participation in the SCpES and DCpE 2023 conference. <br><br>
                                        We hope you enjoyed the conference and we look forward to seeing you again in
                                        the future. </p>
                                </center>




                                <div style="overflow:auto;">
                                    <div style="float:right;">
                                        <!-- <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button> -->
                                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                        <button type="button"
                                            onclick="window.open('', '_self', ''); window.close();">Exit</button>
                                    </div>
                                </div>

                            </div>
                            <!-- <div style="overflow:auto;">
                            <div style="float:right;">
                              <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                              <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                          </div> -->


                        </div>
                    </div>


            </div>






            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>






            </formid=>
        </div>
    </div>





    <div class="mt-3" id="thanksMessage" style="display: none;">
        <div class="alert alert-success text-center">
            Thank you for your feedback!
        </div>
    </div>

    <div class="mt-5">
        <canvas id="ratingChart" width="400" height="400"></canvas>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- <script src="student-form.js"></script> -->
    <!-- <script src="assets/js/student-form.js"></script> -->
    <script src="assets/js/student-formnew.js"></script>

</body>

</html>