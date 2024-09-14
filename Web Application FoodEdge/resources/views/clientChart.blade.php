<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Registration Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="background-color: black;">

<div style="background-color: white; width: 80%; margin: auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h1 style="text-align: center; color: red
    ;">Client Registration Report Sales</h1>
    <canvas id="chart"></canvas>
</div>

<script>
    var ctx = document.getElementById('chart').getContext('2d');
    var userChart = new Chart(ctx,{
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Clients',
                data: {!! json_encode($datasets[0]['data']) !!},
                backgroundColor: 'blue', // Set bar color to red
                borderWidth: 1
            }]
        },
    });
</script>

</body>
</html>