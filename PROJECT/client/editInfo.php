<?php 
include("session.php");
if(!isset($_SESSION['user'])&&!isset($_SESSION['pass'])){
    header("refresh: 0; url=client_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../photos/clinic1.png">
    <title>Account Settings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="//unpkg.com/bootstrap@3.3.7/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="//unpkg.com/bootstrap-select@1.12.4/dist/css/bootstrap-select.min.css" type="text/css" />
    <link rel="stylesheet" href="//unpkg.com/bootstrap-select-country@4.0.0/dist/css/bootstrap-select-country.min.css" type="text/css" />
    
 
    <script src="//unpkg.com/jquery@3.4.1/dist/jquery.min.js"></script> 
    <script src="//unpkg.com/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script> 
    <script src="//unpkg.com/bootstrap-select@1.12.4/dist/js/bootstrap-select.min.js"></script> 
    <script src="//unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');
        * {
            font-family: 'Cabin', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            height: 100%;
            background-image: linear-gradient(#A6C0EE, #FAC5EC);
            display: flex;
            flex-direction: column;
        }
        #body {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #update {
            max-width: 400px;
            height: max-content;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            margin: 30px;
        }
        #btnSubmit {
            background-color: white;
            width: max-content;
            color: black;
            border: solid #ced4da 1px;
        }
        #btnSubmit:hover {
            background-image: linear-gradient(#A6C0EE, #FAC5EC);
        }

        /* header */
        #header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #as {
            font-size: 25px;
            padding: 20px;
        }
        #links {
            display: flex;
            align-items: center;
            border-top: solid 2px white;
        }
        .nav {
            border: none;
            background: none;
            margin: 0 0 0 15px;
        }
        .nav a {
            text-decoration: none;
            color: black;
            padding: 10px 20px;
        }
        #cp {
            background: white;
            border-radius: 0 0 10px 10px;
            box-shadow: 0px 4px 8px 0px rgba(0,0,0,0.2);
        }
        .dropbtn {
            background-color: white;
            color: black;
            padding: 10px;
            font-size: 13px;
            border: none;
            border-radius: 5px;
            margin-right: 50px;
            min-width: 135px;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 10px;
            width: max-content;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 13px;
        }
        .dropdown-content a:hover {
            background-color: gray;
            color: white;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown:hover .dropbtn {
            border: solid black 1px;
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
            background-image: linear-gradient(#A6C0EE, #FAC5EC);
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        #button {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        #register-btn {
            background-color: white;
            width: max-content;
            color: black;
            border: solid #ced4da 1px;
        }
        #register-btn:hover {
            background-image: linear-gradient(#A6C0EE, #FAC5EC);
        }
        .success {
            background: #90D8DB;
            margin-top: 20px;
            text-align: center;
            padding: 5px;
            font-size: 15px;
            border-radius: 5px;
            font-style: italic;
        }
        .error {
            background: #A61D4A;
            margin-top: 20px;
            color: white;
            text-align: center;
            padding: 5px;
            font-size: 15px;
            border-radius: 5px;
            font-style: italic;
        }
    </style>
</head>
<header>
    <div id="header">
        <div id="as">Account Settings</div>
        <div class="dropdown">
            <button class="dropbtn"><?php echo ucfirst($emp_Fname)?>&nbsp;<?php echo ucfirst($emp_Lname) ?></button>
            <div class="dropdown-content">
                <a href="user_dashboard.php">Back to Dashboard</a>
                <a href="logout.php">Log out</a>
            </div>
        </div>
    </div>
    <div id="links">
        <button class="nav">
            <a href="editInfo.php" id="cp">Edit Info</a>
        </button>
    </div>
</header>
<body>
    <div id="body">

        <form id="update" action="updateInfo.php" class="form-control p-5" method="post">

            <a id="back" href="user_dashboard.php" class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5ZM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5Z"/>
                </svg>
                <div>Back to Dashboard</div>
            </a>
            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <hr>

            <div class="d-flex">
                <div class="w-100">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="lname" class="form-control" value="<?php echo strtoupper($emp_Lname) ?>">

                    <label for="mname">Middle Name</label>
                    <input type="text" id="mname" name="mname" class="form-control" value="<?php echo strtoupper($emp_Mname) ?>">

                    <label for="bday">Date of Birth</label>
                    <input value='<?php echo($bday) ?>' type='date' id="bday" name="bday" class="form-control">
                    
                    <label for="address">Address</label>
                    <textarea name="address" id="address" cols="20" rows="8" class="form-control">
                    <?php echo strtoupper ($address) ?>
                    </textarea>

                    <label for="maritalStatus">Marital Status</label>
                    <?php
                    $sql2 = "SELECT Status FROM user WHERE User_ID='$ID'";
                    $result2 = mysqli_query($conn, $sql2);
                    ?>
                    <select name="maritalStatus" id="maritalStatus" class="form-control">
                        <?php
                            echo "<option selected readonly value='".$row['Status']."'>Current value: ".$row['Status']."</option>"
                        ?>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Separated">Separated</option>
                    </select>
                </div>
                <div class="ms-3 w-100">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" name="fname" class="form-control" value="<?php echo strtoupper($emp_Fname) ?>">

                    <label for="Email">Email</label>
                    <input type="email" value="<?php echo strtoupper($Email)?>"  class="form-control"readonly>

                    <label for="cnum">Contact Number</label>
                    <input type="number" id="cnum" name="cnum" class="form-control" value="<?php echo ($cnum) ?>" onKeyDown="if(this.value.length==11 && event.keyCode!=8) return false;">
                    
                    
                    <label for="age">Age <small>(in years)</small> </label>
                    <input type="number" id="age" class="form-control" value="<?php echo strtoupper($Age) ?>" readonly>

                    <label for="weight">Weight <small>(in kilograms)</small> </label>
                    <input type="number" id="weight" name="weight" class="form-control" value="<?php echo strtoupper($weight) ?>"onKeyDown="if(this.value.length==3 && event.keyCode!=8) return false;">

                    <label for="height">Height <small>(in centimeters)</small> </label>
                    <input type="number" id="height" name="height" class="form-control" value="<?php echo strtoupper($height) ?>"onKeyDown="if(this.value.length==3 && event.keyCode!=8) return false;">

                    <label for="countries">Nationality</label> <br>
                    <select name="countries" id="countries" class="selectpicker countrypicker form-control" data-flag="true"  data-default="<?php echo strtoupper($flag) ?>"></select>
                    
                    <label for="bloodtype">Blood Type</label>
                    <?php
                    $sql = "SELECT Blood_Type FROM user WHERE User_ID='$ID'";
                    $result = mysqli_query($conn, $sql);
                    ?>
                    <select name="bloodtype" id="bloodtype" class="form-control">
                        <?php
                            echo "<option selected readonly value='".$row['Blood_Type']."'>Current value: ".$row['Blood_Type']."</option>"
                        ?>
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
            <div id="button">
                <button type="submit" id="register-btn" name="register-btn" class="btn btn-outline-primary">Update Changes</button>
            </div>
        </form>
    </div>
    
    <script>
        $('.countrypicker').countrypicker();
    </script> 
</body>
</html>