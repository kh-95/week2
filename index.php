<?php  

require 'dbConnection.php';

 $sql = "select * from tasks";
 $op  =  mysqli_query($con,$sql);

?>









<!DOCTYPE html>
<html>

<head>
    <title>PDO - Read Tasks - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }
        
        .m-b-1em {
            margin-bottom: 1em;
        }
        
        .m-l-1em {
            margin-left: 1em;
        }
        
        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">
 

        <div class="page-header">
            <h1>Read Tasks </h1> 
            <br>

        </div>

        <?php 
        
           if(isset($_SESSION['message'])){
               echo $_SESSION['message'];
               unset($_SESSION['message']);
           }
        
        ?>


    <a href="create.php">+ Task</a>

        <!-- PHP code to read records will be here -->



        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>StartDate</th>
                <th>EndDate</th>
                <th>action</th>         
            </tr>

        <?php 
            while($data = mysqli_fetch_assoc($op)){
        ?>
           <tr>
           <td><?php echo $data['id'];?></td>
           <td><?php echo $data['title'];?></td>
           <td><?php echo $data['description'];?></td>
           <td><?php echo $data['start_date'];?></td>
           <td><?php echo $data['end_date'];?></td>
                 <td>
                 <a href='delete.php?id=<?php echo $data['id'];?>& enddate=<?php echo $data['end_date'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                 <a href='edit.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>       
                </td> 
           </tr> 
         <?php  } ?>
       
            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>




