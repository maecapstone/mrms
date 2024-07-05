<?php 
    include("connection.php");
    
    if(!isset($_COOKIE['_HC'])){
        header("location: ../");
    }
    else{
        $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);

        $query = mysqli_query($conn,"SELECT * FROM `user` WHERE `user_token`='$userToken';");
        if(mysqli_num_rows($query)>0){
            $rows = mysqli_fetch_array($query);
            if($rows['role'] !== "Super"){
                header("location: ../");
            }
        }
        else{
            header("location: ../");
        }
    }
?>