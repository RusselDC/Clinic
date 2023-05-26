<?php 
session_start();
$user_check = $_SESSION['login_user'];
if(isset($_POST['upload'])&&isset($_FILES['image'])){
    include("db_conn.php");
    //img details
    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];


    if($error == 0){
        //check img size
        if($img_size > 125000){
            $em = "Sorry, your file is too large";
            header("Location: uploadpic.php?error=$em");
        } else{
        
           $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

           $img_ex_lc = strtolower($img_ex);
           //limits file type
           $allowed_ex = array("jpg","jpeg","png");

           if(in_array($img_ex_lc,$allowed_ex)){
                $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                //insert into database
                $sql = "UPDATE employee SET img_url = '$new_img_name' WHERE Emp_ID='$user_check'";
                mysqli_query($conn, $sql);
                echo '<script type="text/javascript">';
                echo 'alert("Photo successfuly changed");';
                echo 'window.location.href = "employee_dashboard.php"';
                echo '</script>';

                

           }else{
                $em = "You cant upload files of this type";
                header("Location: uploadpic.php?error=$em");
           }
        }
    }else{
        $em = "unknown error occured";
        header("Location: uploadpic.php?error=$em");
    }

}else{
    header("Location: uploadpic.php");
}

?>
