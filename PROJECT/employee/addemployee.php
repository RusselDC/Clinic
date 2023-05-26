<?php
include('session.php');
if(!isset($_SESSION['ID'])&&!isset($_SESSION['Pass'])){
  header("refresh: 0; url=employee_login.php");
}
ini_set('display_errors', '0');
?>
<?php
$employee = mysqli_query($conn, "SELECT * FROM employee WHERE Status = 'Active'");

include('db_conn.php');
if(isset($_POST['Add'])){
    $Email = $_POST['Email'];
    $Pos = $_POST['Position'];
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $Mname = $_POST['Mname'];
    $Sex = $_POST['Sex'];
    $DateofBirth = $_POST['Birthdate'];
    $Sub_ID = $_POST['Sub_ID'];
    $date = date("Y/m/d");
    $Age = date_diff(date_create($DateofBirth),date_create($date));
    $age = $Age->format('%y');
    $Password_1 = $_POST['Password1'];
    $Password_2 = $_POST['Password2'];
    $user_check = "SELECT * FROM employee WHERE Email='$Email' AND Status ='Active' LIMIT 1";
    $result = mysqli_query($conn,$user_check);
    $user = mysqli_fetch_assoc($result);


    if(!empty($Sub_ID)){
        if(strlen($Password_1)<=6){
            echo '<script type="text/javascript">';
            echo 'alert("Password is too short");';
            echo 'window.location.href = "addemployee.php"';
            echo '</script>';
        }else if($Pos == 'Doctor'&& empty($Sub_ID)){
            echo '<script type="text/javascript">';
            echo 'alert("Please Insert a Doctor ID");';
            echo 'window.location.href = "addemployee.php"';
            echo '</script>';
        }
        else if ($Password_1 != $Password_2){
            echo '<script type="text/javascript">';
            echo 'alert("Password do not match");';
            echo 'window.location.href = "addemployee.php"';
            echo '</script>';
        }else if ($user['Email'] === $Email){
            echo '<script type="text/javascript">';
            echo 'alert("This Employee already Exists");';
            echo 'window.location.href = "addemployee.php"';
            echo '</script>';
        }
        else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
            echo '<script type="text/javascript">';
            echo 'alert("This email is not available");';
            echo 'window.location.href = "addemployee.php"';
            echo '</script>';
        }else{
            $query = "INSERT INTO `employee`(`Pass`, `Fname`, `Lname`, `Mname`, `Email`, `Gender`, `Age`, `Birthdate`, `Position`,`Sub_ID`) VALUES ('".md5($Password_1)."','$Fname','$Lname','$Mname','$Email','$Sex','$age','$DateofBirth','$Pos','$Sub_ID')";
            $run = mysqli_query($conn,$query);
            if($run===true){
                echo '<script type="text/javascript">';
                echo 'alert("Registered Successfully");';
                echo 'window.location.href = "addemployee.php"';
                echo '</script>';
            }else{
                echo '<script type="text/javascript">';
                echo 'alert("Error");';
                echo 'window.location.href = "addemployee.php"';
                echo '</script>';
            }
        }
    }else{
        if(strlen($Password_1)<=6){
            echo '<script type="text/javascript">';
            echo 'alert("Password is too short");';
            echo 'window.location.href = "addemployee.php"';
            echo '</script>';
        }else if ($Password_1 != $Password_2){
            echo '<script type="text/javascript">';
            echo 'alert("Password do not match");';
            echo 'window.location.href = "addemployee.php"';
            echo '</script>';
        }else if ($user['Email'] === $Email){
            echo '<script type="text/javascript">';
            echo 'alert("This Employee already Exists");';
            echo 'window.location.href = "addemployee.php"';
            echo '</script>';
        }
        else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
            echo '<script type="text/javascript">';
            echo 'alert("This email is not available");';
            echo 'window.location.href = "addemployee.php"';
            echo '</script>';
        }else{
            $query = "INSERT INTO `employee`(`Pass`, `Fname`, `Lname`, `Mname`, `Email`, `Gender`, `Age`, `Birthdate`, `Position`) VALUES ('".md5($Password_1)."','$Fname','$Lname','$Mname','$Email','$Sex','$age','$DateofBirth','$Pos')";
            $run = mysqli_query($conn,$query);
            if($run===true){
                echo '<script type="text/javascript">';
                echo 'alert("Registered Successfully");';
                echo 'window.location.href = "addemployee.php"';
                echo '</script>';
            }else{
                echo '<script type="text/javascript">';
                echo 'alert("Error");';
                echo 'window.location.href = "addemployee.php"';
                echo '</script>';
            }
        }
    }
    

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=!, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/operation.css">
    <link rel="icon" href="../photos/clinic1.png">
    <script src="../javascript/operation.js" defer></script>
    <script>
        function myFunction() {
        var x = document.getElementById("exampleInputPassword1");
        var y = document.getElementById("exampleInputPassword2");
        if (x.type === "password" || y.type === "password") {
        x.type = "text";
        y.type = "text";
        }
        else {
        x.type = "password";
        y.type = "password";
        }
}
    </script>
    <title>Add Employee</title>
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
        <div id="edit" style="border-right:solid 1px">
            <div id="form-container">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <h1>Add Employee</h1>
                <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="Email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                            <label>Position</label>
                            <select name="Position" min="0" class="form-control" required>
                            <Option disabled selected>Choose a position</Option>
                            <option value="Doctor">Doctor</option>
                            <option value="Staff">Staff</option>
                            </select>
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Doctor ID</label>
                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Doctor ID" name="Sub_ID">
                <small id="emailHelp" class="form-text text-muted">This field is only for employees with position of doctor</small>
                </div>
                <div class="row">
                        <div class="col-sm-5">
                            <label for="usr">First name</label>
                            <input type="text" name="Fname" class="form-control" placeholder="First name" required>
                        </div>
                        <div class="col-sm-5">
                            <label for="usr">Lastname</label>
                            <input type="text" name="Lname" class="form-control" placeholder="Last name" required>
                        </div>
                        <div class="col-sm-2">
                            <label for="usr">M.I</label>
                            <input type="text" name="Mname" class="form-control" placeholder="M.I" required>
                        </div>
                </div>
                <div class="row">
                        <div class="col-sm-6">
                            <label>Sex</label>
                            <select name="Sex" min="0"class="form-control" required>
                            <Option disabled selected>Choose a sex</Option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select>
                            
                        </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="usr">Date of birth</label>
                            <input type="date" class="form-control" id="birthdate" name="Birthdate" placeholder="M.I" required>
                        </div>
                </div>
                <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="Password1" placeholder="Password" required>
                            <small id="passHelp" class="form-text text-muted">Make your password 6-12 characters long</small>
                        </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" name="Password2" placeholder="Password" required>
                        </div>
                        <br>
                        <div>
                        <input id="cb" type="checkbox" onclick="myFunction()">
                        <label for="cb">&nbsp;Show password </label>
                        </div>
                </div>

                <div style="width:100%; height:auto; text-align:right;">
                <button class="btn btn-primary" type="submit" id="btn-add" name="Add">Add Employee</button></div>
                </form>

            </div>
        </div>
        
    </div>
</body>


</html>