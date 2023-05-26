
<?php
   //eto yung tinatawag ko na middle man na page, yan yung session
   include("db_conn.php");
   session_start();
   
   //makikita mo dito tinawag dito yung login_user na session sa kabila at yung laman nyan yung ID ng nag log in
   $user_check = $_SESSION['login_user'];
   //magagamit mo yung id ng nag login para mag run ng query tulad neto
   $ses_sql = mysqli_query($conn,"select * from employee where Emp_ID = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   //then ganto mo siya isstore sa variable para magamit sa ibang pages
   $ID = $row['Emp_ID'];
   $Age = $row['Age'];
   $Pos = $row['Position'];
   $emp_Fname = $row['Fname'];
   $emp_Mname = $row['Mname'];
   $emp_Lname = $row['Lname'];
   $emp_name = "$emp_Fname $emp_Mname $emp_Lname";
   $emp_img  = $row['img_url'];
   $emp_bdate = $row['Birthdate'];
   $emp_gender = $row['Gender'];
   $emp_email = $row['Email'];
   $Sub_ID = $row['Sub_ID'];
   $Status = $row['Status'];
?>