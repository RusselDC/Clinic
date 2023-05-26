<?php
include('session.php');
if(!isset($_SESSION['ID'])&&!isset($_SESSION['Pass'])){
  header("refresh: 0; url=employee_login.php");
}
ini_set('display_errors', 0);
?>
<?php
$today = date("Y-m-d");
$diff = date_diff(date_create($emp_bdate), date_create($today));
?>
<?php
if(isset($_POST['Save'])){
    $Email = $_POST['Email'];
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $Mname = $_POST['Mname'];
    $Age = $_POST['Age'];
    $Bdate = $_POST['Bdate'];
    $date = date("Y/m/d");
    $Age = date_diff(date_create($Bdate),date_create($date));
    $age = $Age->format('%y');
    $Sex = $_POST['Sex'];
    $sub = $_POST['Sub_ID'];

    $sql = "UPDATE employee SET Email = '$Email', Fname='$Fname', Lname = '$Lname', Mname = '$Mname', Age = '$age', Birthdate = '$Bdate', Gender = '$Sex',Sub_ID = '$sub' WHERE Emp_ID = '$ID' ";
    if($conn->query($sql) === TRUE){
        echo '<script type="text/javascript">';
        echo 'alert("Changes saved");';
        echo 'window.location.href = "editprofile.php"';
        echo '</script>';
    } else{
        echo '<script type="text/javascript">';
        echo 'alert("An error occured");';
        echo 'window.location.href = "editprofile.php"';
        echo '</script>';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/editprofile.css">
    <link rel="icon" href="../photos/clinic1.png">
    <script src="../javascript/editprofile.js" defer></script>
    <title>Edit Profile</title>
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
                <ul>
                <li>
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
                          <a href="seetaff.php" style="color: white;">SEE STAFF</a>
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
        <div id="form-container">
            <div id="left">
                <h1>Edit Profile</h1>
                <p>You can edit your profile at this page</p>
                <hr>
                <p style="font-size: 20px; margin-bottom: 0%;">Employee ID: <?php echo $ID ?></p>
                <hr>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <p style="font-size: 20px; margin-bottom: 0%;">Position: <?php echo $Pos ?></p>
                <hr>
                    <?php if($Pos =='Doctor'){
                        echo '<div class="form-group">
                        <label for="exampleInputEmail1">Doctor ID</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" name="Sub_ID" value="'; echo $Sub_ID.'">';
                        echo '</div>';
                        echo '<hr>';
                    }?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="Email" value="<?php echo $emp_email ?>">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="usr">First name</label>
                            <input type="text" name="Fname" class="form-control" value="<?php echo $emp_Fname?>" required>
                        </div>
                        <div class="col-sm-5">
                            <label for="usr">Lastname</label>
                            <input type="text" name="Lname" class="form-control"  value="<?php echo $emp_Lname?>" required>
                        </div>
                        <div class="col-sm-2">
                            <label for="usr">M.I</label>
                            <input type="text" name="Mname" class="form-control"  value="<?php echo $emp_Mname?>" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="usr">Birthdate</label>
                            <input type="date"  class="form-control" value="<?php echo $emp_bdate?>" name="Bdate" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="usr">Sex</label>
                            <select class="form-select" aria-label="Default select example" name="Sex">
                                <?php if($emp_gender == 'Male') {  ?>
                                    <option value="<?php echo $emp_gender ?>" selected>Male</option>
                                    <option value="Female">Female</option>
                                <?php }  ?>
                                <?php if($emp_gender == 'Female') {  ?>
                                    <option value="Male">Male</option>
                                    <option value="<?php echo $emp_gender ?>" selected>Female</option>
                                <?php }  ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="usr">Age</label>
                            <input type="number"  name="Age" class="form-control" value="<?php echo $diff->format('%y')?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div style="width: 100%; height:auto; text-align: right;">
                        <button type="submit" name="Save" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
            <div id="right">
                <img src="../photos/Titanium_care-team.png" alt="">
            </div>

        </div>
    </div>
    
</body>
</html>