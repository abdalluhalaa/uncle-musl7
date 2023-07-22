<?php
    session_start();

    //connect to database
    $conn = mysqli_connect('localhost', 'root', '', 'users');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $appointment_id = $_POST['appointment_id'];
    $worker_email = $_POST['worker_email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $title = $_POST['title'];
    $des = $_POST['des'];
    $sql = "UPDATE appointments SET worker_email='$worker_email', date='$date', time='$time',title='$title', des='$des' WHERE id='$appointment_id'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>
        setTimeout(function() {
            swal({
                title: "Appointment updated successfully!",
                type: "success"
            }, function() {
                window.location = "my_appointments.php";
            });
        }, 1000);
    </script>';
        

    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
?>

<html>
    <head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    </head>
</html>
