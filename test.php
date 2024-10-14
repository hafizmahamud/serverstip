<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Monitor Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Server Monitor Dashboard</h1>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Server Details</div>
                    <div class="card-body">
                        <p><strong>Server Name:</strong> MyServer</p>
                        <p><strong>Operating System:</strong> Linux</p>
                        <p><strong>Memory Usage:</strong> 4 GB / 8 GB</p>
                        <p><strong>Disk Space:</strong> 100 GB / 200 GB</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Server Metrics
                        <select id="timeRange" class="float-right">
                            <option value="5">Last 5 Minutes</option>
                            <option value="60">Last 1 Hour</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="metricsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('metricsChart').getContext('2d');
        const metricsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5'], // Sample time labels
                datasets: [{
                    label: 'CPU Usage (%)',
                    data: [20, 30, 25, 35, 40, 30], // Sample data
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Event listener for the select option
        document.getElementById('timeRange').addEventListener('change', function() {
            const timeRange = this.value;
            // Update chart data based on selected time range
            // Fetch new data here based on timeRange
            console.log("Selected Time Range: " + timeRange + " minutes");
        });
    </script>
</body>
</html>
