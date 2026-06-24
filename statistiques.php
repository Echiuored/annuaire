<?php
require 'config/database.php';

$sql = $pdo->query("
    SELECT service, COUNT(*) AS total
    FROM personnel
    GROUP BY service
");

$labels = [];
$data = [];

while ($row = $sql->fetch()) {
    $labels[] = $row['service'];
    $data[] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6f9;
}

/* Centre total */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 90vh;
}

/* Carte style dashboard */
.card {
    background: white;
    padding: 30px;
    border-radius: 16px;
    width: 600px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

/* Canvas centré et plus grand */
canvas {
    max-width: 450px;
    margin: auto;
}
</style>
</head>

<body>

<div class="container">
    <div class="card">
        <h2>📊 Répartition du personnel par service</h2>

        <canvas id="chart"></canvas>
    </div>
</div>

<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            data: <?= json_encode($data) ?>,
            backgroundColor: [
                '#4e79a7',
                '#f28e2b',
                '#e15759',
                '#76b7b2',
                '#59a14f',
                '#edc949'
            ],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>

</body>
</html>