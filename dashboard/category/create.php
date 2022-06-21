<?php
require '../helpers/dbconnection.php';
require '../helpers/functions.php';


################################################################################################################
  // Logic . . .

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $category_name = Clean($_POST['category_name']);
    $category_description = Clean($_POST['category_desc']);

    # Validate Input . . . 
    $errors = [];
    
    if(!Validate('$category_name','required')){
        $errors['category_name'] = "Field Required";
    }elseif(!Validate($category_name ,'min',3)){
        $errors['category_name'] = "Length Must be >= 3 chars";
    }



    # Check if there are any errors . . .
    if (count($errors) > 0) {
      // print errors 
      $_SESSION['message'] = $errors;
  } else {

      $imageName = upload($_FILES);
      if ($imageName == false) {
          $message = ["Error" => "Error Uploading File"];
      } else {

        $sqlInsert = "insert into category ('category_name','category_description','image') VALUES ('$category_name','$category_description','$imageName')";
        $operation  = DoQuery($sqlInsert);

          if ($operation) {
              $message = ['Success' => 'User Created Successfully'];
          } else {
              $message = mysqli_error($conn);
          }
      }

      $_SESSION['message'] = $message;
  }



  }



################################################################################################################



require '../layout/header.php';
require '../layout/nav.php';
require '../layout/sidenav.php';
?>

<!-- Content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Create New User</h1>
            <ol class="breadcrumb mb-4">
                <?php
                message('Users/Create')
                ?>
            </ol>




        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">


            <div class="form-group">
                <label for="exampleInputName">Category Title</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="category_name" placeholder=" catrgory">
            </div>
            
            <div class="form-floating">
  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="category_desc" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Comments</label>
</div>


           <div class="form-group">
            <label for="exampleInputPassword">Image Upload</label>
            <input type="file" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


</main>


 <!-- footer -->
 <?php
    require '../layout/footer.php';
    ?>