<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";

    // Fetch the most recent update timestamp
$last_updated_sql = "SELECT MAX(last_updated) AS last_updated FROM feedback_event";
$last_updated_result = $mysqli->query($last_updated_sql);

$last_updated_time = null;
if ($last_updated_result && $last_updated_result->num_rows > 0) {
    $last_updated_row = $last_updated_result->fetch_assoc();
    $last_updated_time = $last_updated_row['last_updated'];
}


    // Prepare a SQL statement with a JOIN
    $sql = "
        SELECT 
            ce.event_name, 
            ce.event_date, 
            ce.event_start_time, 
            ce.event_venue, 
            ce.event_speaker, 
            ce.qrimage, 
            fe.feedback_id,
            fe.surname,
            fe.first_name,
            fe.middle_initial,
            fe.student_number,
            fe.year_level,
            fe.program,
            fe.college,
            fe.age,
            fe.sex,
            fe.program_flow,
            fe.time_management,
            fe.venue,
            fe.speaker,
            fe.topic,
            fe.facilitator,
            fe.overall_rating,
            fe.comments_speaker,
            fe.comments_organizer
        FROM create_event ce
        LEFT JOIN feedback_event fe ON ce.id = fe.event_id
        WHERE ce.id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch all rows as an associative array
                $feedback_data = [];
                while ($row = $result->fetch_assoc()) {
                    $feedback_data[] = $row;
                }

                // Now assign $event_name from the first row  
                $event_name = $feedback_data[0]["event_name"];

                // THIS IS FOR AVERAGES

                                    // Initialize variables to store total scores and counts for each metric
                    $totals = [
                        'program_flow' => 0,
                        'time_management' => 0,
                        'venue' => 0,
                        'speaker' => 0,
                        'topic' => 0,
                        'facilitator' => 0,
                        'overall_rating' => 0,
                    ];
                    $counts = [
                        'program_flow' => 0,
                        'time_management' => 0,
                        'venue' => 0,
                        'speaker' => 0,
                        'topic' => 0,
                        'facilitator' => 0,
                        'overall_rating' => 0,
                    ];

                    // Loop through feedback data and calculate totals and counts
                    foreach ($feedback_data as $feedback) {
                        foreach ($totals as $metric => &$total) {
                            if (isset($feedback[$metric]) && is_numeric($feedback[$metric])) {
                                $total += $feedback[$metric];
                                $counts[$metric]++;
                            }
                        }
                    }

                    // Calculate averages
                    $averages = [];
                    foreach ($totals as $metric => $total) {
                        $averages[$metric] = $counts[$metric] > 0 ? $total / $counts[$metric] : 0;
                    }

                    $averages_json = json_encode(array_values(array: $averages));


                    // Close statement and database connection
                    $stmt->close();
                    $mysqli->close();

                //END OF AVERAGES

                $adjectives = ["good", "great", "excellent", "amazing", "fantastic", "bad", "poor", 
                "horrible", "terrible", "awesome", "boring", "thanks", "thank you", "appreciate",
                "satisfactory", "nice", "organized", "unorganized", "insightful", "fair", "fun"]; // Add more adjectives as needed

                $word_counts = []; // Initialize an array for word counts
                
                // Loop through the feedback data and count words from both columns
                foreach ($feedback_data as $feedback) {
                    // Process comments_organizer if not empty
                    if (!empty($feedback['comments_organizer'])) {
                        $words = preg_split('/[\s,.;!?]+/', strtolower($feedback['comments_organizer']));
                        foreach ($words as $word) {
                            $word = trim($word); // Trim whitespace
                            if (!empty($word) && in_array($word, $adjectives)) { // Check if the word is an adjective
                                if (!isset($word_counts[$word])) {
                                    $word_counts[$word] = 0;
                                }
                                $word_counts[$word]++;
                            }
                        }
                    }
                
                    // Process comments_speaker if not empty
                    if (!empty($feedback['comments_speaker'])) {
                        $words = preg_split('/[\s,.;!?]+/', strtolower($feedback['comments_speaker']));
                        foreach ($words as $word) {
                            $word = trim($word); // Trim whitespace
                            if (!empty($word) && in_array($word, $adjectives)) { // Check if the word is an adjective
                                if (!isset($word_counts[$word])) {
                                    $word_counts[$word] = 0;
                                }
                                $word_counts[$word]++;
                            }
                        }
                    }
                }
                
                // Sort words by count in descending order
                arsort($word_counts);
                
                // Get the top 5 most used words
                $top_words = array_slice($word_counts, 0, 5, true);

                $top_words_labels = json_encode(array_keys($top_words)); // Extract top words as labels
                $top_words_data = json_encode(array_values($top_words)); // Extract their counts as data

                
            


                    // Initialize counts for program_flow values
                    $program_flow_count = [
                      '5' => 0,
                      '4' => 0,
                      '3' => 0,
                      '2' => 0,
                      '1' => 0,
                    ];

                    // Loop through feedback data and count occurrences of each value
                    foreach ($feedback_data as $feedback) {
                      if (isset($program_flow_count[$feedback['program_flow']])) {
                          $program_flow_count[$feedback['program_flow']]++;
                      }
                    }

                // Initialize counts for program_flow values
                    $time_management_count = [
                      '5' => 0,
                      '4' => 0,
                      '3' => 0,
                      '2' => 0,
                      '1' => 0,
                    ];

                    // Loop through feedback data and count occurrences of each value
                    foreach ($feedback_data as $feedback) {
                      if (isset($time_management_count[$feedback['time_management']])) {
                          $time_management_count[$feedback['time_management']]++;
                      }
                    }

                                        // Initialize counts for program_flow values
                    $venue_count = [
                      '5' => 0,
                      '4' => 0,
                      '3' => 0,
                      '2' => 0,
                      '1' => 0,
                    ];

                    // Loop through feedback data and count occurrences of each value
                    foreach ($feedback_data as $feedback) {
                      if (isset($venue_count[$feedback['venue']])) {
                          $venue_count[$feedback['venue']]++;
                      }
                    }

                    // Initialize counts for program_flow values
                    $speaker_count = [
                      '5' => 0,
                      '4' => 0,
                      '3' => 0,
                      '2' => 0,
                      '1' => 0,
                    ];

                    // Loop through feedback data and count occurrences of each value
                    foreach ($feedback_data as $feedback) {
                      if (isset($speaker_count[$feedback['speaker']])) {
                          $speaker_count[$feedback['speaker']]++;
                      }
                    }

                    // Initialize counts for program_flow values
                    $topic_count = [
                      '5' => 0,
                      '4' => 0,
                      '3' => 0,
                      '2' => 0,
                      '1' => 0,
                    ];

                    // Loop through feedback data and count occurrences of each value
                    foreach ($feedback_data as $feedback) {
                      if (isset($topic_count[$feedback['topic']])) {
                          $topic_count[$feedback['topic']]++;
                      }
                    }
                    // Initialize counts for program_flow values
                    $facilitator_count = [
                      '5' => 0,
                      '4' => 0,
                      '3' => 0,
                      '2' => 0,
                      '1' => 0,
                    ];

                    // Loop through feedback data and count occurrences of each value
                    foreach ($feedback_data as $feedback) {
                      if (isset($facilitator_count[$feedback['facilitator']])) {
                          $facilitator_count[$feedback['facilitator']]++;
                      }
                    }
                    // Initialize counts for program_flow values
                    $overall_rating_count = [
                      '5' => 0,
                      '4' => 0,
                      '3' => 0,
                      '2' => 0,
                      '1' => 0,
                    ];

                    // Loop through feedback data and count occurrences of each value
                    foreach ($feedback_data as $feedback) {
                      if (isset($overall_rating_count[$feedback['overall_rating']])) {
                          $overall_rating_count[$feedback['overall_rating']]++;
                      }
                    }
                    
          

            } else {
                echo "<p>No data found for this event.</p>";
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

} else {
    header("location: error.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Data Analytics - Society of Computer Engineering Students - UE Manila</title>
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
  <link href="assets/css/style-analytics.css" rel="stylesheet">

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



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>EVENT SURVEY RESULT</h1>
      <nav>
        <ol class="breadcrumb" style="margin-bottom: 0px;">
          <li class="breadcrumb-item"><a href="index.php" style="color: #555555;">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="results.html" style="color: #555555;">Event Survey Results</a></li>
          <li class="breadcrumb-item active" style="color: #555555;"><?php echo $event_name; ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    

    <section class="section dashboard">
        <h1 style="text-align: center; text-transform: uppercase; font-weight: bold;">"<?php echo $event_name; ?>"</h1>

    
    <div class="row">
            <!-- Attendees Card -->
            <div class="col">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Attendees</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                      </div>
                    <div class="ps-3">
                      
                      <h6><?php echo count($feedback_data); ?>
                      </h6>
                      <span class="text-success small pt-1 fw-bold">Current</span><span class="text-muted small pt-2 ps-1">responses</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Attendees Card -->

            <!-- Revenue Card -->
            <div class="col">
              <div class="card info-card revenue-card">

              <div class="card-body">
                    <h5 class="card-title">Last Updated</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ri-time-line"></i>
                      </div>
                      <div class="ps-3">
                        <h6>
                          <?php echo $last_updated_time ? date('F j, Y', strtotime($last_updated_time)) : 'No updates yet'; ?>
                        </h6>
                        <span class="text-muted small pt-2 ps-1">As of </span>
                        <span class="text-success small pt-1 fw-bold">
                          <?php echo $last_updated_time ? date('h:i:s A', strtotime($last_updated_time)) : '--'; ?>
                        </span>
                      </div>
                    </div>
                  </div>


              </div>
            </div><!-- End Revenue Card -->


            <div class="card">
              <div class="card-body">
                <div class="row">
                  <!-- 1st col -->
                  <div class="col">
                                  <!-- Table with stripped rows -->
                          <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Metric</th>
                                      <th scope="col">Average Rating</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <th scope="row">1</th>
                                      <td>Program Flow</td>
                                      <td><?php echo number_format($averages['program_flow'], 2); ?></td>
                                  </tr>
                                  <tr>
                                      <th scope="row">2</th>
                                      <td>Time Management</td>
                                      <td><?php echo number_format($averages['time_management'], 2); ?></td>
                                  </tr>
                                  <tr>
                                      <th scope="row">3</th>
                                      <td>Venue and Facilities</td>
                                      <td><?php echo number_format($averages['venue'], 2); ?></td>
                                  </tr>
                                  <tr>
                                      <th scope="row">4</th>
                                      <td>Speakers/Performers</td>
                                      <td><?php echo number_format($averages['speaker'], 2); ?></td>
                                  </tr>
                                  <tr>
                                      <th scope="row">5</th>
                                      <td>Topics/Quality of Performances</td>
                                      <td><?php echo number_format($averages['topic'], 2); ?></td>
                                  </tr>
                                  <tr>
                                      <th scope="row">6</th>
                                      <td>Facilitators/Event Organizers</td>
                                      <td><?php echo number_format($averages['facilitator'], 2); ?></td>
                                  </tr>
                                  <tr>
                                      <th scope="row">7</th>
                                      <td>Overall Rating for the Activity</td>
                                      <td><?php echo number_format($averages['overall_rating'], 2); ?></td>
                                  </tr>
                              </tbody>
                          </table>

                  </div>
                  <!-- 2nd col -->
                   <div class="col">

                                 <!-- Vertical Bar Chart -->
              <div id="verticalBarChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {

                  const averages = <?php echo $averages_json; ?>;

                  echarts.init(document.querySelector("#verticalBarChart")).setOption({
                    title: {
                      text: 'Average Event Ratings',
                    textStyle: {
                      fontFamily: 'Open Sans',
                      fontWeight: 'bold',
                      fontSize: 16,
                      color: 'black'
                      },
                      top: '2%',
                    },
                    tooltip: {
                      trigger: 'axis',
                      axisPointer: {
                        type: 'shadow'
                      }
                    },
                    legend: {},
                    grid: {
                      left: '3%',
                      right: '4%',
                      bottom: '3%',
                      containLabel: true
                    },
                    xAxis: {
                      type: 'value',
                      boundaryGap: [0, 0.01]
                    },
                    yAxis: {
                      type: 'category',
                      data: ['Program Flow', 'Time Management', 'Venue and Facilities ', 'Speakers/Performers', 'Topics/Quality of Performances', 'Facilitators/Event Organizers', 'Overall Rating for the Activity	']
                    },
                    series: [{
                    name: 'Average Ratings',
                    type: 'bar',
                    data: averages
                      },
                    ]
                  });
                });
              </script>
              <!-- End Vertical Bar Chart -->
                   </div>
                </div>
              </div>
            </div>
            

            <div class="card">
                <div class="card-body" style="margin-top: 40px;">
                  <h1 style="text-align: center; margin-bottom: 30px; font-weight: bolder;">Data Statistics</h1>
                  <div class="row">
                    
                    <!-- Row 1 -->
                    <div class="col-md-4">
                      <!-- Pie Chart 1 -->
                       <h3 style="font-size: 15px; text-align: center; margin-bottom: 10px; font-style: italic; font-weight: 500; text-decoration: double;">Program Flow</h3>
                      <div id="pieChart1"></div>
                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          const programFlowCount = <?php echo json_encode(array_values($program_flow_count)); ?>;
                          new ApexCharts(document.querySelector("#pieChart1"), {
                            series: programFlowCount, 
                           chart: { height: 350, type: 'pie', toolbar: { show: true } },
                            labels: ['5 - Excellent', '4 - Very Satisfactory', '3 - Satisfactory', '2 - Poor', '1 - Extremely Poor']
                          }).render();
                        });
                      </script>
                    </div>
              
                    <div class="col-md-4">
                        <h3 style="font-size: 15px; text-align: center; margin-bottom: 10px; font-style: italic; font-weight: 500; text-decoration: double;">Time Management</h3>
                      <!-- Donut Chart 1 -->
                      <div id="donutChart1"></div>
                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          const timeManagementCount = <?php echo json_encode(array_values($time_management_count)); ?>;
                          new ApexCharts(document.querySelector("#donutChart1"), {
                            series: timeManagementCount,
                            chart: { height: 350, type: 'donut', toolbar: { show: true } },
                            labels: ['5 - Excellent', '4 - Good', '3 - Moderate', '2 - Poor', '1 - Extremely Poor']
                          }).render();
                        });
                      </script>
                      
                    </div>
              
                    <div class="col-md-4">
                        <h3 style="font-size: 15px; text-align: center; margin-bottom: 10px; font-style: italic; font-weight: 500; text-decoration: double;">Venue and Facilities</h3>
                      <!-- Pie Chart 2 -->
                      <div id="pieChart2"></div>
                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          const venueCount = <?php echo json_encode(array_values($venue_count)); ?>;
                          new ApexCharts(document.querySelector("#pieChart2"), {
                            series: venueCount,
                            chart: { height: 350, type: 'pie', toolbar: { show: true } },
                            labels: ['5 - Excellent', '4 - Good', '3 - Moderate', '2 - Poor', '1 - Extremely Poor']
                          }).render();
                        });
                      </script>
                    </div>
              
                    <!-- Row 2 -->
                    <div class="col-md-4">
                        <h3 style="font-size: 15px; text-align: center; margin: 20px; font-style: italic; font-weight: 500; text-decoration: double;">Speakers/Performances</h3>

                      <!-- Pie Chart 3 -->
                      <div id="pieChart3"></div>
                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          const speakerCount = <?php echo json_encode(array_values($speaker_count)); ?>;
                          new ApexCharts(document.querySelector("#pieChart3"), {
                            series: speakerCount,
                            chart: { height: 350, type: 'pie', toolbar: { show: true } },
                            labels: ['5 - Excellent', '4 - Good', '3 - Moderate', '2 - Poor', '1 - Extremely Poor']
                          }).render();
                        });
                      </script>
                    </div>
              
                    <div class="col-md-4">
                        <h3 style="font-size: 15px; text-align: center; margin: 20px; font-style: italic; font-weight: 500; text-decoration: double;">Topics/Quality of Performance</h3>

                      <!-- Donut Chart 2 -->
                      <div id="donutChart2"></div>
                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          const topicCount = <?php echo json_encode(array_values($topic_count)); ?>;
                          new ApexCharts(document.querySelector("#donutChart2"), {
                            series: topicCount,
                            chart: { height: 350, type: 'donut', toolbar: { show: true } },
                            labels: ['5 - Excellent', '4 - Good', '3 - Moderate', '2 - Poor', '1 - Extremely Poor']
                          }).render();
                        });
                      </script>
                    </div>
              
                    <div class="col-md-4">
                        <h3 style="font-size: 15px; text-align: center; margin: 20px; font-style: italic; font-weight: 500; text-decoration: double;">Facilitators/Event Organizers</h3>

                      <!-- Pie Chart 4 -->
                      <div id="pieChart4"></div>
                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          const facilitatorCount = <?php echo json_encode(array_values($facilitator_count)); ?>;
                          new ApexCharts(document.querySelector("#pieChart4"), {
                            series: facilitatorCount,
                            chart: { height: 350, type: 'pie', toolbar: { show: true } },
                            labels: ['5 - Excellent', '4 - Good', '3 - Moderate', '2 - Poor', '1 - Extremely Poor']
                          }).render();
                        });
                      </script>
                    </div>
              
                  </div>
                </div>
              </div>


              <div class="card">
                <div class="card-body" style="margin-top: 40px;">
                  <h3 style="text-align: center; font-weight: bolder; font-size: 30px;">Overall Average Event Rating</h3>
                
              <!-- Bar Chart -->
              <div id="barChart" style="min-height: 250px; min-width: 100px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  const overallRatingCount = <?php echo json_encode(array_values($overall_rating_count)); ?>;
                  echarts.init(document.querySelector("#barChart")).setOption({
                    xAxis: {
                      type: 'category',
                      data: overallRatingCount
                    },
                    yAxis: {
                      type: 'value'
                    },
                    series: [{
                      data: [120, 200, 150, 80, 70],
                      type: 'bar'
                    }]
                  });
                });
              </script>
              <!-- End Bar Chart -->

            </div>
        </div>
              


        <section class="section">
          <div class="row">
            <div class="col-lg-12">
    
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Attendees</h5>
                  <p>The following are the students that attended the seminar and has completed the event evaluation. The details to be utilized for their certificates are as follows.</p>
    
                  <!-- Dropdown to select number of records -->
                    <label for="recordLimit">Show</label>
                    <select id="recordLimit" onchange="filterRecords()">
                      <option value="10">10</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                      <option value="300">300</option>
                      <option value="all">All</option>
                    </select>
                    <label>records</label>
                  <!-- Table with stripped rows -->
                  <table class="table datatable" id="recordTable">
                    <thead>
                      <tr>
                      <th>Feedback ID</th>

                        <th>
                          <b>Surname</b>
                        </th>
                        <th>First Name</th>
                        <th>Middle Initial</th>
                        <th>Student Number</th>
                        <th>Year Level</th>
                        <th>Program</th>
                        <th>College</th>
                        <th>Age</th>
                        <th>Sex</th>
                      </tr>
                    </thead>
                    <tbody>
            <?php foreach ($feedback_data as $feedback): ?>
                <tr>
                <td><?php echo htmlspecialchars($feedback['feedback_id']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['surname']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['middle_initial']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['student_number']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['year_level']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['program']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['college']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['age']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['sex']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
                  </table>
                  <!-- End Table with stripped rows -->
    
                </div>
              </div>
    
            </div>
          </div>
        </section>



        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title" style="text-align: center;">Comments for Speakers</h5>
                <!-- Dropdown to select number of records -->
                <label for="recordLimit_cmspeaker">Show</label>
                    <select id="recordLimit_cmspeaker" onchange="filterRecords_cmspeaker()">
                      <option value="2" selected>2</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                      <option value="300">300</option>
                      <option value="all">All</option>
                    </select>
                    <label>records</label>
                                  <!-- Table with stripped rows -->
                                  <table class="table datatable" id="recordTable_cmspeaker">
                                    <tbody>
                                      <?php foreach ($feedback_data as $feedback): ?>
                                          <?php if (!empty($feedback['comments_speaker']) || !empty($feedback['comments_organizer'])): ?>
                                              <tr>
                                                  <td><?php echo htmlspecialchars($feedback['comments_speaker']); ?></td>
                                              </tr>
                                          <?php endif; ?>
                                      <?php endforeach; ?>
                                  </tbody>
                                  </table>
                                  <!-- End Table with stripped rows -->
              </div>
            </div>

          </div>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title" style="text-align: center;">Comments and Suggestions for Organizers</h5>
                <label for="recordLimit_cmorganizer">Show</label>
                    <select id="recordLimit_cmorganizer" onchange="filterRecords_cmorganizer()">
                      <option value="2" selected>2</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                      <option value="300">300</option>
                      <option value="all">All</option>
                    </select>
                    <label>records</label>
                                  <!-- Table with stripped rows -->
                                  <table class="table datatable" id="recordTable_cmorganizer">
                                    <tbody>
                                    <?php foreach ($feedback_data as $feedback): ?>
                                        <?php if (!empty($feedback['comments_speaker']) || !empty($feedback['comments_organizer'])): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($feedback['comments_organizer']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>

                                  </table>
                                  <!-- End Table with stripped rows -->
    
              </div>
            </div>
          </div>
        </div>




        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Top Words Used</h5>
            <p>The following are the top words used by the students based on the comments they left on the survey. This includes the remarks they left for the speakers and for the organizers.</p>
            <!-- Small tables -->
            <div class="row">
              <div class="col" style="display: flex; justify-content: center; align-items: center ;">
<table class="table table-sm" style="align-items: center;">
<thead><tr>
<th scope="col" style="font: size 30px;">Words</th>
<th scope="col" style="font: size 30px;">Count</th>
</tr></thead><tbody>
            
                <?php
                foreach ($top_words as $word => $count) {
                    echo '<tr>';
                    echo '<th scope="row">' . htmlspecialchars($word) . '</th>';
                    echo '<td>' . $count . '</td>';
                    echo '</tr>';
                }
            
                echo '</tbody></table>';
                ?>
              </div>
              <div class="col" style="display: flex; justify-content: center; align-items: center;;">
                <!-- Bar Chart -->
              <canvas id="barChart2" style="max-height: 400px;"></canvas>
              
              <script>
  document.addEventListener("DOMContentLoaded", () => {
    const labels = <?php echo $top_words_labels; ?>; // PHP-generated labels
    const data = <?php echo $top_words_data; ?>;     // PHP-generated data

    new Chart(document.querySelector('#barChart2'), {
      type: 'bar',
      data: {
        labels: labels, // Use dynamic labels
        datasets: [{
          label: 'Top Words Used',
          data: data, // Use dynamic data
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
</script>

              <!-- End Bar CHart -->

              </div>
            </div>
            
            <!-- End small tables -->

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


  <script>

document.addEventListener("DOMContentLoaded", () => {
    const dayElement = document.getElementById('currentDay');
    const now = new Date();

    // Get the day name based on the user's device settings
    const options = { weekday: 'long' };
    const dayName = now.toLocaleDateString(undefined, options);

    dayElement.textContent = dayName; // Display the day name
  });


document.addEventListener("DOMContentLoaded", () => {
    const dateTimeElement = document.getElementById('currentDateTime');
    const now = new Date();
    const options = { 
      year: 'numeric', 
      month: '2-digit', 
      day: '2-digit', 
      hour: '2-digit', 
      minute: '2-digit', 
      second: '2-digit',
      hour12: true 
    };

    // Format the date and time based on user's locale (e.g., en-PH for Philippine format)
    const formattedDateTime = now.toLocaleString('en-PH', options);
    dateTimeElement.textContent = formattedDateTime;
  });
//for student record
function filterRecords() {
  var limit = document.getElementById('recordLimit').value;
  var table = document.getElementById('recordTable');
  var rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
  
  // Convert "all" to a very large number to show all records
  if (limit === "all") {
    limit = rows.length;
  } else {
    limit = parseInt(limit);
  }

  // Loop through the rows and show/hide as per the selected limit
  for (var i = 0; i < rows.length; i++) {
    if (i < limit) {
      rows[i].style.display = "";  // Show row
    } else {
      rows[i].style.display = "none";  // Hide row
    }
  }
}

//fikter for speaker comments

    // Function to filter table rows
    function filterRecords_cmspeaker() {
        const limit = document.getElementById("recordLimit_cmspeaker").value; // Get selected option
        const table = document.getElementById("recordTable_cmspeaker");
        const tbody = table.querySelector("tbody"); // Access tbody directly
        const rows = tbody.getElementsByTagName("tr"); // Get all table rows
        
        if (!rows.length) {
            console.error("No rows found in table body."); // Debug log
            return;
        }

        // Show or hide rows based on the selected limit
        for (let i = 0; i < rows.length; i++) {
            if (limit === "all") {
                rows[i].style.display = ""; // Show all rows
            } else if (i < parseInt(limit)) {
                rows[i].style.display = ""; // Show rows within the limit
            } else {
                rows[i].style.display = "none"; // Hide rows outside the limit
            }
        }
    }

    // Call the filter function on page load
    document.addEventListener("DOMContentLoaded", () => {
        filterRecords_cmspeaker();
    });



//filter for comments organizer
function filterRecords_cmorganizer() {
        const limit = document.getElementById("recordLimit_cmorganizer").value; // Get selected option
        const table = document.getElementById("recordTable_cmorganizer");
        const tbody = table.querySelector("tbody"); // Access tbody directly
        const rows = tbody.getElementsByTagName("tr"); // Get all table rows
        
        if (!rows.length) {
            console.error("No rows found in table body."); // Debug log
            return;
        }

        // Show or hide rows based on the selected limit
        for (let i = 0; i < rows.length; i++) {
            if (limit === "all") {
                rows[i].style.display = ""; // Show all rows
            } else if (i < parseInt(limit)) {
                rows[i].style.display = ""; // Show rows within the limit
            } else {
                rows[i].style.display = "none"; // Hide rows outside the limit
            }
        }
    }

    // Call the filter function on page load
    document.addEventListener("DOMContentLoaded", () => {
        filterRecords_cmorganizer();
    });



// Set an initial limit when the page loads (e.g., 10 records)
window.onload = function() {
  filterRecords();
};
</script>

</body>

</html>