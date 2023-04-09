<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

$con = Connect();
function User_ID()
{
    $user_id = $_SESSION["user_id"];
}


?>

<script>
                                    function redirectToPage() {
                                        location.href = './?p=show_search';
                                    }
                                </script>

<div class="container">
   <div class="d-flex justify-content-center">
      
   <form method="POST">
      <input class="search_input form-control" type="text" name="search" placeholder="Keresés...">
   </div>
   <br>
   <div class="d-flex justify-content-center">
      <span class="pe-3">Összes</span><input name="all_checkbox" type="checkbox" <?php $all_cb_value ?>>
      <span class="pe-3 ps-5">Könyvek</span><input name="books_checkbox" type="checkbox" <?php $books_cb_value ?>>
      <span class="pe-3 ps-5">Filmek</span><input name="movies_checkbox" type="checkbox" <?php $books_cb_value ?>>
      <span class="pe-3 ps-5">Sorozatok</span><input name="tvshows_checkbox" type="checkbox" <?php $books_cb_value ?>>
      <span class="pe-3 ps-5">Animék</span><input name="animes_checkbox" type="checkbox" <?php $books_cb_value ?>>
      <span class="pe-3 ps-5">Drámák</span><input name="drama_checkbox" type="checkbox" <?php $books_cb_value ?>>
   </div>
   <br>
   <table class="table background">
      <thead>
         <tr>
            <th scope="col">ID</th>
            <th scope="col">Típus</th>
            <th scope="col">Cím</th>
            <th scope="col">Szerző/Rendező</th>
            <th scope="col">Megjelenés</th>
            <th scope="col">Saját oldaluk</th>
            <th scope="col">Szerkesztés</th>
            <th scope="col">Törlés</th>
         </tr>
      </thead>
      <tbody>
            <?php
            $show_name;

            $result = mysqli_query(
                $con,
                "SELECT movies_name as title, movies_director as author, movies_date as date, movies_id as id, movies_spoiler as spoiler
                FROM movies
                UNION
                SELECT books_name as title, books_author as author, books_date as date, books_id as id, books_spoiler as spoiler
                FROM books
                UNION
                SELECT animes_name as title, animes_author as author, animes_date as date, animes_id as id, animes_spoiler as spoiler
                FROM animes
                UNION
                SELECT tvshows_name as title, tvshows_director as author, tvshows_date as date, tvshows_id as id, tvshows_spoiler as spoiler
                FROM tvshows
                UNION
                SELECT dramas_name as title, dramas_director as author, dramas_date as date, dramas_id as id, dramas_spoiler as spoiler
                FROM dramas"
            );
            while ($row = mysqli_fetch_array($result)) { ?>
               <tr>
                  <td>
                     <?php echo $row["id"]; ?><br>
                  </td>
                  <td>
                     <?php
                     $row_item;
                     // Borító
                     $result_for_movies_image = mysqli_query(
                         $con,
                         "SELECT * FROM movies"
                     );
                     while (
                         $row_movies_image = mysqli_fetch_array($result_for_movies_image)
                     ) {
                         if (
                             $row["title"] == $row_movies_image["movies_name"] &&
                             $row["author"] == $row_movies_image["movies_director"] &&
                             $row["date"] == $row_movies_image["movies_date"]
                         ) {
                             $movies_pic =
                                 '<img src="./img/movies.png" alt="movies">';
                             echo $movies_pic;
                             $row_item="movie";
                         }
                     }
                     // Books
                     $result_for_books_image = mysqli_query(
                         $con,
                         "SELECT * FROM books"
                     );
                     while (
                         $row_books_image = mysqli_fetch_array($result_for_books_image)
                     ) {
                         if (
                             $row["title"] == $row_books_image["books_name"] &&
                             $row["author"] == $row_books_image["books_author"] &&
                             $row["date"] == $row_books_image["books_date"]
                         ) {
                           $books_pic =
                           '<img src="./img/books.png" alt="books">';
                           echo $books_pic;
                           $row_item="book";
                         }
                     }

                     // Animes
                     $result_for_animes_image = mysqli_query(
                        $con,
                        "SELECT * FROM animes"
                    );
                    while (
                        $row_animes_image = mysqli_fetch_array($result_for_animes_image)
                    ) {
                        if (
                            $row["title"] == $row_animes_image["animes_name"] &&
                            $row["author"] == $row_animes_image["animes_author"] &&
                            $row["date"] == $row_animes_image["animes_date"]
                        ) {
                          $animes_pic =
                          '<img src="./img/animes.png" alt="animes">';
                          echo $animes_pic;
                          $row_item="anime";
                        }
                    }


                    // Tv Shows
                    $result_for_tvshows_image = mysqli_query(
                     $con,
                     "SELECT * FROM tvshows"
                 );
                 while (
                     $row_tvshows_image = mysqli_fetch_array($result_for_tvshows_image)
                 ) {
                     if (
                         $row["title"] == $row_tvshows_image["tvshows_name"] &&
                         $row["author"] == $row_tvshows_image["tvshows_director"] &&
                         $row["date"] == $row_tvshows_image["tvshows_date"]
                     ) {
                       $tvshows_pic =
                       '<img src="./img/tvshows.png" alt="tvshows">';
                       echo $tvshows_pic;
                       $row_item="tvshow";
                     }
                 }
                    

                 // Dramas
                 $result_for_dramas_image = mysqli_query(
                  $con,
                  "SELECT * FROM dramas"
              );
              while (
                  $row_dramas_image = mysqli_fetch_array($result_for_dramas_image)
              ) {
                  if (
                      $row["title"] == $row_dramas_image["dramas_name"] &&
                      $row["author"] == $row_dramas_image["dramas_director"] &&
                      $row["date"] == $row_dramas_image["dramas_date"]
                  ) {
                    $dramas_pic =
                    '<img src="./img/dramas.png" alt="dramas">';
                    echo $dramas_pic;
                    $row_item="drama";
                  }
              }
                    
                     ?><br>
                  </td>
                  <td>
                     <?php
                     $show_name = $row["title"];
                     echo $row["title"];
                     ?><br>
                  </td>
                  <td>
                     <?php echo $row["author"]; ?><br>
                  </td>
                  <td>
                     <?php echo $row["date"]; ?><br>
                  </td>
                  <td>
                     <a type="submit" name="btn-finished" class="btn btn-primary btn-sm" href="./?t=<?php echo $show_name; ?>&a=<?php echo $row["author"]; ?>&d=<?php echo $row["date"]; ?>">
                     
                       Megnyitás
                     </a>
                  </td>
                  <td>
                  
<!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#<?php echo $row['id']; ?><?php echo $row_item; ?>">
  Szerkesztés
</button>

<!-- Modal -->
<div class="modal fade" id="<?php echo $row['id']; ?><?php echo $row_item; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Szerkesztés</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table background text-center">
            <thead>
                <tr>
                    <th>Adat</th>
                    <th>Eredeti</th>
                    <th>Új</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cím:</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><input type="text" name="new-title" class="form-control" placeholder="Új cím..."></td>
                </tr>
                <tr>
                    <td>Szerző:</td>
                    <td><?php echo $row['author']; ?></td>
                    <td><input type="text" name="new-author" class="form-control CustomInput2" aria-describedby="emailHelp" placeholder="Új szerző..."></td>
                </tr>
                <tr>
                    <td>Dátum:</td>
                    <td><?php echo $row['date']; ?></td>
                    <td><input type="text" name="new-date" class="form-control CustomInput2" aria-describedby="emailHelp" placeholder="Új dátum..."></td>
                
                </tr>
                <tr>
                    <td>Spoiler:</td>
                    <td><?php echo $row['spoiler']; ?></td>
                    <td><input type="text" name="new-spoiler" class="form-control CustomInput2" aria-describedby="emailHelp" placeholder="Új szerző..."></td>

                    
                </tr>
            </tbody>
        </table>
        <br>
        <h5>Egyéb adatok:</h5>
        <br>
        <table class="table background text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tartalom típusa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php
                    if($row_item=="movie")
                    {
                      echo "Film";  
                    }

                    elseif($row_item=="anime")
                    {
                        echo "Anime";  
                    }

                    elseif($row_item=="book")
                    {
                        echo "Könyv";  
                    }

                    elseif($row_item=="tvshow")
                    {
                        echo "Sorozat";  
                    }

                    elseif($row_item=="drama")
                    {
                        echo "Színházi előadás";  
                    }
                    ?></td>
                </tr>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
        <button type="submit" class="btn btn-warning" value="<?php echo $row['title']; ?>+<?php echo $row['date']; ?>+<?php echo $row['author']; ?>+<?php echo $row['spoiler']; ?>" name="submit-new">Adatok felvétele</button>
        <input type="hidden" name="new-id" value="<?php echo $row['id'];?>">
        <input type="hidden" name="new-type" value="<?php echo $row_item; ?>">

        
                    
      </div>
    </div>
  </div>
</div>

                  </td>
                  <td>
                     <button type="submit" value="<?php echo $row['id']; ?>+<?php echo $row_item; ?>+<?php echo $row['title']; ?>+<?php echo $row['author']; ?>+<?php echo $row['date']; ?>" name="delete" class="btn btn-danger btn-sm">Törlés</button>
                     
                  </td>
               </tr>

               
                

            <?php }
            ?>

<?php
                    if(isset($_POST['submit-new']))
                    {
                        switch($_POST['new-type'])
                        {
                            case "drama":
                                $old_values_array = $_POST['submit-new'];
                                $old_values = explode("+",$old_values_array);

                                $new_id = $_POST['new-id'];
                                $new_title = $_POST['new-title'];
                                $new_author = $_POST['new-author'];
                                $new_date = $_POST['new-date'];
                                $new_spoiler = $_POST['new-spoiler'];

                                if(empty($new_author)) $new_author = $old_values[2];
                                if(empty($new_title)) $new_title = $old_values[0];
                                if(empty($new_date)) $new_date = $old_values[1];
                                if(empty($new_spoiler)) $new_spoiler = $old_values[3];

                                $original_name = $old_values[0] . "-" . $old_values[2] . "-" . $old_values[1]. ".php";
                                $new_name = $new_title . "-" . $new_author . "-" . $new_date . ".php";

                                rename("./include/database/dramas/".$original_name, "./include/database/dramas/".$new_name);
                            
    
                                $sql_update = "UPDATE dramas SET dramas_name = '$new_title', dramas_director = '$new_author',dramas_date = '$new_date', dramas_spoiler = '$new_spoiler' WHERE dramas_id = '$new_id' ";
    
                                mysqli_query($con,$sql_update);
                                break;
                            case "movie":
                                $old_movies_array = $_POST['submit-new'];
                                $old_movies = explode("+",$old_movies_array);

                                $new_movies_id = $_POST['new-id'];
                                $new_movies_title = $_POST['new-title'];
                                $new_movies_author = $_POST['new-author'];
                                $new_movies_date = $_POST['new-date'];
                                $new_movies_spoiler = $_POST['new-spoiler'];

                                if(empty($new_movies_author)) $new_movies_author = $old_movies_values[2];
                                if(empty($new_movies_title)) $new_movies_title = $old_movies_values[0];
                                if(empty($new_movies_date)) $new_movies_date = $old_movies_values[1];
                                if(empty($new_movies_spoiler)) $new_movies_spoiler = $old_movies_values[3];

                                $original_movies_name = $old_movies[0] . "-" . $old_movies[2] . "-" . $old_movies[1]. ".php";
                                $new_movies_name = $new_movies_title . "-" . $new_movies_author . "-" . $new_movies_date . ".php";
    
                                rename("./include/database/movies/".$original_movies_name, "./include/database/movies/".$new_movies_name);
                                
        
                                $sql_movies_update = "UPDATE movies SET movies_name = '$new_movies_title', movies_director = '$new_movies_author movies_date = '$new_movies_date', movies_spoiler = '$new_movies_spoiler' WHERE movies_id = '$new_movies_id' ";
        
                                mysqli_query($con,$sql_movies_update);
                                break;
                        }
                         ?>
                         <script>
                            setTimeout(redirectToPage, 1);
                        </script>
                         <?php

                        }
                    ?>

                    <?php
                            






                        // Azok az adatok lekérése amiket a gombbal egy sorban találunk    
                        if (isset($_POST['delete'])) {

                            ?>
                            

                        <?php

                        $delete_btn_value =  $_POST['delete'];
                        $delete_values = explode("+",$delete_btn_value);
                        $error_delete = true;
                        
                        switch($delete_values[1])
                        {
                            case "movie":
                                $delete_movie_query = "DELETE FROM movies WHERE movies_id = '$delete_values[0]'";
                                mysqli_query($con,$delete_movie_query);
                                unlink("./include/database/movies/".$delete_values[2]."-".$delete_values[3]."-".$delete_values[4].".php");
                                $error_delete = false;
                                ?>
                                <script>

                                    setTimeout(redirectToPage, 1000);
                                </script>
                                <?php
                                break;
                            case "anime":
                                $delete_anime_query = "DELETE FROM animes WHERE animes_id = '$delete_values[0]'";
                                mysqli_query($con,$delete_anime_query);
                                unlink("./include/database/animes/".$delete_values[2]."-".$delete_values[3]."-".$delete_values[4].".php");
                                $error_delete = false;
                                ?>
                                <script>
                                    setTimeout(redirectToPage, 1000);
                                </script>
                                <?php
                                break;
                            case "book":
                                $delete_book_query = "DELETE FROM books WHERE books_id = '$delete_values[0]'";
                                mysqli_query($con,$delete_book_query);
                                unlink("./include/database/books/".$delete_values[2]."-".$delete_values[3]."-".$delete_values[4].".php");
                                $error_delete = false;
                                ?>
                                <script>
                                    setTimeout(redirectToPage, 1000);
                                </script>
                                <?php
                                break;
                            case "tvshow":
                                $delete_tvshow_query = "DELETE FROM tvshows WHERE tvshows_id = '$delete_values[0]'";
                                mysqli_query($con,$delete_tvshow_query);
                                unlink("./include/database/tvshows/".$delete_values[2]."-".$delete_values[3]."-".$delete_values[4].".php");
                                $error_delete = false;
                                ?>
                                <script>
                                    setTimeout(redirectToPage, 1000);
                                </script>
                                <?php
                                break;
                            case "drama":
                                $delete_drama_query = "DELETE FROM dramas WHERE dramas_id = '$delete_values[0]'";
                                mysqli_query($con,$delete_drama_query);
                                unlink("./include/database/dramas/".$delete_values[2]."-".$delete_values[3]."-".$delete_values[4].".php");
                                $error_delete = false;
                                ?>
                                <script>
                                    setTimeout(redirectToPage, 1000);
                                </script>
                                <?php
                                break;
                            }

                            if($error_delete == false)
                            {
                                ?>
                                <div class="alert alert-success">
                                <?php echo "Sikeresen el lett távolítva a tartalom!"; ?>
                                </div>
                                <?php
                            }
                        }
                    ?>



            </form>
         </tbody>
      </table>
</div>

