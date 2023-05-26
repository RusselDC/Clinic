
<?php 
include('db_conn.php');
include('session.php');
if(!isset($_SESSION['user'])&&!isset($_SESSION['pass'])){
    header("refresh: 0; url=client_login.php");
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $Post=mysqli_query($conn, "UPDATE appointment SET Status='Cancelled' WHERE Appointment_ID ='$id'");
    header("location:viewPosted.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../photos/clinic1.png">
    <title>View Appointments</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');
        * {
            font-family: 'Cabin', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        html {
            min-height: 100vh;
        }
        body {
            background-image: linear-gradient(#A6C0EE, #FAC5EC);
            min-width: max-content;
        }
        #main {
            height: 100%;
            /* width: 100vw; */
            display: flex;
            justify-content: center;
            overflow: auto;
        }
        .schedTable {
            padding: 30px;
            background: white;
            border-radius: 10px;
            margin: 30px;
            height: max-content;
            min-height: 300px;
            min-width: 80vw;
        }
        #title {
            background: white;
            padding: 15px;

            border: 10px solid;
            border-image-slice: 1;
            border-width: 5px;
            max-height: max-content; 
            min-height: 300px;
            border-image-source: linear-gradient(to top, #FAC5EC, #A6C0EE);
        }
        #headerMain {
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
        @media screen and (max-width: 600px) {
            .schedTable {
                padding: 20px;
            }
            #title {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div id="header">
        <div id="headerMain">
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
                <a href="viewAppointments.php">New</a>
            </button>
            <button class="nav">
                <a href="viewPosted.php" >Posted</a>
            </button>
            <button class="nav">
                <a href="viewCancelled.php">Cancelled</a>
            </button>
            <button class="nav">
                <a href="viewCompleted.php" id="cp">Completed</a>
            </button>
        </div>
    </div>
    <div id="main">
        <div class="schedTable" id="">
            <div id="title">
                <div class="d-flex align-items-center justify-content-center" id="box">
                    <h1 class="h1">APPOINTMENTS&nbsp;</h1>
                    <h3 class="h3">(Closed)</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Service</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql2 = "SELECT * FROM appointment WHERE Status = 'Closed' AND User_ID = '$ID'";
                        $res2 = mysqli_query($conn, $sql2);?>

                    <?php while ($row1 = mysqli_fetch_array($res2)):;?>
                    <tr>
                        <td>
                            <?php echo $row1['Appointment_Date'];?>
                        </td>
                        <td>
                            <?php echo $row1['Time'];?>
                        </td>
                        <td>
                            <?php echo $row1['Service'];?>
                        </td>
                        <td>
                            <?php echo $row1['Doctor'];?>
                        </td>
                        <td>
                             <?php echo "NO OPERATION";?>
                        </td>
                    </tr>
                    <?php endwhile;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>