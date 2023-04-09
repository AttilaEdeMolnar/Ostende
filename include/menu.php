<?php
ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);




   $content = "include/main.php";
   $con = Connect();
   $books_query = mysqli_query($con,"SELECT * FROM books");
   $movies_query = mysqli_query($con,"SELECT * FROM movies");
   $tvshows_query = mysqli_query($con,"SELECT * FROM tvshows");
   $animes_query = mysqli_query($con,"SELECT * FROM animes");
   $dramas_query = mysqli_query($con,"SELECT * FROM dramas");
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

                if($_SESSION['user_type']== 1)
                {
                $content = "./include/admin.php";
                }

                else
                {
                    $content = "./include/error.php";
                }
                break;
            case "credit":
                $content = "include/credit.php";
                break;
            case "profile":
                $content = "include/profile.php";
                break;
            case "own_list":
                $content = "include/own_list.php";
                break;
            case "books":
                $content = "include/contents/books.php";
                break;
            case "animes":
                $content = "include/contents/animes.php";
                break;
            case "movies":
                $content = "include/contents/movies.php";
                break;
            case "tvshows":
                $content = "include/contents/tvshows.php";
                break;
            case "dramas":
                $content = "include/contents/dramas.php";
                break;
            case "animes_page":
                $content = "include/pages/animes_page.php";
                break;
            case "dramas_page":
                $content = "include/pages/dramas_page.php";
                break;
            case "movies_page":
                $content = "include/pages/movies_page.php";
                break;
            case "books_page":
                $content = "include/pages/books_page.php";
                break;
            case "tvshows_page":
                $content = "include/pages/tvshows_page.php";
                break;
            default:
                $content = "include/error.php";
            }   
   }

   
   else{
    if(isset($_SESSION['user_id']))
    {
    $content = "include/error.php";
    }
   }
?>