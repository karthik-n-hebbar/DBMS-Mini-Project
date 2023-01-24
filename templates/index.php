<?php
$con = mysqli_connect("localhost", "root", "", "tollease");
$conn = mysqli_connect("localhost", "root", "", "tollease");
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
        <label for="hourly">One Month</label>
      </div>
      <div id="curve_chart" class="curve_chart"></div>
      <div id="chart_div" class="chart_div"></div>
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
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['date', 'total_vehicle'],
      <?php
      $sql = "select * from vehicles_by_date";
      $fire = mysqli_query($con, $sql);
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

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    chart.draw(data, options);
  }
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['time', 'total_vehicle'],
      <?php
      $sql = "SELECT time, total_vehicle FROM vehicles_in_peak_hours";
      $fire = mysqli_query($conn, $sql);
      while ($result = mysqli_fetch_assoc($fire)) {
        echo "['" . $result['time'] . "'," . $result['total_vehicle'] . "],";
      }
      ?>

    ]);

    var options = {
      title: 'Number Of Vehicles During Peak Hours (5PM Onwards)',
      curveType: 'none',
      legend: {
        position: 'bottom'
      }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>

<script>
  function hour() {
    console.log("Hourly Graph");
    document.getElementById("chart_div").style.display = "block";
    document.getElementById("curve_chart").style.display = "none";
  }

  function day() {
    console.log("One Day Graph");
    document.getElementById("chart_div").style.display = "none";
    document.getElementById("curve_chart").style.display = "none";
  }

  function week() {
    console.log("One Week Graph");
    document.getElementById("curve_chart").style.display = "block";
    document.getElementById("chart_div").style.display = "none";
  }
</script>
<style>
  #curve_chart {
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
    /* display: none; */
  }
</style>
</html>