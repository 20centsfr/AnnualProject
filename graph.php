<!DOCTYPE html>
<html>
<head>
    <title>Graphique</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        fetch('donnees.php')
            .then(response => response.json())
            .then(data => {
                var pages = [];
                var visites = [];
                data.forEach(element => {
                    pages.push(element.page);
                    visites.push(element.visites);
                });

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: pages,
                        datasets: [{
                            label: 'Nombre de visites par page',
                            data: visites,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
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
            })
            .catch(error => console.error(error));
    </script>
</body>
</html>
