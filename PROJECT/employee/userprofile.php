<?php
include('session.php');
if(!isset($_SESSION['ID'])&&!isset($_SESSION['Pass'])){
  header("refresh: 0; url=employee_login.php");
}
?>
<?php
include('db_conn.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $apt = mysqli_query($conn, "SELECT * FROM appointment WHERE User_ID='$id'");

    $New = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS New_Count FROM appointment WHERE User_ID = '$id' and Status = 'New'");
    $row1 = mysqli_fetch_array($New,MYSQLI_ASSOC);
    $NC = $row1['New_Count'];

    $Posted = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS Posted_Count FROM appointment WHERE User_ID = '$id' and Status = 'Posted'");
    $row2 = mysqli_fetch_array($Posted,MYSQLI_ASSOC);
    $PC = $row2['Posted_Count'];

    $query = "SELECT * FROM user WHERE User_ID = '$id'";
    $query_run = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);

    $Docid = $row['User_ID'];
    $name = $row['Fname'].' '.$row['Lname'];
    $img = $row['img_url'];
    $spec = $row['Email'];
    $age = $row['Age'];
    $bd = $row['Birthdate'];
    $g = $row['Sex'];
    $num = $row['Contact_number'];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" /> 
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/doc.css">
    <script src="../javascript/index.js" defer></script>
    <link rel="icon" href="../photos/clinic1.png">
    <title>Profile</title>
    
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
        <div id="content3">
            <div id="box3">
                <div id="b3">
                  <img src="../client/uploads/<?php echo $img?>" alt="" id="img">
                  </div>
                <div id="b4">
                    <h1><b>USER ID: </b><?php echo $Docid?></h1>
                    <h2><?php echo $name?></h2>
                    <p><b>Email: </b><?php echo $spec?></p>
                    <p><b>Age: </b><?php echo $age?></p>
                    <p><b>Birthdate: </b><?php echo $bd?></p>
                    <p><b>Gender: </b><?php echo $g?></p>
                    <p><b>Contact#: </b><?php echo $num?></p>
                </div>
            </div>
            <div id="box4">
                <div id="c3">
                    <h1>NEW</h1>
                    <p><?php echo $NC ?></p>
                </div>
                <div id="c4">
                    <h1>POSTED</h1>
                    <p><?php echo $PC ?></p>
                </div>
            </div>
        </div>
        <div id="content4">
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
              </tr>
            </thead>
            <tbody>
                            <?php
                            while($row = $apt->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>".$row['Appointment_ID']."</td>";
                                echo "<td>".$row['Pname']."</td>";
                                echo "<td>".$row['Service']."</td>";
                                echo "<td>".$row['Appointment_Date']."</td>";
                                echo "<td>".$row['Time']."</td>";
                                echo "<td>".$row['Doctor']."</td>";
                                echo "<td>".$row['Status']."</td>";
                              echo "</tr>";
                            }
                            ?>
            </tbody>
          </table>
        </div>



    </div>
</body>
</html>