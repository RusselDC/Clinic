
<?php
session_start();
include("db_conn.php");
if(isset($_SESSION['ID'])&&isset($_SESSION['Pass'])){
    header("refresh: 0; url=employee_dashboard.php");
}
if(isset($_POST['login'])){

    $myempid = $_POST['ID'];
    $mypassword =  $_POST['Pass'];

    $select = mysqli_query($conn, "SELECT * FROM employee WHERE Emp_ID = '$myempid' AND Pass = '".md5($mypassword)."' LIMIT 1");
    $row = mysqli_num_rows($select);

    if($row==1){
        $_SESSION['login_user'] = $myempid;
        $_SESSION['ID'] = $myempid;
        $_SESSION['Pass'] = $mypassword;

        echo '<script type="text/javascript">';
        echo 'alert("Logged in sucessfuly");';
        echo 'window.location.href = "employee_dashboard.php"';
        echo '</script>';
    }
    else{
        echo '<script type="text/javascript">';
        echo 'alert("Invalid Username and Password");';
        echo 'window.location.href = "employee_login.php"';
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
    <title>Employee Log in</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');

        /* HEADER */
        * {
            font-family: 'Cabin', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        header {
            display: grid;
            grid-template-columns: 2fr 6fr 1fr;
            grid-template-areas: 'logoName headerLinks headerButtons';
            align-items: center;
            width: 100%;

            background-color: #666;
            padding: 10px;
            border: solid black;
            border-width: 1px 0;
            position: sticky;
            top: 0;
        }
        #logo {
            height: 65px;
        }
        #clinicName {
            font-size: 30px;
            font-weight: bold;
            color: white;
        }
        #logoName {
            display: flex;
            align-items: center;
            align-self: center;
        }
        .logoName {
            margin-right: 10px;
        }
        #headerLinks, #headerLinks a {
            display: flex;
            justify-content: flex-start;
            margin-left: 10px;
        }
        #headerLinks a {
            margin-right: 30px;

            font-size: 13px;
            text-decoration: none;
            color: white;
        }
        #headerButtons {
            display: flex;
            justify-content: flex-end;
        }
        .headerButtons button {
            background-color: white;
            border-radius: 5px;
            width: 75px;
            border: none;

            padding: 5px 10px;
            margin-left: 10px;

            transition: all 0.3s ease 0s;
        }
        .headerButtons button:hover {
            background-color: black;
            color: white;
        }

        @media screen and (max-width: 684px) {
            #headerLinks, #headerLinks a {
                display: block;
                margin: 5px 0px 5px 10px;
            }
            #headerButtons {
                display: block;
            }
            .headerButtons button {
                margin: 2.5px 15px;
            }
        }
        @media screen and (max-width: 414px) {
            header {
                display: block;
            }
            #logoName {
                display: flex;
                justify-content: center;
            }
            #headerLinks {
                display: flex;
                justify-content: space-around;
            }
            #headerButtons {
                display: flex;
                justify-content: center;
            }
            .headerButtons button {
                margin: 0 5px;
            }
        }

        /* MAIN */
        main {
            display: grid;
            grid-template-columns: 3fr 2fr;
            grid-template-areas: 'sidebar login';
            align-items: center;
            /* background-color: #d3d3d3; */
            
            overflow: hidden;
            width: 100%;
            min-height: 84vh;
        }
        #sidebar {
            background-image: url("https://img.freepik.com/free-vector/hand-painted-watercolor-pastel-sky-background_23-2148902771.jpg?w=2000");
            background-repeat: no-repeat;
            background-size: cover;
            /* background-color: #d3d3d3; */
            padding: 50px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        #motto {
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .sidebar button {
            font-size: 30px;
            background-color: white;
            border-radius: 10px;
            width: 150px;
            border: none;

            padding: 5px 10px;

            transition: all 0.3s ease 0s;
            }
        .sidebar button:hover {
            background-color: black;
            color: white;
        }
        #login {
            background-color: white;
            padding: 30px;

            display: flex;
            justify-content: center;
        }
        #login form {
            background-color: #d3d3d3;
            padding: 50px;
            border-radius: 50px;
            min-width: 371px;
        }
        hr {
            margin: 30px 0;
        }
        #loginHeading {
            margin-bottom: 30px;
            font-size: 25px;
            font-weight: bold;
            text-align: center;
        }
        .login input {
            margin-bottom: 10px;
            width: 100%;
            height: 30px;
            border: none;
            padding: 0 5px;
        }
        #cbDiv {
            display: flex;
            
        }
        #flexSign {
            text-align: right;
        }
        #logInBtn {
            font-size: 15px;
            background-color: white;
            border-radius: 5px;
            width: 85px;
            border: none;

            padding: 5px 10px;
            margin-left: 10px;

            transition: all 0.3s ease 0s;
        }
        #logInBtn:hover {
            background-color: black;
            color: white;
        }
        @media screen and (max-width: 919px) {
            #flexSign {
                display: block;
            }
            #login {
                display: flex;
                justify-content: center;
            }
            #loginDiv {
                display: flex;
                margin-top: 10px;
                justify-content: center;
            }
            #login form {
                background-color: #d3d3d3;
                padding: 50px;
                border-radius: 50px;
                min-width: 300px;
            }
            #loginHeading {
                margin-bottom: 15px;
            }
            hr {
                margin: 15px 0;
            }
        }
        @media screen and (max-width: 701px) {
            main {
                display: block;
            }
            #sidebar {
                border-bottom: black solid 1px;
            }
        }
        footer {
            background-color: #555;
            border-top: black solid 1px;
            width: 100%;
            height: 68px;
        }

        .error {
            background: #ffb3b2;
            color: red;
            width: 100%;
            border: none;
            padding: 7px 5px;
            border-radius: 10px;
            text-align: center;
            font-style: italic;
            font-size: 15px;
        }
    </style>

</head>
<body>
    <header>
        <div id="logoName">
            <div class="logoName" id="logo">
                <img id="logo" src="../photos/clinic1.png" alt="logo">
            </div>
            <div class="logoName" id="clinicName">
                <a href="../index.html" style="text-decoration:none; color:white;">CLINICA</a> 
            </div>
        </div>
        <div id="headerLinks">
            <div class="headerLinks" id="">
            <a href="link" aria-disabled="true" style="color:#666">KNOW US</a>
            </div>
            <div class="headerLinks" id="">
            <a href="link" aria-disabled="true" style="color:#666">HOME</a>
            </div>
            <div class="headerLinks" id="">
            <a href="link" aria-disabled="true" style="color:#666">CONTACT</a>
            </div>
        </div>
        <div id="headerButtons">
            <div class="headerButtons">
                <button onclick="window.location = '../client/client_login.php'">
                    CLIENT
                </button>
            </div>
        </div>
    </header>
    <main>
        <div id="sidebar">
            <div class="sidebar" id="motto">
                Compassion Lives here. Care That last a life Time
            </div>
            <div class="sidebar" id="joinUs">
            </div>
        </div>
        <div id="login">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="login" id="loginHeading"> Employee Log in</div>
                <div class="login" id="emailTxt">Employee ID</div>
                <div class="login" id="emailInput">
                    <input type="text" name="ID" placeholder="Enter Employee ID" required>
                </div>
                <div class="login" id="pword">Password</div>
                <div class="login" id="pwordInput">
                    <input type="password" name="Pass" placeholder="Enter Password" required>
                </div>
                <div id="flexSign">
                    <div id="loginDiv">
                        <button type="submit" name="login" id="logInBtn">LOG IN</button>
                    </div>
                </div>
                <hr color="black">
            </form>
        </div>
    </main>
    <footer></footer>
</body>
</html>