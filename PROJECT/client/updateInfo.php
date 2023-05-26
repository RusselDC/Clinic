<?php 
include("session.php");

    
if (isset($_POST['register-btn'])) {
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $cnum = $_POST['cnum'];
        $bday = $_POST['bday'];
        $address = $_POST['address'];
        $maritalStatus = $_POST['maritalStatus'];
        $bloodtype = $_POST['bloodtype'];
        $date = date("Y/m/d");
        $Age = date_diff(date_create($bday),date_create($date));
        $age = $Age->format('%y');
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $countries = $_POST['countries'];

        $resulta = mysqli_query($conn, "SELECT * FROM user WHERE User_ID = '$ID'");
        $row = mysqli_fetch_array($resulta, MYSQLI_ASSOC);
        $count = mysqli_num_rows($resulta);

        if($count==1){
            $eskyuel = "UPDATE user SET 
            `Lname`=trim('$lname'),
            `Fname`=trim('$fname'),
            `Mname`=trim('$mname'),
            `Contact_number`=trim('$cnum'),
            `Address`=trim('$address'),
            `Birthdate`=trim('$bday'),
            `Status`=trim('$maritalStatus'),
            `Blood_Type`=trim('$bloodtype'),
            `Age`=trim('$age'),
            `Weight`=trim('$weight'),
            `Height`=trim('$height'),
            `Nationality`=trim('$countries')
             WHERE User_ID = trim('$ID')";
            mysqli_query($conn, $eskyuel);
            header("Location: editInfo.php?success=Updated successfully");
        }
    }
?>