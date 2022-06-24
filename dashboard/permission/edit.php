<!-- Code -->
<?php
// DB Connecting
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

### Fetching permission
$sqlGetpermission = "select * from perm";
$catResult = DoQuery($sqlGetpermission);
#########

### Fetching Users
$sqlGetUser = "select * from user";
$userResult = DoQuery($sqlGetUser);
###########


### Getting permission Data
$id = $_GET['id'];
$sqlGetProducts = "select * from perm_name where perm_id=$id";
$op= DoQuery($sqlGetProducts);
$productData = mysqli_fetch_assoc($op);

// Create Structure Logic
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    ### Create user code structure
     $perm_name =  clean($_POST['perm_name']);

        # Validate Input . . . 
        $errors = [];
        
         // perm_name Validation
    if (!validate($perm_name, 'required')) {
        $errors['perm_name'] = 'Please Insert perm_name';
    } elseif (!validate($perm_name, 'min', 5)) {
        $errors['perm_name'] = 'First order must be 5 name';
    }
  
    // Catching errors
    if (count($errors) > 0) {
        // print errors 
        $_SESSION['message'] = $errors;
    } else {
        $sqlUpdate = "insert into user(permission,perm_name ,) values($perm_name)";
        $operation = DoQuery($sqlUpdate);

        if ($operation) {
            $message = ['Success' => 'orders Created Successfully'];
            header('Location: index.php');
        } else {
            $message = ['Error' => 'error occurred while Adding New perm_name'];
        }
        $_SESSION['message'] = $message;
    }
}


### Design -->

require '../layout/header.php';
require '../layout/nav.php';
require '../layout/sidenav.php';
?>

<!-- Content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Product</h1>
            <ol class="breadcrumb mb-4">
                <?php
                message('permission/Update')
                ?>
            </ol>


            <div class="container mt-5 mb-5 w-100">
                <form class="w-100" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                       <label for="exampleInputName" class="form-label">perm</label>
                        <input type="text" class="form-control" id="exampleInputName" name="perm_name ">
                        </div>
               
                      <button type="submit" class="btn btn-primary">Edit Product</button>

                </form>
            </div>

        </div>
    </main>

    <!-- footer -->
    <?php
    require '../layout/footer.php';
    ?>