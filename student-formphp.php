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

    $sql = "INSERT INTO feedback_event (event_id, surname, first_name, middle_initial, student_number, year_level, program, college, age, sex)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param(
            "isssisssis",
            $param_event_id,
            $param_surname,
            $param_first_name,
            $param_middle_initial,
            $param_student_number,
            $param_year_level,
            $param_program,
            $param_college,
            $param_age,
            $param_sex
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
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header text-center text-white" style="background-color: rgba(0, 0, 0, 0.831);">
                <h2>Event Satisfaction Survey</h2>
                <p>We value your feedback! Please take a moment to share your thoughts.</p>
            </div>
            <div class="card-body">
                <h1 class="text-center"><?php echo htmlspecialchars($event_name); ?></h1>
                <p class="text-center"><?php echo htmlspecialchars($event_date . " | " . $event_venue); ?></p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $_GET["id"]; ?>" method="post">
                    <!-- Form Fields -->
                    <label>Surname</label>
                    <input type="text" name="surname" class="form-control" required>
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                    <label>Middle Initial</label>
                    <input type="text" name="middle_initial" class="form-control">
                    <label>Student Number</label>
                    <input type="text" name="student_number" class="form-control" required>
                    <label>Year Level</label>
                    <select name="year_level" class="form-control" required>
                        <option disabled selected>Choose Year Level</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <label>Program</label>
                    <input type="text" name="program" class="form-control" required>
                    <label>College</label>
                    <input type="text" name="college" class="form-control" required>
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" required>
                    <label>Sex</label>
                    <select name="sex" class="form-control" required>
                        <option disabled selected>Choose Sex</option>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
