<!-- Code -->
<?php
// DB Connecting
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

### Fetching Category
$sqlGetorders = "select * from order";
$catResult = DoQuery($sqlGetorders);
#########

### Fetching Users
$sqlGetUser = "select * from user";
$userResult = DoQuery($sqlGetUser);
###########


### Getting Products Data
$id = $_GET['id'];
$sqlGetProducts = "select * from order where order_id=$id";
$op= DoQuery($sqlGetProducts);
$productData = mysqli_fetch_assoc($op);

// Create Structure Logic
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    ### Create user code structure
    $order_id =  clean($_POST['order_id']);
    $order_name = (int)clean($_POST['order_name']);
    $address =  clean($_POST['address']);
    $state=     clean($_POST['state']);
    $city= (int)clean($_POST['zip_code']);
    $contact =(int)clean($_POST['contact']);
    // Validations
    $errors = [];

    //  order_id Validation
    if (!validate($order_id, 'required')) {
        $errors['order_id'] = 'Please  order_id';
    } elseif (!validate($order_id, 'min', 3)) {
        $errors['order_id'] = 'Product Name must be at Least 3order';
    }

    // order_name Validation
    if (!validate($order_name, 'required')) {
        $errors['order_name'] = 'Field Required';
    } elseif (!validate($order_name, 'order_name')) {
        $errors['order_name'] = 'Price Must Be order_name';
    } elseif (!validate($order_name, 'zero')) {
        $errors['order_name'] = 'Product Price never equal zero';
    } elseif (!validate($price, 'negative')) {
        $errors['order_name'] = 'Price Must Be order_name';
    }

    //address Validation
    if (!validate($address, 'required')) {
        $errors['address'] = 'Please Insert Description for Product';
    } elseif (!validate($address, 'min', 10)) {
        $errors['address'] = 'Product Description Must be at least 10 letters';
    }

    // state Validation
    if (!validate($state, 'required')) {
        $errors['state='] = 'Please Insert Product state=';
    } elseif (!validate($state, 'min', 10)) {
        $errors['state='] = 'Product Brand Must be at least 10 state';
    }

    //  city Validation
    if (!validate($city, 'required')) {
        $errors['city'] = "city is Required";
    } elseif (!validate($city, 'city')) {
        $errors['city'] = "Invalid  city";
    }


     //contact validation
     if (!validate($contact, 'required')) {
        $errors['contact'] = "contact is Required";
    } elseif (!validate($contact, 'int')) {
        $errors['contact'] = "Invalid contact";
    }


    // Catching errors
    if (count($errors) > 0) {
        // print errors 
        $_SESSION['message'] = $errors;
    } else {
        $sqlUpdate = "insert into user(order,ordername ,addres,state,city,zip_code,contact) values('$order','$ordername','$addres', '$state','city','zip_code',$contact)";
        $operation = DoQuery($sqlUpdate);

        if ($operation) {
            $message = ['Success' => 'orders Created Successfully'];
            header('Location: index.php');
        } else {
            $message = ['Error' => 'error occurred while Adding New orders'];
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
                message('orders/Update')
                ?>
            </ol>


            <div class="container mt-5 mb-5 w-100">
                <form class="w-100" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">order</label>
                        <input type="text" class="form-control" id="exampleInputName" placeholder="Enter order" name="order_id">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputBrand" class="form-label">order</label>
                        <input type="text" class="form-control" id="exampleInputBrand"  name="order_name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPrice" class="form-label">address</label>
                        <input type="text" class="form-control" id="exampleInputPrice" name="address">
                    </div>
                    
                    <div class="form-floating">
                        <label for="floatingTextarea2">state</label>
                        <textarea class="form-control" placeholder="" id="floatingTextarea2" name="state"></textarea>
                    </div>
                      
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">city</label>
                        <input type="text" class="form-control"  autocomplete="0" aria-describedby="" name="city">
                       </div>
                  


                       <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">code</label>
                        <input type="text" class="form-control" id="" autocomplete="0" aria-describedby="emailHelp" name="zip_code">
                       </div>
<br>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">contact</label>
                        <input type="text" class="form-control"  autocomplete="0" aria-describedby="" name="contact">
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