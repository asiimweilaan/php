<?php
session_start();
include("connecttest.php");
$user=$_POST["user"];
$email = $_POST["email"];
$password = $_POST["password"];
// $userid = $_SESSION['id'];
// $hashedpass= password_hash($password,PASSWORD_DEFAULT);

$sql = "select password from username2 where email = \"$email\" ";// command for getting the hashed pass
$hash_result = mysqli_query($connectvar,$sql);
$hash = mysqli_fetch_assoc($hash_result);
$gethash = substr($hash['password'], 0, 60);
$verifyhash = password_verify($password, $gethash); //command to check if password entered matches hashed pass



$exists = isset($_POST["user"]) ? $user=$_POST["user"] : $user=null;
if(!preg_match("([^A-Za-z0-9])",$user)){ 
    //$sql = "select * from username where email= \"$email\"";
    $sql = "select * from username2 where user = \"$user\" and email= \"$email\"";
    $result = mysqli_query($connectvar,"$sql");
    $row = mysqli_num_rows($result)>0?mysqli_num_rows($result):null;

    if($row>0 and $verifyhash){
    // $confirm_code = md5(uniqid(rand()));
        $sql2 = "select imgurl,title from groups";
        $resultgroup = mysqli_query($connectvar,$sql2);
        if(mysqli_num_rows($resultgroup)>0){
            $groups = mysqli_fetch_all($resultgroup,MYSQLI_ASSOC);
            $_SESSION['groups'] = $groups;

        }
        $data = mysqli_fetch_array($result);
        $_SESSION['id']=$data['id'];
        $_SESSION['status']=$data['status'];
        $_SESSION['data']=$data;

        echo '<script>
        window.location="./view.php";
        </script>';
        
        // $message = "Your confirmation link. Click to confirm your email address\r\n";
        // $message.="http://localhost/HelloWorld/confirmation.php?passkey=$confirm_code";
        // $sent_mail = mail($email,"Confirmation of email",$message);
        // echo '<script>
        // alert("Check your email for confirmation link");
        // </script>';
    }
    else{
        echo '<script>
        alert("Failed to Login. Did you register?");
        window.location="./login.html";
        </script>';
    }
}   
    else{
    //header("Location:invalidname.html");
    echo '<script>
    alert("Name must contain Alphanumeric values only");
    window.location="./login.html";
    </script>';
}


?>