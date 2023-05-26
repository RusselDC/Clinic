
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
    <title>CMS Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #d3d3d3;
            padding: 10px;
            border: solid black;
            border-width: 1px 0;
            position: sticky;
            top: 0;
        }
        #logo {
            height: 60px;
        }
        #picture {
            height: 100px;
            border: solid black 1px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        }
        #view {
            text-align: center;
            color: black;
        }
        #view:hover {
            border: solid black 1px;
        }
        #clinicName {
            font-size: 30px;
            font-weight: bold;
        }
        #logoName {
            display: flex;
            align-items: center;
            align-self: center;
        }
        .logoName {
            margin-right: 10px;
        }
        .dropbtn {
            background-color: white;
            color: black;
            padding: 10px;
            font-size: 13px;
            border: none;
            border-radius: 5px;
            margin-right: 50px;
            min-width: 80px;
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
            #header {
                display: block;
            }
            #nameLogout {
                margin-right: 0px;
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
        }

        body {
            height: 100vh;
            max-width: 100vw;
        }

        /* MAIN */
        main {
            overflow: hidden;
            min-width: 100%;
            min-height: 100vh;
            display: flex;
        }

        footer {
            background-color: #d3d3d3;
            border-top: black solid 1px;
            width: 100%;
            height: 40px;
        }

        .sidebar {
            background: #d3d3d3;
            padding: 30px;
            width: 25%;
        }
        .today {
            padding: 25px;
            background: white;
            border-radius: 10px;
            font-size: 15px;
            text-align: center;
            box-shadow: darkgray 0px 12px 25px 0px;
        }
        .patientData {
            display: grid;
            grid-template-columns: 1fr 1fr;

            text-align: left;
        }
        .TAright {
            text-align: right;
        }
        .pfp {
            height: 100px;
            border-radius: 50px;
            border: solid gray 2px;
        }
        .name {
            font-weight: bold; 
            text-transform: uppercase;
            font-size: 20px;
            margin: 10px 0px;
        }
        .buttons {
            margin: 10px 0px;
            display: flex;
            justify-content: space-around;
            background: #d3d3d3;
            padding: 20px;
            border-radius: 15px;
            background-image: linear-gradient(#A6C0EE, #FAC5EC);
            align-items: center;
        }
        #bola {
            font-size: 30px;
            font-style: oblique;
            margin-right: 10px;
        }
        .dashboard {
            width: 75%;
            justify-self: center;
            margin: 0 10px;
            height: 100%;
        }
        .greet {
            padding: 25px;
            background: #d3d3d3;
            background-image: linear-gradient(white, #d8d8d8);
            border: solid #666666;
            border-width: 0px 1px 1px 1px;

            border-radius: 0 0 20px 20px;
        }
        #small {
            font-size: 14px;
        }
        #of-appt {
            text-decoration: none;
            color: black;
        }
        .icons {
            height: 100px;
        }
        .list {
            padding: 20px;
            background: white;
            width: max-content;
            border-radius: 15px;
            text-align: center;
            max-width: 140px;
        }
        .list:hover {
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);

        }
        .label {
            font-size: 20px;
            font-weight: bold;
        }
        .scheduleList {
            display: grid;
            justify-items: center;
        }
        .schedule {
            border-radius: 20px 20px 0 0;
            padding: 20px;
            background-image: linear-gradient(white, #d9d9d9);
            border: solid #666666;
            border-width: 1px 1px 0px 1px;
            min-height:450px;
        }

        @media screen and (max-width: 1047px) {
            main {
                display: block;
            }
            .sidebar {
                width: 100%;
                display: flex;
                justify-content: center;
            }
            
            .today {
                width: max-content;
                display: flex;
                justify-content: space-between;
                padding: 0;
            }
            .patientData {
                min-width: 200px;
                padding: 25px;
                align-items: center;
            }
            #picname {
                padding: 25px;
            }
            .TAright {
                text-align: left;
            }
            .dashboard {
                width: 100%;
                margin: 0;
            }
            #greetings {
                padding: 15px;
            }
            .greet {
                border-radius: 20px 0 20px 0;
                border-style: solid;
                border-color: #d8d8d8;
                border-width: 2px;
            }
            #buttons {
                padding: 0 15px;
            }
            .buttons {
                margin: 0;
            }
            #schedule {
                padding: 15px;
                padding-bottom: 0;
            }
        }
        @media screen and (max-width: 1020px) {
            #viewDiv{
                display: none;
            }
            header{
                position: static;
            }
        }
        @media screen and (max-width: 640px) {
            .sched-container {
                padding: 10px;
            }
            #when, #what, #who {
                padding: 0 10px;
            }
        }
        #header {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
        }
        #viewDiv {
            justify-content: center;
        }
        #view {
            text-decoration: none;
            padding: 10px;
            margin: 0;
        }
        #edit {
            font-size: 15px;
            line-height: 1;
        }
    </style>

</head>
<body>
    <header>
    <div id="header">
        <div id="as">
            <div id="logoName">
                <div class="logoName" id="logo">
                    <img id="logo" src="https://static.thenounproject.com/png/1533617-200.png" alt="logo">
                </div>
                <div class="logoName" id="clinicName">
                    CLINICA
                </div>
            </div>
        </div>
        <div id="viewDiv">
            <a id="view" class="dropbtn" href="viewAppointments.php">View Appointments</a>
        </div>
        <div class="dropdown">
            <button id="nameLogout" class="dropbtn"><?php echo ucfirst($emp_Fname)?></button>
            <div class="dropdown-content">
                <a href="accSettings.php">Account Settings</a>
                <a href="logout.php">Log out</a>
            </div>
        </div>
    </div>
    </header>
    <main>
        <div class="sidebar">

            <div class="today">
                <div id="picname">
                <?php 
                    $sql = "SELECT img_url FROM user WHERE User_ID = '$ID' ";
                    $res = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($res)>0){
                        while($images = mysqli_fetch_assoc($res)){ ?>
                        <div class="picture">
                        <img id="picture" src="uploads/<?=$images['img_url']?>" alt="Temp">
                        </div>
                    <?php }}?>
                    <div class="name">
                        <?php echo ucfirst($emp_Fname)?>&nbsp;<?php echo ucfirst($emp_Lname) ?>
                        <br>
                        
                        <a id="edit" href="editInfo.php">Edit Info</a>
                    </div>
                    
                </div>
                <div class="patientData">
                    <div class="age">
                        Age:&nbsp;
                    </div>
                    <div class="TAright ageDB">
                        <?php echo ucfirst($Age)?>y/o
                    </div>
                    <div class="sex">
                        Sex:&nbsp;
                    </div>
                    <div class="TAright sexDB">
                        <?php echo ucfirst($sex)?>
                    </div>
                    <div class="weight">
                        Weight:&nbsp;
                    </div>
                    <div class="TAright weightDB">
                        <?php echo ucfirst($weight)?>kg
                    </div>
                    <div class="height">
                        Height:&nbsp;
                    </div>
                    <div class="TAright heightDB">
                        <?php echo ucfirst($height)?>cm
                    </div>
                    <div class="btype">
                        Blood Type:&nbsp;
                    </div>
                    <div class="TAright heightDB">
                        <?php echo ucfirst($btype)?>
                    </div>
                    <div class="status">
                        Marital Status:&nbsp;
                    </div>
                    <div class="TAright heightDB">
                        <?php echo ucfirst($status)?>
                    </div>
                    <div class="nationality">
                        Nationality:&nbsp;
                    </div>
                    <div class="TAright heightDB">
                        <?php echo ucfirst($flag)?>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard">
            <div id="greetings">
                <div class="greet">
                    <?php echo '<h2 style="font-size:2em;"> Hello, '.$emp_Fname.'!</h2>' ?><br>
                    <span id="small">How are you feeling today?</span>
                </div>
            </div>
            <div id="buttons">
                <div class="buttons">
                    <div id="bola">
                        In Clinica, we make your health our top priority. <br>
                        Book an appointment now!
                    </div>
                    <a href="addAppointment.php" id="of-appt">
                        <div class="list">
                            <img src="https://cdn-icons-png.flaticon.com/512/45/45533.png" alt="calendarIcon" class="icons"> <br>
                            APPOINTMENTS
                        </div>
                    </a>
                </div>
            </div>
            <div id="schedule">
                <div class="schedule">
                    <div class="label">
                        POSTED APPOINTMENTS
                    </div>
                    <div class="scheduleList">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Doctor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql2 = "SELECT * FROM appointment WHERE Status = 'Posted' AND User_ID ='$ID'";
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
                                </tr>
                                <?php endwhile;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer></footer>
</body>
</html>