<?php
$con = mysqli_connect("localhost", "root", "", "tollease");
$s = mysqli_query($con, "select * from vehicle_type");
$en = mysqli_query($con, "select * from entry_and_exit_point");
$ex = mysqli_query($con, "select * from entry_and_exit_point");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
    <link rel="icon" href="/media/favicon.ico" type="image/favicon">
    <link rel="stylesheet" href="/style/billing_page.css">
</head>

<body>
    <header>
        <img id="logo" src="/media/TollEase-1.png" alt="" onclick="home()">
    </header>
    <div class="main">
        <div class="billing">
            <h2>Billing Here</h2>
            <form action="connect.php" method="post" id="billing">
                <label for="">Vehicle Type: </label>
                <br>
                <select name="vehicle_type" id="vehicle_type" class="io2" value="Select The Vehicle Type" required>
                    <option value="entry_point">Select Entry Point</option>
                    <?php
                    while ($r = mysqli_fetch_array($s)) {
                    ?>
                        <option><?php echo $r['vehicle_type']; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br><br>
                <label for="">Vehicle Number: </label>
                <br>
                <input type="text" name="vehicle_no" id="vehicle_no" placeholder="Enter the Vehicle No" class="io1" required>
                <br><br>
                <label for="">Date: </label>
                <br>
                <input type="text" name="date" id="date" class="io2">
                <br><br>
                <label for="">Time: </label>
                <br>
                <input type="text" name="time" id="time" class="io2">
                <br><br>
                <label for="">Entry Point: </label>
                <br>
                <select name="entry_point" id="entry_point" class="io2">
                    <option value="entry_point">Select Entry Point</option>
                    <?php
                    while ($enp = mysqli_fetch_array($en)) {
                    ?>
                        <option><?php echo $enp['entry_exit_point']; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br><br>
                <label for="">Exit Point: </label>
                <br>
                <select name="exit_point" id="exit_point" class="io2">
                    <option value="exit_point">Select Exit Point</option>
                    <?php
                    while ($ext = mysqli_fetch_array($ex)) {
                    ?>
                        <option><?php echo $ext['entry_exit_point']; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br><br>
                <label for="">Amount: </label>
                <br>
                <input type="number" name="amount" id="amount" class="io3">
                <input type="button" value="CALCULATE AMOUNT" id="amt_confirm" onclick="hey()">
                </button>
                <br><br>
                <div class="buttons">
                    <input type="submit" value="SUBMIT" id="submit" class="btn">
                    <!-- <input type="reset" value="RESET" id="reset" class="btn"> -->
                </div>
            </form>
        </div>
    </div>
</body>
<script src="/javascript/billing_page.js"></script>
</html>