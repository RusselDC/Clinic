<?php
include("db_conn.php");
?>

<?php
if (isset($_POST['Register'])) {
    $Email = $_POST['Email'];
    $Fname = $_POST['Fname'];
    $Mname = $_POST['Mname'];
    $Lname = $_POST['Lname'];
    $Sex = $_POST['Sex'];
    $DateofBirth = $_POST['Birthdate'];
    $date = date("Y/m/d");
    $Age = date_diff(date_create($DateofBirth),date_create($date));
    $age = $Age->format('%y');
    $password_1 = $_POST['Password1'];
    $password_2 = $_POST['Password2'];
    $maritalStatus = $_POST['maritalStatus'];
    $countries = $_POST['countries'];
    $bloodtype = $_POST['bloodtype'];

    $user_check_query = "SELECT * FROM user WHERE Email='$Email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($password_1 != $password_2) {
        echo '<script type="text/javascript">';
        echo 'alert("Password do not match");';
        echo 'window.location.href = "register.php"';
        echo '</script>';
    }
    else if($user['Email'] === $Email){
        echo '<script type="text/javascript">';
        echo 'alert("Email already exists");';
        echo 'window.location.href = "register.php"';
        echo '</script>';
    }else if($user['Password'] === $password_1){
        echo '<script type="text/javascript">';
        echo 'alert("Password already exists");';
        echo 'window.location.href = "register.php"';
        echo '</script>';
    }
    else{
  
        $query = "INSERT INTO `user`(`User_ID`, `Email`, `Fname`, `Lname`, `Mname`, `Age`, `Sex`, `Birthdate`,`Pass`, `Nationality`, `Status`, `Blood_Type`) VALUES (NULL,'$Email','$Fname','$Lname','$Mname','$age','$Sex','$DateofBirth','".md5($password_1)."', '$countries', '$maritalStatus', '$bloodtype')";
        mysqli_query($conn, $query);
        echo '<script type="text/javascript">';
        echo 'alert("Registered Successfully");';
        echo 'window.location.href = "../index.html"';
        echo '</script>';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../photos/clinic1.png">
    
    <link rel="stylesheet" href="//unpkg.com/bootstrap@3.3.7/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="//unpkg.com/bootstrap-select@1.12.4/dist/css/bootstrap-select.min.css" type="text/css" />
    <link rel="stylesheet" href="//unpkg.com/bootstrap-select-country@4.0.0/dist/css/bootstrap-select-country.min.css" type="text/css" />
    
 
    <script src="//unpkg.com/jquery@3.4.1/dist/jquery.min.js"></script> 
    <script src="//unpkg.com/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script> 
    <script src="//unpkg.com/bootstrap-select@1.12.4/dist/js/bootstrap-select.min.js"></script> 
    <script src="//unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>

    
    <link rel="stylesheet" href="../css/register.css" >

    <title>Registration</title>
    <script>
        function myFunction() {
        var x = document.getElementById("inputPassword6");
        var y = document.getElementById("inputPassword7");
        if (x.type === "password" || y.type === "password") {
        x.type = "text";
        y.type = "text";
        }
        else {
        x.type = "password";
        y.type = "password";
        }
}
    </script>

    
</head>
<body>
    <header>
        <div id="logoName">
            <div class="logoName" id="logo">
                <img id="logo" src="../photos/clinic1.png" alt="logo">
            </div>
            <div class="logoName" id="clinicName">
                <a href="../index.html">CLINICA</a> 
            </div>
        </div>
        <div id="headerLinks">
            <div class="headerLinks" id="">
                <a role="link" aria-disabled="true">KNOW US</a>
            </div>
            <div class="headerLinks" id="">
                <a role="link" aria-disabled="true">HOME</a>
            </div>
            <div class="headerLinks" id="">
                <a role="link" aria-disabled="true">CONTACTS</a>
            </div>
        </div>
        <div id="headerButtons">
            <div class="headerButtons" id="">
                <button onclick=" window.location ='client_login.php'">
                    LOG IN
                </button>
        </div>
        </div>
    </header>
    <main>
    <div id="form-container">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <h2 style="text-align:center">REGISTER</h2>
                <div class="form-group">
                    <label for="usr">Email:</label>
                    <input type="email" name="Email" class="form-control" id="usr" placeholder="Insert your email here" required >
                </div>
                <div class="form-group">
                    <label for="inputPassword6" >Password</label>
                    <input type="password" id="inputPassword6" placeholder="New password" class="form-control" name="Password1" aria-describedby="passwordHelpInline" minlength="8" maxlength="20" required>
                    <label for="inputPassword7"  class="mt">Repeat Password</label>
                    <input type="password" id="inputPassword7" placeholder="Confirm password" class="form-control" name="Password2" aria-describedby="passwordHelpInline" minlength="8" maxlength="20" required>
                    <small id="passwordHelpInline" class="text-muted">
                      Must be 8-20 characters long.
                      <br>
                      <div>
                        <input id="cb" type="checkbox" onclick="myFunction()">
                        <label for="cb">&nbsp;Show password </label>
                      </div>
                    </small>
                    
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-5">
                        <label for="fname">First name</label>
                        <input type="text" name="Fname" class="form-control" id="fname" placeholder="First name"style="text-transform:uppercase" required>
                    </div>
                    <div class="col-sm-5">
                        <label for="lname">Lastname</label>
                        <input type="text" name="Lname" class="form-control" id="lname" placeholder="Last name"style="text-transform:uppercase" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="mi">M.I</label>
                        <input type="text" name="Mname" class="form-control" id="mi" placeholder="M.I"style="text-transform:uppercase" maxlength="2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 " id="mt">
                        <label for="choices">Sex</label>
                        <select name="Sex" id="choices" class="form-control" >
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </select>
                    </div>
                    <div class="col-sm-6 " id="mt">
                        <label for="usr">Date of birth</label>
                        <input type="date" id="usr" class="form-control" name="Birthdate" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4" id="mt">
                        <label for="maritalStatus">Marital Status</label>
                        <select name="maritalStatus" id="maritalStatus" class="form-control">
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Separated">Separated</option>
                        </select>
                    </div>
                    <div class="col-sm-4" id="mt">
                        <label for="countries">Nationality</label> <br>
                        <select name="countries" id="countries" class="selectpicker countrypicker form-control" data-flag="true"  data-default="PH" ></select>
                    </div>
                    <div class="col-sm-4" id="mt">
                        <label for="bloodtype">Blood Type</label>
                        <select name="bloodtype" id="bloodtype" class="form-control" required>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                </div>
                <div id="button" >
                    <button type="submit" id="register-btn" name="Register" class="btn btn-outline-primary ">Register</button>
                </div>
              </form>
        </div>
    </main>
    <footer>

    </footer>
    <script>
        $('.countrypicker').countrypicker();
    </script> 
    
</body>
</html>