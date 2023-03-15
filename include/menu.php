<?php
   $content = "include/main.php";
   $con = Connect();
   $result = mysqli_query($con, "SELECT books_name FROM books");


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
            case "credit":
                $content = "include/credit.php";
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
            default:   
            while ($row = mysqli_fetch_array($result)) {
               $books_name = $row['books_name'];

               if($_GET["p"]==$books_name)
               {
                    $content = "include/database/".$books_name.".php";
               }
            }

            
       }   
   }
?>