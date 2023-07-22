<?php
    session_start();

    //connect to database
    $conn = mysqli_connect('sql306.epizy.com', 'epiz_33450722', 'A96HNCY1Dsv', 'epiz_33450722_users');
     if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $appointment_id = $_GET['id'];
    $sql = "DELETE FROM appointments WHERE id = '$appointment_id'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>
        setTimeout(function() {
            swal({
                title: "Appointment deleted successfully!",
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
