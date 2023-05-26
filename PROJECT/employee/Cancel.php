<?php 
include('db_conn.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $Post=mysqli_query($conn, "UPDATE appointment SET Status='Cancelled' WHERE Appointment_ID ='$id'");
    header("location:see.php");
    die();
  }
?>