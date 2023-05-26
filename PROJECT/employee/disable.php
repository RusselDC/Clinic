<?php 
include('db_conn.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $disable=mysqli_query($conn, "UPDATE doctors SET Status='Inactive' WHERE Doc_ID ='$id'");
    header("location:seedoctors.php");
    die();
  }
?>