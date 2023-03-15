<?php
$con = Connect();

function User_ID()
{
    $user_id = $_SESSION["user_id"];
}

if (empty($_POST["all"]) == false) {
    $_POST["books_checkbox"] = off;
    $_POST["movies_checkbox"] = off;
    $_POST["tv_shows_checkbox"] = off;
    $_POST["animes_checkbox"] = off;
    $_POST["drama_checkbox"] = off;
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
?>

<div class="container">
   <div class="d-flex justify-content-center">
      
   <form method="POST">
      <input class="search_input form-control" type="text" name="search" placeholder="Keresés...">
   </div>
   <br>
   <div class="d-flex justify-content-center">
      <span class="pe-3">Összes</span><input name="all_checkbox" type="checkbox" checked>
      <span class="pe-3 ps-5">Könyvek</span><input name="books_checkbox" type="checkbox">
      <span class="pe-3 ps-5">Filmek</span><input name="movies_checkbox" type="checkbox">
      <span class="pe-3 ps-5">Sorozatok</span><input name="tv_shows_checkbox" type="checkbox">
      <span class="pe-3 ps-5">Animék</span><input name="animes_checkbox" type="checkbox">
      <span class="pe-3 ps-5">Drámák</span><input name="drama_checkbox" type="checkbox">
   </div>
   <br>
   <table class="table background">
      <thead>
         <tr>
            <th scope="col">Típus</th>
            <th scope="col">Cím</th>
            <th scope="col">Szerző/Rendező</th>
            <th scope="col">Megjelenés</th>
            <th scope="col">Saját oldaluk</th>
         </tr>
      </thead>
      <tbody>
            <?php
            $show_name;

            $result = mysqli_query(
                $con,
                "SELECT movies_name as title, movies_director as author, movies_date as date, movies_type as type
                                          FROM movies
                                          UNION
                                          SELECT books_name as title, books_author as author, books_date as date, books_type as type
                                          FROM books"
            );
            while ($row = mysqli_fetch_array($result)) { ?>
               <tr>
                  <td>
                     <?php
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
                         }
                     }

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
                             echo "Könyv";
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
                     <a type="submit" name="btn-finished" class="btn btn-primary btn-sm" href="./?p=<?php echo $show_name; ?>">
                       Megnyitás
                     </a>
                  </td>
               </tr>
            <?php }
            ?>
            </form>
         </tbody>
      </table>
</div>