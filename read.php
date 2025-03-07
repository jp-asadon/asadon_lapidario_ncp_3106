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
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Society of Computer Engineering Students - UE Manila</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="scpeslogo.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
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
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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

  <main id="main" class="main"  style="margin: 20px; display: flex; justify-content: center; align-items: center;">

    <section class="event-details">
        <h2><strong>Event Details</strong></h2>
        <div class="details-body">  
          <div class="info-container">

          <div class="info-row">
                <p class="label"><strong>Event Name:</strong></p>
                <p><?php echo $row["event_name"]; ?></p>
          </div>

          <div class="info-row">
                <p class="label"><strong>Event Date:</strong></p>
                <p><?php echo $row["event_date"]; ?></p>
          </div>

          <div class="info-row">
                <p class="label"><strong>Event Time:</strong></p>
                <p><?php echo htmlspecialchars($row['event_start_time']) . " - " . htmlspecialchars($row['event_end_time']); ?></p>
          </div>

          <div class="info-row">
                <p class="label"><strong>Venue:</strong></p>
                <p><?php echo htmlspecialchars($row['event_venue']); ?></p>
          </div>

          <div class="info-row">
                <p class="label"><strong>Speakers:</strong></p>
                <p><?php echo htmlspecialchars($row['event_speaker']); ?></p>
          </div>
        </div>

          <!-- <div class="image-container">
            <img src="" alt="Event Image"> I would like to display the qrcode image of an event based on the event id. How can I do this? Per event, a table on  my database holds
            value for my qr image in a png form like for example 1732187508.png. 
            This qr code is in my directory "images/" I want to get ther names to use for my img src="".
          </div> -->
          <div class="image-container">
    <img src="images/<?php echo htmlspecialchars($qrimage); ?>" alt="Event QR Code" class="img-fluid">
</div>

        </div>

        <div class="download-container">
          <a href="images/<?php echo htmlspecialchars($qrimage); ?>" class="btn-download" download>Download QR</a>
        </div>

      </div>
    </section>

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