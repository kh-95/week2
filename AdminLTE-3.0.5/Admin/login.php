<?php

require '../helpers/dbConnection.php';
require '../helpers/function.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
  
    $email    = Clean($_POST['email']);
    $password = Clean($_POST['password']);
 
 
 
     # Validate Inputs ..... 
     $errors = [];
 
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
 
 
 
      if(count($errors) > 0){
          foreach($errors as $key => $val){
              echo '* '.$key.' : '.$val.'<br>';
          }
      }else{
          // DB CODE ....... 
 
 
        //  $password =   md5($password);
 
         $sql = "select * from  admin where email = '$email'  and  password = '$password' ";
           
         $op =  mysqli_query($con,$sql);
 
         if(mysqli_num_rows($op) == 1){
             // code 
         while ($data = mysqli_fetch_assoc($op)) {

          $username=$data['name'];
         $id=$data['id'];
 
           $_SESSION['user'] = $username;
 
           $_SESSION['id'] = $id;

           
           header("Location: index.php");
          }
         }else{
             echo 'Error In Your Cre Try Again!!!';
         }
    
      }
 
 
     exit();
 
 }
 









?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php

require "./layouts/header.php";

?>

<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
        
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


    
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>



