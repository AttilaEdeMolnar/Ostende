<?php
   $content = "include/main.php";
   
   if (isset($_GET["p"])) {
       switch($_GET["p"]){
            // Menü
            case "login":
               $content = "include/login.php";
               break;
            case "logout":
                $content = "include/logout.php";
                break;
            case "admin":
                $content = "include/admin.php";
                break;
            case "show_search":
                $content = "include/show_search.php";
                break;
            case "profile":
                $content = "include/profile.php";
                break;
            case "own_list":
                $content = "include/own_list.php";
                break;
            // Műsorok
            case "Tóték":
                $content = "include/database/Tóték.php";
                break;
            case "Stützi":
                $content = "./Stützi.php";
                break;
       }   
   }
?>