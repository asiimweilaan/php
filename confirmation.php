<?php
include("connecttest.php");
$passkey = $_GET("passkey");

$sql3 = "select * from temp where code='$passkey'";
$result3 = mysqli_query($connectvar,$sql3);
if($result3){
    $rows = mysqli_num_rows($result3);
    if($rows==1){
        $arr = mysqli_fetch_assoc($result3);
        $namex = $arr["Name"];
        $emailx = $arr["email"];
        $passwordx = $arr["password"];
        
        $name = str_replace(" ","",$namex);
        $email = str_replace(" ","",$emailx);
        $password = str_replace(" ","",$passwordx);

        $sql = "insert into username values($name,$email,$password)";

    }
    else{
        echo "could not verify email";
    }
}

?>