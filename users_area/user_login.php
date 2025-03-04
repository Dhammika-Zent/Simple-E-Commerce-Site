<?php
session_start();
include('../includes/connect.php');
include('../functions/common_functions.php');
// Get redirect_to parameter from the URL (if present)
if (isset($_GET['redirect_to'])) {
    $_SESSION['redirect_to'] = $_GET['redirect_to'];
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <style>
        .logo{
    width:7%;
    height: 7%;
}

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    height: 100%; /* Ensure the body and html occupy full height */
}

body {
    display: flex;
    flex-direction: column;
}

.container-fluid.my-5 {
    flex: 1; /* Allow the content section to grow and push the footer to the bottom */
}

footer {
    margin-top: auto; /* Push the footer to the bottom of the page */
}


    </style>

</head>
<body>

<!-- Navbar -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #90EE90;">
        <div class="container-fluid">
            <img src="../img2/logo2.webp" alt="" class="logo me-3">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="../about_us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="../display_all.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="../workshops.php">Workshops</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="../gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="user_registration.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="../contact.php">Contact Us</a></li>
                   
                </ul>
                
            </div>
        </div>
    </nav>
</div>

<!-- Second Child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="#">Welcome Guest!</a></li>
      
    </ul>
</nav>

<!-- Third Child -->
<div class="bg-light" style="padding-top: 20px;">
    <h3 class="text-center">Kasun's Handmades</h3>
    <p class="text-center" style="font-style: italic;">Welcome to the world of handmade products by Kasun Jayasekara...!</p>
</div>



    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-3">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post">

                <!--username-->
                    <div class="form-outline mb-4 pt-2">
                        <label for="user_username" class="form-label">User Name</label>
                        <input type="text" id="user_username" class="form-control"
                        placeholder="Enter your username" autocomplete="off" required="required" 
                        name="user_username"/>
                    </div>
                       
                    

                 <!--password-->
                 <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control"
                        placeholder="Enter your password" autocomplete="off" required="required" 
                        name="user_password"/>
                    </div>

                  
                    
                    

                   
                    <div class="mt-4 pt-3">
                        <input type="submit" value="Login" class="bg-success py-2 px-3
                        border-0 text-light fw-bold" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php" class="text-success"> Register</a></p>
                    </div>


                    


                </form>
            </div>
        </div>
    </div>
    <style>
            .navbar-nav .nav-item .nav-link:hover {
                background-color: #575757;
                color: #fff;
            }

            .navbar-nav .nav-item.bg-success .nav-link {
                background-color: #4CAF50;
            }

            .logo {
    width: 60px; /* Adjust the width as needed */
    height: 60px; /* Adjust the height as needed */
    border-radius: 50%; /* Ensure it's rounded */
    object-fit: cover; /* Ensures the logo doesn't get distorted */
}
        </style>


<footer>
    <div style="background-color: #90EE90; padding: 10px; text-align: center;">
        <p style="font-weight: bold;">© 2024 Kasun's Handmades. All Rights Reserved. | Designed by Dhammika.</p>
    </div>
</footer>



</body>
</html>

<?php

if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    
    // Check if the user exists in the database
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();

    // Check cart items for the user's IP
    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $select_cart = mysqli_query($con, $select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);

    if ($row_count > 0) {
        if (password_verify($user_password, $row_data['user_password'])) {
            $_SESSION['username'] = $user_username; // Set session variable

             // Determine redirection after login
             echo "<script>alert('Login Successful')</script>";
             if (isset($_SESSION['redirect_to'])) {
                $redirect_url = $_SESSION['redirect_to'];
                unset($_SESSION['redirect_to']); // Clear the session variable after use
                echo "<script>window.open('$redirect_url', '_self')</script>";
            } else if ($row_count_cart == 0) {
                echo "<script>window.open('profile.php', '_self')</script>";
            } else {
                echo "<script>window.open('payment.php', '_self')</script>";
            }
            
         } else {
             echo "<script>alert('Invalid Credentials')</script>";
         }
     } else {
         echo "<script>alert('Invalid Credentials')</script>";
     }
 }


?>