<?php
    session_start();

    //connect to database
    $conn = mysqli_connect('sql306.epizy.com', 'epiz_33450722', 'A96HNCY1Dsv', 'epiz_33450722_users');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $appointment_id = $_GET['id'];
    $status = 'Finished';
    $sql = "UPDATE appointments SET status = '$status' WHERE id = '$appointment_id'";
    if ($conn->query($sql) === TRUE) {
        header("location: wo.php");


    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
?>