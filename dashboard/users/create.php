<!-- Code -->
<?php
// DB Connecting
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

### Fetching Roles
$sqlGetRoles = "select role_id , role_name from roles";
$result = DoQuery($sqlGetRoles);
#########


// Create Structure Logic
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    ### Create user code structure
    $fName = clean($_POST['fName']);
    $lName = clean($_POST['lName']);
    $email = clean($_POST['email']);
    $password = clean($_POST['password']);
    $role_id = (int)clean($_POST['role_id']);

    // Validations
    $errors = [];

    // First Name Validation
    if (!validate($fName, 'required')) {
        $errors['fName'] = 'Please Insert Your First Name';
    } elseif (!validate($fName, 'max', 8)) {
        $errors['fName'] = 'First Name Must Be less Than 8 Letters';
    }

    // Last Name Validation
    if (!validate($lName, 'required')) {
        $errors['lName'] = 'Please Insert Your Last Name';
    } elseif (!validate($fName, 'max', 8)) {
        $errors['lName'] = 'Last Name Must Be less Than 8 Letters';
    }

    // Email Validation
    if (!validate($email, 'required')) {
        $errors['email'] = 'Please Insert Your Email Address';
    } elseif (!validate($email, 'email')) {
        $errors['email'] = 'Invalid Email';
    }

    // Password Validation
    if (!validate($password, 'required')) {
        $errors['password'] = 'Password Required';
    } elseif (!validate($password, 'min') && !validate($password, 'max', 14)) {
        $errors['Password'] = "Length Must be between 6-14 Letters";
    }

    // Role_ID Validation
    if (!validate($role_id, 'required')) {
        $errors['role_id'] = "Role is Required";
    } elseif (!validate($role_id, 'int')) {
        $errors['role_id'] = "Invalid Role ID";
    }

    // Catching errors
    if (count($errors) > 0) {
        // print errors 
        $_SESSION['message'] = $errors;
    } else {
        $password = md5($password);

        $imageName = upload($_FILES);
        if ($imageName == false) {
            $message = ["Error" => "Error Uploading File"];
        } else {

            $sqlInsert = "insert into user(f_name,l_name,password,email,image,role_id) values('$fName','$lName','$password','$email','$imageName',$role_id)";
            $operation = DoQuery($sqlInsert);

            if ($operation) {
                $message = ['Success' => 'User Created Successfully'];
            } else {
                $message = ['Error' => 'error Occurred While Adding User'];
            }
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
            <h1 class="mt-4">Create New User</h1>
            <ol class="breadcrumb mb-4">
                <?php
                message('Users/Create')
                ?>
            </ol>


            <div class="container mt-5 mb-5 w-100">
                <form class="w-100" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                    <div class="input-group mb-4">
                        <label for="exampleInputFName" class="form-label mr-4 pt-2">First Name</label>
                        <input type="text" class="form-control" id="exampleInputFName" aria-autocomplete="0" aria-describedby="textHelp" name="fName">

                        <label for="exampleInputFName" class="form-label ml-5 pr-4 pt-2">Last Name</label>
                        <input type="text" class="form-control" id="exampleInputFName" autocomplete="0" aria-describedby="textHelp" name="lName">
                    </div>

                    <div class="input-group mb-4 w-100">
                        <label class="input-group-text mr-4 pr-4" for="inputGroupSelect01">Roles</label>
                        <select class="form-select w-75" required name="role_id">

                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value=<?php echo $row['role_id']; ?>><?php echo $row['role_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" autocomplete="0" aria-describedby="emailHelp" name="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Image Upload</label>
                        <input type="file" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>
            </div>

        </div>
    </main>

    <!-- footer -->
    <?php
    require '../layout/footer.php';
    ?>