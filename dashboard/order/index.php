<?php
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

### Getting Specific User Data 
$sqlGetProducts = "select orders.order_id,orders.order_name,orders.address,orders.state,orders.city,orders.contactinner join user on orders.user_id = user.user_id";

$operation = DoQuery($sqlGetProducts);
##########


require '../layout/header.php';
require '../layout/nav.php';
require '../layout/sidenav.php';
?>
<!-- Content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Products Data</h1>
            <ol class="breadcrumb mb-4">
                <?php
                message('Products/Display');
                ?>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Products Table
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                     <th>#</th>
                                    <th>order_id </th>
                                    <th>order_name</th>
                                    <th>address</th>
                                    <th>state</th>
                                    <th>city</th>
                                    <th>zip_code</th>
                                    <th>contact</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>order_id </th>
                                    <th>order_name</th>
                                    <th>address</th>
                                    <th>state</th>
                                    <th>city</th>
                                    <th>zip_code</th>
                                    <th>contact</th>                                    
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($operation)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['order_id']; ?></td>
                                        <td><?php echo $row['order_name']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['state']; ?></td>
                                        <td><?php echo $row['state']; ?></td>
                                        <td><?php echo $row['city']; ?></td>
                                        <td><?php echo $row['zip_code'].' '.$row['l_name']  ?></td>
                                        <td><?php echo $row['contact'].' '.$row['l_name']  ?></td>
                                        <td> <a href='edit.php?id=<?php echo $row['order_id'] ?>' class='btn btn-primary m-r-1em'>Edit</a> </td>
                                        <td> <a href='delete.php?id=<?php echo $row['order_id'] ?>' class='btn btn-danger m-r-1em'>Delete</a> </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- footer -->
    <?php
    require '../layout/footer.php';
    ?>