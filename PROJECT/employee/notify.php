<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>

<?php 
include('db_conn.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $Post=mysqli_query($conn, "SELECT * FROM appointment WHERE Appointment_ID ='$id'");
    $row = mysqli_fetch_array($Post,MYSQLI_ASSOC);
    $Email = $row['Email'];
    $apt_id = $row['Appointment_ID'];
    $apt_date = $row['Appointment_Date'];
    $apt_time = $row['Time'];
    $apt = $row['Pname'];
    $Service = $row['Service'];
    $docname = $row['Doctor'];



    
    require 'phpmailer/vendor/autoload.php';
    $mail = new PHPMailer(true);
    header("employee_dashboard.php");

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
        $mail->Subject = 'Appointmnet Notification';
        $mail->Body    = '<h1>This message was sent to inform you that you have an appointment starting an hour from now</h1><br>'.
                          '<p><b> Appointment ID: '.$apt_id.'</b></p><br>'.
                          '<p><b> Patient Name: '.$apt.'</b></p><br>'.
                          '<p><b> Service Chosen:'.$Service.'</b></p><br>'.
                          '<p><b> Appointment Date :'.$apt_date.'</b></p><br>'.
                          '<p><b> Appointment Time :'.$apt_time.'</b></p><br>'.
                          '<p><b> Doctor :'.$docname.'</p><br>';
                  
        $mail->AltBody = 'Appointmnet Notification';
  
      $mail->send();
      echo '<script type="text/javascript">';
      echo 'alert("Email has been sent");';
      echo 'window.location.href = "employee_dashboard.php"';
      echo '</script>';
      
      }  catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
       }else{
      echo '<script type="text/javascript">';
      echo 'alert("Email not found");';
      echo 'window.location.href = "employee_dashboard.php"';
      echo '</script>';
    }
  
?>