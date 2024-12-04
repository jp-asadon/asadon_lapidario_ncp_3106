

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Society of Computer Engineering Students - UE Manila</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->

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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
        <img src="scpeslogo.png" alt="">
        <span class="d-none d-lg-block" style="color: #e4e4e4;">SCPES</span>
      </a>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul>
        <li><a href="index.php" class="zoom-link" style="color: #e4e4e4;">Dashboard</a></li>
        <li><a href="results.html" class="zoom-link" style="color: #e4e4e4;">Results</a></li>
      </ul>
  </nav>

  <div>  
    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
      <img src="uelogo.png" alt="Profile" class="rounded-circle" style="max-height: 36px;">
      <span class="d-none d-md-block dropdown-toggle ps-2" style="color: #e4e4e4;">Admin</span>
    </a><!-- End Profile Iamge Icon -->

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
      <a  href="pages-login.php" class="dropdown-item d-flex align-items-center" href="#">
        <i class="bi bi-box-arrow-right"></i>
        <span>Sign Out</span>
      </a>
    </ul><!-- End Profile Dropdown Items -->
    
  </div>

</header><!-- End Header -->

  <main id="main" class="main"  style="margin: 20px;">


    <div class="pagetitle">
      <h1 style="font-weight: bold; font-size: 30px; color: #2a2a2a;">Deleted Events</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php" style="color: #555555;">Dashboard</a></li>
          <li class="breadcrumb-item active"></li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">

    <div class="card info-card customers-card" style="height: 410px;">
        <!-- Card Header -->
        <div style="position: sticky; top: 0; background-color: white; z-index: 1; padding: 15px; border-bottom: 1px solid #ddd;">
            <h1 style="margin: 0;">EVENT LIST</h1>
        </div>
        
        <!-- Card Body -->
        <div class="card-body" style="height: 410px; overflow-y: auto; padding: 15px;">
            <?php
            require_once("config.php");

            $sql = "SELECT * FROM create_event WHERE delete_event = 1";

            if ($result = $mysqli->query($sql)) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="card info-card customers-card mb-3">
                            <div class="card-body" style="color: #555555; padding: 10px; border-radius: 10px;">
                                <div class="row">
                                    <div class="col-lg-2 d-flex align-items-center justify-content-center" style="background-color: aqua; padding: 10px;">
                                        <img src="assets/img/ardui.jpg" style="height: 120px; width: 120px; object-fit: scale-down;">
                                    </div>
                                    
                                    <div class="col-lg-5" style="padding: 10px;">
                                        <div class="form-group">
                                            <label>Event Name</label>
                                            <p style="margin-bottom: 5px; font-weight: bold;">
                                                  <?php echo htmlspecialchars($row['event_name']); ?> 
                                                  <a href="analytics-page.php?id=<?php echo $row['id']; ?>" style="font-size: 20px; text-decoration: none;" target="_blank" data-toggle="tooltip" title="Show Event Survey Result">
                                                      <i class="fa">&#xf200;</i>
                                                  </a>
                                              </p>
                                        </div> 
                                        <div class="form-group">
                                            <label>Date</label>
                                            <p style="margin-bottom: 5px; font-weight: bold;"><?php echo htmlspecialchars($row['event_date']); ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Time</label>
                                            <p style="margin-bottom: 5px; font-weight: bold;"><?php echo htmlspecialchars($row['event_start_time']) . " - " . htmlspecialchars($row['event_end_time']); ?></p>
                                        </div>
                                    </div>

                                    <div class="col-lg-5" style="padding: 10px;">
                                        <div class="form-group">
                                            <label>Event Venue</label>
                                            <p style="margin-bottom: 5px; font-weight: bold;"><?php echo htmlspecialchars($row['event_venue']); ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Event Speaker/s</label>
                                            <p style="margin: 0; font-weight: bold;"><?php echo htmlspecialchars($row['event_speaker']); ?></p>
                                        </div>

                                        <!-- Buttons for View, Edit, Delete -->
                                        <div class="mt-3 d-flex justify-content-start">

                                            <button class="btn btn-danger delete-btn" title="Delete Event" data-id="<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="bi bi-trash"></i> Restore
</button>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No events found.</p>";
                }
            } else {
                echo "<p>Error: Could not execute query.</p>";
            }
            ?>

            
        </div>

        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">DELETE RECORD</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- <form>
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" />
                            <p>Are you sure you want to delete this event record?</p>
                        </div>
                    </form> -->


                </div>
            </div>
        </div>
    </div>
<form method="POST" action="restore.php">
    <div class="modal-body">
        <div class="alert alert-danger">
            <input type="hidden" name="id" />
            <p>Are you sure you want to RESTORE this event record?</p>
        </div>
    </div>
    <div class="modal-footer">
        <input type="submit" value="Yes" class="btn btn-danger">
        <button type="button" class="btn btn-secondary ml-2" data-bs-dismiss="modal">No</button>
    </div>
</form>
      </div>
    </div>
  </div>
</div>
    </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Project-Wolfgang Developers</span></strong>. All Rights Reserved
    <!-- </div>
     Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div> -->
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

<!-- Include Bootstrap JS (at the bottom of your page) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <script>

      // Enable Bootstrap tooltips
      $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });


    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const eventId = this.getAttribute('data-id');
                document.querySelector('#exampleModal input[name="id"]').value = eventId;
            });
        });
    });


    document.querySelectorAll('.filter-option').forEach(option => {
  option.addEventListener('click', function (e) {
    e.preventDefault();
    const filter = this.getAttribute('data-filter');

    // Fetch filtered data via AJAX
    fetch('filter_events.php?filter=' + filter)
      .then(response => response.text())
      .then(data => {
        document.getElementById('activity-list').innerHTML = data;
      })
      .catch(err => console.error('Error fetching events:', err));
  });
});

// Load default events (all upcoming events) on page load
fetch('filter_events.php?filter=all')
  .then(response => response.text())
  .then(data => {
    document.getElementById('activity-list').innerHTML = data;
  })
  .catch(err => console.error('Error loading default events:', err));
</script>
</body>

</html>