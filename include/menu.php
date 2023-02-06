<?php
   $content = "include/main.php";
   
   if (isset($_GET["p"])) {
       switch($_GET["p"]){
           case "login":
               $content = "include/login.php";
               break;
            case "logout":
                $content = "include/logout.php";
                break;
       }   
   }
?>