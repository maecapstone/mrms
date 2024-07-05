<?php
    include("connection.php");

    if(isset($_GET['fetch_api']) || !isset($_GET['fetch_api'])){
        session_destroy();
        mysqli_close($conn);
        setcookie("_HC",'', time() - (86400 * 30), "/");
        header("location: ../");
    }
?>