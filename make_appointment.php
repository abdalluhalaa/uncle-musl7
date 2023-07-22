<?php
        session_start();

    //connect to database
    $conn = mysqli_connect('sql306.epizy.com', 'epiz_33450722', 'A96HNCY1Dsv', 'epiz_33450722_users');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $title = $_POST['title'];
    $des = $_POST['des'];
    $status = $_POST['status'];
    
    $sql = "INSERT INTO appointments (email, date, time, title, des, status) VALUES ('$email', '$date', '$time','$title' '$des', '$status')";

    if ($conn->query($sql) === TRUE) {

        echo '<script>
        setTimeout(function() {
            swal({
                title: "Appointment created successfully",
                type: "success"
            }, function() {
                window.location = "my_appointments.php";
            });
        }, 1000);
    </script>';

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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