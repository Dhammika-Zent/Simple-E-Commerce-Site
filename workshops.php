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
    <title>Workshops - Kasun's Handmades</title>

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

    <!-- Main Content -->
    <div class="container mt-4 mb-4">
        <h3 class="text-center">Workshops</h3>
        <p class="text-center text-muted" style="font-style: italic;">Join our workshops and learn to create your own handmade crafts!</p>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $workshops = [
                ["Crafting Basics", "Learn the art of crafting from scratch.", "img2/crafting.webp", "2024-01-15", "2500"],
                ["Pottery Workshop", "Shape clay into beautiful pottery.", "img2/pottery.jpg", "2024-01-20", "3000"],
                ["Jewelry Making", "Design stunning handmade jewelry.", "img2/jwellery.webp", "2024-01-25", "2000"],
                ["Painting Workshop", "Express yourself through art.", "img2/painting2.avif", "2024-02-01", "1500"],
                ["Fabric Crafting", "Create wonders with fabric.", "img2/fabric.png", "2024-02-10", "1800"],
                ["Woodwork Basics", "Craft wooden items with precision.", "img2/woodwork.jpg", "2024-02-15", "4000"],
            ];

            foreach ($workshops as $workshop) {
                if (!isset($_SESSION['username'])) {
                    // If not logged in, set the redirect URL and redirect to login
                    $button = "<a href='./users_area/user_login.php?redirect_to=../workshops.php' 
                    class='btn btn-success fw-bold'>Book Now</a>";
                } else {
                    // If logged in, show the Book Now button as functional
                    $button = "<button class='btn btn-success fw-bold book-now-btn'>Book Now</button>";
                }
                
            
                echo "
                <div class='col'>
                    <div class='card h-100'>
                        <img src='{$workshop[2]}' class='card-img-top' alt='{$workshop[0]}'>
                        <div class='card-body'>
                            <h5 class='card-title fw-bold'>{$workshop[0]}</h5>
                            <p class='card-text'>{$workshop[1]}</p>
                            <p class='text-muted'><strong>Date:</strong> {$workshop[3]}</p>
                            <p class='text-muted'><strong>Price:</strong> LKR {$workshop[4]}</p>
                            $button
                        </div>
                    </div>
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

            /* Set consistent size and round corners for images */
.card img {
    width: 100%; /* Ensures the image takes up the card width */
    height: 250px; /* Set a fixed height for consistent size */
    object-fit: cover; /* Ensures the image maintains aspect ratio */
    border-radius: 5px; /* Adds rounded corners */

    
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

    <!-- Alert Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.book-now-btn').forEach(button => {
                button.addEventListener('click', function() {
                    alert('Workshop booking successful!');
                });
            });
        });
    </script>
</body>
</html>
