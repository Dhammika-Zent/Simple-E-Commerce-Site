<?php
include ('../includes/connect.php');
include('../functions/common_functions.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

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
        <li class="nav-item"><a class="nav-link" href="user_login.php">Login</a></li>
    </ul>
</nav>

<!-- Third Child -->
<div class="bg-light" style="padding-top: 20px;">
    <h3 class="text-center">Kasun's Handmades</h3>
    <p class="text-center" style="font-style: italic;">Welcome to the world of handmade products by Kasun Jayasekara...!</p>
</div>

    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center mt-2">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">

                <!--username-->
                    <div class="form-outline mb-4 pt-4">
                        <label for="user_username" class="form-label">User Name</label>
                        <input type="text" id="user_username" class="form-control"
                        placeholder="Enter your username" autocomplete="off" required="required" 
                        name="user_username"/>
                    </div>
                        <!--email-->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">E-mail</label>
                        <input type="email" id="user_email" class="form-control"
                        placeholder="Enter your e-mail" autocomplete="off" required="required" 
                        name="user_email"/>
                    </div>
                    <!--user image-->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" class="form-control"
                        required="required" name="user_image"/>
                    </div>

                 <!--password-->
                 <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control"
                        placeholder="Enter your password" autocomplete="off" required="required" 
                        name="user_password"/>
                    </div>

                    <!--confirm password-->
                 <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control"
                        placeholder="Confirm your password" autocomplete="off" required="required" 
                        name="conf_user_password"/>
                    </div>
                    
                    <!--address-->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">User Address</label>
                        <input type="text" id="user_address" class="form-control"
                        placeholder="Enter your address" autocomplete="off" required="required" 
                        name="user_address"/>
                    </div>

                    <!--contact-->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" class="form-control"
                        placeholder="Enter your contact number" autocomplete="off" required="required" 
                        name="user_contact"/>
                    </div>

                    <div class="mt-4 pt-3">
                        <input type="submit" value="Register" class="bg-success py-2 px-3
                        border-0 text-light fw-bold" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php" class="text-success"> Login</a></p>
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

<!--php code-->

<?php
if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();

    //select query
    $select_query="Select * from `user_table` where username='$user_username' or user_email='$user_email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if ($rows_count>0){
        echo "<script>alert('Username or Email already exsits')</script>";
    }else if($user_password!=$conf_user_password){
        echo "<script>alert('Passwords do not match')</script>";
    }
    
    
    else{
      //insert query
    $insert_query="insert into `user_table`
    (username,user_email,user_password,user_image,user_ip,user_address,user_mobile) 
    values('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
    $sql_execute=mysqli_query($con,$insert_query);
    move_uploaded_file( $user_image_tmp,"./user_images/$user_image");  
    }

    //selecting cart items
    $select_cart_items="Select * from `cart_details` 
    where ip_address='$user_ip'";
    $result_cart=mysqli_query($con,$select_cart_items);
    $rows_count=mysqli_num_rows($result_cart);
    if($rows_count>0){
        $_SESSION['username']=$user_username;
        echo "<script>alert('Registration Successfull and You have items in your cart')</script>";
        echo "<script>window.open('payment.php','_self')</script>";
    }else{
        echo "<script>alert('Registation Successfull')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
    
}


?>