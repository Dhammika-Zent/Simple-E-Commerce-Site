<?php
// Ensure connect.php exists and initializes the $con variable.
include('includes/connect.php'); 
include('functions/common_functions.php');
session_start(); // Include the file containing getIPAddress() function

// Call the cart() function to handle Add to Cart functionality
cart();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Kasun's Handmades</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <style>
        /* Image Hover Effect */
        .img-fluid:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Back to Home Button */
        .back-home-btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .back-home-btn:hover {
            background-color: #3d8b40;
            color: #fff;
        }

        /* Add spacing between sections */
        .section-spacing {
            margin-top: 30px;
        }
    </style>
</head>

<body>

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
                    <li class="nav-item"><a class="nav-link active fw-bold" aria-current="page" href="./index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="#">About Us</a></li>
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

<!-- Third Child -->
<div class="bg-light" style="padding-top: 20px;">
    <h3 class="text-center">Kasun's Handmades</h3>
    <p class="text-center" style="font-style: italic;">Welcome to the world of handmade products by Kasun Jayasekara...!</p>
</div>

<!-- About Us Content -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="./img2/about_us.jpg" alt="Kasun's Handmades" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h2 class="text-success">Our Story...</h2>
            <p>At <strong>Kasun's Handmades</strong>,we are deeply committed to preserving and celebrating the rich heritage of Sri Lankan craftsmanship. Our journey is rooted in a profound respect for tradition, artistry, and the stories that handmade creations carry. With each product, we aim to showcase the unparalleled beauty and uniqueness of locally crafted items that are infused with the heart and soul of skilled artisans.
Kasun Jayasekara, our founder, envisioned a platform where traditional craftsmanship could flourish and thrive in a modern world.</p>
 <p> This vision grew into a mission to protect Sri Lanka’s cultural legacy while bringing it to a global audience. From the intricate patterns that echo centuries-old traditions to the eco-friendly materials that reflect our commitment to sustainability, every piece we create is a testament to dedication, meticulous skill, and a love for preserving the essence of our culture.</p>
 <p>Our journey began as a dream to uplift local artisans, giving them the recognition and support they deserve. 
Through this initiative, we strive to empower these talented individuals by providing them with opportunities to share their exceptional creations with the world. By blending the timeless techniques of our ancestors with innovative, contemporary designs, we ensure that our products remain relevant, functional, and meaningful in today’s dynamic lifestyle.</p>
        </div>
    </div>

    

    <!-- Back to Home Button -->
    <div class="text-center mt-5">
        <a href="index.php" class="back-home-btn bg-success">Back to Shopping</a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
</body>
</html>
