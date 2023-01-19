<?php
$con = mysqli_connect("localhost", "root", "", "tollease");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/style/index.css">
  <title>TollEase - For Smarter Commutes</title>
  <link rel="icon" href="/media/favicon.ico" type="image/favicon">
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
        <div id="curve_chart" style="width: 900px; height: 500px; margin: 0 0 0 300px;"></div>
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
      curveType: 'function',
      legend: {
        position: 'bottom'
      }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }
</script>

</html>