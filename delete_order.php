<?php
    $conn = mysqli_connect('sql306.epizy.com', 'epiz_33450722', 'A96HNCY1Dsv', 'epiz_33450722_users');



if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM orders WHERE id = $id";

    if(mysqli_query($conn, $sql)) {
        header("location: oadmin.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<html>
    <head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    </head>
</html>