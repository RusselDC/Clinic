<?php
include('session.php');
if(!isset($_SESSION['ID'])&&!isset($_SESSION['Pass'])){
  header("refresh: 0; url=employee_login.php");
}
if($Status=='Inactive'){
  echo '<script type="text/javascript">';
  echo 'alert("This account is already disabled, contact the management if you think this is a mistake");';
  echo 'window.location.href = "employee_login.php"';
  echo '</script>';
  session_unset();
  session_destroy();
}
?>
<?php
   include("db_conn.php");
   $Male = mysqli_query($conn, "SELECT COUNT(User_ID) AS Male_Count FROM user WHERE Sex = 'Male'");
   $row1 = mysqli_fetch_array($Male,MYSQLI_ASSOC);
   $Male_Count = $row1['Male_Count'];

   $Female = mysqli_query($conn, "SELECT COUNT(User_ID) AS Female_Count FROM user WHERE Sex = 'Female'");
   $rows = mysqli_fetch_array($Female,MYSQLI_ASSOC);
   $Female_Count = $rows['Female_Count'];

   $Doctor = mysqli_query($conn, "SELECT COUNT(Doc_ID) AS Doctor_Count FROM doctors WHERE Status = 'Active'");
   $row2 = mysqli_fetch_array($Doctor,MYSQLI_ASSOC);
   $Doctor_Count = $row2['Doctor_Count'];

   $date = date("Y/m/d");
   $time = date("h:i:s a");
  if($Pos=='Doctor'){
    $query2 = "SELECT * FROM appointment WHERE Status = 'Posted' AND Appointment_Date = '$date' AND Doctor_ID = '$Sub_ID'";
    $result2 = mysqli_query($conn, $query2);

    $appointments = mysqli_query($conn, "SELECT COUNT(Appointment_ID) As Apt_Count FROM appointment WHERE Appointment_Date = '$date' AND Status = 'Posted' AND Doctor_ID = '$Sub_ID'");
    $row3 = mysqli_fetch_array($appointments,MYSQLI_ASSOC);
    $Apt = $row3['Apt_Count'];
  }else{
    $query2 = "SELECT * FROM appointment WHERE Status = 'Posted' AND Appointment_Date = '$date'";
    $result2 = mysqli_query($conn, $query2);

    $appointments = mysqli_query($conn, "SELECT COUNT(Appointment_ID) As Apt_Count FROM appointment WHERE Appointment_Date = '$date' AND Status = 'Posted'");
    $row3 = mysqli_fetch_array($appointments,MYSQLI_ASSOC);
    $Apt = $row3['Apt_Count'];
  }


  $query3 = "SELECT * FROM doctors WHERE Status = 'Active'";
  $result3 = mysqli_query($conn,$query3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="../javascript/dashboard.js" defer></script>
    <link rel="icon" href="../photos/clinic1.png">
    <script>
    setInterval(function() {
    var currentTime = new Date ( );    
    var currentHours = currentTime.getHours ( );   
    var currentMinutes = currentTime.getMinutes ( );   
    var currentSeconds = currentTime.getSeconds ( );
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;   
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;    
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";    
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;    
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;    
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
    document.getElementById("timer").innerHTML = currentTimeString;
      }, 1000);
    </script>

    <title>HOME</title>
</head>
<body>
    <div id="container">
        <nav id="navbar">
            <div id="brand-title">
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
        <main style="margin-right:10px ;">
            <div id="greetings">
                <?php echo '<h2 style="text-indent: 10px;"> Welcome '. $emp_Fname .'</h2>' ?>
                <p style="text-indent: 10px;">In this dashboard, you can do the following!</p>
            </div>
            <div id="dashboard">
                <div id="dashboard-1">
                    <div id="d1">
                        <a href="seeusers.php"><img class="logo" src="../photos/users.png" alt="" style="display: block;
                            width: 40%;
                            margin: auto;"></a>
                        <h2 style="text-align: center ;">USERS</h2>
                    </div>
                    <div id="d2">
                        <a href="seetaff.php"><img class="logo" src="../photos/nurse.png" alt="" style="display: block;
                            width: 40%;
                            margin: auto;"></a>
                        <h2 style="text-align: center ;">STAFF</h2>
                    </div>
                </div>
                <div id="dashboard-2">
                    <div id="d1">
                        <a href="seedoctors.php"><img class="logo" src="../photos/doctor (1).png" alt="" style="display: block;
                            width: 40%;
                            margin: auto;"></a>
                        <h2 style="text-align: center ;">doctor</h2>
                    </div>
                    <div id="d2">
                        <a href="see.php"><img class="logo" src="../photos/addbooking.png" alt="" style="display: block;
                            width: 40%;
                            margin: auto;"></a>
                        <h2 id="apt" style="text-align: center ;">appointments</h2>
                    </div>
                </div>
            </div>
        </main>
        <div id="sidebar" style="margin-left:10px;">
          
            <div id="box">
                <div id="box1">
                <a href="uploadpic.php"></a>
                <?php 
                $sql = "SELECT img_url FROM employee WHERE Emp_ID = '$ID' ";
                $res = mysqli_query($conn, $sql);

                if(mysqli_num_rows($res)>0){
                 while($images = mysqli_fetch_assoc($res)){ ?>

                    <div id="image-box">
                        <img id="picture" src="uploads/<?=$images['img_url']?>" alt="Temp">
                    </div> 
                    <?php }}?>
                      

                    <div id="staff">
                        <?php echo '<h5> '.$emp_Fname.' '.$emp_Lname.'</h5>'?>
                        <?php echo '<p>ID: '.$ID.'</p>' ?>
                        <?php echo '<p>Age: '.$Age.'</p>' ?>
                        <?php echo '<p>Position: '.$Pos.'</p>' ?>
                    </div>
                </div>
                <div id="box2">
                    <h2>today's activity</h2>
                    <p><?php echo "Today is " . $date?></p>
                    <b><p id="timer"></p></b>
                    <p>Appointment today: <?php echo $Apt ?></p>
                    <p>Male patients: <?php echo $Male_Count ?></p>
                    <p>Female Patients: <?php echo $Female_Count ?></p></p>
                    <p> Active Doctors: <?php echo $Doctor_Count ?></p>
                </div>
            </div>
        </div>
        <div id="content"style="margin-right: 10px;">

            <div id="content1" >
                <h2 style="text-align:center ;">List of Doctors</h2>
                <div id="table-container">
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">DOCTOR_ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Specialization</th>
                            <th scope="col">Age</th>
                          </tr>
                        </thead>
                        <tbody>
                      <?php
                            while($row = $result3->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>".$row['Doc_ID']."</td>";
                              echo "<td>".$row['Name']."</td>";
                              echo "<td>".$row['Spec']."</td>";
                              echo "<td>".$row['Age']."</td>";
                              echo "</tr>";
                            }
                            ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <div id="content2">
                <h2 style="text-align:center ;">List of appointments</h2>
                <div id="table-container">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Appointment ID</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Service</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Notify</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                            while($row = $result2->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>".$row['Appointment_ID']."</td>";
                              echo "<td>".$row['Pname']."</td>";
                              echo "<td>".$row['Service']."</td>";
                              echo "<td>".$row['Appointment_Date']."</td>";
                              echo "<td>".$row['Time']."</td>";
                              echo "<td>".$row['Doctor']."</td>";
                              echo "<td><a href='notify.php?id=".$row['Appointment_ID']."' style='text-decoration:none; font-weight:bold;'>Notify</a></td>";
                              echo "</tr>";
                            }
                            ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>