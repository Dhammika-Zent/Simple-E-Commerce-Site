<?php
// Include database connection and functions
include('includes/connect.php'); 
include('functions/common_functions.php');

//session starting
session_start();

// Call the cart() function to handle Add to Cart functionality
cart();
removeCartItem();




// Handle quantity update operations
if (isset($_GET['update_quantity']) && isset($_GET['product_id']) && isset($_GET['operation'])) {
    $product_id = intval($_GET['product_id']);
    $operation = $_GET['operation']; // 'increase' or 'decrease'
    updateCartItemQuantity($product_id, $operation);
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']); // Adjust 'user_id' to match your session key
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

<style>
    /* Make the entire body a flex container */
    html, body {
        height: 100%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    /* Ensure the main content takes up remaining space */
    .container {
        flex: 1;
    }

    /* Footer stays at the bottom */
    footer {
        background-color: #90EE90;
        padding: 10px;
        text-align: center;
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
                    <li class="nav-item"><a class="nav-link fw-bold" href="about_us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="display_all.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="workshops.php">Workshops</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="./users_area/user_registration.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup><?php cartItemCount(); ?></sup></a></li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#"><span class="total-price"><?php echo totalCartPrice(); ?></span></a>
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

<!-- Cart Items Section -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Your Cart Items</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$ip_address = getIPAddress();
$query = "SELECT * FROM cart_details JOIN products ON cart_details.product_id = products.product_id WHERE cart_details.ip_address = '$ip_address'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<table class="table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_image = $row['product_image1'];
        $quantity = $row['quantity'];
        $price = $row['product_price'];
        $total = $quantity * $price;

        echo "
        <tr>
            <td><img src='./admin_area/product_images/$product_image' width='60'></td>
            <td>$product_title</td>
            <td>
                <a href='cart.php?update_quantity=1&product_id=$product_id&operation=decrease' class='btn btn-sm btn-outline-secondary'>-</a>
                $quantity
                <a href='cart.php?update_quantity=1&product_id=$product_id&operation=increase' class='btn btn-sm btn-outline-secondary'>+</a>
            </td>
            <td>$price /=</td>
            <td>$total /=</td>
            <td>
                <a href='cart.php?remove_item=$product_id' class='btn btn-danger btn-sm'>Remove</a>
            </td>
        </tr>";
    }
    echo '</tbody></table>';
    echo '<h5 class="text-center">Total Price: ' . fetchTotalCartPrice() . ' /=</h5>';
} else {
    // Added this section for the empty cart message
    echo '<p class="text-center text-muted">Your cart is empty. Add some items to your cart to get started!</p>';
}
?>

</tbody>

            </table>

             <!-- Display Total Price Below Table -->
            <!-- Total Price Already Displayed Above -->


             <div class="cart-buttons text-center mt-5">
                <a href="index.php" class="btn btn-secondary">Back to Shopping</a>
                <a href="<?php echo $isLoggedIn ? 'payment.php' : 'users_area/user_login.php'; ?>" class="btn btn-success">Proceed to Checkout</a>
                </div>
        </div>
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

<style>
    /* Button Hover Effect */
    .btn:hover {
        background-color: #575757;
        color: #fff;
    }

    /* Back to Home Button Specific Styling */
    .btn-back-to-home {
        background-color: #575757;
        color: #fff;
        font-weight: bold;
    }

    /* Make Buttons Bold */
    .btn {
        font-weight: bold;
    }

    /* Adjust Buttons Position */
    .cart-buttons {
        margin-bottom: 40px; /* Increased space above the footer */
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
