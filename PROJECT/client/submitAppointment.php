<?php
include("session.php");

if (isset($_POST['submit'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $sched = validate($_POST['sched']);
    $timeslot = validate($_POST['timeslot']);
    $reason = validate($_POST['reason']);
    $Email;

    if (empty($sched)) {
        header("Location: addAppointment.php?error=Please specify date");
        exit();
    }
    else if (empty($timeslot)) {
        header("Location: addAppointment.php?error=Please specify time");
        exit();
    }
    else if (empty($reason)) {
        header("Location: addAppointment.php?error=Please specify reason for visit");
        exit();
    }
    else{

        $New = mysqli_query($conn, "SELECT COUNT(Appointment_ID) AS New_Count FROM appointment WHERE Status = 'New' ");
        $row1 = mysqli_fetch_array($New,MYSQLI_ASSOC);
        $NC = $row1['New_Count'];

        $Doctor = mysqli_query($conn, "SELECT Name From doctors WHERE Service = '$reason'");
        $rows = mysqli_fetch_assoc($Doctor);
        $Docname = $rows['Name'];
    
        $doctor = mysqli_query($conn, "SELECT Doc_ID FROM doctors WHERE Name = '$Docname'");
        $row = mysqli_fetch_assoc($doctor);
        $docid = $row['Doc_ID'];


        if($NC >= 50){
            header("Location: addAppointment.php?error=Appointment count already reached its limit, please try again in later date <3");
            exit();
        }
        else {
            $insert = mysqli_query($conn, "INSERT INTO `appointment`(`Pname`, `Email`, `Service`, `Appointment_Date`, `Time`, `Doctor`, `Doctor_ID`, `User_ID`) VALUES ('$emp_name','$Email','$reason','$sched','$timeslot','$Docname','$docid','$ID')");
            header("Location: addAppointment.php?success=Appointment scheduled successfully");
            exit();
        }
        
        
    }
  }
?>
