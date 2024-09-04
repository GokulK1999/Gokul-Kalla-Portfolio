<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Booking Line Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #chartContainer {
            background-color: #000; /* Black background */
            padding: 20px; /* Add padding to create space */
        }
        #chartContent {
            background-color: #fff; /* White box background */
            border-radius: 8px; /* Rounded corners */
            padding: 20px; /* Add padding */
            width: 80%; /* Set width */
            margin: auto; /* Center horizontally */
        }
        #chartTitle {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <div id="chartContainer">
        <div id="chartContent">
            <h1 id="chartTitle">Number of Bookings by Month</h1>
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('lineChart').getContext('2d');
        var months = @json($months);
        var bookings = @json(array_values($bookings));
        var highestBookingIndex = @json($highestBookingIndex);

        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Number of Bookings',
                    data: bookings,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)', // Change line color to red
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)', // Point color
                    pointRadius: 6, // Increase point size
                    pointHoverRadius: 8, // Point radius on hover
                    lineTension: 0.4 // Smooth interpolation
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1 // Set step size for y-axis
                        },
                        gridLines: { // Add grid lines
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: 'rgba(0, 0, 0, 0)' // Hide x-axis grid lines
                        }
                    }]
                },
                legend: {
                    display: true,
                    position: 'bottom' // Position legend at the bottom
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';
                            label += ': ' + tooltipItem.yLabel;
                            return label;
                        }
                    }
                }
            }
        });

        // Highlight the highest booking as a red dot
        lineChart.data.datasets[0].pointBackgroundColor[highestBookingIndex] = 'red';
        lineChart.data.datasets[0].pointBorderColor[highestBookingIndex] = 'red';
        lineChart.data.datasets[0].pointRadius[highestBookingIndex] = 8; // Increase point radius for visibility
        lineChart.update();
    </script>
</body>
</html>