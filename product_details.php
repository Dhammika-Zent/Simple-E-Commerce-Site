<?php
// Include database connection
include('includes/connect.php');
include('functions/common_functions.php');

// Call the cart() function to handle Add to Cart functionality
cart();

// Get the product ID from the URL parameter
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Fetch product details from the database
$product_query = "SELECT * FROM products WHERE product_id = $product_id";
$product_result = mysqli_query($con, $product_query);

// Check if the product exists
if ($product_result && mysqli_num_rows($product_result) > 0) {
    $product = mysqli_fetch_assoc($product_result);
    $product_title = $product['product_title'];
    $product_description = $product['product_description'];
    $product_image1 = $product['product_image1'];
    $product_image2 = $product['product_image2'];
    $product_image3 = $product['product_image3'];
    $product_price = $product['product_price'];
} else {
    // Redirect to index.php if product is not found
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product_title); ?> - Kasun's Handmades</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar (optional, reused from index.php) -->
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
                        <a class="nav-link fw-bold" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="about_us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="display_all.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="workshops.php">Workshops</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="./users_area/user_registration.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup><?php cartItemCount(); ?></sup></a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="#"><span class="total-price"><?php echo totalCartPrice(); ?></span></a></li>
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
        <li class="nav-item"><a class="nav-link" href="#">Welcome Guest!</a></li>
        <li class="nav-item"><a class="nav-link" href="./users_area/user_login.php">Login</a></li>
    </ul>
</nav>

<!-- Third Child -->
<div class="bg-light" style="padding-top: 20px;">
    <h3 class="text-center">Kasun's Handmades</h3>
    <p class="text-center" style="font-style: italic;">Welcome to the world of handmade products by Kasun Jayasekara...!</p>
</div>

<!-- Product Details Section -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Main Product Image -->
            <img src="./admin_area/product_images/<?php echo htmlspecialchars($product_image1); ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($product_title); ?>">
            <div class="d-flex">
                <!-- Additional Images -->
                <img src="./admin_area/product_images/<?php echo htmlspecialchars($product_image2); ?>" class="img-thumbnail me-2" style="width: 100px; height: 100px;" alt="Additional Image">
                <img src="./admin_area/product_images/<?php echo htmlspecialchars($product_image3); ?>" class="img-thumbnail" style="width: 100px; height: 100px;" alt="Additional Image">
            </div>
        </div>
        <div class="col-md-6">
            <h3 class="fw-bold"><?php echo htmlspecialchars($product_title); ?></h3>
            <p class="text-muted"><?php echo nl2br(htmlspecialchars($product_description)); ?></p>
            <h4 class="text-success fw-bold">Price: <?php echo number_format($product_price, 2); ?> /=</h4>
            <div class="mt-4">
                <a href="index.php?add_to_cart=<?php echo $product_id; ?>" class="btn btn-success btn-lg fw-bold">Add to Cart</a>
                <a href="index.php" class="btn btn-secondary btn-lg fw-bold">Back to Shopping</a>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Section -->
<div class="container mt-5">
    <h4 class="text-center fw-bold">Related Products</h4>
    <div class="row d-flex justify-content-around">
        <?php
        // Fetch related products (randomized, limit 3)
        $related_query = "SELECT * FROM products WHERE product_id != $product_id ORDER BY RAND() LIMIT 3";
        $related_result = mysqli_query($con, $related_query);

        if ($related_result && mysqli_num_rows($related_result) > 0) {
            while ($related = mysqli_fetch_assoc($related_result)) {
                $related_id = $related['product_id'];
                $related_title = $related['product_title'];
                $related_image = $related['product_image1'];
                echo "
                <div class='col-md-3 mb-3'>
                    <div class='card'>
                        <img src='./admin_area/product_images/$related_image' class='card-img-top' alt='$related_title'>
                        <div class='card-body'>
                            <h5 class='card-title fw-bold'>$related_title</h5>
                            <a href='product_details.php?product_id=$related_id' class='btn btn-secondary btn-sm fw-bold'>View More</a>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<p class='text-center'>No related products available.</p>";
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
