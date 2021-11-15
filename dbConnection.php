<?php

$server="localhost";
$dbuser="root";
$dbpassword="";
$dbname="group8";

$con= mysqli_connect($server,$dbuser,$dbpassword,$dbname);

if($con){

    echo "connect successfully";
}else{

    echo mysqli_connect_error();
}

?>