<?php
// Include necessary files and start session
include('includes/connect.php');
include('functions/common_functions.php');
session_start();
cart();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Kasun's Handmades</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Lightbox CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    
    
</head>
<body>
    <!-- Navbar -->
   <!-- Navbar -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #90EE90;">
        <div class="container-fluid">
            <img src="./img2/logo2.webp" alt="" class="logo me-3">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="about_us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="display_all.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="workshops.php">Workshops</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="./users_area/user_registration.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="contact.php">Contact Us</a></li>
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

<!-- Second Child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">

<?php
if (!isset ($_SESSION['username'])){
    echo"  <li class='nav-item'><a class='nav-link' href='#'>Welcome Guest!</a>
    </li>";
}else{
    echo" <li class='nav-item'>
    <a class='nav-link' href='#'>Welcome".$_SESSION['username']."</a>
    </li>";
}

if (!isset ($_SESSION['username'])){
    echo" <li class='nav-item'>
    <a class='nav-link' href='./users_area/user_login.php'>Login</a>
    </li>";
}else{
    echo" <li class='nav-item'>
    <a class='nav-link' href='./users_area/user_logout.php'>Logout</a>
    </li>";
}

?>

</ul>
</nav>


    <!-- Gallery Header -->
    <div class="container mt-4">
        <h3 class="text-center">Gallery</h3>
        <p class="text-center text-muted" style="font-style: italic;">Explore the creativity behind Kasun's handmade products and workshops!</p>
    </div>

    <!-- Gallery Grid -->
    <div class="container">
        <div class="row g-4 mb-4">
            <?php
            // Gallery images array
            $gallery_images = [
                ["img2/gallery1.webp", "Our Iconic Models"],
                ["img2/gallery2.jpg", "Our Art Shows"],
                ["img2/gallery3.avif", "Our Proud Artisans"],
                ["img2/gallery4.jpg", "Our Happy Customers"],
                ["img2/gallery5.webp", "Our Fashion Shows"],
                ["img2/gallery6.webp", "Our Sponsored Festivals"],
                ["img2/gallery7.webp", "Our Suppliers"],
                ["img2/gallery8.jpeg", "Our Prsidential Awards"],
                ["img2/gallery0.webp", "Our Guests"],
            ];

            foreach ($gallery_images as $image) {
                echo "
                <div class='col-md-4 col-sm-6'>
                    <a href='{$image[0]}' data-lightbox='gallery' data-title='{$image[1]}'>
                        <div class='card'>
                            <img src='{$image[0]}' class='card-img-top img-thumbnail' alt='{$image[1]}'>
                           <div class='card-body'>
    <a href='{$image[0]}' data-lightbox='gallery' data-title='{$image[1]}'>
        <h6 class='card-title'>{$image[1]}</h6>
    </a>
</div>

                        </div>
                    </a>
                </div>";
            }
            ?>
        </div>
    </div>

    <script>
    // Function to update the total price dynamically in the navbar
    function updateNavbarTotal() {
        fetch('update_total_price.php') // Make a request to the new PHP script
            .then(response => response.text()) // Parse the response as text
            .then(total => {
                // Update the navbar element with the new total price
                const navbarTotalPrice = document.querySelector('.navbar .total-price');
                if (navbarTotalPrice) {
                    navbarTotalPrice.textContent = `Total Price: ${total} /=`;
                }
            })
            .catch(error => console.error('Error fetching total price:', error));
    }

    // Automatically update the total price when the page loads
    document.addEventListener('DOMContentLoaded', updateNavbarTotal);

    // Optional: If you have quantity buttons, add an event listener to update the price dynamically
    document.querySelectorAll('.quantity-button').forEach(button => {
        button.addEventListener('click', updateNavbarTotal);
    });
</script>

<style>
            .navbar-nav .nav-item .nav-link:hover {
                background-color: #575757;
                color: #fff;
            }

            .navbar-nav .nav-item.bg-success .nav-link {
                background-color: #4CAF50;
            }

            /* Add this in the <style> section */
.card-body {
 
    color:  #28a745;
    padding: 5px;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
}


a h6.card-title {
    text-decoration: none;
}



.card img {
    width: 100%; /* Ensure full width within the card */
    height: 250px; /* Set consistent height */
    object-fit: cover; /* Crop the image to fit */
    border-radius: 5px; /* Rounded corners */
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>
