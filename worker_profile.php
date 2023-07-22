<?php
session_start();
if (empty($_SESSION['email'])) {
    header("location: 404.html"); }

    
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
    $p ='<a href="login.php" class="btn btn-primary px-3 d-none d-lg-block">Login Now!</a>';
   
} else {
    //$p= '<p class="nav-item nav-link">Hello!</p>';


    // Include config file 
    $conn = mysqli_connect('sql306.epizy.com', 'epiz_33450722', 'A96HNCY1Dsv', 'epiz_33450722_users');
    // Define variables and initialize with empty values
    $email = $_SESSION["email"];

    // Execute a SQL query to retrieve data from the database
    $query = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if (!$result) {
        die('Error executing query: ' . mysqli_error($conn));
    }

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // A row was returned, so fetch the data and print it
        $row = mysqli_fetch_assoc($result);
        $n = $row['fname'];
        $role =$row['role'];

    } else {
        // No rows were returned, so the email address was not found
        echo "No user found with email address '$email'";
    }
    //$p = '<pr class="nav-item nav-link">Hey ' . $n . ' !</pr>' ;
    $p = '<h4  class="nav-item nav-link">Hey ' . $n . ' !</h4>';

    //admin panel start
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
} else {
if ($role == 'admin')
$p = '<div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle btn btn-primary" data-bs-toggle="dropdown"> Admin Panel</a>
        <div class="dropdown-menu bg-light m-0">
        <a href="uadmin.php" class="dropdown-item">Users</a>
        <a href="wadmin.php" class="dropdown-item">Worker</a>
        <a href="oadmin.php" class="dropdown-item">Orderes</a>';
}
//  admin panel end  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Uncle Musl7 - Make Order</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Rubik:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-0">
        <div class="row g-0 d-none d-lg-flex">
            <div class="col-lg-6 ps-5 text-start">
                <div class="h-100 d-inline-flex align-items-center text-white">
                    <span>Follow Us:</span>
                    <a class="btn btn-link text-light" href="https://m.facebook.com/people/Mahmoud-Amareen/100083908870062/"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-link text-light" href="https://twitter.com/Mahmoud_3mareen"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-link text-light" href="https://jo.linkedin.com/in/mahmoud-alamareen-086494228"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-link text-light" href="https://www.instagram.com/mahmoud.alamareen/?hl=en"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="col-lg-6 text-end">
                <div class="h-100 topbar-right d-inline-flex align-items-center text-white py-2 px-5">
                    <span class="fs-5 fw-bold me-2"><i class="fa a-phone-alt me-2"></i>Contact Us:</span>
                    <span class="fs-5 fw-bold">info@unclemusl7.com</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-0 pe-5">
        <a href="index.php" class="navbar-brand ps-5 me-0">
            <h1 class="text-white m-0">Uncle Musl7</h1>
        </a>
        <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link ">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Services</a>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Menu</a>
                    <div class="dropdown-menu bg-light m-0">
                    <?php if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
                                    }else 
                                    echo '<a href="profile.php" class="dropdown-item">My Profile</a>';?>
                        
                        <?php if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
                        } else {
                            if ($role == 'worker' || $role == 'admin')
                                echo '<a href="wo.php" class="dropdown-item">My Appointments</a>';

                            echo '<a href="opp.php" class="dropdown-item">Order Now!</a>';
                            echo '<a href="my_appointments.php" class="dropdown-item">My Orders</a>';
                        }
                                    ?>
                        <a href="ourteam.php" class="dropdown-item">Our Team</a>

                        
                        <?php if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
                        } else {
                            
                            echo '<a href="switch_user.php" class="dropdown-item">Switch User</a>';
                            echo '<a href="logout.php" class="dropdown-item">Logout</a>';
                        }?>
                        
                    </div></div></div>
                    <div><?php echo $p  ?></div>
                </div>
                
          
        
           
        </div>
    </nav>
    <!-- Navbar End -->

    
 <!-- Page Header Start -->
 <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white animated slideInRight"> Make Order</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb animated slideInRight mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Oredr Now!</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Make Order</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- worker profile Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                
                <h4 class="mb-4">"Professional and reliable handyman services"</h4>
            </div>
            <div class="row gy-5 gx-4">
    
<?php
    //connect to database
    $conn = mysqli_connect('sql306.epizy.com', 'epiz_33450722', 'A96HNCY1Dsv', 'epiz_33450722_users');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = $_GET['email'];
    $sql = "SELECT fname,lname,email, category, city, phone,profile_pic,wdes FROM user WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();


    $worker_email = $_GET['email'];
    $sqle = "SELECT AVG(rate) as avgrate FROM appointments WHERE worker_email = '$worker_email'";
    $resultt = $conn->query($sqle);
    if ($resultt->num_rows > 0) {
        $roww = mysqli_fetch_assoc($resultt) ;
        //echo "<p>Rate: " . $roww['avgrate'] . "</p>";}

            echo '<div class="col-lg-12 col-md-6 wow fadeInUp  " data-wow-delay="0.3s ">
    <div class="bg mx-auto text-center p-3" style="width:400px"  >
        <div class="service-item ">
            <img class="img-fluid" style="width:auto; height: 380px" src="' . $row['profile_pic'] . '" alt="">
            <div class="service-img">
                <img class="img-fluid" style="width:auto; height: 100px" src="' . $row['profile_pic'] . '" alt="">
            </div>
            <div class="service-detail">
                <div class="service-title">
                   
                    <h3 class="mt-2">' . $row['fname'] . ' ' . $row['lname'] . '</h3>
                    <hr class="w-25">
                    <h6 class="text-primary mt-1">Rate: ' . $roww['avgrate'] . '</h6>
                    <hr class="w-25">
                    <h6 class="">city: ' . $row['city'] . '</h6>
                    
                </div>

                <div class="service-text ">
                <h6 class="text-white mb-">' . $row['wdes'] . '</h6><br><br> 
              
                </div></div>';

            echo "<form action='test.php' method='post'>
                <input type='hidden' name='email' value='" . $row['email'] . "'>
                <input class='btn btn-light p-md-1' type='submit' value='Make Order' >
              </form>";
            ' </div>';

        }
    }

    else {
        echo "No worker found";
    }

?>
</div>
      </div>
            </div></div></div></div>
  <!-- Testimonial Start -->
  <div class="container-xxl mt-5 py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 style="font-size:12ch;" class="mb-5">What Our Clients Say about <?php echo $row['fname']?>!</h1>
            </div>   
            
<?php
        $sqle = "SELECT review, id FROM appointments WHERE worker_email = '$worker_email'";
        $resultt = $conn->query($sqle);
        if ($resultt->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($resultt)) {
        if (empty($row['review']))
            echo "";
        else {

         echo   '<div class="card">
         <div class="card-header">
        User ID  ' . $row['id'] . '
         </div>
         <div class="card-body">
           <h5 class=" text-primary card-title">' . $row['review'] . '</h5>
         </div>
       </div>';

        } echo'<br>';
  }
   
}  $conn->close();



?>
</div></div></div>        </div></div>



    
  
    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Contact us</h5>
                    
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+962788703033</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@unclemusl7.com</p>
                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="https://twitter.com/Mahmoud_3mareen"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="https://m.facebook.com/people/Mahmoud-Amareen/100083908870062/"><i
                                class="fab fa-facebook-f"></i></a>
                       
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="https://jo.linkedin.com/in/mahmoud-alamareen-086494228"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="about.php">About Us</a>
                    <a class="btn btn-link" href="">Make Appointments</a>
                    <a class="btn btn-link" href="">My Orders</a>
                    <a class="btn btn-link" href="ourteam.php">Our team</a>
                    <a class="btn btn-link" href="service.php">Services</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Business Hours</h5>
                    <p class="mb-1">Monday - Friday</p>
                    <h6 class="text-light">09:00 am - 07:00 pm</h6>
                    <p class="mb-1">Saturday</p>
                    <h6 class="text-light">09:00 am - 12:00 pm</h6>
                    <p class="mb-1">Sunday</p>
                    <h6 class="text-light">Closed</h6>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container text-center">
            <p class="mb-2">Copyright &copy; <a class="fw-semi-bold" href="#">Uncle Musl7</a>, All Right Reserved.
            </p>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>