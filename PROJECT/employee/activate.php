<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>

<?php 
$date = date('Y/m/d');
include('db_conn.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $Post=mysqli_query($conn, "SELECT Email FROM employee WHERE Emp_ID ='$id'");
    $row = mysqli_fetch_array($Post,MYSQLI_ASSOC);
    $Email = $row['Email'];


    
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
        $mail->Subject = 'Activation Letter';
        $mail->Body    = '<h1>'.$date.'</h1>'.
                        '<h2>We are very sorry to tell you that your account had been terminated</h2>'.'<br>'.
                        '<p>'.'We already activated your account, We are very sorry for the mistake'.'</p>'.'<br>'.
                        '<h1>'.'Please, do not hold this against us'.'</h1>';
                  
        $mail->AltBody = 'Appointmnet Notification';
  
      $mail->send();
        $delete = "UPDATE employee SET Status = 'Active' where Emp_ID ='$id'";
        $result = mysqli_query($conn,$delete);
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