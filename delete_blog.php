<?php 
require 'dbConnection.php';
require 'helpers.php';

 $id = $_GET['id'];



 # Validate id ... 
if(validate($id,4) ){
    // delete Logic ....... 
  
 $sql = "delete from blog where id = $id ";

 $op = mysqli_query($con,$sql);

 if($op){
     $message = "Raw Removed !!";
 }else{
     $message = "Error Try Again";
 }

}

$_SESSION['message'] = $message;

header("Location: blog.php");

?>