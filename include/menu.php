<?php
   $content = "include/main.php";
   $con = Connect();
   $books_query = mysqli_query($con,"SELECT * FROM books");
   $movies_query = mysqli_query($con,"SELECT * FROM movies");
   $main = mysqli_query(
    $con,
    "SELECT movies_name as title, movies_director as author, movies_date as date
                              FROM movies
                              UNION
                              SELECT books_name as title, books_author as author, books_date as date
                              FROM books"
);


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
            }   
   }


   elseif(isset($_GET["t"]) && isset($_GET["a"]) && isset($_GET["d"]))
   {
	
    while ($row = mysqli_fetch_array($main)) {
               $title = $_GET["t"];
               $author = $_GET["a"];
               $date = $_GET["d"];
                // Film
               $movies_result = mysqli_fetch_array($movies_query);
               if (
                $title == $movies_result["movies_name"] &&
                $author == $movies_result["movies_director"] &&
                $date == $movies_result["movies_date"]
            ) {
                $stop = true;
                $content = "./include/database/movies/".$title.".php";

                ini_set("display_errors", 0);
                ini_set("display_startup_errors", 0);
            }
            // Könyv
            elseif (
                $title == $movies_result["movies_name"] &&
                $author == $movies_result["movies_director"] &&
                $date == $movies_result["movies_date"]
            ) {
                $stop = true;
                $content = "./include/database/movies/".$title.".php";

                ini_set("display_errors", 0);
                ini_set("display_startup_errors", 0);
            }
            // Sorozat
            /*
            elseif (
                $title == $movies_result["movies_name"] &&
                $author == $movies_result["movies_director"] &&
                $date == $movies_result["movies_date"]
            ) {
                $stop = true;
                $content = "./include/database/movies/".$title.".php";

                ini_set("display_errors", 0);
                ini_set("display_startup_errors", 0);
            }
            */

            // Anime
            /*
            elseif (
                $title == $movies_result["movies_name"] &&
                $author == $movies_result["movies_director"] &&
                $date == $movies_result["movies_date"]
            ) {
                $stop = true;
                $content = "./include/database/movies/".$title.".php";

                ini_set("display_errors", 0);
                ini_set("display_startup_errors", 0);
            }
            */

            // Színházi előadás
            /*
            elseif (
                $title == $movies_result["movies_name"] &&
                $author == $movies_result["movies_director"] &&
                $date == $movies_result["movies_date"]
            ) {
                $stop = true;
                $content = "./include/database/movies/".$title.".php";

                ini_set("display_errors", 0);
                ini_set("display_startup_errors", 0);
            }
            */
   }

}
?>