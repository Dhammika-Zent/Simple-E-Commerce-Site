<?php
include ('../includes/connect.php');

if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];

    //select data from database
    $select_query = "Select * from `categories` where category_title='$category_title'";
    $result_select= mysqli_query($con, $select_query);
   $number=mysqli_num_rows($result_select);
   if($number>0){
    echo "<script>alert('This category is present inside the database')</script>";
   }
    $insert_query = "INSERT INTO `categories`(`category_title`) VALUES ('$category_title')";

    $result = mysqli_query($con, $insert_query);
    
    if ($result) {
        echo "<script>alert('Category has been inserted successfully')</script>";
    } else {
        echo "<script>alert('Failed to insert category')</script>";
    }
}
?>


<!-- Form Section -->
<div class="container my-5"> <!-- Added `my-5` for vertical spacing -->
    <form action="" method="post" class="mb-2">
        <div class="input-group w-90 mb-2">
            <span class="input-group-text bg-success" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
            <input type="text" class="form-control" name="cat_title" placeholder="Insert categories" aria-describedby="basic-addon1">
        </div>

        <div class="input-group w-10 mb-2 m-auto">
          <input type="Submit" class="bg-success border-0 p-2 rounded text-light my-5" name="insert_cat" value="Insert Categories">
           
        </div>
    </form>
</div>

