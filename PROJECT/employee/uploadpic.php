<?php
include('session.php');
if(!isset($_SESSION['ID'])&&!isset($_SESSION['Pass'])){
  header("refresh: 0; url=employee_login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/uploadpic.css">
    <link rel="icon" href="../photos/clinic1.png">
    <title>Edit Profile Pic.</title>
</head>
<body>
    <div id="container">
    <nav id="navbar">
            <div id="brand-title" onclick="location = 'employee_dashboard.php'">
                Clinica</div>
            <a href="#" class="toggle-button">
                <span id="bar"></span>
                <span id="bar"></span>
                <span id="bar"></span>
            </a>
            <div class="navbar-links">
                <ul><li>
                        <div id="dropdown">
                            <a href="mail.php">Mail</a>
                        </div>
                    </li>
                    <li><div id="dropdown">
                        <a href="#">USERS</a>
                        <div id="dropdown-content">
                        <a href="seeusers.php" style="color: white;">SEE USERS</a>
                        </div>
                      </div></li>
                      <li><div id="dropdown">
                        <a href="#">DOCTORS</a>
                        <div id="dropdown-content">
                          <a href="seedoctors.php" style="color: white;">SEE DOCTORS</a>
                          <?php 
                          if($Pos=='Doctor'){
                            echo '<a href="#" style="color: white;">CLOSED</a>';
                          }else{
                            echo '<a href="adddoctor.php" style="color: white;">EDIT DOCTORS</a>';
                          }
                          ?>
                        </div>
                      </div></li>
                      <li><div id="dropdown">
                        <a href="#">STAFF</a>
                        <div id="dropdown-content">
                          <a href="seetaff.php  " style="color: white;">SEE STAFF</a>
                          <?php 
                          if($Pos=='Doctor'){
                            echo '<a href="#" style="color: white;">CLOSED</a>';
                          }else{
                            echo '<a href="addemployee.php" style="color: white;">EDIT STAFF</a>';
                          }
                          ?>
                        </div>
                      </div></li>
                      <li><div id="dropdown">
                        <a href="#">APPOINTMENTS</a>
                        <div id="dropdown-content">
                          <a href="see.php" style="color: white;">SEE APPOINTMENTS</a>
                          <a href="operation.php" style="color: white;">EDIT APPOINTMENTS</a>
                        </div>
                      </div></li>
                    <li><div id="dropdown">
                        <a href="#">ACCOUNT</a>
                        <div id="dropdown-content">
                          <a href="editprofile.php" style="color: white;">EDIT PROF.</a>
                          <a href="uploadpic.php" style="color: white;">PHOTO</a>
                          <a href="logout.php" style="color: white;">SIGN OUT</a>
                        </div>
                      </div></li>
                </ul>
            </div>
        </nav>
        <div id="body">
            <h1 id="header">Add/Edit Profile Picture</h1>
            <?php  if (isset($_GET['error'])):?>
                <p style="text-align:center; margin-bottom:0px; font-size:20px;"><?php echo $_GET['error'];?></p>
            <?php endif ?>
            <div id="form-container">
                <div id="left">
                <?php 
                $sql = "SELECT img_url FROM employee WHERE Emp_ID = '$ID' ";
                $res = mysqli_query($conn, $sql);

                if(mysqli_num_rows($res)>0){
                 while($images = mysqli_fetch_assoc($res)){ ?>

                    <div id="image-box">
                        <img id="picture" src="uploads/<?=$images['img_url']?>" alt="Temp">
                    </div> 
                <?php }}?>
                </div>
                <div id="right">
                    <div id="upload"> 
                        <form action="uploadpic_class.php"
                        method="POST"
                        enctype="multipart/form-data">
                        <input type="file" name="image" id="buttons">
                        <input type="submit" name="upload" id="button" value="Change Profile Picture">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>