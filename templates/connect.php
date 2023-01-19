<?php
    $vehicle_type = $_POST['vehicle_type'];
    $vehicle_no = $_POST['vehicle_no'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $entry_point = $_POST['entry_point'];
    $exit_point = $_POST['exit_point'];
    $amount = $_POST['amount'];

    $conn = new mysqli('localhost','root','','tollease');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into billing(vehicle_type,vehicle_no,date,time,entry_point,exit_point,amount)
        values(?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssi",$vehicle_type,$vehicle_no,$date,$time,$entry_point,$exit_point,$amount);
        $stmt->execute();
        echo "<a href=/templates/billing_page.php>Billing Successfull</a>";
        $stmt->close();
        $conn->close();
    }
?>