<?php
include('../includes/connect.php');
include('../functions/common_functions.php');

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ./users_area/user_login.php');
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT * FROM user_table WHERE username='$username'";
$result = mysqli_query($con, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('No user found.');</script>";
    exit();
}

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Kasun's Handmades</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

        body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
}

.content {
    flex: 1;
}

footer {
    background-color: #90EE90;
    padding: 10px;
    text-align: center;
}
.profile-img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 4px solid #4CAF50; /* Green border */
    transition: transform 0.3s ease, border-color 0.3s ease; /* Smooth transition */
}

.profile-img:hover {
    transform: scale(1.1); /* Slight zoom effect */
    border-color: #90EE90; /* Change border color on hover (Tomato color) */
}

.profile-container h2 {
    margin-top: 20px;
    color: #333;
}

.profile-container p {
    font-size: 1.1em;
    color: #555;
}



        
    </style>
</head>
<body>

<!-- Navbar -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #90EE90;">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">
                <img src="../img2/logo2.webp" alt="Kasun's Handmades" class="logo me-3">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active fw-bold" aria-current="page" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="../about_us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="../display_all.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="../workshops.php">Workshops</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="../gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="user_registration.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="../contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup><?php cartItemCount(); ?></sup></a></li>
     
                </ul>
                <form class="d-flex" action="search_product.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                    <input type="submit" value="search" class="btn btn-outline-light fw-bold" name="search_data_product">
                </form>
            </div>
        </div>
    </nav>
</div>

<!-- Main Content -->
<div class="content">
    <div class="container">
        <div class="profile-container mt-5">
            <div class="text-center">
                <img src="user_images/<?php echo $user['user_image']; ?>" alt="User Image" class="profile-img mb-3">
                <h2><?php echo $user['username']; ?></h2>
                <p><strong>Email:</strong> <?php echo $user['user_email']; ?></p>
                <p><strong>Address:</strong> <?php echo $user['user_address']; ?></p>
                <p><strong>Mobile:</strong> <?php echo $user['user_mobile']; ?></p>
                <a href="../index.php" class="btn btn-success fw-bold mt-3 mb-5">Back to Home</a>
            </div>
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


<!-- Footer -->
<div style="background-color: #90EE90; padding: 10px; text-align: center;">
    <p style="font-weight: bold;">© 2024 Kasun's Handmades. All Rights Reserved. | Designed by Dhammika.</p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
