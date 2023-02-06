<?php
    function Connect(){
        $server = "localhost";
        $user    = "root";
        $pass    = "";
        $db      = "ostende";

        $con = mysqli_connect($server,$user,$pass,$db);
        if(!$con){
            die("Nem sikerült");
        }
        return $con;
    }
?>