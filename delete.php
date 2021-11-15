<?php 
require 'dbConnection.php';
require 'helpers.php';

 $id = $_GET['id'];

 $enddate = $_GET['enddate'];

$currentdate = date('Y-m-d');


 # Validate id ... 
if(validate($id,3) && ($currentdate < $enddate)){
    // delete Logic ....... 
  
 $sql = "delete from tasks where id = $id ";

 $op = mysqli_query($con,$sql);

 if($op){
     $message = "Raw Removed !!";
 }else{
     $message = "Error Try Again";
 }

}else{
    $message = "Invalid Id!!! , you cant delete task";
}


$_SESSION['message'] = $message;

header("Location: index.php");

?>