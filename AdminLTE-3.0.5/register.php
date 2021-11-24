
<?php
require './helpers/dbConnection.php';
require './helpers/function.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

  $name    = Clean($_POST['name']); 
  $email    = Clean($_POST['email']);
  $password = Clean($_POST['password']);
  $dateofbirth = Clean($_POST['dateofbirth']);
  $gender =clean($_POST['gender']);
  $address =clean($_POST['address']);
  $passport =clean($_POST['passport']);
  $national_id =clean($_POST['national_id']);



   # Validate Inputs ..... 
   $errors = [];

   # Name Validate
   if(!validate($name,1)){
      $errors['title'] = "Field Required";
   }
 # Email Validate 
 if(!validate($email,1)){
  $errors['Email'] = "Field Required";
}elseif(!validate($email,2)){
  $errors['Email'] = "Invalid Email Format";
}
   
  # Password Validate 
  if(!validate($password,1)){
    $errors['Password'] = "Field Required";
 }elseif(!validate($password,4)){
    $errors['Password'] = "Invalid Length , Length Must Be >= 6 ch";
 }


  # Address Validate 
  if(!validate($address,1)){
    $errors['Address'] = "Field Required";
 }

 # id Validate 
 if(!validate($national_id,1)){
  $errors['NationalId'] = "Field Required";
}elseif(!validate($national_id,9)){
  $errors['NationalId'] = "Invalid Length , Length Must Be = 14 ch";
}elseif(!validate($national_id,5)){
  $errors['NationalId'] = "Inavlid data";

}

# Passport Validate 
if(!validate($passport,1)){
  $errors['Passport'] = "Field Required";
}


    if(count($errors) > 0){
        foreach($errors as $key => $val){
            echo '* '.$key.' : '.$val.'<br>';
        }
    }else{
        // DB CODE ....... 
$password =md5($password);

$sql = "insert into travellers
 (name,email,password,dateofbirth,gender,address,passport_number,national_id) values
 ('$name','$email','$password','$dateofbirth','$gender','$address','$passport',$national_id)";
         
       $op =  mysqli_query($con,$sql);

    

       $id=mysqli_insert_id($con);


       $sql_data="select * from travellers where id =$id";

       $result=mysqli_query($con,$sql_data);

       $final_result=mysqli_fetch_assoc($result);


       $_SESSION['passenger']=$final_result['name'];
       $_SESSION['id']=$final_result['id'];

       if($op){
           $message =  'you have registered successfully';
       }else{
           $message =  'Error Try Again !!!';
       }

       $_SESSION['message'] = $message;

       header("Location: http://localhost/week2/AdminLTE-3.0.5/Passenger/index.php");
      
      echo   mysqli_error($con);
   exit();

      }

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
<?php

require 'Admin/layouts/header.php';

?>


</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="date" class="form-control" placeholder="Date Of Birth" name="dateofbirth">
          <div class="input-group-append">
            <div class="input-group-text">
           
            </div>
          </div>
        </div>
        
  

<select name="gender"  placeholder="Gender">
<option value="0">Male</option>
<option value="1">Female</option>
</select>
 
<br>

<div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Address" name="address">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Passport Number" name="passport">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="National_id" name="national_id">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>



        
        <div class="row">
    
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
