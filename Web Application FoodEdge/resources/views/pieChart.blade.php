<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Rating Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000; /* Set body background color to black */
            margin: 0;
            padding: 40px; /* Increase padding to create space around the chart */
        }
        .container {
            max-width: 800px; /* Adjust max-width to make it wider */
            margin: auto;
            background-color: #fff; /* Set container background color to white */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            overflow: hidden; /* Add overflow hidden to prevent page scrolling */
        }
        h1 {
            text-align: center;
            color: #ff5733;
        }
        canvas {
            margin: 0 auto;
            display: block;
            width: 100%; /* Set canvas width to 100% */
            height: auto; /* Allow height to adjust according to width */
        }
        .container-bg {
            background-color: #000; /* Set background color for the container */
            padding: 20px; /* Add padding to create space between the container and the black background */
            border-radius: 8px; /* Apply border radius to match the container */
        }
    </style>
</head>
<body>

<div class="container-bg">
    <div class="container">
        <h1>Service Rating Report</h1>
        <canvas id="chart" width="1000" height="400"></canvas> <!-- Set canvas width and height -->
    </div>
</div>

<script>
    var ctx = document.getElementById('chart').getContext('2d');
    var reviewChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                data: {!! json_encode($datasets[0]['data']) !!},
                backgroundColor: ['#FF5733', '#3498DB', '#2ECC71', '#F1C40F', '#9B59B6'], // Specify custom colors
            }]
        },
        options: {
            plugins: {
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold'
                    },
                    formatter: function(value, context) {
                        return (value * 100).toFixed(2) + '%';
                    }
                }
            },
            elements: {
                arc: {
                    hoverOffset: 20 // Increase hover offset to make the sections pop out even more
                }
            }
        }
    });
</script>

</body>
</html>