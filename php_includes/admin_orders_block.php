<script src="../static/js/charts.js"></script>

<div class="row mx-auto" style="max-width:1000px;">
    <div class="col" id="transaction_graph">
        <canvas id="myChart"></canvas>
    </div>
</div>

<script>
  var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            data: [12, 19, 3, 5, 2, 3],
           
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
