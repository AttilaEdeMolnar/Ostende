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
            <th scope="col">ID</th>
            <th scope="col">Típus</th>
            <th scope="col">Cím</th>
            <th scope="col">Szerző/Rendező</th>
            <th scope="col">Megjelenés</th>
            <th scope="col">Saját oldaluk</th>
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
                                          FROM books"
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
                  <form method="POST" style="display: inline;">
                     <input type="hidden" name="id" value="<?php echo $row['id'];?>">

                     <input type="hidden" name="name" value="<?php echo $row['title'];?>">
                     <input type="hidden" name="author_del" value="<?php echo $row['author'];?>">
                     <input type="hidden" name="date" value="<?php echo $row['date'];?>">
                     <button type="submit" name="delete" class="btn btn-danger btn-sm">Törlés</button>
                  </form>

                  </td>
               </tr>
            <?php }
            ?>
            </form>
         </tbody>
      </table>
</div>