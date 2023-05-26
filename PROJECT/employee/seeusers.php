<?php
include('session.php');
if(!isset($_SESSION['ID'])&&!isset($_SESSION['Pass'])){
  header("refresh: 0; url=employee_login.php");
}
?>
<?php
$query = "SELECT * from user";
$quer_run = mysqli_query($conn,$query);

$New = mysqli_query($conn, "SELECT COUNT(USER_ID) AS Male_Count FROM user WHERE Sex = 'Male'");
$row1 = mysqli_fetch_array($New,MYSQLI_ASSOC);
$MC = $row1['Male_Count'];

$New1 = mysqli_query($conn, "SELECT COUNT(USER_ID) AS Female_Count FROM user WHERE Sex = 'Female'");
$row2 = mysqli_fetch_array($New1,MYSQLI_ASSOC);
$FC = $row2['Female_Count'];

$New2 = mysqli_query($conn, "SELECT MIN(Age) AS Youngest FROM user");
$row3 = mysqli_fetch_array($New2,MYSQLI_ASSOC);
$AC = $row3['Youngest'];

$New3 = mysqli_query($conn, "SELECT MAX(Age) AS Oldest FROM user");
$row4 = mysqli_fetch_array($New3,MYSQLI_ASSOC);
$IC = $row4['Oldest'];

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
    <title>Doctors</title>
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
                          <a href="#" style="color: white;">SEE DOCTORS</a>
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
        <div id="bod">
            <h1>USERS</h1>
            
            <div id="box1">
                <div id="cont1">
                <div>
                    <h2>MALE</h2>
                    <?php echo '<h1>'.$MC.'</h1>' ?>
                </div>
                <div>
                    <h2>FEMALE</h2>
                    <?php echo '<h1>'.$FC.'</h1>' ?>
                </div>
                </div>

                <div id="cont2">
                <div>
                    <h2>YOUNGEST</h2>
                    <?php echo '<h1>'.$AC.'</h1>' ?>
                </div>
                <div>
                    <h2>OLDEST</h2>
                    <?php echo '<h1>'.$IC.'</h1>' ?>
                </div>
              </div>
            </div>
            <H1>LIST OF USERS</H1>
            <div id="status-btn">
            <a href="#"style="text-decoration:none; font-weight:bold;font-size:20px;color:#333;">Active</a>
            <a href="seeinactive.php"style="text-decoration:none; font-weight:bold;font-size:20px;color:#333;">Inactive</a>
          </div>
            <div id="box2" style="border-color:white;height:auto;border-radius:0px;">
                  <table id="example" class="display table table-bordered data-table" style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">IMG</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Sex</th>
                        <th scope="col">Status</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Operation</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                            while($row = $quer_run->fetch_assoc()) {
                                $name = $row['Fname'].' '.$row['Lname'];
                              echo "<tr>";
                              echo "<td> <img src='../client/uploads/".$row['img_url']."' alt='' style='height:50px; width:50px; border-radius:100%; border-style:solid; border-width: 1px;'> </td>";
                              echo "<td>".$row['Email']."</td>";
                              echo "<td>".$name."</td>";
                              echo "<td>".$row['Age']."</td>";
                              echo "<td>".$row['Sex']."</td>";
                              echo "<td>".$row['Status']."</td>";
                              echo "<td>".$row['User_ID']."</td>";
                              echo '<td> <a href="userprofile.php?id='.$row['User_ID'].'" style="text-decoration:none; color:#333; font-weight:bold;">View Profile</a> </td>';
                              echo "</tr>";
                            }
                            ?>
                    </tbody>
                          </table>
                          
                          
            </div>
        </div>
    </div>
    
</body>