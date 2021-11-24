<?php 

 # Logic 
 require  "../../helpers/dbConnection.php";
 require '../../helpers/function.php';
 require '../../helpers/checkLoginPassenger.php';


 
# GET RAW Data .... 
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

    $_SESSION['Message'] = $Message;

    header("Location: index.php");
    exit();
}else{

 $sql = "select * from destination where id = $id";
 $op  = mysqli_query($con,$sql);
 $data = mysqli_fetch_assoc($op);

}

  if($_SERVER['REQUEST_METHOD'] == "POST"){

    $from = Clean($_POST['from']);
    $to = Clean($_POST['to']);

    $errors = [];

    if(!validate($from,1)){
        $errors['From'] = "Field Required";
   
    }
    if(!validate($to,1)){
        $errors['To'] = "Field Required";
   
    }

    if(count($errors) > 0){
        $_SESSION['Message'] = $errors;
    }else{

       # Db Operation ..... 
// $id=  $_SESSION['id'];

       $sql = "update destination set first_destination = '$from' , last_destination ='$to'  where id = $id ";
       $op  = mysqli_query($con,$sql);

       if($op){
           $message = ['Data Inserted'];
       }else{
           $message = ['Error Try Again'];
       }
       $_SESSION['Message'] = $message;
       
        header("Location: http://localhost/week2/AdminLTE-3.0.5/Passenger/distinations/index.php");

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
                $text = "Update Destination";
               printMessage($text);
                ?>
                </li>

            </ol>




            <div class="container">

                <form action="edit.php?id=<?php echo $data['id']; ?>" method="post">


                    <div class="form-group">
                        <label for="exampleInputName">FROM</label>
                        <input type="text" class="form-control" name="from" id="exampleInputName" aria-describedby=""
                     value="<?php echo $data['first_destination'];?>"       placeholder="FROM">
                    </div>

                    
                    <div class="form-group">
                        <label for="exampleInputName">TO</label>
                        <input type="text" class="form-control" name="to" id="exampleInputName" aria-describedby=""
                     value="<?php echo $data['last_destination'];?>"       placeholder="TO">
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