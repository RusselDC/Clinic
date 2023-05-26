<?php
include("session.php");
$docid = "";
$docname = "";
$docspec = "";
$docservice = "";
$docage = "";
$docdate = "";
$docgender = "";
$docstatus = "";
if(isset($_POST['search-btn'])){
    $search = $_POST['searchbar'];
    $searchq = mysqli_query($conn, "SELECT * FROM doctors WHERE Doc_ID = '$search'");
    $row = mysqli_fetch_array($searchq,MYSQLI_ASSOC);
    $docid =  $row['Doc_ID'];
    $docname = $row['Name'];
    $docspec = $row['Spec'];
    $docservice = $row['Service'];
    $docage = $row['Age'];
    $docdate = $row['Birthdate'];
    $docgender = $row['Gender'];
    $docstatus = $row['Status'];
}
if(isset($_POST['Save'])){
    $id = $_POST['Doc_ID'];
    $name = $_POST['Name'];
    $spec = $_POST['Spec'];
    $Service = $_POST['Service'];
    $bdate = $_POST['Birthdate'];
    $gender = $_POST['Gender'];
    $date = date("Y/m/d");
    $Age = date_diff(date_create($bdate),date_create($date));
    $age = $Age->format('%y');
    if($age <= 25){
        echo '<script type="text/javascript">';
        echo 'alert("Invalid Age");';
        echo 'window.location.href = "adddoctor.php"';
        echo '</script>';
    }else{
        $Save = mysqli_query($conn, "UPDATE doctors SET Name = '$name', Spec ='$spec', Service = '$Service', Birthdate = '$bdate', Age = '$age', Gender = '$gender' WHERE Doc_ID = '$id'");
        if($Save===TRUE){
            echo '<script type="text/javascript">';
            echo 'alert("Changes saved");';
            echo 'window.location.href = "adddoctor.php"';
            echo '</script>';
          }
          else{
          echo '<script type="text/javascript">';
          echo 'alert("Something went wrong");';
          echo 'window.location.href = "adddoctor.php"';
          echo '</script>';
          }
    }
}
if(isset($_POST['Add'])){
    $dname = $_POST['Name1'];
    $dspec = $_POST['Spec1'];
    $dservice = $_POST['Service1'];
    $dbdate = $_POST['Birthdate1'];
    $dgender = $_POST['Gender1'];
    $date = date("Y/m/d");
    $Age = date_diff(date_create($dbdate),date_create($date));
    $age = $Age->format('%y');
    if($age <= 25){
        echo '<script type="text/javascript">';
        echo 'alert("Invalid Age");';
        echo 'window.location.href = "adddoctor.php"';
        echo '</script>';
    }
    else{
        $Add = mysqli_query($conn, "INSERT INTO doctors(Name,Spec,Service,Age,Birthdate,Gender) VALUES ('$dname','$dspec','$dservice','$age','$dbdate','$dgender')");
        if($Add===TRUE){
            echo '<script type="text/javascript">';
            echo 'alert("Doctor Added");';
            echo 'window.location.href = "adddoctor.php"';
            echo '</script>';
          }
          else{
          echo '<script type="text/javascript">';
          echo 'alert("Something went wrong");';
          echo 'window.location.href = "adddoctor.php"';
          echo '</script>';
          }
    }
}
?>

<?php
$query = "SELECT * FROM doctors WHERE Status = 'Active'";
$result = mysqli_query($conn,$query);
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
    <title>Add/Edit Doctor.</title>
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
        <div id="edit">
            <div id="form-container">
                <h1>Edit Doctor</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="input-group mb-3">
                    <select name="searchbar" id="" class="form-control" aria-placeholder="Choose Appointment_ID" required>
                      <option value="" selected disabled>Choose Doctor ID</option>
                      <?php
                      while($row = $result->fetch_assoc()){
                        echo "<Option value=".$row['Doc_ID'].">".$row['Name']." - ".$row['Spec']." - ".$row['Service']."</Option>";
                      }
                      
                      ?>
                    </select>
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit" name="search-btn">Search</button>
                    </div>
                </form>
                    </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="form-group">
                      <label for="exampleInputEmail1">Doctor ID</label>
                      <input type="number" class="form-control"  placeholder="Enter Doctor ID" name="Doc_ID" value="<?php echo $docid ?>" readonly>
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Doctor Name</label>
                      <input type="Text" class="form-control"  placeholder="Enter Doctor Name" name="Name" value="<?php echo $docname ?>" required>
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Specialization</label>
                      <input type="Text" class="form-control"  placeholder="Enter Doctor Specialization" name="Spec" value="<?php echo $docspec ?>" required>
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Service</label>
                      <input type="Text" class="form-control"  placeholder="Enter Doctor Service" name="Service" value="<?php echo $docservice ?>" required>
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Age</label>
                      <input type="Number" class="form-control"  placeholder="Enter Doctor Age" value="<?php echo $docage ?>" readonly>
                </div>
                <div class="form-group">
                        <label for="exampleInputPassword1">Birthdate</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" placeholder="YYYY-MM-DD" name="Birthdate" value="<?php echo $docdate ?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Gender</label>
                    <select class="form-select" aria-label="Default select example" name="Gender" required>
                        <option value="<?php echo $docgender ?>"><?php echo $docgender ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <input type="Text" class="form-control" value="<?php echo $docstatus ?>" readonly>
                </div>
                <br>
                <div style="height:auto ;width: 100%; text-align: right;">
                        <button type="submit" class="btn btn-primary" name="Save">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
        <div id="add">
            <div id="form-container">
                <h1>Add Doctor</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="form-group">
                      <label for="exampleInputEmail1">Doctor Name</label>
                      <input type="Text" class="form-control"  placeholder="Enter Doctor Name" name="Name1" required>
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Specialization</label>
                      <input type="Text" class="form-control"  placeholder="Enter Doctor Specialization" name="Spec1" required>
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Service</label>
                      <input type="Text" class="form-control"  placeholder="Enter Doctor Service" name="Service1" required>
                </div>
                <div class="form-group">
                        <label for="exampleInputPassword1">Birthdate</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" placeholder="YYYY-MM-DD" name="Birthdate1" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Gender</label>
                    <select class="form-select" aria-label="Default select example" name="Gender1" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <br>
                <div style="height:auto ;width: 100%; text-align: right;">
                    <button type="submit" class="btn btn-primary" name="Add">Add Doctor</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>


</html>