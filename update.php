<?php
// Include config file
require_once "config.php";

// Initialize variables
$event_name = $event_date = $event_start_time = $event_end_time = $event_venue = $event_speaker = "";
$event_name_err = $event_date_err = $event_start_time_err = $event_end_time_err = $time_err = $event_venue_err = $event_speaker_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate event name
    $input_event_name = trim($_POST["id_event_name"]);
    if (empty($input_event_name)) {
        $event_name_err = "Please enter a name.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $input_event_name)) {
        $event_name_err = "Please enter a valid name.";
    } else {
        $event_name = $input_event_name;
    }

    // Validate event date
    $input_date = trim($_POST["id_event_date"]);
    $tomorrow_date = date("Y-m-d", strtotime("+1 day"));
    if (empty($input_date)) {
        $event_date_err = "Please enter a date.";
    } elseif ($input_date < $tomorrow_date) {
        $event_date_err = "Please enter a date from tomorrow onwards.";
    } else {
        $event_date = $input_date;
    }

    // Validate start and end times
    $input_start_time = trim($_POST["id_event_start_time"]);
    $input_end_time = trim($_POST["id_event_end_time"]);
    if (empty($input_start_time)) {
        $event_start_time_err = "Please enter a start time.";
    } elseif (empty($input_end_time)) {
        $event_end_time_err = "Please enter an end time.";
    } elseif (strtotime($input_start_time) >= strtotime($input_end_time)) {
        $time_err = "Start time must be before end time.";
    } else {
        $event_start_time = $input_start_time;
        $event_end_time = $input_end_time;
    }

    // Validate event venue
    $input_venue = trim($_POST["id_event_venue"]);
    if (empty($input_venue)) {
        $event_venue_err = "Please enter the event venue.";
    } else {
        $event_venue = $input_venue;
    }

    // Validate event speaker
    $input_speaker = trim($_POST["id_event_speaker"]);
    if (empty($input_speaker)) {
        $event_speaker_err = "Please enter the speaker.";
    } else {
        $event_speaker = $input_speaker;
    }

    // Check for errors
    if (empty($event_name_err) && empty($event_date_err) && empty($event_start_time_err) && empty($event_end_time_err)
        && empty($time_err) && empty($event_venue_err) && empty($event_speaker_err)) {
        
        // Update query
        $sql = "UPDATE create_event SET event_name = ?, event_date = ?, event_start_time = ?, event_end_time = ?, event_venue = ?, event_speaker = ? WHERE id = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssi", $event_name, $event_date, $event_start_time, $event_end_time, $event_venue, $event_speaker, $id);

            // Execute the statement
            if ($stmt->execute()) {
                // Redirect to the index page or show a success message
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $mysqli->close();
} else {
    // Check for valid id in GET request
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $sql = "SELECT * FROM create_event WHERE id = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $event_name = $row["event_name"];
                    $event_date = $row["event_date"];
                    $event_start_time = $row["event_start_time"];
                    $event_end_time = $row["event_end_time"];
                    $event_venue = $row["event_venue"];
                    $event_speaker = $row["event_speaker"];
                } else {
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        $stmt->close();
    } else {
        header("location: error.php");
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Update Event Record</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="scpeslogo.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style-analytics.css" rel="stylesheet">

  <!-- QRCode.js Library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center light-background sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <img src="scpes-logo1.png" alt="">
        <span class="d-none d-lg-block" style="color: #e4e4e4;">SCPES</span>
      </a>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul>
        <li><a href="index.php" class="zoom-link" style="color: #e4e4e4; margin-right: 18px;">Dashboard</a></li>
        <li><a href="deleted-page.php" class="zoom-link" style="color: #e4e4e4; margin-right: 25px;">Archive</a></li>
      </ul>
  </nav>

  <div>  
    <a class="nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" style=" background-color: transparent;">
      <img src="uelogo.png" alt="Profile" class="rounded-circle" style="max-height: 36px;">
      <span class="d-none d-md-block dropdown-toggle ps-2 zoom-link" style="color: #e4e4e4; margin-right: 30px;">Admin</span>
    </a><!-- End Profile Iamge Icon -->

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
      <a  href="pages-login.php" class="dropdown-item d-flex align-items-center" href="#">
        <i class="bi bi-box-arrow-right"></i>
        <span>Sign Out</span>
      </a>
    </ul><!-- End Profile Dropdown Items -->
    
  </div>

</header><!-- End Header -->

  <main id="main" class="main" style="margin: 10px;">

    <div class="pagetitle">
      <h1 style="font-size: 35px;">Update Event Record</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"style="color: #555555;" >Dashboard</a></li>
          <li class="breadcrumb-item active" style="color: #555555;">Update event</li>
        </ol>
      </nav>
      <p style="margin-bottom: 0; padding-bottom: 0;">Please edit the input values and submit to update the event record.</p>
</div><!-- End Page Title -->

<div class="container mt-3">
  <div class="card shadow" style="border-radius: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
    <div class="card-body" style="padding: 20px; font-family: 'Montserrat', sans-serif; background-color: #dae6ed; border-radius: 20px;">
      <!-- Vertical Form -->
    <form class="row g-3 needs-validation" id="eventForm" action="<?php echo htmlspecialchars(basename($_SERVER["REQUEST_URI"])); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="col-12">
        <label for="id_event_name" class="form-label">Event Name</label>
        <input type="text" class="form-control <?php echo (!empty($event_name_err)) ? 'is-invalid' : ''; ?>" name="id_event_name" style="text-transform: capitalize" value="<?php echo $event_name; ?>" required>
        <div class="invalid-feedback">
          <?php echo $event_name_err; ?>
        </div>
      </div>
      <div class="col-12">
        <label for="id_event_date" class="form-label">Event Date</label>
        <input type="date" class="form-control <?php echo (!empty($event_date_err)) ? 'is-invalid' : ''; ?>" name="id_event_date" value="<?php echo $event_date; ?>" required>
        <div class="invalid-feedback">
        <?php echo $event_date_err; ?>
        </div>
      </div>
      <div class="row" style="margin: 0px; padding: 0px;">
        <div class="col">
          <label for="id_event_start_time" class="form-label">Start Time</label>
          <input type="time" class="form-control <?php echo (!empty($event_start_time_err)) ? 'is-invalid' : ''; ?>" name="id_event_start_time" value="<?php echo $event_start_time; ?>" required>
          <div class="invalid-feedback">
          <?php echo $event_start_time_err; ?>
          </div>
        </div>
        <div class="col">
          <label for="id_event_end_time" class="form-label">End Time</label>
          <input type="time" class="form-control <?php echo (!empty($event_end_time_err)) ? 'is-invalid' : ''; ?>" name="id_event_end_time" value="<?php echo $event_end_time; ?>" required>
          <div class="invalid-feedback">
          <?php echo $event_end_time_err; ?>
        </div>
        </div>
      </div>

      <div class="col-12">
        <label for="id_event_venue" class="form-label">Event Venue</label>
        <input type="text" class="form-control <?php echo (!empty($event_venue_err)) ? 'is-invalid' : ''; ?>" name="id_event_venue" style="text-transform: capitalize" value="<?php echo $event_venue; ?>" required>
        <div class="invalid-feedback">
        <?php echo $event_venue_err; ?>
      </div>
      </div>
      <div class="col-12">
        <label for="id_event_speaker" class="form-label">Event Speaker/s</label>
        <input type="text" class="form-control <?php echo (!empty($event_speaker_err)) ? 'is-invalid' : ''; ?>" name="id_event_speaker" style="text-transform: capitalize" value="<?php echo $event_speaker; ?>" required>
        <div class="invalid-feedback">
        <?php echo $event_speaker_err; ?>
        </div>
      </div>
      <div class="text-center" style="margin-top: 40px;">
        <button type="submit" class="btn btn-primary" style="margin: 5px;" data-toggle="modal" data-target="#createEventModal">Submit</button>
        <!-- <button type="reset" class="btn btn-secondary" style="margin: 5px;">Reset</button> -->
        <a href="index.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
    </div>
  </div>
</div>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Project-Wolfgang Developers</span></strong>. All Rights Reserved
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>


  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



</body>

</html>
