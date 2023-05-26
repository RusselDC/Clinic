<?php
include('session.php');
if(!isset($_SESSION['ID'])&&!isset($_SESSION['Pass'])){
  header("refresh: 0; url=employee_login.php");
}
ini_set('display_errors', '0');
?>
<?php 
$date = $_GET['date'];
$time = $_GET['time'];
$did = $_GET['docid'];
$appointment = mysqli_query($conn, "SELECT Time,Appointment_Date,Service FROM appointment WHERE Appointment_Date = '$date' AND Doctor_ID='$did'");
$rows = mysqli_num_rows($appointment);



?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/vendor/autoload.php';
$mail = new PHPMailer(true);
?>

<?php 
$Email = "";
$Name = "";
$Service = "";
$Doctor = "";
$IDs = "";
if(isset($_POST['search-btn'])){
    $search = $_POST['searchbar'];
    if(empty($search)){
      echo '<script type="text/javascript">';
      echo 'alert("Please select an appointment id");';
      echo 'window.location.href = "operation.php"';
      echo '</script>';
    }else{
      $select = mysqli_query($conn, "SELECT * FROM appointment WHERE Appointment_ID = '$search'");
      $row = mysqli_fetch_array($select,MYSQLI_ASSOC);
      $IDs = $row['Appointment_ID'];
      $Name = $row['Pname'];
      $Email = $row['Email'];
      $Service = $row['Service'];
      $Date = $row['Appointment_Date'];
      $Time = $row['Time'];
      $Status = $row['Status'];
      $Doctor = $row['Doctor'];
    }
    
}
$query3 = "SELECT Name, Spec,Service FROM doctors";
$result3 = mysqli_query($conn,$query3);

$query5 = "SELECT Name, Spec,Service FROM doctors";
$result5 = mysqli_query($conn,$query5);

$query4 = "SELECT * FROM appointment WHERE Status = 'New' OR Status = 'Posted'";
$result4 = mysqli_query($conn,$query4);
if(isset($_POST['Save'])){
  $ID = $_POST['apt_id'];
  $Email = $_POST['Email'];
  $Name = $_POST['Name'];
  $Service = $_POST['Service'];
  $Date = $_POST['Date'];
  $Time = $_POST['Time'];
  $today = strtotime(date("Y/m/d"));
  $insertdate = strtotime($Date);

  $doctor = mysqli_query($conn, "SELECT Name FROM doctors WHERE Service ='$Service'");
  $row2 = mysqli_fetch_assoc($doctor);
  $docname = $row2['Name'];

  $Doc_ID = mysqli_query($conn, "SELECT Doc_ID FROM doctors WHERE Name = '$docname'");
  $row3 = mysqli_fetch_assoc($Doc_ID);
  $docid = $row3['Doc_ID'];
  

  $select = mysqli_query($conn, "SELECT * FROM appointment WHERE Appointment_Date= '$Date' AND Time = '$Time' AND Doctor = '$docname'");
  $row = mysqli_num_rows($select);
  if($row>=1){
    echo '<script type="text/javascript">';
    echo 'alert("Appointment Time slot Already occupied");';
    echo 'window.location.href = "operation.php?date='.$Date.'&time='.$Time.'&docid='.$docid.'"';
    echo '</script>';
  }else if($insertdate<$today){
  echo '<script type="text/javascript">';
  echo 'alert("Appointment date is invalid");';
  echo 'window.location.href = "operation.php"';
  echo '</script>';
}
else{
  $Save = mysqli_query($conn, "UPDATE appointment SET Email='$Email',Pname='$Name',Service='$Service',Appointment_Date='$Date',Time='$Time',Doctor='$docname',Doctor_ID='$docid' WHERE Appointment_ID='$ID'");
  if($Save===TRUE){
    try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
      $mail->isSMTP();                                            
      $mail->Host       = 'smtp.gmail.com';                     
      $mail->SMTPAuth   = true;                                   
      $mail->Username = '';                     
      $mail->Password = '';                            
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
      $mail->Port       = 465;                                    


      $mail->setFrom('clinica.noreply22@gmail.com');
      $mail->addAddress($Email); 


      $mail->isHTML(true);                                 
      $mail->Subject = 'Appointment Changes';
      $mail->Body    = '<p><b> Patient Name: '.$Name.'</b></p><br>'.
                        '<p><b> Service Chosen:'.$Service.'</b></p><br>'.
                        '<p><b> Appointment Date :'.$Date.'</b></p><br>'.
                        '<p><b> Appointment Time :'.$Time.'</b></p><br>'.
                        '<p><b> Doctor :'.$docname.'</p><br>';
                        
      $mail->AltBody = 'Appointmnet Notification';

    $mail->send();
    echo '<script type="text/javascript">';
    echo 'alert("Email has been sent");';
    echo 'window.location.href = "operation.php"';
    echo '</script>';
    
    }  catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
     }
  }
  
}


?>
<?php 
if(isset($_POST['Add'])){
  $Email = $_POST['Email1'];
  $Name = $_POST['name1'];
  $Service = $_POST['Service1'];
  $Date = $_POST['Date1'];
  $Time = $_POST['Time1'];
  $today = strtotime(date("Y/m/d"));
  $insertdate = strtotime($Date);

  $Doctor = mysqli_query($conn, "SELECT Name From doctors WHERE Service = '$Service'");
  $rows = mysqli_fetch_assoc($Doctor);
  $Docname = $rows['Name'];

  $doctor = mysqli_query($conn, "SELECT Doc_ID FROM doctors WHERE Name = '$Docname'");
  $row = mysqli_fetch_assoc($doctor);
  $docid = $row['Doc_ID'];

  $default = mysqli_query($conn, "SELECT User_ID FROM user WHERE Lname = 'CLINICA'");
  $guest = mysqli_fetch_assoc($default);
  $guestid = $guest['User_ID'];

  $New = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS New_Count FROM appointment WHERE Status = 'New' ");
  $row1 = mysqli_fetch_array($New,MYSQLI_ASSOC);
  $NC = $row1['New_Count'];


  $select = mysqli_query($conn, "SELECT * FROM appointment WHERE Appointment_Date= '$Date' AND Time = '$Time' AND Doctor = '$Docname'");
  $row = mysqli_num_rows($select);
  if($row>=1){
    echo '<script type="text/javascript">';
    echo 'alert("Appointment Time slot Already occupied");';
    echo 'window.location.href = "operation.php?date='.$Date.'&time='.$Time.'&docid='.$docid.'"';
    echo '</script>';
  }else if($insertdate<$today){
    echo '<script type="text/javascript">';
    echo 'alert("Appointment date is invalid");';
    echo 'window.location.href = "operation.php"';
    echo '</script>';
  }
  else if($NC>=50){
    echo '<script type="text/javascript">';
    echo 'alert("Appointment count has reached it limit, please try again in later date");';
    echo 'window.location.href = "operation.php"';
    echo '</script>';
  }
  else{
    $insert = mysqli_query($conn, "INSERT INTO `appointment`(`Pname`, `Email`, `Service`, `Appointment_Date`, `Time`, `Doctor`, `Doctor_ID`, `User_ID`) VALUES ('$Name','$Email','$Service','$Date','$Time','$Docname','$docid','$guestid')");
    echo '<script type="text/javascript">';
    echo 'alert("Appointment Added");';
    echo 'window.location.href = "operation.php"';
    echo '</script>';
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
            

    </script>
    <title>Add/Edit Appt.</title>
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
                <h1>Edit Appointment</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="input-group mb-3">
                    <select name="searchbar" id="" class="form-control" aria-placeholder="Choose Appointment_ID" required>
                      <option value="" selected disabled>Choose Appointment ID</option>
                    <?php
                            while($row = $result4->fetch_assoc()) {
                  
                               echo "<Option value=".$row['Appointment_ID'].">".$row['Appointment_ID']." - ".$row['Pname']." - ".$row['Status']."</Option>";
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
                      <label for="exampleInputEmail1">Appointment ID</label>
                      <h1><?php $Email?></h1>
                      <input type="number" class="form-control"  placeholder="Enter Appointment_ID" name="apt_id" value="<?php echo $IDs?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <h1><?php $Email?></h1>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" id="Email" placeholder="Enter email" name="Email" value="<?php echo $Email?>" required>
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Name</label>
                      <input type="text" class="form-control" placeholder="Enter Name" id="exampleInputPassword1" name="Name" value="<?php echo $Name?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Service</label>
                        <select class="form-select" aria-label="Default select example" name="Service" required>
                          <option value="<?php echo $Service?>"><?php echo $Service?></option>
                          <option value="General Checkup">General Checkup</option>
                          <option value="Cervix Checkup">Cervix Checkup</option>
                          <option value="Heart Checkup">Heart Checkup</option>
                          <option value="Eye Checkup">Eye Checkup"</option>
                          <option value="Hearing Test">Hearing Test</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Appointment Date</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" placeholder="YYYY-MM-DD" name="Date" value="<?php echo $Date?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Time</label>
                        <select class="form-select" aria-label="Default select example" name="Time" required>
                            <?php if($Time == '08:00-09:00') {  ?>
                                    <option value="<?php echo $Time ?>" selected>08:00-09:00</option>
                                    <option value="09:00-10:00">09:00-10:00</option>
                                    <option value="10:00-11:00">10:00-11:00</option>
                                    <option value="11:00-12:00">11:00-12:00</option>
                                    <option disabled>Break Time</option>
                                    <option value="01:00-02:00">01:00-02:00</option>
                                    <option value="02:00-03:00">02:00-03:00</option>
                                    <option value="03:00-04:00">03:00-04:00</option>
                                    <option value="04:00-05:00">04:00-05:00</option>
                            <?php }  ?>
                            <?php if($Time == '09:00-10:00') {  ?>
                                    <option value="08:00-09:00" >08:00-09:00</option>
                                    <option value="<?php echo $Time ?>"selected>09:00-10:00</option>
                                    <option value="10:00-11:00">10:00-11:00</option>
                                    <option value="11:00-12:00">11:00-12:00</option>
                                    <option disabled>Break Time</option>
                                    <option value="01:00-02:00">01:00-02:00</option>
                                    <option value="02:00-03:00">02:00-03:00</option>
                                    <option value="03:00-04:00">03:00-04:00</option>
                                    <option value="04:00-05:00">04:00-05:00</option>
                            <?php }  ?>
                            <?php if($Time == '10:00-11:00') {  ?>
                                    <option value="08:00-09:00" >08:00-09:00</option>
                                    <option value="09:00-10:00">09:00-10:00</option>
                                    <option value="<?php echo $Time ?>" selected>10:00-11:00</option>
                                    <option value="11:00-12:00">11:00-12:00</option>
                                    <option disabled>Break Time</option>
                                    <option value="01:00-02:00">01:00-02:00</option>
                                    <option value="02:00-03:00">02:00-03:00</option>
                                    <option value="03:00-04:00">03:00-04:00</option>
                                    <option value="04:00-05:00">04:00-05:00</option>
                            <?php }  ?>
                            <?php if($Time == '11:00-12:00') {  ?>
                                    <option value="08:00-09:00" >08:00-09:00</option>
                                    <option value="09:00-10:00">09:00-10:00</option>
                                    <option value="10:00-11:00">10:00-11:00</option>
                                    <option value="<?php echo $Time ?>" selected>11:00-12:00</option>
                                    <option disabled>Break Time</option>
                                    <option value="01:00-02:00">01:00-02:00</option>
                                    <option value="02:00-03:00">02:00-03:00</option>
                                    <option value="03:00-04:00">03:00-04:00</option>
                                    <option value="04:00-05:00">04:00-05:00</option>
                            <?php }  ?>
                            <?php if($Time == '01:00-02:00') {  ?>
                                    <option value="08:00-09:00" >08:00-09:00</option>
                                    <option value="09:00-10:00">09:00-10:00</option>
                                    <option value="10:00-11:00">10:00-11:00</option>
                                    <option value="11:00-12:00">11:00-12:00</option>
                                    <option disabled>Break Time</option>
                                    <option value="<?php echo $Time ?>" selected>01:00-02:00</option>
                                    <option value="02:00-03:00">02:00-03:00</option>
                                    <option value="03:00-04:00">03:00-04:00</option>
                                    <option value="04:00-05:00">04:00-05:00</option>
                            <?php }  ?>
                            <?php if($Time == '02:00-03:00') {  ?>
                                    <option value="08:00-09:00" >08:00-09:00</option>
                                    <option value="09:00-10:00">09:00-10:00</option>
                                    <option value="10:00-11:00">10:00-11:00</option>
                                    <option value="11:00-12:00">11:00-12:00</option>
                                    <option disabled>Break Time</option>
                                    <option value="01:00-02:00">01:00-02:00</option>
                                    <option value="<?php echo $Time ?>" selected>02:00-03:00</option>
                                    <option value="03:00-04:00">03:00-04:00</option>
                                    <option value="04:00-05:00">04:00-05:00</option>
                            <?php }  ?>
                            <?php if($Time == '03:00-04:00') {  ?>
                                    <option value="08:00-09:00" >08:00-09:00</option>
                                    <option value="09:00-10:00">09:00-10:00</option>
                                    <option value="10:00-11:00">10:00-11:00</option>
                                    <option value="11:00-12:00">11:00-12:00</option>
                                    <option disabled>Break Time</option>
                                    <option value="01:00-02:00">01:00-02:00</option>
                                    <option value="02:00-03:00">02:00-03:00</option>
                                    <option value="<?php echo $Time ?>" selected>03:00-04:00</option>
                                    <option value="04:00-05:00">04:00-05:00</option>
                            <?php }  ?>
                            <?php if($Time == '04:00-05:00') {  ?>
                                    <option value="08:00-09:00" >08:00-09:00</option>
                                    <option value="09:00-10:00">09:00-10:00</option>
                                    <option value="10:00-11:00">10:00-11:00</option>
                                    <option value="11:00-12:00">11:00-12:00</option>
                                    <option disabled>Break Time</option>
                                    <option value="01:00-02:00">01:00-02:00</option>
                                    <option value="02:00-03:00">02:00-03:00</option>
                                    <option value="03:00-04:00">03:00-04:00</option>
                                    <option value="<?php echo $Time ?>" selected>04:00-05:00</option>
                            <?php }  ?>
                        </select>    
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Doctor</label>
                        <input type="text" class="form-control" readonly value="<?php echo $Doctor?>">
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
                <h1>Add Appointment</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="Email1" required>
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Name" name="name1" required>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Service</label>
                        <select class="form-select" aria-label="Default select example" name="Service1" required>
                          <option value="" disabled selected>SELECT A SERVICE</option>
                          <option value="General Checkup">General Checkup</option>
                          <option value="Cervix Checkup">Cervix Checkup</option>
                          <option value="Heart Checkup">Heart Checkup</option>
                          <option value="Eye Checkup">Eye Checkup</option>
                          <option value="Hearing Test">Hearing Test</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Appointment Date</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" placeholder="YYYY-MM-DD" name="Date1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Time</label>
                        <select class="form-select" aria-label="Default select example" name="Time1" required>
                            <option value="1" selected disabled>Select a timeslot</option>
                            <option value="08:00-09:00">08:00-09:00</option>
                            <option value="09:00-10:00">09:00-10:00</option>
                            <option value="10:00-11:00">10:00-11:00</option>
                            <option value="11:00-12:00">11:00-12:00</option>
                            <option disabled>Break Time</option>
                            <option value="01:00-02:00">01:00-02:00</option>
                            <option value="02:00-03:00">02:00-03:00</option>
                            <option value="03:00-04:00">03:00-04:00</option>
                            <option value="04:00-05:00">04:00-05:00</option>
                        </select>    
                    </div>
                    <br>
                    <div style="height:auto ;width: 100%; text-align: right;">
                        <button type="submit" class="btn btn-primary" name="Add">Add New Appointment</button>
                    </div>
                  </form>
                  <br>
                  <?php
                    if($rows>=1){
                      echo '<p> All the occupied timeslot will appear here based from your previously inserted date and service';
                      while($row = $appointment->fetch_assoc()){
                        echo '<p><b> '.$row['Service'].' - '.$row['Time'].' - '.$row['Appointment_Date'].'</b></p>';
                      }
                    }
                  ?>
            </div>
        </div>
    </div>
</body>


</html>