<?php
include('session.php');
if(!isset($_SESSION['ID'])&&!isset($_SESSION['Pass'])){
  header("refresh: 0; url=employee_login.php");
}
?>
<?php
include("db_conn.php");


if($Pos=='Doctor'){
  $query5 = "SELECT * FROM appointment WHERE Doctor_ID = '$Sub_ID' AND Status = 'Posted'";
  $result2 = mysqli_query($conn, $query5);

  $New = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS New_Count FROM appointment WHERE Status = 'New' AND Doctor_ID = '$Sub_ID' ");
  $row1 = mysqli_fetch_array($New,MYSQLI_ASSOC);
  $NC = $row1['New_Count'];

  $Posted = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS Post_Count FROM appointment WHERE Status = 'Posted' AND Doctor_ID = '$Sub_ID'");
  $row2 = mysqli_fetch_array($Posted,MYSQLI_ASSOC);
  $PC = $row2['Post_Count'];

  $Closed = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS Closed_Count FROM appointment WHERE Status = 'Closed' AND Doctor_ID = '$Sub_ID'");
  $row3 = mysqli_fetch_array($Closed,MYSQLI_ASSOC);
  $CC = $row3['Closed_Count'];

  $Cancelled = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS Cancelled_Count FROM appointment WHERE Status = 'Cancelled' AND Doctor_ID = '$Sub_ID'");
  $row4 = mysqli_fetch_array($Cancelled,MYSQLI_ASSOC);
  $CLC = $row4['Cancelled_Count'];
}else{
  $query5 = "SELECT * FROM appointment WHERE Status = 'Posted'";
  $result2 = mysqli_query($conn, $query5);

  $New = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS New_Count FROM appointment WHERE Status = 'New' ");
  $row1 = mysqli_fetch_array($New,MYSQLI_ASSOC);
  $NC = $row1['New_Count'];

  $Posted = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS Post_Count FROM appointment WHERE Status = 'Posted'");
  $row2 = mysqli_fetch_array($Posted,MYSQLI_ASSOC);
  $PC = $row2['Post_Count'];

  $Closed = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS Closed_Count FROM appointment WHERE Status = 'Closed'");
  $row3 = mysqli_fetch_array($Closed,MYSQLI_ASSOC);
  $CC = $row3['Closed_Count'];

  $Cancelled = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS Cancelled_Count FROM appointment WHERE Status = 'Cancelled'");
  $row4 = mysqli_fetch_array($Cancelled,MYSQLI_ASSOC);
  $CLC = $row4['Cancelled_Count'];
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/see.css">
    <!-- CSS only --> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" /> 
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="../javascript/see.js" defer></script>
    <link rel="icon" href="../photos/clinic1.png">
    <title>Appointments</title>
    <script>
            $(document).ready(function () {
            $('#example').DataTable({
            pagingType: 'full_numbers',
            });
            });
    </script>
    
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
                          <a href="#" style="color: white;">SEE APPOINTMENTS</a>
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
        <div id="bod">
            <h1>LIST OF APPOINTMENTS</h1>
            
            <div id="box1">
                <div id="cont1">
                <div>
                    <h2>NEW</h2>
                    <?php echo '<h1>'.$NC.'</h1>' ?>
                </div>
                <div>
                    <h2>POSTED</h2>
                    <?php echo '<h1>'.$PC.'</h1>' ?>
                </div>
                </div>

                <div id="cont2">
                <div>
                    <h2>CLOSED</h2>
                    <?php echo '<h1>'.$CC.'</h1>' ?>
                </div>
                <div>
                    <h2>CANCELLED</h2>
                    <?php echo '<h1>'.$CLC.'</h1>' ?>
                </div>
              </div>
            </div>
            <H1>POSTED APPOINTMENTS</H1>
            <div id="status-btn">
            <a href="see.php" style="text-decoration:none; font-weight:bold;font-size:20px;color:#333;">ALL</a>
            <a href="seenew.php"style="text-decoration:none; font-weight:bold;font-size:20px;color:#333;">NEW</a>
            <a href="#"style=" font-weight:bold;font-size:20px;color:#333;">POSTED</a>
            <a href="seeclosed.php"style="text-decoration:none; font-weight:bold;font-size:20px;color:#333;">CLOSED</a>
            <a href="seecancelled.php"style="text-decoration:none; font-weight:bold; font-size:20px;color:#333;">CANCELLED</a>
          </div>
            <div id="box2" style="border-color:white;height:auto;border-radius:0px;">
                  <table id="example" class="display table table-bordered data-table" style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">Appointment ID</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Service</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Status</th>
                        <th scope="col">Operation</th>
                        <th scope="col">Cancel</th>
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
                              echo "<td>".$row['Status']."</td>";
                              echo "<td><a href='Close.php?id=".$row['Appointment_ID']."' style='text-decoration:none; font-weight:bold;'>Close</a></td>";
                              echo "<td><a href='Cancel.php?id=".$row['Appointment_ID']."' style='text-decoration:none; font-weight:bold; color:red;'>Cancel</a></td>";
                              echo "</tr>";
                            }
                            ?>
                    </tbody>
                          </table>
            </div>
        </div>
    </div>
    
</body>
</html>