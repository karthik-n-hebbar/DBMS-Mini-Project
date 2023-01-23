<?php
$con1 = mysqli_connect("localhost", "root", "", "tollease");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TollEase - For Smarter Commutes</title>
  <link rel="icon" href="/media/favicon.ico" type="image/favicon">
  <link rel="stylesheet" href="/style/index.css">
  <link rel="stylesheet" href="/javascript/index.js">
</head>

<body>
  <div class="banner">
    <div class="navbar">
      <img src="/media/TollEase-1.png" class="logo">
      <ul>
        <li><a href="/templates/index.php">Home</a></li>
        <li><a href="/templates/login.html">Login</a></li>
        <li><a href="/templates/about.html">About</a></li>
        <li><a href="/templates/contact_us.html">Contact Us</a></li>
      </ul>
    </div>
    <div class="content">
      <div class="graph_option">
        <input name="graph_type" class="graph_type" value="hourly" id="hourly" type="radio" checked onclick="hour()">
        <label for="hourly">Hourly</label>
        <input name="graph_type" class="graph_type" value="one_day" id="one_day" type="radio" onclick="day()">
        <label for="hourly">One Day</label>
        <input name="graph_type" class="graph_type" value="one_week" id="one_week" type="radio" onclick="week()">
        <label for="hourly">One Week</label>
      </div>
      <div id="curve_chart1"></div>
      <div id="chart_div"></div>
    </div>
  </div>
  <footer>
    Copyright &copy; <script>
      document.write(new Date().getFullYear())
    </script> TollEase.com
  </footer>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart1);

  function drawChart1() {
    var data = google.visualization.arrayToDataTable([
      ['date', 'total_vehicle'],
      <?php
      $sql = "select * from vehicles_by_date";
      $fire = mysqli_query($con1, $sql);
      while ($result = mysqli_fetch_assoc($fire)) {
        echo "['" . $result['date'] . "'," . $result['total_vehicle'] . "],";
      }
      ?>

    ]);

    var options = {
      title: 'Number of Vehicles in a month',
      curveType: 'none',
      legend: {
        position: 'bottom'
      }
    };

    var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart1'));
    chart1.draw(data, options);
  }

  function hour() {
    console.log("Hourly Graph");
  }

  function day() {
    console.log("One Day Graph");

  }

  function week() {
    console.log("One Week Graph");
  }
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawBasic);

  function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', 'Motivation Level');

      data.addRows([
        [{v: [8, 0, 0], f: '8 am'}, 1],
        [{v: [9, 0, 0], f: '9 am'}, 2],
        [{v: [10, 0, 0], f:'10 am'}, 3],
        [{v: [11, 0, 0], f: '11 am'}, 4],
        [{v: [12, 0, 0], f: '12 pm'}, 5],
        [{v: [13, 0, 0], f: '1 pm'}, 6],
        [{v: [14, 0, 0], f: '2 pm'}, 7],
        [{v: [15, 0, 0], f: '3 pm'}, 8],
        [{v: [16, 0, 0], f: '4 pm'}, 9],
        [{v: [17, 0, 0], f: '5 pm'}, 10],
      ]);

      var options = {
        title: 'Motivation Level Throughout the Day',
        hAxis: {
          title: 'Time of Day',
          format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }
        },
        vAxis: {
          title: 'Rating (scale of 1-10)'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
  }
</script>
<style>
  .graph_option {
    color: white;
    background-color: rgba(255, 255, 255, 0.401);
    width: 265px;
    height: 35px;
    border-radius: 10px;
    align-items: center;
    justify-content: center;
    display: flex;
    margin: -45px 0 0 0;
    position: absolute;
    right: 135px;
  }
  .graph_type {
    margin: 7px;
  }

  #curve_chart1 {
    width: 1000px; 
    height: 500px; 
    margin: 0 0 0 300px;
    position: absolute;
  }
  #chart_div {
    width: 1000px; 
    height: 500px; 
    margin: 0 0 0 300px;
    position: absolute;
    display: none;
  }
</style>

</html>