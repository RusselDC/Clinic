<?php

include("db_conn.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../photos/clinic1.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: linear-gradient(#A6C0EE, #FAC5EC);
      }
      .container {
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .card {
        width: 800px;
      }
      #divSubmit {
        display: flex;
        justify-content: center;
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
      #back {
        background-color: white;
        width: max-content;
        color: black;
        border: solid #ced4da 1px;
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
        margin-bottom: 10px;
      }
      #back:hover {
        background-color: gray;
        color: white;
      }
      #title {
        font-size: 25px;
      }

      @media only screen and (max-width: 480px) {
        .card {
          width: 400px;
        }
      }
    </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-header text-center">
        <button id="back" onclick="history.back()" class="d-flex align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5ZM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5Z"/>
          </svg>
          <div>Go back</div>
        </button>
        <b id="title">SEND RESET PASSWORD LINK</b>
      </div>
      <div class="card-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Insert Code Here</label>
            <input type="text" name="code" class="form-control" id="email" aria-describedby="emailHelp" required>
            <label for="exampleInputEmail1">Insert Password Here</label>
            <input type="password" name="password1" class="form-control" id="email" aria-describedby="emailHelp" minlength="8" maxlength="20" required>
            <label for="exampleInputEmail1">Confirm Password</label>
            <input type="password" name="password2" class="form-control" id="email" aria-describedby="emailHelp" minlength="8" maxlength="20" required>
          </div>
          
          <div id="divSubmit">
            <button type="submit" id="btnSubmit" name="change" class="btn btn-primary"> Send Code</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php

    if(isset($_POST['change'])){
        $code = $_POST['code'];
        $pw1 = $_POST['password1'];
        $pw2 = $_POST['password2'];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE Code ='$code' LIMIT 1");
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count==1){
            if ($pw1 != $pw2) {
                echo '<script type="text/javascript">';
                echo 'alert("Password do not match");';
                echo 'window.location.href = "newpassword.php"';
                echo '</script>';
            }else{
                $user_check_query = "SELECT Pass From user WHERE Pass ='$pw1' LIMIT 1";
                $result = mysqli_query($conn, $user_check_query);
                $user = mysqli_fetch_assoc($result);
                if($user['Pass'] === $pw1){
                    echo '<script type="text/javascript">';
                    echo 'alert("Password already used");';
                    echo 'window.location.href = "newpassword.php"';
                    echo '</script>';
                }else{
                    $sql = "UPDATE user SET Pass = '".md5($pw1)."' WHERE Code = '$code'";
                    mysqli_query($conn, $sql);
                    header("Location: client_login.php");
                }
            }
        }
        else{
            echo '<script type="text/javascript">';
            echo 'alert("Code not found!");';
            echo 'window.location.href = "newpassword.php"';
            echo '</script>';
        }

    }


  ?>
</body>
</html>