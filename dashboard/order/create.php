<!-- Code -->
<?php
// DB Connecting
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

### Fetching Roles
$sqlGet = "select user_id , role_name from ";
$result = DoQuery($sqlGetRoles);
#########


// Create Structure Logic
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    ### Create user code structure
    $order_id =  clean($_POST['order_id']);
    $order_name = (int)clean($_POST['order_name']);
    $address =  clean($_POST['address']);
    $state=     clean($_POST['state']);
    $city= (int)clean($_POST['zip_code']);
    $contact = (int)clean($_POST['contact']);

    // Validations
    $errors = [];

    // order_id Validation
    if (!validate($order_id, 'required')) {
        $errors['order_id'] = 'Please Insert order_id';
    } elseif (!validate($order_id, 'min', 5)) {
        $errors['order_id'] = 'First order must be 5 order';
    }

    // order_name Validation
    if (!validate($order_name, 'required')) {
        $errors['order_name'] = 'Please enter  order_name';
    } elseif (!validate($order_name, 'min', 3)) {
        $errors['order_name'] = 'Last order name min Be less be 3 letters';
    }

    // address Validation
    if (!validate($address, 'required')) {
        $errors['address'] = 'Please Insert Your address';
    } elseif (!validate($address, 'address')) {
        $errors['address'] = 'Invalid address ';
    }

    //  state validation
    if (!validate($state, 'required')) {
        $errors['state'] = 'Please Insert state';
    } elseif (!validate($state, 'min',5)) {
        $errors['state'] = 'Product Description Must be at least 5 state';
    }

    //  city Validation
    if (!validate($city, 'required')) {
        $errors['city'] = 'Please Insert Product Brand';
    } elseif (!validate($city, 'min',1)) {
        $errors['city'] = 'Product Brand Must be at least 1 city';
    }

   
     //contact validation
    if (!validate($contact, 'required')) {
        $errors['contact'] = "contact is Required";
    } elseif (!validate($contact, 'int')) {
        $errors['contant'] = "Invalid contant";
    }

    // Catching errors
    if (count($errors) > 0) {
        // print errors 
        $_SESSION['message'] = $errors;
    } else {
            $sqlInsert = "insert into user(order,ordername ,addres,	city,zip_code,contact) values('$order','$ordername','$addres','city','zip_code',$contact)";
            $operation = DoQuery($sqlInsert);

            if ($operation) {
                $message = ['Success' => 'User Created Successfully'];
            } else {
                $message = ['Error' => 'error Occurred While order'];
            }
        }
        $_SESSION['message'] = $message;
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

                       <div class="mb-3">
                       <label for="exampleInputName" class="form-label">order</label>
                        <input type="text" class="form-control" id="exampleInputName" placeholder="order"  name="order_id ">
                        </div>
                        
                        <div class="mb-3">
                       <label for="exampleInputName" class="form-label">order_name</label>
                        <input type="text" class="form-control" id="exampleInputName"   name="order_name ">
                        </div>

                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" autocomplete="0" aria-describedby="emailHelp" name="address">
                       </div>

                       <div class="mb-3">
                       <label for="exampleInputName" class="form-label">state</label>
                        <input type="text" class="form-control" id="exampleInputName"name="state ">
                        </div>
                       
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">city</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" autocomplete="0" aria-describedby="emailHelp" name="city">
                       </div>
                  
                       <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">code</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" autocomplete="0" aria-describedby="emailHelp" name="zip_code">
                       </div>
                  
                       <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">contact</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" autocomplete="0" aria-describedby="emailHelp" name="contact">
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