<?php
// Start the session
session_start();

// Check if the user is logged in, if not then redirect him to login page

if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
     $p ='<a href="login.php" class="btn btn-primary px-3 d-none d-lg-block">Login Now!</a>';
    
}
else {
     //$p= '<p class="nav-item nav-link">Hello!</p>';
     

// Include config file 
    $conn = mysqli_connect('sql306.epizy.com', 'epiz_33450722', 'A96HNCY1Dsv', 'epiz_33450722_users');
// Define variables and initialize with empty values
$email=$_SESSION["email"];

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
  $n= $row['fname'];
  $e= $row['email'];
  $c= $row['city'];
  $user_id = $row['id'];
  $role =$row['role'];
} else {
  // No rows were returned, so the email address was not found
  echo "No user found with email address '$email'";
}
//$p = '<pr class="nav-item nav-link">Hey ' . $n . ' !</pr>' ;
$p =  '<h4  class="nav-item nav-link">Hey ' . $n . ' !</h4>';

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
                
    $sql = "SELECT COUNT(*) AS id FROM user";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $num_users = 15;
    if($num_users<$row['id'])
    $num_users = $row['id'];
    
    $sqle = "SELECT COUNT(*) as total FROM user WHERE role = 'worker'";
    $resultt = mysqli_query($conn, $sqle);
    $roww = mysqli_fetch_assoc($resultt);
    $num_workers = $roww['total'];
    
  

// Close the database connection
mysqli_close($conn);}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Uncle Musl7 - Home</title>
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
                <a href="index.php" class="nav-item nav-link active">Home</a>
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


    <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 text-start">
                                        
                                    <h1 class="display-1 text-white mb-5 animated slideInRight">Industrial Solution
                                        Providing Company</h1>
                                       <?php if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
                                    echo '<a href="login.php" ><h1 class="display-2 text-primary  animated slideInRight"> Login!  <h1></a>';}?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 text-start">
                                    
                                    <h1 class="display-1 text-white mb-5 animated slideInRight">The Best Reliable
                                        Industry Solution</h1>
                                      <?php if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
                                    echo '<a href="login.php" ><h1 class="display-2 text-primary  animated slideInRight"> Login!  <h1></a>';}?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="row gx-3 h-100">
                        <div class="col-6 align-self-start wow fadeInUp" data-wow-delay="0.1s">
                            <img class="img-fluid" src="img/aaa.jpg">
                        </div>
                        <div class="col-6 align-self-end wow fadeInDown" data-wow-delay="0.1s">
                            <img class="img-fluid" src="img/about-2.jpg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-5 mb-4">We Are Leader In Industrial Market</h1>
                    <p  style="font-size: 2.3ch;" class="text  mb-4">The person advertising home repair services from the back of his pickup truck is not Uncle Musl7.</p>
                    <p  style="font-size: 2.3ch;" class="text  mb-4"> Uncle Musl7 is a dependable, personal home improvement adviser. Our trained artisans have an average of ten years of trade experience and are knowledgeable, dependable, and professional home repair and renovation technicians.</p>

                    <p  style="font-size: 2.3ch;" class="text  mb-4">    You shouldn't trust just anyone to be in your home because you don't have time to waste on a service that isn't trustworthy and reputable. Uncle Musl7 is the handyman you can rely on to complete the job correctly when you require professional services.
                    </p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 bg-primary p-4">
                            <h1 class="display-2">10</h1>
                            <h5 class="text-white">Services</h5>
                            
                        </div>
                        <div class="ms-4">
                            <p><i class="fa fa-check text-primary me-2"></i>Electrician</p>
                            <p><i class="fa fa-check text-primary me-2"></i>Carpentry</p>
                            <p><i class="fa fa-check text-primary me-2"></i>Babysitter</p>
                            <p><i class="fa fa-check text-primary me-2"></i>Assembly</p>
                            <p><i class="fa fa-check text-primary me-2"></i>Installation</p>
                            <p><i class="fa fa-check text-primary me-2"></i>Maintenance</p>
                            <p><i class="fa fa-check text-primary me-2"></i>Painting</p>
                            <p><i class="fa fa-check text-primary me-2"></i>Plumbing</p>
                            
                            <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Repair</p>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-envelope-open text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-2">Email us</p>
                                    <h5 class="mb-0">info@unclemusl7.com</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-phone-alt text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-2">Call us</p>
                                    <h5 class="mb-0">+962788703033</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Facts Start -->
    <div class="container-fluid facts my-5 p-5">
        <div class="row g-5">
            <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="text-center border p-5">
                    <i class="fa fa-certificate fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">13</h1>
                    <span class="fs-5 fw-semi-bold text-white">Cities</span>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.3s">
                <div class="text-center border p-5">
                    <i class="fa fa-users-cog fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up"><?php echo $num_workers; ?></h1>
                    <span class="fs-5 fw-semi-bold text-white">Team Members</span>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.5s">
                <div class="text-center border p-5">
                    <i class="fa fa-users fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up"><?php echo $num_users; ?></h1>
                    <span class="fs-5 fw-semi-bold text-white">Happy Clients</span>
                </div>
            </div>  
            <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.7s">
                <div class="text-center border p-5">
                    <i class="fa fa-check-double fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">10</h1>
                    <span class="fs-5 fw-semi-bold text-white">Services</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->




    <!-- Video Modal Start -->
    <div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Youtube Video</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                            allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->



    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative me-lg-4">
                        <img class="img-fluid w-100" src="img/7.jpg" alt="">
                        <span
                            class="position-absolute top-50 start-100 translate-middle bg-white rounded-circle d-none d-lg-block"
                            style="width: 120px; height: 120px;"></span>
                        <button type="button" class="btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <h1 class="display-5 mb-4">Few Reasons Why People Choosing Us!</h1>
                    </p>
                    <div class="row gy-4">
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <div class="ms-4">
                                    <h4>Experienced Workers</h4>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <div class="ms-4">
                                    <h4>Reliable Industrial Services</h4>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <div class="ms-4">
                                    <h4>24/7 Customer Support</h4>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Video Modal Start -->
    <div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Youtube Video</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="index.php" id="video" allowfullscreen
                            allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->


    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-5 mb-4">We Provide Best Industrial Services</h1>
            </div>
            <div class="row gy-5 gx-4">

                <div class="card mx-auto wow fadeInUp " style="max-width: 500px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="img/Electriciann.jpg" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Electrician</h5>
                          <p class="card-text">Have you ever undertaken any electrically related home projects? Hire one of our handymen if hiring an electrician seems excessive. We can add new features and update current ones.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                
                <div class="card mx-auto wow fadeInUp " style="max-width: 500px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="img/Carpentry.jpg" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Carpentry</h5>
                          <p class="card-text">Nothing but expert, specialized carpentry gives a house a more distinctive or lovely appearance. Mantels, cabinets, shelving, and other new additions can be installed and built by our crew.</p>
                        </div>
                      </div>
                    </div>
                  
                </div>
                
                <div class="card mx-auto wow fadeInUp " style="max-width: 500px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="img/Babysitter.jpg" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Babysitter</h5>
                          <p class="card-text">Uncle Musl7 helps people just like you find trustworthy, affordable care. We give you the most advanced search tools and security systems available to make it safe and easy to find Babysitters with the specific traits and experience you want. </p>
                          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mx-auto wow fadeInUp " style="max-width: 500px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="img/Assembly.jpg" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Assembly</h5>
                          <p class="card-text">Almost infrequently does "some assembly required" merely mean "some." Let our skilled handymen do it for you to save the hassle of attempting to understand furniture instructions. </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mx-auto wow fadeInUp " style="max-width: 500px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="img/Installationn.jpg" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Installation</h5>
                          <p class="card-text">You may remove the old and bring in the new with our assistance! We can be relied upon to handle any of your installation jobs, from new floors to new doors. </p>
                        </div>
                      </div>
                    </div>
                  </div>

                 

                  <div class="card mx-auto wow fadeInUp " style="max-width: 500px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="img/Maintenancee.jpg" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Maintenance</h5>
                          <p class="card-text">Your home will continue to look its best with regular maintenance. No matter how big or tiny the projects are that are piling up on your to-do list, let us handle them all. </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mx-auto wow fadeInUp " style="max-width: 500px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="img/Painting.jpg" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Painting</h5>
                          <p class="card-text">Our painting services can add color to your house! We can take care of it for you whether you want to paint your walls or bring vitality to furniture with a fresh stain job. </p>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="card mx-auto wow fadeInUp " style="max-width: 500px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="img/Plumbing.jpg" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Plumbing</h5>
                          <p class="card-text">If not addressed properly, plumbing issues can cause damage to your house in addition to being inconvenient. Allow us to provide the services you require to maintain the functionality of your house. </p>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="card mx-auto wow fadeInUp " style="max-width: 500px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="img/Repair.jpg" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Repair</h5>
                          <p class="card-text">It's straightforward; we can repair everything that is damaged in your house. Our repair services can help you save time and money while maintaining the greatest possible appearance for your house. </p>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="card mx-auto wow fadeInUp " style="max-width: 500px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="img/Tiling.jpg" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Tiling</h5>
                          <p class="card-text">Our workers have extensive knowledge and experience in all aspects of tiling. </p>
                        </div>
                      </div>
                    </div>
                  </div>


            </div></div> 
        </div>
    </div>
    <!-- Service End -->

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