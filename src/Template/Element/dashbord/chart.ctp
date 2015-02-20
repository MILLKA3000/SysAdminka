<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1.1', {packages: ['line']});
    google.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Day');
        data.addColumn('number', 'Guardians of the Galaxy');
        data.addColumn('number', 'The Avengers');
        data.addColumn('number', 'Transformers: Age of Extinction');

        data.addRows([
            [1,  37.8, 80.8, 41.8],
            [2,  30.9, 69.5, 32.4],
            [3,  25.4,   57, 25.7],
            [4,  11.7, 18.8, 10.5],
            [5,  11.9, 17.6, 10.4],
            [6,   8.8, 13.6,  7.7],
            [7,   7.6, 12.3,  9.6],
            [8,  12.3, 29.2, 10.6],
            [9,  16.9, 42.9, 14.8],
            [10, 12.8, 30.9, 11.6],
            [11,  5.3,  7.9,  4.7],
            [12,  6.6,  8.4,  11.2],
            [13,  50.8,  20.3,  12.6],
            [14,  100.2,  10.2,  25.4]
        ]);

        var options = {
            chart: {
                title: 'Active Graph',
                subtitle: 'Migrations all users'
            },
            height: 500,
            legend: {position: 'none'},
            axes: {
                x: {
                    0: {side: 'bottom'}
                }
            }
        };

        var chart = new google.charts.Line(document.getElementById('line_top_x'));

        chart.draw(data, options);
    }
</script>
<body>
<div class="col-lg-6 col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Active Graph </h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive" style="padding-bottom: 25px">
                <div id="line_top_x" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>