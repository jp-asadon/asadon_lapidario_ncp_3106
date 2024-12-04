

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
        <img src="scpes-logo1.png" alt="">
        <span class="d-none d-lg-block" style="color: #e4e4e4;">SCPES</span>
      </a>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul>
        <li><a href="index.php" class="zoom-link" style="color: #e4e4e4;">Dashboard</a></li>
        <li><a href="deleted-page.php" class="zoom-link" style="color: #e4e4e4;">Archive</a></li>
      </ul>
  </nav>

  <div>  
    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
      <img src="uelogo.png" alt="Profile" class="rounded-circle" style="max-height: 36px;">
      <span class="d-none d-md-block dropdown-toggle ps-2" style="color: #e4e4e4; margin-right: 10px;">Admin</span>
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
      <h1 style="font-weight: bold; font-size: 30px; color: #2a2a2a;">Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php" style="color: #555555;">Dashboard</a></li>
          <li class="breadcrumb-item active"></li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Right side columns -->
        <div class="col-lg-4">

          <div class="card info-card customers-card" style="border-radius: 15px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); transition: box-shadow 0.3s ease;" onmouseover="this.style.boxShadow='0 12px 24px rgba(0, 0, 0, 0.3)'" 
          onmouseout="this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.2)'">

            <div class="card-body">  <a href="create-event.php">
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-calendar-plus"></i>
                </div>
                <div class="ps-3">
                  <h6 style="color: #2a2a2a;">
                  Create New Event</h6>
                </div>
              </div>
            </a>
            </div>
          </div>

          <!-- Recent Activity -->
          <div class="card" style="height: 300px; overflow-y: auto;">
  <div class="filter" style="background-color: #2a2a2a">
    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
      <li class="dropdown-header text-start">
        <h6>Filter</h6>
      </li>
      <li><a class="dropdown-item filter-option" href="#" data-filter="all">All</a></li>
      <li><a class="dropdown-item filter-option" href="#" data-filter="today">Today</a></li>
      <li><a class="dropdown-item filter-option" href="#" data-filter="week">This Week</a></li>
      <li><a class="dropdown-item filter-option" href="#" data-filter="month">This Month</a></li>
    </ul>
  </div>

  <div class="card-body">
    <h5 class="card-title sticky-title">Upcoming Events</h5>
    <div class="activity" id="activity-list">
    <p>Loading events...</p>

</div>



            </div>
          </div><!-- End Recent Activity -->

        </div><!-- End Right side columns -->


<!-- Left side columns -->
<div class="col-sm-8" style="height: 410px;">
    <!-- Customers Card -->
    <div class="card info-card customers-card" style="height: auto; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); overflow: hidden;">

        <!-- Card Header -->
        <div style="font-family: 'Poppins', sans-serif; position: sticky; top: 0; background-color: #ffffff; z-index: 1; padding: 15px 10px; border-bottom: 2px solid #e6e6e6; text-align: center;">
            <h6 style="margin: 0; font-size: 28px; color: #333; font-weight: 600;">List of Events</h6>
        </div>

        <!-- Tabs for Filtering -->
        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist" style="border-bottom: 1px solid #ddd;">
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" onclick="filterEvents('all')" type="button" 
                    style="border-radius: 5px; font-size: 14px; font-weight: 500; color: #555; transition: background-color 0.3s, color 0.3s;">
                    ALL
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" onclick="filterEvents('upcoming')" type="button" 
                    style="border-radius: 5px; font-size: 14px; font-weight: 500; color: #555; transition: background-color 0.3s, color 0.3s;">
                    Current and Upcoming Events
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" onclick="filterEvents('past')" type="button" 
                    style="border-radius: 5px; font-size: 14px; font-weight: 500; color: #555; transition: background-color 0.3s, color 0.3s;">
                    Past Events
                </button>
            </li>
        </ul>

        <!-- Card Body -->
        <div class="card-body d-flex flex-column" style="max-height: 340px; overflow-y: auto; padding: 20px; font-family: 'Montserrat', sans-serif; background-color: #fff;">
            <!-- PHP Code for Event Listing -->
            <?php
                require_once("config.php");



// Determine the filter type based on the URL parameter
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$currentDateTime = date('Y-m-d H:i:s'); // Get the current date and time

// Base SQL query
$sql = "SELECT * FROM create_event WHERE delete_event = 0";

// Add conditions for filtering
if ($filter === 'upcoming') {
    $sql .= " AND CONCAT(event_date, ' ', event_start_time) >= '$currentDateTime'";
} elseif ($filter === 'past') {
    $sql .= " AND CONCAT(event_date, ' ', event_start_time) < '$currentDateTime'";
}

// Add sorting for events
$sql .= " ORDER BY event_date ASC, event_start_time ASC";

// Execute the query
if ($result = $mysqli->query($sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>

<div class="card info-card customers-card mb-3" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="card-body" style="color: #555555; padding: 15px; border-radius: 10px;">
        <div class="row align-items-center d-flex flex-wrap">
            <!-- Image Column -->
            <div class="col-lg-3 col-md-4 col-12 d-flex justify-content-center" style="padding: 10px;">
                <img src="assets/img/ardui.jpg" style="height: 120px; width: 120px; object-fit: cover; border-radius: 8px; border: 2px solid #ddd;">
            </div>

            <!-- Event Information Column -->
            <div class="col-lg-4 col-md-4 col-12" style="padding: 10px;">
                <div class="form-group">
                    <label>Event Name</label>
                    <p style="margin-bottom: 5px; font-weight: bold;">
                      <a href="analytics-page.php?id=<?php echo $row['id']; ?>" 
                        style="font-size: 20px; text-decoration: none; display: flex; align-items: center;" 
                        target="_blank" 
                        data-toggle="tooltip" 
                        title="Show Event Survey Result">
                          <?php echo htmlspecialchars($row['event_name']); ?> 
                          <i class="fa" style="margin-left: 10px;">&#xf200;</i>
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

            <!-- Event Venue and Speaker Column -->
            <div class="col-lg-4 col-md-4 col-12" style="padding: 10px;">
                <div class="form-group">
                    <label>Event Venue</label>
                    <p style="margin-bottom: 5px; font-weight: bold;"><?php echo htmlspecialchars($row['event_venue']); ?></p>
                </div>
                <div class="form-group">
                    <label>Event Speaker/s</label>
                    <p style="margin: 0; font-weight: bold;"><?php echo htmlspecialchars($row['event_speaker']); ?></p>
                </div>

                <!-- Buttons for View, Edit, Delete -->
                <div class="mt-3 d-flex justify-content-start" style="flex-wrap: nowrap;">
                    <!-- View Event Details -->
                    <a href="read.php?id=<?php echo $row['id']; ?>" 
                      class="btn btn-primary me-2 d-flex align-items-center px-3 py-2" 
                      title="View Event" 
                      style="white-space: nowrap; font-size: 14px;">
                        <i class="bi bi-eye me-1"></i> <span>View</span>
                    </a>

                    <!-- Update Event Details -->
                    <a href="update.php?id=<?php echo $row['id']; ?>" 
                      class="btn btn-warning me-2 d-flex align-items-center px-3 py-2" 
                      title="Update Event" 
                      style="white-space: nowrap; font-size: 14px;">
                        <i class="bi bi-pencil me-1"></i> <span>Update</span>
                    </a>

                    <!-- Delete Event -->
                    <button class="btn btn-danger delete-btn d-flex align-items-center px-3 py-2" 
                            title="Delete Event" 
                            data-id="<?php echo $row['id']; ?>" 
                            data-bs-toggle="modal" 
                            data-bs-target="#exampleModal" 
                            style="white-space: nowrap; font-size: 14px;">
                        <i class="bi bi-trash me-1"></i> <span>Delete</span>
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

            
        </div>''
    </div>
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
<form method="POST" action="archive.php">
    <div class="modal-body">
        <div class="alert alert-danger">
            <input type="hidden" name="id" />
            <p>Are you sure you want to delete this event record?</p>
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

function filterEvents(filter) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('filter', filter);
    window.location.search = urlParams.toString();
}


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

<style>
    /* Hover effect for the tabs */
    .nav-link {
        transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition */
        font-weight: 500;
        color: #555;
    }

    .nav-link:hover {
        background-color: #f0f0f0; /* Light background on hover */
        color: #333; /* Darker text on hover */
    }

    .nav-link.active {
        background-color: #e6e6e6; /* Light background for active tab */
        color: #333; /* Darker text for active tab */
    }
</style>

</body>

</html>