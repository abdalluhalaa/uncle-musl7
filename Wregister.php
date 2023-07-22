<?php


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
    // check if form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // retrieve form data
        $firstname = $_POST["fname"];
        $lastname = $_POST["lname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["Password"];
        $confirmpassword = $_POST["CPassword"];
        $city=$_POST["city"];
        $category=$_POST["category"];
        $wdes=$_POST["wdes"];

        
        // -----------------------------------------------------------------

        // validate user input
        if (empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($password) || empty($confirmpassword)) {
            $error_message= "Please fill out all fields.";
        } else if ($password != $confirmpassword) {
            $error_message = "Passwords do not match.";
    } else {
        // check if email already exists in database
        $conn = mysqli_connect('sql306.epizy.com', 'epiz_33450722', 'A96HNCY1Dsv', 'epiz_33450722_users');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $error_message= "Email already exists, please choose another one.";
        } else {
            $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    if (!preg_match($pattern, $password)) {
        $error_message = 'Password must be Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character.';
    } else {
            // hash password
            $password = password_hash($password, PASSWORD_DEFAULT);
            // Check if the password is strong

            $r = '/^07[789]\d{7}$/';
            if (!preg_match($r, $phone)) {
                $error_message = 'Sorry, Phone number must start with 078';
                } else {

                    //image upload
                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $error_message = "File is not an image.";
                        $uploadOk = 0;
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        $error_message = "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
                    // Check file size
                    if ($_FILES["profile_pic"]["size"] > 500000) {
                        $error_message = "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        $error_message = "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {

                            // write to database
                            $role = "worker";
                            $sql = "INSERT INTO user (fname, lname, email, phone, password,city,role,category,profile_pic,wdes)
            VALUES ('$firstname', '$lastname', '$email', '$phone', '$password','$city','$role','$category', '$target_file','$wdes')";

                            if ($conn->query($sql) === TRUE) {
                                header("location: login.php");
                                $_SESSION['logged_in'] = true;
                            } else {
                                $error_message = "Error: " . $sql . "<br>" . $conn->error;
                            }
                        } else {
                            $error_message = "Sorry, there was an error uploading your file.";
                        }
                    }
                }
                $conn->close();
        }}
        }
    }?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Uncle Musl7 - Handyman Register</title>
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
                <a href="index.php" class="nav-item nav-link">Home</a>
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
                            if ($role == 'worker')
                                echo '<a href="wo.php" class="dropdown-item">My Appointments</a>';

                            echo '<a href="opp.php" class="dropdown-item">Order Now!</a>';
                            echo '<a href="my_appointments.php" class="dropdown-item">My Orders</a>';
                        }
                                    ?>
                        <a href="ourteam.php" class="dropdown-item">Our Team</a>

                        
                        <?php if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
                        } else {
                            if ($role == 'admin')
                                echo '<a href="admin.php" class="dropdown-item">All Users</a>';
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
            <h1 class="display-3 text-white animated slideInRight"> Handyman Register</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb animated slideInRight mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Handyman Register</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- WRegister Start -->
    <div class="container-xxl py-5">
        <div class="container " >
            
            <div class="col-lg-12 col-md-6 wow fadeInUp " data-wow-delay="0.3s">
                <div class="bg-light mx-auto text-center p-3" style="width:500px"  >
                    
                 <form action="" method="post" enctype="multipart/form-data">
                   
                   <h1 class="m-5" >Register</h1 >
                   
                   <?php if (isset($error_message)) { echo "<p style=' color: var(--primary); font-style: bold; font-size: 18px; '>$error_message</p>"; } ?>
                    <div class="mx-auto m-5" style="width: 400px;">
                        <div class="mx-auto" style="width: 400px;">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name">
                                <label for="fname">First Name</label>
                            </div>
                        </div>

                        <div class="mx-auto m-3" style="width: 400px;">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name">
                                <label for="lname">Last Name</label>
                            </div>
                        </div>

                        <div class="mx-auto m-3" style="width: 400px;">
                            <div class="form-floating">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                <label for="email">Email</label>
                            </div>
                        </div>

                        <div class="mx-auto" style="width: 400px;">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone number">
                                <label for="phone">Phone number</label>
                            </div>
                        </div>

                <div class="mx-auto m-3" style="width: 400px;">
                    <div class="form-floating">
                        <input type="password" class="form-control" name="Password" id="Password" placeholder="Password">
                        <label for="Password">Password</label>
                        
                    </div>
                </div>

                <div class="mx-auto m-3" style="width: 400px;">
                    <div class="form-floating">
                        <input type="password" class="form-control" name="CPassword" id="CPassword" placeholder="Confirm Password">
                        <label for="CPassword">Confirm Password</label>
                        
                    </div>
                </div>
                
                <div class="mx-auto m-3" style="width: 400px;">
                    <div class="form-floating ">
                        <input list="city" name="city" class="form-control"   placeholder="Your city" >
                        <label for="city">Your city</label>
                        <datalist id="city">
                            <option value="irbid">
                            <option value="Amman">
                            <option value="Zarqa">
                            <option value="Kerak">
                            <option value="Aqaba">
                            <option value="Madaba">
                            <option value="At-Tafilah">
                            <option value="As-Salt">
                            <option value="Al-Mafraq">
                            <option value="Ar-Ramtha">
                            <option value="Ajloun">
                            <option value="Jerash">
                            <option value="Ma'an">
                        </datalist>
                    </div>
                </div>
                <div class="mx-auto m-3" style="width: 400px;">
                    <div class="form-floating ">
                        <input list="category" name="category" class="form-control"   placeholder="Category" >
                        <label for="category">Your Work: </label>
                        <datalist id="category">
                            <option value="Electrician">
                            <option value="Carpentry">
                            <option value="Babysitter">
                            <option value="Assembly">
                            <option value="Installation">
                            <option value="Maintenance">
                            <option value="Painting">
                            <option value="Plumbing">
                            <option value="Repair">
                            <option value="Tiling">
                            
                                
                        </datalist>
                    </div>
                </div>

                <div class="mx-auto m-3" style="width: 400px;">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="wdes" id="wdes" placeholder="About you:">
                                <label for="wdes">About you</label>
                            </div>
                        </div>
                        
                <div class="mx-auto m-3" style="width: 400px;">
                            <div class="form-floating">
                                <input type="file" class="form-control" name="profile_pic" id="profile_pic" accept="image/*" placeholder="Profile Picture:">
                                <label for="profile_pic">Profile Picture:</label>
                            </div>
                                   </div>

                
                    <div class="col-12" style="margin-top: 50px;">
                        <button class="btn btn-primary py-3 px-5" name="submit" type="submit">Continue</button>
                    </div>

                    <h6 class="mb-10" style="margin-top: 20px;"> Or <a href="login.php">Sign in</a>.</h6>
                    <h6 class="mb-10" style="margin-top: 20px;">  <a href="Register.php">Signup as a User</a>.</h6>
                    </div>
                </form>
                </div>
            </div>
               
                    
                </div>
            </div>
        </div>
    </div></form>

    <!-- WRegister End -->


  
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