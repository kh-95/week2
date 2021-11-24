<?php 

 # Logic 
 require  "../../helpers/dbConnection.php";
 require '../../helpers/function.php';
 require '../../helpers/checkLogin.php';

  
 $sql = "select * from airlines order by id desc";
 $op  = mysqli_query($con,$sql);





  if($_SERVER['REQUEST_METHOD'] == "POST"){

    $description = Clean($_POST['desc']);
    $date        = Clean($_POST['date']);
    $airline = Clean($_POST['airline_id']);

    $errors = [];
// description validate
    if(!validate($description,1)){
        $errors['Description'] = "Field Required";
   
    }elseif(!validate($description,4,100)){
        $errors['Description'] = "Length Must >= 100 CH";
      }

      // date validate
      if(!validate($date,1)){
        $errors['date'] = "Field Required";
       }elseif(!validate($date,10)){
         $errors['date'] = "Invalid Date Format";
      }
    
      //airline id validate

      if(!validate($airline,1)){
        $errors['Airline'] = "Field Required";
       }elseif(!validate($airline,5)){
         $errors['Airline'] = "Invalid Airline";
      }
    





    if(count($errors) > 0){
        $_SESSION['Message'] = $errors;
    }else{

       # Db Operation ..... 


       $sql = "insert into reports (description,date,airline_id) values ('$description','$date',$airline)";
       $op  = mysqli_query($con,$sql);

       if($op){
           $message = ['Data Inserted'];
       }else{
           $message = ['Error Try Again'];
       }
       $_SESSION['Message'] = $message;
       
       header("Location: http://localhost/week2/AdminLTE-3.0.5/Admin/reports/index.php");

       echo mysqli_error($con);
       exit();

      

    }

  }  // end form Logic ..... 

 require '../layouts/header.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?php

 require '../layouts/navbar.php';


 require '../layouts/sidebar.php'; 

?>


<div class="content-wrapper">
<section class="content">


        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">


                <li class="breadcrumb-item active">
                    <?php
                $text = "ADD NEW Report";
               printMessage($text);
                ?>
                </li>

            </ol>




            <div class="container">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">


                    <div class="form-group">
                        <label for="exampleInputName">Description</label>
                        <textarea  class="form-control" name="desc"></textarea>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputName">Date</label>
                        <input type="date" class="form-control" name="date" id="exampleInputName" >
                    </div>


                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <select class="form-control" name="airline_id">

<?php 
while($data = mysqli_fetch_assoc($op)){
?>
<option value="<?php echo $data['id'];?>"> <?php echo $data['name'];?></option>
<?php } ?>
</select>
                    </div>






                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>

</div>


</section>

</div>


    <?php 

 require '../layouts/footer.php';

?>



<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="localhost/week2/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="localhost/week2/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="http://localhost/week2/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="http://localhost/week2/AdminLTE-3.0.5/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="http://localhost/week2/AdminLTE-3.0.5/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="http://localhost/week2/AdminLTE-3.0.5/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="http://localhost/week2/AdminLTE-3.0.5/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="http://localhost/week2/AdminLTE-3.0.5/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="http://localhost/week2/AdminLTE-3.0.5/plugins/moment/moment.min.js"></script>
<script src="http://localhost/week2/AdminLTE-3.0.5/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="http://localhost/week2/AdminLTE-3.0.5/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="http://localhost/week2/AdminLTE-3.0.5/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="http://localhost/week2/AdminLTE-3.0.5/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="http://localhost/week2/AdminLTE-3.0.5/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="http://localhost/week2/AdminLTE-3.0.5/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="http://localhost/week2/AdminLTE-3.0.5/dist/js/demo.js"></script>
</body>
</html>