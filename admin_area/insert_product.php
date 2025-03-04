<?php
include ('../includes/connect.php'); // Ensure database connection is established

if (isset($_POST['insert_product'])) {
    // Accessing form inputs
    $product_title = mysqli_real_escape_string($con, $_POST['product_title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $product_keywords = mysqli_real_escape_string($con, $_POST['product_keywords']);
    $product_category = mysqli_real_escape_string($con, $_POST['product_category']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);
    $product_status = 'true';

    // Accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // Accessing temporary image paths
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // Checking if fields are empty
    if ($product_title == '' || $description == '' || $product_keywords == '' 
        || $product_category == '' || $product_price == '' || $product_image1 == ''
        || $product_image2 == '' || $product_image3 == '') {
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    } else {
        // Moving images to the appropriate directory
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        // Insert query with reserved keywords wrapped in backticks
        $insert_products = "INSERT INTO `products` (`product_title`, `product_description`, `product_keywords`, `category_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `date`, `status`) 
                            VALUES ('$product_title', '$description', '$product_keywords', '$product_category', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), '$product_status')";

        $result_query = mysqli_query($con, $insert_products);
        if ($result_query) {
            echo "<script>alert('Successfully inserted the product')</script>";
        } else {
            echo "<script>alert('Error inserting the product. Please check your query syntax and database.')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products - Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-light">
    <!-- Navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #90EE90;">
            <div class="container-fluid">
                <img src="../img2/logo2.webp" alt="" class="logo">
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>

        <!-- Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="form-outline mb-4 w-50 m-auto mt-3">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>

            <!-- Description -->
            <div class="form-outline mb-4 w-50 m-auto mt-3">
                <label for="description" class="form-label">Product Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div>

            <!-- Keywords -->
            <div class="form-outline mb-4 w-50 m-auto mt-3">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>

            <!-- Categories -->
            <div class="form-outline mb-4 w-50 m-auto mt-3">
                <select name="product_category" id="product_category" class="form-select">
                    <option value="">Select a Category</option>
                    <?php
                    $select_query = "SELECT * FROM `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Images -->
            <div class="form-outline mb-4 w-50 m-auto mt-3">
                <label for="product_image1" class="form-label">Product Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto mt-3">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto mt-3">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
            </div>

            <!-- Price -->
            <div class="form-outline mb-4 w-50 m-auto mt-3">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>

            <!-- Submit -->
            <div class="form-outline mb-4 w-50 m-auto mt-3">
                <input type="submit" name="insert_product" class="btn btn-success mb-3 px-3" value="Insert Product">
            </div>
        </form>
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
</body>
</html>
