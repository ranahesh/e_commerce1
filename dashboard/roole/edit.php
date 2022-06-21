<?php
require '../helpers/dbconnection.php';
require '../helpers/functions.php';
################################################################################################################
# Fetch Raw Data . . . 
$id = $_GET['id'];
$sqlGetUser = "select * from role where id = $id ";
$op  = DoQuery($sqlGetUser);
$userData= mysqli_fetch_assoc($op);
################################################################################################################


// Logic . . .

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $role = Clean($_POST['role_name']);

    # Validate Input . . . 
    $errors = [];

    if (!Validate($role, 'required')) {
        $errors['role_name'] = "Field Required";
    } elseif (!Validate($role, 'min', 3)) {
        $errors['role'] = "Length Must be >= 3 chars";
    }



    # Check if there are any errors . . .
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // code . . . 

        $sqlEdit  = "UPDATE roles SET role = 'role' WHERE id = $id";
        $operation = DoQuery($sqlEdit);

        if ($operation ) {
            $message = ['success' => 'Role Updated Successfully'];
            $_SESSION['Message'] = $message;
            header("Location: index.php");
             exit(); // stop the script

        } else {
            $message = ['error' => 'Error Updating Role  , Try Again '];
            $_SESSION['message'] = $message;
        }
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
            Message('role/Edit');
            ?>
        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $data['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputName">role</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="role_name" value="<?php echo $data['role']; ?>" placeholder="Enter Title">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


</main>


<?php
  require '../layout/footer.php';
?>