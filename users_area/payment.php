<?php
// Include database connection and utility functions
include('../includes/connect.php');
include('../functions/common_functions.php');

// Session start
session_start();

// Ensure the user is logged in before accessing payment
if (!isset($_SESSION['username'])) {
    header('Location: user_login.php');
    exit();
}

// Retrieve cart details
$ip_address = getIPAddress();
$query = "SELECT * FROM cart_details JOIN products ON cart_details.product_id = products.product_id WHERE cart_details.ip_address = '$ip_address'";
$result = mysqli_query($con, $query);

// Calculate total price
$total_price = 0;
$cart_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cart_items[] = $row;
    $total_price += $row['quantity'] * $row['product_price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Kasun's Handmades</title>

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


    <style>
/* Reset margins and paddings for consistent layout */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.logo{
    width:7%;
    height: 7%;
}

/* Ensure the body and html occupy full height */
html, body {
    height: 100%;
}

/* Main layout structure */
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Ensure the body covers full height */
}

/* Content section that grows to fill space */
.container {
    flex: 1; /* Push the footer to the bottom of the page */
}

/* Footer styling */
footer {
    background-color: #90EE90;
    text-align: center;
    padding: 10px;
    font-weight: bold;
    margin-top: auto;
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
                    <li class="nav-item"><a class="nav-link active fw-bold" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="../cart.php"><i class="fa fa-shopping-cart"></i><sup><?php cartItemCount(); ?></sup></a></li>
                   
                </ul>
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
    <a class='nav-link' href='../users_area/user_login.php'>Login</a>
    </li>";
}else{
    echo" <li class='nav-item'>
    <a class='nav-link' href='../users_area/user_logout.php'>Logout</a>
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

<!-- Payment Section -->
<div class="container mt-5">
    <h3 class="text-center">Payment</h3>
    <p class="text-center">Review your order and complete your purchase.</p>

    <!-- Order Summary -->
    <div class="row">
        <div class="col-md-8">
            <h5>Order Summary</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?php echo $item['product_title']; ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo $item['product_price']; ?> /=</td>
                            <td><?php echo $item['quantity'] * $item['product_price']; ?> /=</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Payment Details -->
        <div class="col-md-4">
            <h5>Total Price</h5>
            <p class="fw-bold"><?php echo $total_price; ?> /=</p>
            <form action="#" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name on Card</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="card_number" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="card_number" name="card_number" maxlength="16" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="expiry" class="form-label">Expiry Date</label>
                        <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="password" class="form-control" id="cvv" name="cvv" maxlength="3" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100 mb-4 payment-btn">Pay Now</button>
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


<!-- Footer -->
<div style="background-color: #90EE90; padding: 10px; text-align: center;">
    <p style="font-weight: bold;">© 2024 Kasun's Handmades. All Rights Reserved. | Designed by Dhammika.</p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.payment-btn').forEach(button => {
                button.addEventListener('click', function() {
                    alert('Payment Successful');
                });
            });
        });
    </script>
</body>
</html>
