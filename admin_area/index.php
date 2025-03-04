<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    

    <!--CSS file-->
    <link rel="stylesheet" href="../style.css">
    <style>
.admin_image{
    width: 100px;
    object-fit: contain;
}

    </style>


</head>
<body>
 <!-- Navbar -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #90EE90;"> 
<div class="container-fluid">
    <img src="../img2/logo2.webp" alt="" class="logo">
    <nav class="navbar navbar-expand-lg"> 
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="" class="nav-link fw-bold">Welcome Guest!</a>
            </li>
        </ul>
</nav>
</div>
    </nav>
</div>

    <!-- Second Child -->
    <div class="bg-light">
        <h3 class="text-center p-2">Manage Details</h3>
    </div>

   <!-- Parent Container -->
<div style="display: flex; flex-direction: column; min-height: 100vh;">
    <!-- Content -->
    <div style="flex: 1;">
        <!-- Add your third child and other content here -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-3">
                <div class="text-center">
                    <a href="#"><img src="../img2/Garrix.jpg" alt="" class="admin_image rounded-circle"></a>
                    <p class="text-light text-center mt-2 mb-4">Admin Name</p>
                </div>
                <div class="button d-flex justify-content-center flex-wrap">
                    <!-- Buttons -->
                    <a href="insert_product.php" class="nav-link text-light bg-success mx-1 rounded text-center" style="transition: all 0.3s ease; width: 150px; padding: 10px 0;">Insert Products</a>
                    <a href="#" class="nav-link text-light bg-success mx-1 rounded text-center" style="transition: all 0.3s ease; width: 150px; padding: 10px 0;">View Products</a>
                    <a href="index.php?insert_category" class="nav-link text-light bg-success mx-1 rounded text-center" style="transition: all 0.3s ease; width: 150px; padding: 10px 0;">Insert Categories</a>
                    <a href="#" class="nav-link text-light bg-success mx-1 rounded text-center" style="transition: all 0.3s ease; width: 150px; padding: 10px 0;">View Categories</a>
                    <a href="#" class="nav-link text-light bg-success mx-1 rounded text-center" style="transition: all 0.3s ease; width: 150px; padding: 10px 0;">All Orders</a>
                    <a href="#" class="nav-link text-light bg-success mx-1 rounded text-center" style="transition: all 0.3s ease; width: 150px; padding: 10px 0;">All Payments</a>
                    <a href="#" class="nav-link text-light bg-success mx-1 rounded text-center" style="transition: all 0.3s ease; width: 150px; padding: 10px 0;">List Users</a>
                    <a href="#" class="nav-link text-light bg-success mx-1 rounded text-center" style="transition: all 0.3s ease; width: 150px; padding: 10px 0;">LogOut</a>
                </div>
            </div>
        </div>
    </div>

    <!--fourth child-->
    <div class="container my-5">
        <?php 
        if (isset($_GET['insert_category'])){
            include('insert_categories.php');
        }
        ?>
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
</div>




        </div>
        </div>
    </div>
  </div>

<!--bootstrap JS link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>

</body>
</html>