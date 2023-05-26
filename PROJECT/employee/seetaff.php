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
$employee = "SELECT * FROM employee";
$result = mysqli_query($conn,$employee);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/seetaff.css">
    <!-- CSS only --> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" /> 
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="../javascript/see.js" defer></script>
    <link rel="icon" href="../photos/clinic1.png">
    <title>Staffs</title>
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
                          <a href="#" style="color: white;">SEE STAFF</a>
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
            <H1>LIST OF STAFF</H1>
            <div id="box2" style="border-color:white;height:auto;border-radius:0px;">
                  <table id="example" class="display table table-bordered data-table" style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Age</th>
                        <th scope="col">Birthdate</th>
                        <th scope="col">Position</th>
                        <th scope="col">Password</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while($row = $result->fetch_assoc()){
                        if($Pos=='Superadmin'){
                        $name = $row['Lname'].",".$row['Fname']." ".$row['Mname'];
                            if($row['Position']=='Superadmin'){
                            echo "<tr>";
                            echo "<td>".$row['Emp_ID']."</td>";
                            echo "<td>".$name."</td>";
                            echo "<td>".$row['Email']."</td>";
                            echo "<td>".$row['Gender']."</td>";
                            echo "<td>".$row['Age']."</td>";
                            echo "<td>".$row['Birthdate']."</td>";
                            echo "<td>".$row['Position']."</td>";
                            echo "<td>".$row['Pass']."</td>";
                            echo "<td>".$row['Status']."</td>";
                            echo "<td> NO ACTION </td>";
                            echo "</tr>";
                            }
                            else{
                            if($row['Status']=='Inactive'){
                            echo "<tr>";
                            echo "<td>".$row['Emp_ID']."</td>";
                            echo "<td>".$name."</td>";
                            echo "<td>".$row['Email']."</td>";
                            echo "<td>".$row['Gender']."</td>";
                            echo "<td>".$row['Age']."</td>";
                            echo "<td>".$row['Birthdate']."</td>";
                            echo "<td>".$row['Position']."</td>";
                            echo "<td>".$row['Pass']."</td>";
                            echo "<td>".$row['Status']."</td>";
                            echo "<td><a href='activate.php?id=".$row['Emp_ID']."' style='text-decoration:none; font-weight:bold;'>Activate</a></td>";
                            echo "</tr>";
                            }
                            echo "<tr>";
                            echo "<td>".$row['Emp_ID']."</td>";
                            echo "<td>".$name."</td>";
                            echo "<td>".$row['Email']."</td>";
                            echo "<td>".$row['Gender']."</td>";
                            echo "<td>".$row['Age']."</td>";
                            echo "<td>".$row['Birthdate']."</td>";
                            echo "<td>".$row['Position']."</td>";
                            echo "<td>".$row['Pass']."</td>";
                            echo "<td>".$row['Status']."</td>";
                            echo "<td><a href='remove.php?id=".$row['Emp_ID']."' style='text-decoration:none; font-weight:bold;'>Remove</a></td>";
                            echo "</tr>";
                            }
                            
                        }
                        else{
                            $name = $row['Lname'].",".$row['Fname']." ".$row['Mname'];
                            if($row['Position']=='Superadmin'){
                                echo "<tr>";
                                echo "<td>".$row['Emp_ID']."</td>";
                                echo "<td>".$name."</td>";
                                echo "<td>".$row['Email']."</td>";
                                echo "<td>".$row['Gender']."</td>";
                                echo "<td>".$row['Age']."</td>";
                                echo "<td>".$row['Birthdate']."</td>";
                                echo "<td>".$row['Position']."</td>";
                                echo "<td> *****</td>";
                                echo "<td>".$row['Status']."</td>";
                                echo "<td> NO ACTION </td>";
                                echo "</tr>";
                                }
                                else{
                                echo "<tr>";
                                echo "<td>".$row['Emp_ID']."</td>";
                                echo "<td>".$name."</td>";
                                echo "<td>".$row['Email']."</td>";
                                echo "<td>".$row['Gender']."</td>";
                                echo "<td>".$row['Age']."</td>";
                                echo "<td>".$row['Birthdate']."</td>";
                                echo "<td>".$row['Position']."</td>";
                                echo "<td> ***** </td>";
                                echo "<td>".$row['Status']."</td>";
                                echo "<td> NO ACTION </td>";
                                echo "</tr>";
                                }
                        }
                        

                      }
                            
                        ?>
                    </tbody>
                          </table>
            </div>
        </div>
    </div>
    
</body>
</html>