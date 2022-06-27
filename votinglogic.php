<?php
session_start();
include('connecttest.php');

$votes = $_POST['groupvotes'];
$totalvotes = $votes+1;

$groupid = $_POST['groupid'];
$userid = $_SESSION['id'];

$updatevotes = mysqli_query($connectvar,"update groups set votes='$totalvotes' where groupid='$groupid'");
$updatestatus = mysqli_query($connectvar,"update username2 set status=1 where id='$userid'");

if($updatevotes and $updatestatus){
    $getgroups = mysqli_query($connectvar,"select groupid,imgurl,title,votes from groups");
    $groups = mysqli_fetch_all($getgroups,MYSQLI_ASSOC);
    $_SESSION['groups']=$groups;
    $_SESSION['status'] = 1;
    
    echo '
    <script>
    alert("Voting successful");
    window.location="./view.php";

    </script>
    ';

}else{
    echo '
    <script>
    alert("Technical error!! Vote after sometime");
    window.location="./view.php";

    </script>
    ';
}

?>