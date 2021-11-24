<?php 

require '../../helpers/dbConnection.php';
require '../../helpers/function.php';
require '../../helpers/checkLogin.php';



$id = $_GET['id'];
$errors = [];
# Start Validation .... 

if(!validate($id,1)){
    $errors['id'] = "Field Required";
}elseif(!validate($id,5)){

    $errors['id'] = "Invalid id";
}


if(count($errors) > 0){

    $Message = $errors;
}else{

  # Delete Logic ..... 

  $sql = "delete from flights where id = $id";
  $op  = mysqli_query($con,$sql);
   
  if($op){
      $message = ['Raw Removed'];
  }else{
      $message = ["Error In Process try again"];
  }

   
   $_SESSION['Message'] = $message;

   header("Location: index.php");

}







?>