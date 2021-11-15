<?php 
 require 'dbConnection.php';
 require 'helpers.php';

 $id = $_GET['id'];

 $sql = "select * from tasks where id = $id";

 $op = mysqli_query($con,$sql);

  if(mysqli_num_rows($op) == 1){
      // code 

     $data = mysqli_fetch_assoc($op);

  }else{
      header("Location: index.php");
  }





if($_SERVER['REQUEST_METHOD'] == "POST"){

    $title     = Clean($_POST['title']); 
    $description    = Clean($_POST['description']);
    $startdate = Clean($_POST['startdate']);
    $enddate = Clean($_POST['enddate']);
 
 
     # Validate Inputs ..... 
     $errors = [];
 
     # Title Validate
     if(!validate($title,1)){
        $errors['title'] = "Field Required";
     }
     # Description Validate
     if(!validate($description,1)){
         $errors['description'] = "Field Required";
      }
     
      # Startdate validate 
      if(!validate($startdate,1)){
         $errors['startdate'] = "Field Required";
      }
 
       # Enddate validate 
       if(!validate($enddate,1)){
         $errors['enddate'] = "Field Required";
      }
 
 
 


     if(count($errors) > 0){
         foreach($errors as $key => $val){
             echo '* '.$key.' : '.$val.'<br>';
         }
     }else{
         // DB CODE ....... 


        $sql = "update tasks set title='$title' , description='$description' , start_date= '$startdate' , end_date= '$enddate' where id=$id";
          
        $op =  mysqli_query($con,$sql);

        if($op){
           $message = "Raw Updated";
        }else{
           $message =  'Error Try Again !!!';
        }


        $_SESSION['message'] = $message;
        
        header("Location: index.php");


     }


    mysqli_close($con);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Edit</h2>
  
  
  <form   action="edit.php?id=<?php echo $data['id'];?>"  method="post">


  <div class="form-group">
    <label for="exampleInputName">Title</label>
    <input type="text" class="form-control" name="title" value="<?php echo $data['title'];?>" id="exampleInputName" aria-describedby="" placeholder="Enter Title">
  </div>


  <div class="form-group">
    <label for="exampleInputEmail">Description</label>
    <input type="text"   class="form-control"  name="description" value="<?php echo $data['description'];?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter description">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail">Start Date</label>
    <input type="date"   class="form-control"  name="startdate" value="<?php echo $data['start_date'];?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter startdate">
  </div>
 

  
  <div class="form-group">
    <label for="exampleInputPassword">End Date</label>
    <input type="date"   class="form-control" name="enddate"  value="<?php echo $data['end_date'];?>" id="exampleInputPassword1" placeholder="Enter enddate">
  </div>
  
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

</body>
</html>