<?php

include "connecttest.php";
session_start();
// $data = $_SESSION['data'];
if(!isset($_SESSION['id'])){
    header("location:login.html");
}

if($_SESSION['status']==1){
    $status = '<b class="text-success">Voted!</b>';
}else{
    $status = '<b class="text-danger">Not Voted!</b>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .image{
            /* height: 10rem;
            padding-bottom: 3rem; */
            height: 10rem;
        }
        /* .image img{
            height: 100%;
            object-fit: contain;
        } */
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body class="bg-dark">
    <div class="container text-center">
        <div class="row mt-5">
            <?php 
            $sql = "select * from groups order by groupid desc";
            $res = mysqli_query($connectvar,"$sql");
            $arr = mysqli_fetch_all($res,MYSQLI_ASSOC);
            $groups = $_SESSION['groups'];
            
            if($arr){
            foreach($arr as $x){ ?>

                <div class="card col-3 mx-auto text-center">
                    <img src="./uploads/<?=$x['imgurl'] ?>" class="card-img-top image" alt="Cannot display img">
                    <div class="card-body">
                        <h5 class="card-title"><?= $x['title'] ?></h5>
                    </div>
                
                
                    <form action="votinglogic.php" method="POST">
                        
                        <input type="hidden" name="groupvotes" value="<?php echo $x['votes']?>">
                        <input type="hidden" name="groupid" value="<?php echo $x['groupid']?>">

                        <?php 
                        if($_SESSION['status']==1){?>
                            <!-- <button class="btn btn-success">Voted</button> -->
                            <div class="text-light fs-4 fw-bolder text-center bg-success">Voted</div>
                        
                        <?php }else{ ?>
                            <button class="btn btn-danger" type="submit">Vote</button>
                        <?php } ?>
                    </form>
                </div>
            <?php }}?>
        </div>
        <a href="logout.php" class="btn btn-outline-info mt-5">Logout</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>

