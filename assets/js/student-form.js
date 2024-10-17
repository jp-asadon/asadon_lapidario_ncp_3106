



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