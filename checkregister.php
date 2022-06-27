<?php

include("connecttest.php");
$user=$_POST["user"];
$email = $_POST["email"];
$password = $_POST["password"];
$hashedpass= substr(password_hash($password,PASSWORD_DEFAULT),0,60);
$zero = 0;
// $four=4;

$exists = isset($_POST["user"]) ? $user=$_POST["user"] : $user=null;
if(!preg_match("([^A-Za-z0-9])",$user)&&$exists!=null){ 
    //$sql = "select * from username where email= \"$email\"";
    $sql = "select * from username2 where user = \"$user\" and email = \"$email\" and password=\"$hashedpass\" or email = \"$email\"";
    $result = mysqli_query($connectvar,"$sql");
    $row = mysqli_num_rows($result)>0?mysqli_num_rows($result):null;

    if($row>0){
        echo '<script>
        alert("You\'re already registered or email already used");
        window.location="./login.html";
        </script>';
    }
    else{
        if($_POST["user"]==$_POST["user2"] && $_POST["email"]==$_POST["email2"] && $_POST["password"]==$_POST["password2"]){
            // $confirm_code = md5(uniqid(rand()));
            
            $userx=strip_tags("$user");
            $emailx = strip_tags("$email");
            $user = str_replace(" ","",$userx);
            $email = str_replace(" ","",$emailx);

            // $sql2 = "insert into temp values('$user','$email','$password','$confirm_code')";
            $sql2 = "insert into username2(user,email,password,status) values('$user','$email','$hashedpass',$zero)";
            $result2 = mysqli_query($connectvar,"$sql2");

            if($result2){
                echo '<script>
                alert("Email Registered!");
                window.location="./login.html";
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
                alert("Failed to Register. Please try again");
                window.location="./register.html";
                </script>';
            }


        }
        else{
            //header("Location:invalidname.html");
            echo '<script>
            alert("some credentials do not match, please recheck and try again");
            window.location="./register.html";
            </script>';
        }
    }
}   
    else{
    //header("Location:invalidname.html");
    echo '<script>
    alert("Name must contain Alphanumeric values only");
    window.location="./register.html";
    </script>';
}


?>