<?php
// Include the database connection file
include('includes/connect.php');
include('functions/common_functions.php'); 
session_start();

// Call the cart() function to handle Add to Cart functionality
cart();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasun's Handmades</title>

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
        .card {
            height: 480px; /* Fixed card height */
        }

        .card-body {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 6; /* Limit to 6 lines */
            -webkit-box-orient: vertical;
        }

        .card img {
            height: 250px; /* Fixed height for images */
            object-fit: cover;
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
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="about_us.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="display_all.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="workshops.php">Workshops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="gallery.php">Gallery</a>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="./users_area/user_registration.php">Register</a></li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup>
                            <?php cartItemCount(); ?></sup></a>
                    </li>
                   
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

<!-- Fourth Child -->
<div class="container">
    <div class="row">
        <!-- Main Content (Cards) -->
        <div class="col-md-10">
            <div class="row d-flex justify-content-around">

                <!-- Fetching Products -->
                <?php
                $select_query = "SELECT * FROM `products` ORDER BY RAND() LIMIT 0,50";
                $result_query = mysqli_query($con, $select_query);

                if ($result_query && mysqli_num_rows($result_query) > 0) {
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_description = $row['product_description'];
                        $product_image1 = $row['product_image1'];
                        $product_price = $row['product_price'];
echo "
<div class='col-md-4 mb-2'>
    <div class='card'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' 
        alt='$product_title'>
        <div class='card-body'>
            <h5 class='card-title fw-bold italic'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-success fw-bold italic'>
            Add to cart</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary 
            fw-bold italic'>View More</a>
        </div>
    </div>
</div>";

                    }
                }
                ?>

            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-2 bg-secondary p-0">
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-success">
                    <a href="#" class="nav-link text-white"><h4>Categories</h4></a>
                </li>
                <?php
                $select_categories = "SELECT * FROM categories";
                $result_categories = mysqli_query($con, $select_categories);

                if ($result_categories && mysqli_num_rows($result_categories) > 0) {
                    while ($row_data = mysqli_fetch_assoc($result_categories)) {
                        $category_title = $row_data['category_title'];
                        $category_id = $row_data['category_id'];
                        echo "<li class='nav-item'>
                                <a href='index.php?category=$category_id' 
                                class='nav-link text-light fw-bold category-link'>$category_title</a>
                              </li>";
                    }
                } else {
                    echo "<li class='nav-item'>
                            <a href='#' class='nav-link text-light'>No Categories Available</a>
                          </li>";
                }
                ?>
            </ul>
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

    </div>
</div>

<!-- Last Child -->
<div style="background-color: #90EE90; padding: 10px; text-align: center;">
    <p style="font-weight: bold;">© 2024 Kasun's Handmades. All Rights Reserved. | Designed by Dhammika.</p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>

</body>
</html>
