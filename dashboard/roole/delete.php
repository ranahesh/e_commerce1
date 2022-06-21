<?php 
  require '../helpers/dbConnection.php';
  require '../helpers/functions.php';

 $id = $_GET['id']; 




$sqlSelectUser = "delete from roles where id = $id";
    
 $$operation  = DoQuery($operation);

    if($op){
    $message = ['success' => 'Role Deleted Successfully'];
    }else{
    $message = ['error' => 'Error Deleting Role'];
    }

    $_SESSION['message'] = $message;

    header("Location: index.php");
    
    ?>