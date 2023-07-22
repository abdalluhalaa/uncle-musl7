<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("location: login.php");
    }
    else
    $email = $_SESSION['email'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $phone = $_POST['phone'];
    // connect to database
    $conn = mysqli_connect('sql306.epizy.com', 'epiz_33450722', 'A96HNCY1Dsv', 'epiz_33450722_users');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE user SET fname='$firstname', lname='$lastname' , phone='$phone' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
        
        echo '<script>
        setTimeout(function() {
            swal({
                title: "Profile updated successfully!",
                type: "success"
            }, function() {
                window.location = "profile.php";
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