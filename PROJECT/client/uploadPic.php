<?php 
session_start();
$user_check = $_SESSION['login_user'];
if(isset($_POST['upload'])&&isset($_FILES['image'])){
    include("db_conn.php");
    echo "<pre>";
    print_r($_FILES['image']);
    echo "</pre>";

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    if($error == 0){
        if($img_size > 625000){
            $em = "Sorry, your file is too large (Max of 5MB)";
            header("Location: uploadpic.php?error=$em");
        } else{
           $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
           $img_ex_lc = strtolower($img_ex);
           $allowed_ex = array("jpg","jpeg","png");

           if(in_array($img_ex_lc,$allowed_ex)){
                $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                //insert into database
                $sql = "UPDATE user SET img_url = '$new_img_name' WHERE User_ID='$user_check'";
                mysqli_query($conn, $sql);
                header("Location: user_dashboard.php");
           }else{
                $em = "You can't upload files of this type";
                header("Location: accSettings.php?error=$em");
           }
        }
    }else{
        $em = "unknown error occured";
        header("Location: accSettings.php?error=$em");
    }

}else{
    header("Location: accSettings.php");
}

?>
