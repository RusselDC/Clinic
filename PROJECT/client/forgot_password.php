<?php 
include('db_conn.php');
?>
<?php

function generateRandomString($length = 5) {
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
}
return $randomString;
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['password-reset-token'])){
  

  $Email = $_POST['email'];


  $user_check_query = "SELECT * FROM user WHERE Email='$Email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if($user['Email'] === $Email){
      $code = generateRandomString();
      $sql = "UPDATE user SET code = '$code' WHERE Email='$Email'";
      mysqli_query($conn, $sql);

      require 'phpmailer/vendor/autoload.php';

      $mail = new PHPMailer(true);

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


      $mail->setFrom('');
      $mail->addAddress($Email);     //Add a recipient


      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Password Code';
      $mail->Body    = 'Your verification code is: </b>'.'<br>'.
                    '<h1>'. $code .'</h1>';
                
      $mail->AltBody = 'Verification Code';

    $mail->send();
    echo 'Message has been sent';
    header("Location: newpassword.php");
    
    }  catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

     }else{
    // echo '<script type="text/javascript">';
    // echo 'alert("Email not found");';
    // echo 'window.location.href = "forgot_password.php"';
    // echo '</script>';

    header("Location: forgot_password.php?error=Email not found");
    exit();
  }

  

  
}
?>


<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="icon" href="../photos/clinic1.png">
   
      <title>Send Reset Password Code</title>
       <!-- CSS -->
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

       <style>
        body {
          height: 100vh;
          background-image: linear-gradient(#A6C0EE, #FAC5EC);
        }
        .container {
          height: 100%;
          display: flex;
          justify-content: center;
          align-items: center;
        }
        .card {
          min-width: 400px;
        }
        #btnSubmit {
            background-color: white;
            width: max-content;
            color: black;
            border: solid #ced4da 1px;
            border-radius: 5px;
            padding: 5px 20px;
        }
        #btnSubmit:hover {
            background-color: gray;
            color: white;
        }
        #divSubmit {
            display: flex;
            justify-content: end;
        }
        .error {
            background: #A61D4A;
            color: white;
            text-align: center;
            padding: 5px;
            font-size: 15px;
            border-radius: 5px;
            font-style: italic;
        }
        #back {
            background-color: white;
            width: max-content;
            color: black;
            border: solid #ced4da 1px;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }
        #back:hover {
            background-color: gray;
            color: white;
        }
        .buttonForms {
          display: flex;
          justify-content: space-between;
        }
       </style>
   </head>
   <body>
      <div class="container">
          <div class="card">
            <div class="card-header text-center">
              <p class="m-0">Send Reset Password Link</p>
            </div>
            <div class="card-body">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                  <?php if (isset($_GET['error'])) { ?>
                      <p class="error"><?php echo $_GET['error']; ?></p>
                  <?php } ?>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="buttonForms">
                  <div>
                    <a id="back" href="client_login.php" class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5ZM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5Z"/>
                    </svg>
                    <div>Back</div>
                    </a>
                  </div>
                  <div id="divSubmit">
                    <button id="btnSubmit" type="submit" name="password-reset-token" class="btn btn-primary"> Send Code</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
   </body>
   
</html>