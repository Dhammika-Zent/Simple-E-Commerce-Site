<?php
// Include necessary files and start session
include('includes/connect.php');
include('functions/common_functions.php'); 
session_start();
cart();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_feedback'])) {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $feedback = mysqli_real_escape_string($con, $_POST['feedback']);
        $query = "INSERT INTO feedback (username, feedback) VALUES ('$username', '$feedback')";
        mysqli_query($con, $query);
        echo "<script>alert('Thank you for your feedback!');</script>";
    } else {
        // Redirect to login with the current page as the "redirect_to" parameter
        $current_page = urlencode($_SERVER['REQUEST_URI']);
        echo "<script>
                alert('Please log in to submit feedback.');
                window.location.href='./users_area/user_login.php?redirect_to=$current_page';
              </script>";
        exit();
    }
}


// Fetch feedback from the database
$feedback_query = "SELECT * FROM feedback ORDER BY id DESC";
$feedback_result = mysqli_query($con, $feedback_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Kasun's Handmades</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
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


    <!-- Contact Us Header -->
    <div class="container mt-4">
        <h3 class="text-center">Contact Us</h3>
        <p class="text-center text-muted" style="font-style: italic;">We value your feedback. Share your thoughts about our site and products!</p>
    </div>

    <!-- Feedback Form -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Leave Your Feedback</h5>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="feedback" class="form-label">Your Feedback</label>
                        <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="submit_feedback" class="btn btn-success fw-bold">Submit Feedback</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Display Feedback -->
    <div class="container mt-5 mb-5">
        <h5>User Feedback</h5>
        <div class="list-group">
            <?php
            if (mysqli_num_rows($feedback_result) > 0) {
                while ($row = mysqli_fetch_assoc($feedback_result)) {
                    echo "
                    <div class='list-group-item'>
                        <h6 class='fw-bold mb-1'>{$row['username'] }</h6>
                        <p class='mb-0'>{$row['feedback']}</p>
                    </div>";
                }
            } else {
                echo "<p class='text-muted'>No feedback available yet. Be the first to leave a comment!</p>";
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

            /* Ensure the entire page is a flex container */
html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

/* Main content area should take available space */
.container {
    flex: 1;
}

/* Footer stays at the bottom */
footer, .footer {
    margin-top: auto;
    background-color: #90EE90;
    padding: 10px;
    text-align: center;
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
</body>
</html>
