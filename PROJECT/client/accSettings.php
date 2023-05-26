<?php 
    include('session.php');
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

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');
        * {
            font-family: 'Cabin', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            height: 100vh;
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
        #upload {
            max-width: 350px;
            height: max-content;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
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
            <a href="accSettings.php" id="cp">Change Photo</a>
        </button>
        <button class="nav">
            <a href="editDetails.php">Change Password</a>
        </button>
    </div>
</header>
<body>
    <div id="body">
        <?php  if (isset($_GET['error'])):?>
            <p><?php echo $_GET['error'];?></p>
        <?php endif ?>

        <form id="upload" class="form-control p-3" action="uploadPic.php" method="post" enctype="multipart/form-data">

            <a id="back" href="user_dashboard.php" class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5ZM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5Z"/>
                </svg>
                <div>Back to Dashboard</div>
            </a>

            <hr>

            <label class="form-label" for="customFile">Please choose an image </label>
            
            <div class="d-flex">
                <input type="file" class="form-control" id="customFile" name="image"/>
                <input id="btnSubmit" type="submit" name="upload" class="form-control ms-2">
            </div>

            <small>
                Allowed file types: (.jpg, .jpeg, .png)
            </small>

        </form>
    </div>
</body>
</html>