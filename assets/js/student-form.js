// FOR CUSTON RADIO BUTTON



// END OF CUSTOM RADIO BUTTONS


//next button in consent radio is disabled unless I do is filled

//end of consent radio js

// ==============================****============================
// For form transition W3school
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}
////ENDDDD
function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
  // end of W3school tutorial 



// Initialize an empty array to store all ratings
let ratings = [];

// Form submission handler
document.getElementById('surveyForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const eventName = document.getElementById('event').value;
    const rating = parseInt(document.getElementById('rating').value);
    const comments = document.getElementById('comments').value;

    // Store the rating
    if (!isNaN(rating)) {
        ratings.push(rating);
    }

    // Show thank you message
    document.getElementById('thanksMessage').style.display = 'block';

    // Reset form fields
    document.getElementById('surveyForm').reset();

    // Update the pie chart after each submission
    updateChart();

    // Scroll to the pie chart section
    document.getElementById('ratingChart').scrollIntoView({ behavior: 'smooth' });
});

// Function to calculate average rating and update the pie chart
function updateChart() {
    const totalRatings = ratings.length;
    if (totalRatings === 0) return;

    // Count occurrences of each rating
    const ratingCounts = [0, 0, 0, 0, 0];
    ratings.forEach(rating => {
        ratingCounts[rating - 1]++;
    });

    // Create the pie chart
    const ctx = document.getElementById('ratingChart').getContext('2d');
    if (window.myChart) {
        window.myChart.destroy(); // Destroy previous chart if it exists
    }
    window.myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Poor', 'Fair', 'Good', 'Very Good', 'Excellent'],
            datasets: [{
                label: 'Event Ratings',
                data: ratingCounts,
                backgroundColor: [
                    '#ff6384',
                    '#ff9f40',
                    '#ffcd56',
                    '#4bc0c0',
                    '#36a2eb'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Event Satisfaction Ratings'
            }
        }
    });
}