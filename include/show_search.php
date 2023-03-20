<?php
$con = Connect();

$all_cb_value = "";
$books_cb_value = "";
$movies_cb_value = "";
$tvshows_cb_value = "";
$animes_cb_value = "";
$drama_cb_value = "";
function User_ID()
{
    $user_id = $_SESSION["user_id"];
}

if (isset($_POST["all"])) {
   $books_cb_value = "";
   $movies_cb_value = "";
   $tvshows_cb_value = "";
   $animes_cb_value = "";
   $drama_cb_value = "";
}

if (
    empty($_POST["books_checkbox"]) == false ||
    empty($_POST["movies_checkbox"]) == false ||
    empty($_POST["tv_shows_checkbox"]) == false ||
    empty($_POST["animes_checkbox"]) == false ||
    empty($_POST["drama_checkbox"]) == false
) {
    $_POST["books_checkbox"] = false;
}


// TÖRLÉS
if (isset($_POST['delete'])) {
   $id = $_POST['id'];
   $delete_name = $_POST['name'];
   $delete_author = $_POST['author_del'];
   $delete_date = $_POST['date'];


   $result_for_delete = mysqli_query(
      $con,
      "SELECT * FROM books"
  );
  while (
      $row_delete = mysqli_fetch_array($result_for_delete)
  ) {
      if (
         $delete_name == $row_delete["books_name"] &&
         $delete_author == $row_delete["books_author"] &&
         $delete_date == $row_delete["books_date"]
      ) {
         mysqli_query($con, "DELETE FROM books WHERE books_id = '$id'");
         unlink("./include/database/books/".$delete_name.".php");
      }
  }


  $result_for_delete = mysqli_query(
   $con,
   "SELECT * FROM movies"
);
while (
   $row_delete = mysqli_fetch_array($result_for_delete)
) {
   if (
      $delete_name == $row_delete["movies_name"] &&
      $delete_author == $row_delete["movies_director"] &&
      $delete_date == $row_delete["movies_date"]
   ) {
      mysqli_query($con, "DELETE FROM movies WHERE movies_id = '$id'");
   }
}


   
      
   header("Location: ./?p=show_search");
   exit();
}
?>

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
                "SELECT movies_name as title, movies_director as author, movies_date as date, movies_id as id
                                          FROM movies
                                          UNION
                                          SELECT books_name as title, books_author as author, books_date as date, books_id as id
                                          FROM books
                                          UNION
                                          SELECT animes_name as title, animes_author as author, animes_date as date, animes_id as id
                                          FROM animes
                                          UNION
                                          SELECT tvshows_name as title, tvshows_director as author, tvshows_date as date, tvshows_id as id
                                          FROM tvshows
                                          UNION
                                          SELECT dramas_name as title, dramas_director as author, dramas_date as date, dramas_id as id
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
                     $result_for_image = mysqli_query(
                         $con,
                         "SELECT * FROM movies"
                     );
                     while (
                         $row_image = mysqli_fetch_array($result_for_image)
                     ) {
                         if (
                             $row["title"] == $row_image["movies_name"] &&
                             $row["author"] == $row_image["movies_director"] &&
                             $row["date"] == $row_image["movies_date"]
                         ) {
                             $movies_pic =
                                 '<img src="./img/movies.png" alt="movies">';
                             echo $movies_pic;
                             $row_item="movie";
                         }
                     }
                     // Books
                     $result_for_image = mysqli_query(
                         $con,
                         "SELECT * FROM books"
                     );
                     while (
                         $row_image = mysqli_fetch_array($result_for_image)
                     ) {
                         if (
                             $row["title"] == $row_image["books_name"] &&
                             $row["author"] == $row_image["books_author"] &&
                             $row["date"] == $row_image["books_date"]
                         ) {
                           $books_pic =
                           '<img src="./img/books.png" alt="books">';
                           echo $books_pic;
                           $row_item="book";
                         }
                     }

                     // Animes
                     $result_for_image = mysqli_query(
                        $con,
                        "SELECT * FROM animes"
                    );
                    while (
                        $row_image = mysqli_fetch_array($result_for_image)
                    ) {
                        if (
                            $row["title"] == $row_image["animes_name"] &&
                            $row["author"] == $row_image["animes_author"] &&
                            $row["date"] == $row_image["animes_date"]
                        ) {
                          $animes_pic =
                          '<img src="./img/animes.png" alt="animes">';
                          echo $animes_pic;
                          $row_item="anime";
                        }
                    }


                    // Tv Shows
                    $result_for_image = mysqli_query(
                     $con,
                     "SELECT * FROM tvshows"
                 );
                 while (
                     $row_image = mysqli_fetch_array($result_for_image)
                 ) {
                     if (
                         $row["title"] == $row_image["tvshows_name"] &&
                         $row["author"] == $row_image["tvshows_director"] &&
                         $row["date"] == $row_image["tvshows_date"]
                     ) {
                       $tvshows_pic =
                       '<img src="./img/tvshows.png" alt="tvshows">';
                       echo $tvshows_pic;
                       $row_item="tvshow";
                     }
                 }
                    

                 // Dramas
                 $result_for_image = mysqli_query(
                  $con,
                  "SELECT * FROM dramas"
              );
              while (
                  $row_image = mysqli_fetch_array($result_for_image)
              ) {
                  if (
                      $row["title"] == $row_image["dramas_name"] &&
                      $row["author"] == $row_image["dramas_director"] &&
                      $row["date"] == $row_image["dramas_date"]
                  ) {
                    $tvshows_pic =
                    '<img src="./img/dramas.png" alt="dramas">';
                    echo $tvshows_pic;
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
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $row['id']; ?><?php echo $row_item; ?>">
  Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="<?php echo $row['id']; ?><?php echo $row_item; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        echo $row['id'];
        echo $row_item;
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

                  </td>
                  <td>
                     <input type="hidden" name="id" value="<?php echo $row['id'];?>">

                     <input type="hidden" name="name" value="<?php echo $row['title'];?>">
                     <input type="hidden" name="author_del" value="<?php echo $row['author'];?>">
                     <input type="hidden" name="date" value="<?php echo $row['date'];?>">
                     <button type="submit" name="delete" class="btn btn-danger btn-sm">Törlés</button>

                  </td>
               </tr>
            <?php }
            ?>
            </form>
         </tbody>
      </table>
</div>