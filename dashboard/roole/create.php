<?php
 require '../helpers/dbconnection.php';
 require '../helpers/functions.php';
################################################################################################################
  // Logic . . .

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $role_name = clean($_POST['role_name']);

    # Validate Input . . . 
    $errors = [];
    
    if(!Validate($role_name,'required')){
        $errors['role_name'] = "Field Required";
    }elseif(!Validate($role_name,'min',3)){
        $errors['role_name'] = "Length Must be >= 3 chars";
    }



    # Check if there are any errors . . .
    if(count($errors) > 0){
        $_SESSION['Message'] = $errors;
    }else{
        // code . . . 

        $sqlGetRoles = "INSERT INTO roles (role_name) VALUES ('$role_name')";
        $result = DoQuery($sqlGetRoles);
        
          if($operation){
            $message = ['success' => 'Role Added Successfully'];
          }else{
            $message = ['error' => 'Error Adding Role'];
          }

        $_SESSION['message'] = $message;

    }



  }



################################################################################################################

require '../layout/header.php';
require '../layout/nav.php';
require '../layout/sidenav.php';
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard / Roles</h1>
        <ol class="breadcrumb mb-4">
           
          <?php 
              message('roles/Create');
          ?>

        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">role</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="role_name" placeholder="Enter role">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


</main>


<?php
require '../layouts/footer.php';
?>