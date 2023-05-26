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
$query5 = "SELECT * FROM appointment WHERE Status = 'New' OR Status = 'Posted' ";
$result5 = mysqli_query($conn, $query5);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/vendor/autoload.php';
$mail = new PHPMailer(true);
if(isset($_POST['Send'])){
    $email = $_POST['Email'];
    $subject = $_POST['Subject'];
    $content = $_POST['Content'];
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username =                   
        $mail->Password =                         
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                    
  
  
        $mail->setFrom('clinica.noreply22@gmail.com');
        $mail->addAddress($email); 
  
  
        $mail->isHTML(true);                                 
        $mail->Subject = $subject;
        $mail->Body    = $content;
                          
        $mail->AltBody = $subject;
  
      $mail->send();
      echo '<script type="text/javascript">';
      echo 'alert("Email has been sent");';
      echo 'window.location.href = "mail.php"';
      echo '</script>';
      
      }  catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=!, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/> 
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/operation.css">
    <link rel="icon" href="../photos/clinic1.png">
    <script src="../javascript/operation.js" defer></script>
    <script>
            $(document).ready(function () {
            $('#example').DataTable({
            pagingType: 'full_numbers',
            });
            });
    </script>
    <title>Mail</title>
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
                <h1>Send an email</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="Email">
                </div>
                <div class="form-group">
                <label for="inputAddress">Subject</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Enter Subject" name="Subject">
                </div>
                <div class="form-group">
                <label for="exampleFormControlTextarea1">Mail Content</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="Content"></textarea>
                </div>
                <br>
                <div style="height:auto ;width: 100%; text-align: right;">
                        <button type="submit" class="btn btn-primary" name="Send">Send Mail</button>
                </div>

                </form>
            </div>
        </div>
        <div id="add">
            <div id="form-container">
                <h1>New/Posted Appointments</h1>
                <table id="example" class="display table table-bordered data-table" style="width:100%;">
                    <thead>
                      <tr>
                        <th scope="col">Appointment ID</th>

                        <th scope="col">Email</th>
                        <th scope="col">Service</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                            while($row = $result5->fetch_assoc()) {
                              if($row['Status']=='New'){
                                echo "<tr>";
                                echo "<td>".$row['Appointment_ID']."</td>";
                                echo "<td>".$row['Email']."</td>";
                                echo "<td>".$row['Service']."</td>";
                                echo "<td>".$row['Appointment_Date']."</td>";
                                echo "<td>".$row['Time']."</td>";
                                echo "<td>".$row['Doctor']."</td>";
                                echo "<td>".$row['Status']."</td>";
                                echo "</tr>";
                              }
                              if($row['Status']=='Posted'){
                                echo "<tr>";
                                echo "<td>".$row['Appointment_ID']."</td>";
                                echo "<td>".$row['Email']."</td>";
                                echo "<td>".$row['Service']."</td>";
                                echo "<td>".$row['Appointment_Date']."</td>";
                                echo "<td>".$row['Time']."</td>";
                                echo "<td>".$row['Doctor']."</td>";
                                echo "<td>".$row['Status']."</td>";
                                echo "</tr>";
                              }
                              if($row['Status'] == 'Closed'){
                                echo "<tr>";
                                echo "<td>".$row['Appointment_ID']."</td>";
                                echo "<td>".$row['Email']."</td>";
                                echo "<td>".$row['Service']."</td>";
                                echo "<td>".$row['Appointment_Date']."</td>";
                                echo "<td>".$row['Time']."</td>";
                                echo "<td>".$row['Doctor']."</td>";
                                echo "<td>".$row['Status']."</td>";
                                echo "</tr>";
                              }
                              if($row['Status'] == 'Cancelled'){
                                echo "<tr>";
                                echo "<td>".$row['Appointment_ID']."</td>";
                                echo "<td>".$row['Email']."</td>";
                                echo "<td>".$row['Service']."</td>";
                                echo "<td>".$row['Appointment_Date']."</td>";
                                echo "<td>".$row['Time']."</td>";
                                echo "<td>".$row['Doctor']."</td>";
                                echo "<td>".$row['Status']."</td>";
                                echo "</tr>";
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