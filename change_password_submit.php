<?php
// change_password_submit.php

//connect to the database
    $conn = mysqli_connect('sql306.epizy.com', 'epiz_33450722', 'A96HNCY1Dsv', 'epiz_33450722_users');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //get the user_id from the session
    session_start();
    $email = $_SESSION['email'];

    //get the current password from the form
    $current_password = $_POST['current_password'];

    //get the new password from the form
    $new_password = $_POST['new_password'];

    //get the confirm password from the form
    $confirm_password = $_POST['confirm_password'];

    //check if the current password is correct
    $check_password = "SELECT password FROM user WHERE email = '$email'";
    $result = $conn->query($check_password);
    $password = $result->fetch_assoc();


        if (password_verify($current_password, $password['password'])) {
            //check if the new password and confirm password match
            if ($new_password == $confirm_password) {
                //hash the new password
                
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                //update the password in the database
                $update_password = "UPDATE user SET password = '$hashed_password' WHERE email = '$email'";
                $conn->query($update_password);
                echo '<script>
                setTimeout(function() {
                    swal({
                        title: "Password changed successfully!",
                        type: "success"
                    }, function() {
                        window.location = "profile.php";
                    });
                }, 1000);
            </script>';
            } else {
                echo '<script>
                setTimeout(function() {
                    swal({
                        title: "The new password and confirm password do not match.",
                        type: "error"
                    }, function() {
                        window.location = "changepassword.php";
                    });
                }, 1000);
            </script>';
            }
        } else {
            echo '<script>
            setTimeout(function() {
                swal({
                    title:  "The current password is incorrect.",
                    type: "error"
                }, function() {
                    window.location = "changepassword.php";
                });
            }, 1000);
        </script>';
           
        }
        $conn->close();
    }

?>



<html>
    <head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    </head>
</html>
