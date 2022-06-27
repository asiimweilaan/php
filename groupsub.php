<?php
include('connecttest.php');

if(isset($_FILES["group1"])){
    
    $arr = $_FILES["group1"];
    
    // print_r($_FILES["group1"]);
    $img_name = $arr["name"];
    $img_size = $arr["size"];
    $temp_name = $arr["tmp_name"];
    $error = $arr["error"];

    if($error === 0){
        if($img_size > 125000){
            $em = "Sorry, your file is too large";
            header("Location: groups.html");
        }
        else{
            // echo "Not more than 1mb";
            $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            
            $allowed_exs = array("jpg","jpeg","png");
            
            if(in_array($img_ex_lc,$allowed_exs)){
                $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($temp_name,$img_upload_path);
                
                $sql = "insert into groups(imgurl) values('$new_img_name')";
                mysqli_query($connectvar,$sql);
                header("Location: view.php");                

            }else{
                $em = "You can't upload files of this type";
                header("Location: index.php?error=$em");
            }
        }
    }else{
        $em = "unknown error occured!";
        header("Location: groups.html");
    }
}
else{
    echo "Invalid! Try again!";
}

?>