<?php
// Function to get the current IP address
function getIPAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

//including connect file
//include('./includes/connect.php');

// Function to display categories
function displayCategories() {
    global $con;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];
        echo "<li class='nav-item'><a href='index.php?category=$category_id' class='nav-link text-light fw-bold'>$category_title</a></li>";
    }
}

// Function to display products by category
function displayProductsByCategory($category_id) {
    global $con;
    $query = "SELECT * FROM products WHERE category_id = $category_id";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echoProductCard($row);
    }
}

// Function to display default products
function displayDefaultProducts() {
    global $con;
    $query = "SELECT * FROM products ORDER BY RAND() LIMIT 6";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echoProductCard($row);
    }
}

// Function to output a product card
function echoProductCard($row) {
    $product_id = $row['product_id'];
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_image1 = $row['product_image1'];
    
   
    echo "
    <div class='col-md-4 mb-4'>
        <div class='card'>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
                <h5 class='card-title fw-bold italic'>$product_title</h5>
                <p class='card-text'>$product_description</p>
               
                <a href='index.php?add_to_cart=$product_id' class='btn btn-success fw-bold'>Add to Cart</a>
                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary fw-bold'>View More</a>
               
            </div>
        </div>
    </div>";
}

// Function to count cart items
function cartItemCount() {
    global $con;
    $ip_address = getIPAddress();
    $query = "SELECT COUNT(*) AS count FROM cart_details WHERE ip_address = '$ip_address'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row['count'];
}

// Function to calculate total cart price
function totalCartPrice() {
    global $con;
    $ip_address = getIPAddress();
    $query = "SELECT SUM(products.product_price) AS total FROM cart_details JOIN products ON cart_details.product_id = products.product_id WHERE ip_address = '$ip_address'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row['total'] ? $row['total'] : 0;
}

// Function to handle cart
function cart() {
    global $con;
    if (isset($_GET['add_to_cart'])) {
        $product_id = intval($_GET['add_to_cart']);
        $ip_address = getIPAddress();

        $query = "SELECT * FROM cart_details WHERE ip_address = '$ip_address' AND product_id = $product_id";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Product already in cart');</script>";
        } else {
            $insert = "INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ($product_id, '$ip_address', 1)";
            mysqli_query($con, $insert);
            echo "<script>alert('Product added to cart');</script>";
        }
    }
}

// Function to remove an item from the cart
function removeCartItem() {
    global $con;
    if (isset($_GET['remove_item'])) {
        $remove_id = $_GET['remove_item'];
        $ip_address = getIPAddress();
        $query = "DELETE FROM cart_details WHERE product_id='$remove_id' AND ip_address='$ip_address'";
        mysqli_query($con, $query);
        echo "<script>alert('Item removed from the cart')</script>";
        echo "<script>window.open('cart.php', '_self')</script>";
    }
}

// Function to update cart item quantity
function updateCartItemQuantity($product_id, $operation) {
    global $con;
    $ip_address = getIPAddress();

    if ($operation === 'increase') {
        $query = "UPDATE cart_details SET quantity = quantity + 1 WHERE product_id = $product_id AND ip_address = '$ip_address'";
    } elseif ($operation === 'decrease') {
        $query = "UPDATE cart_details SET quantity = quantity - 1 WHERE product_id = $product_id AND ip_address = '$ip_address' AND quantity > 1";
    }

    mysqli_query($con, $query);

    echo "<script>window.open('cart.php', '_self')</script>";
}

// Function to fetch and return total cart price for AJAX requests
function fetchTotalCartPrice() {
    global $con;
    $ip_address = getIPAddress();

    // Query to calculate the total cart price
    $query = "SELECT SUM(products.product_price * cart_details.quantity) AS total 
              FROM cart_details 
              JOIN products 
              ON cart_details.product_id = products.product_id 
              WHERE ip_address = '$ip_address'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    // Return total price as a number
    return $row['total'] ? $row['total'] : 0;
}





?>
