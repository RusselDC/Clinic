
<?php
   include("db_conn.php");
   session_start();
   
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conn,"select * from user where User_ID = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $ID = $row['User_ID'];
   $Email = $row['Email'];
   $Age = $row['Age'];
   $emp_Fname = $row['Fname'];
   $emp_Mname = $row['Mname'];
   $emp_Lname = $row['Lname'];
   $cnum = $row['Contact_number'];
   $bday = $row['Birthdate'];
   $address = $row['Address'];
   $status = $row['Status'];
   $btype = $row['Blood_Type'];
   $flag = $row['Nationality'];
   $weight = $row['Weight'];
   $height = $row['Height'];
   $sex = $row['Sex'];
   
   $emp_name = "$emp_Fname $emp_Mname $emp_Lname";
   
   $pass = $row['Pass'];
   
?>