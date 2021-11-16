<?php 
 require 'dbConnection.php';
 require 'helpers.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

   $title     = Clean($_POST['title']); 
   $content   = Clean($_POST['content']);
 


    # Validate Inputs ..... 
    $errors = [];

    # Title Validate
    if(!validate($title,1)){
       $errors['title'] = "Field Required";
    }

    if(!validate($title,2)){
        $errors['title'] = "Field must be string";
     }


    # Content Validate
    if(!validate($content,1)){
        $errors['content'] = "Field Required";
     }

     if(!validate($content,3)){
        $errors['content'] = "Field must be more than 100 chars";
     }

     //validate image

     if(!validate($_FILES['img']['name'],1)){

      $errors['image'] = "Field Required";

    
   
     }
     else{

     $img_name = $_FILES['img']['name'];
     $img_temp = $_FILES['img']['tmp_name'];
     move_uploaded_file($img_temp,"upload/$img_name");
     }

     if(count($errors) > 0){
         foreach($errors as $key => $val){
             echo '* '.$key.' : '.$val.'<br>';
         }
     }else{
         // DB CODE ....... 


        $sql = "insert into blog (title,content,image) values ('$title','$content','$img_name')";
          
        $op =  mysqli_query($con,$sql);

        if($op){
            $message =  'Blog Inserted';
        }else{
            $message =  'Error Try Again !!!';
        }

        $_SESSION['message'] = $message;

        header("Location: blog.php");

     }


    mysqli_close($con);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Create Blog</h2>
  
  
  <form   action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  method="post" enctype="multipart/form-data"   >


  <div class="form-group">
    <label for="exampleInputName">Title</label>
    <input type="text" class="form-control" name="title" id="exampleInputName" aria-describedby="" placeholder="Enter Title">
  </div>


  <div class="form-group">
    <label >Content</label>
    <input type="text"   class="form-control"  name="content"   placeholder="Enter Content">
  </div>
  
  <div class="form-group">
    <label >Image</label>
    <input type="file"   class="form-control" name="img"  placeholder="Enter Image">
  </div>
  
  <button type="submit" class="btn btn-primary">Save</button>
</form>
</div>

</body>
</html>