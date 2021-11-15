<?php 
 require 'dbConnection.php';
 require 'helpers.php';

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


        $sql = "insert into tasks (title,description,start_date,end_date) values ('$title','$description','$startdate','$enddate')";
          
        $op =  mysqli_query($con,$sql);

        if($op){
            $message =  'Task Inserted';
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
  <title>TODO LIST</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Record ur task</h2>
  
  
  <form   action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  method="post">


  <div class="form-group">
    <label for="exampleInputName">Title</label>
    <input type="text" class="form-control" name="title" id="exampleInputName" aria-describedby="" placeholder="Enter Title">
  </div>


  <div class="form-group">
    <label >Description</label>
    <input type="text"   class="form-control"  name="description"   placeholder="Enter Description">
  </div>

  <div class="form-group">
    <label >Start Date</label>
    <input type="date"   class="form-control" name="startdate"  placeholder="Start Date">
  </div>
 

  
  <div class="form-group">
    <label >End Date</label>
    <input type="date"   class="form-control" name="enddate"  placeholder="End Date">
  </div>
  
  <button type="submit" class="btn btn-primary">Save</button>
</form>
</div>

</body>
</html>