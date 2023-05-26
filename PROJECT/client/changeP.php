<?php 
include('session.php');

if (isset($_POST['currpass']) && isset($_POST['newpass']) && isset($_POST['retype'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $current = validate($_POST['currpass']);
    $new = validate($_POST['newpass']);
    $match = validate($_POST['retype']);

    if(empty($current)){
        header("Location: editDetails.php?error=Old Password is required");
        exit();
    }
    else if(empty($new)){
        header("Location: editDetails.php?error=New Password is required");
        exit();
    }
    else if(empty($match)){
        header("Location: editDetails.php?error=Confirmation of new password is required");
        exit();
    }
    else{
        $sql = "SELECT Pass FROM  user WHERE User_ID='$ID' AND Pass='".md5($current)."'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $sql_2 = "UPDATE user SET Pass ='".md5($new)."' WHERE User_ID='$ID'";
            $result_2 = mysqli_query($conn, $sql_2);
            header("Location: editDetails.php?success=Password has been changed successfully");
            exit();
        }
        else {
            header("Location: editDetails.php?error=Incorrect password");
            exit();
        }
    }
}
else {
    header("Location: editDetails.php");
}
?>