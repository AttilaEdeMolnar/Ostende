<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
$con = Connect();
$current_id = $_SESSION['user_id'];
?>

<div class="container">

<!-- ANIME -->
<?php
if(empty($_POST['animes-search']))
{
  $sql_animes_result = "SELECT * FROM finished_animes WHERE finished_animes_user_id = ".$current_id;
}

elseif(isset($_POST['animes-search']) && !empty($_POST['animes-search']))
{
  $animes_search = $_POST['animes-search'];
  $sql_animes = "SELECT * FROM animes WHERE animes_name LIKE '%$animes_search%' OR animes_author LIKE '%$animes_search%' OR animes_date LIKE '%$animes_search%'";
  $sql_animes_id = mysqli_query($con,$sql_animes);
  $sql_animes_id_row = mysqli_fetch_assoc($sql_animes_id);
  $sql_animes_help_value = $sql_animes_id_row['animes_id'];
  $sql_animes_result = "SELECT * FROM finished_animes WHERE finished_animes_animes_id = '$sql_animes_help_value' AND finished_animes_user_id = ".$current_id;

}

$animes_result = mysqli_query($con,$sql_animes_result);
?>
<script>
function redirectToPage() {
    location.href = './?p=own_list';
    }
</script>


  <form method="POST">
    <div class="col-sm-4 container">
    <input type="text" name="animes-search" class="form-control" placeholder="Keresés az animéid között...">
    </div>
    <br>
  </form>
  <form method="POST">
    <div class="table-responsive">
    <table class="table background">
      <thead>
        <tr>
        <th scope="col">Borító</th>
        <th scope="col">Cím</th>
          <th scope="col">Rendező</th>
          <th scope="col">Megjelenés</th>
          <th scope="col">Értékelés</th>
          <th scope="col">Vélemény</th>
          <th scope="col">Szerkesztés</th>
          <th scope="col">Törlés</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          while ($animes_row = mysqli_fetch_array($animes_result)) {
            $sql_animes_id_table = $animes_row['finished_animes_animes_id'];
            $sql_animes_table = "SELECT * FROM `animes` WHERE `animes_id` = '".$sql_animes_id_table."'";
            $sql_animes_table_result = mysqli_query($con,$sql_animes_table);
            $sql_animes_table_fetch = mysqli_fetch_array($sql_animes_table_result);
          ?>
          <td><img src="./img/animes.png" alt="animes.png"></td>
          <td><?php echo $sql_animes_table_fetch['animes_name'] ?></td>
          <td><?php echo $sql_animes_table_fetch['animes_author'] ?></td>
          <td><?php echo $sql_animes_table_fetch['animes_date'] ?></td>
          <td>⭐ <?php echo $animes_row['finished_animes_rating'] ?>/10</td>
          <td><?php echo $animes_row['finished_animes_opinion'] ?></td>
          <td>
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#animes-<?php echo $animes_row['finished_animes_animes_id'] ?>">
  Szerkesztés
</button>

<!-- Modal -->
<div class="modal fade" id="animes-<?php echo $animes_row['finished_animes_animes_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Szerkesztés</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table background">
                            <thead>
                                <th>Adat</th>
                                <th>Eredeti</th>
                                <th>Új</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Értékelés:</td>
                                    <td>⭐ <?php echo $animes_row['finished_animes_rating'];?>/10</td>
                                    <td>
                                      <select class="form-select" id="inputGroupSelect01" name="animes-new-rating-<?php echo $animes_row['finished_animes_animes_id'] ?>">
                                        <option selected value="0">Válassz...</option>
                                        <option value="1">⭐ 1/10</option>
                                        <option value="2">⭐ 2/10</option>
                                        <option value="3">⭐ 3/10</option>
                                        <option value="4">⭐ 4/10</option>
                                        <option value="5">⭐ 5/10</option>
                                        <option value="6">⭐ 6/10</option>
                                        <option value="7">⭐ 7/10</option>
                                        <option value="8">⭐ 8/10</option>
                                        <option value="9">⭐ 9/10</option>
                                        <option value="10">⭐ 10/10</option>
                                      </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vélemény:</td>
                                    <td><?php echo $animes_row['finished_animes_opinion']; ?></td>
                                    <td><input type="text" name="animes-new-opinion-<?php echo $animes_row['finished_animes_animes_id']; ?>" class="form-control CustomInput3" placeholder="Új vélemény..."></td>
                                </tr>
                            </tbody>
                        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
        <button type="submit" class="btn btn-warning" name="animes-new-add" value="<?php echo $animes_row['finished_animes_rating'];?>¤¤<?php echo $animes_row['finished_animes_opinion'];?>¤¤<?php echo $animes_row['finished_animes_animes_id'];?>">Adatok módosítása</button>
      </div>
    </div>
  </div>
</div>
          </td>
          <td><button type="submit" name="animes-btn-delete" value="<?php echo $animes_row['finished_animes_animes_id']; ?>" class="btn btn-danger ">Törlés</button></td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    </div>

    <?php

if(isset($_POST['animes-new-add']))
{
  $animes_old_values = $_POST['animes-new-add'];
  $animes_old_values = explode("¤¤",$animes_old_values);

  $animes_id = $animes_old_values[2];
  $animes_new_values = array($_POST["animes-new-rating-".$animes_id],$_POST["animes-new-opinion-".$animes_id]);

  for ($i=0; $i < 2; $i++) { 
    if(empty($animes_new_values[$i]))
    {
        $animes_new_values[$i] = $animes_old_values[$i]; 
    }
}

if($animes_new_values[0]==0)
    {
      $animes_new_values[0]=$animes_old_values[0];
    }

$animes_sql_update = "UPDATE finished_animes SET finished_animes_rating = '".$animes_new_values[0]."', finished_animes_opinion = '".$animes_new_values[1]."' WHERE finished_animes_animes_id = '".$animes_id."'";
mysqli_query($con,$animes_sql_update);

?>
<script>
  redirectToPage();
</script>
<?php
}

      if(isset($_POST['animes-btn-delete'])) {
        $animes_delete_id = $_POST['animes-btn-delete'];
        // Törlési műveletek végrehajtása
        
        $animes_sql_delete = "DELETE FROM finished_animes WHERE finished_animes_animes_id = '$animes_delete_id'";
        mysqli_query($con,$animes_sql_delete);
        ?>
      <script>
        redirectToPage();
      </script>
      <?php
      }
?>
  </form>

  <p class="biggerBr"></p>
  <!-- DRAMAS -->
<?php
if(empty($_POST['dramas-search']))
{
  $sql_dramas_result = "SELECT * FROM finished_dramas WHERE finished_dramas_user_id = ".$current_id;
}

elseif(isset($_POST['dramas-search']) && !empty($_POST['dramas-search']))
{
  $dramas_search = $_POST['dramas-search'];
  $sql_dramas = "SELECT * FROM dramas WHERE dramas_name LIKE '%$dramas_search%' OR dramas_director LIKE '%$dramas_search%' OR dramas_date LIKE '%$dramas_search%'";
  $sql_dramas_id = mysqli_query($con,$sql_dramas);
  $sql_dramas_id_row = mysqli_fetch_assoc($sql_dramas_id);
  $sql_dramas_help_value = $sql_dramas_id_row['dramas_id'];
  $sql_dramas_result = "SELECT * FROM finished_dramas WHERE finished_dramas_dramas_id = '$sql_dramas_help_value' AND finished_dramas_user_id = ".$current_id;

}

$dramas_result = mysqli_query($con,$sql_dramas_result);
?>
  <form method="POST">
    <div class="col-sm-4 container">
    <input type="text" name="dramas-search" class="form-control" placeholder="Keresés a drámáid között...">
    </div>
    <br>
  </form>
  <form method="POST">
  <div class="table-responsive">
    <table class="table background">
      <thead>
        <tr>
        <th scope="col">Borító</th>
        <th scope="col">Cím</th>
          <th scope="col">Rendező</th>
          <th scope="col">Megjelenés</th>
          <th scope="col">Értékelés</th>
          <th scope="col">Vélemény</th>
          <th scope="col">Szerkesztés</th>
          <th scope="col">Törlés</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          while ($dramas_row = mysqli_fetch_array($dramas_result)) {
            $sql_dramas_id_table = $dramas_row['finished_dramas_dramas_id'];
            $sql_dramas_table = "SELECT * FROM `dramas` WHERE `dramas_id` = '".$sql_dramas_id_table."'";
            $sql_dramas_table_result = mysqli_query($con,$sql_dramas_table);
            $sql_dramas_table_fetch = mysqli_fetch_array($sql_dramas_table_result);
          ?>
          <td><img src="./img/dramas.png" alt="dramas.png"></td>
          <td><?php echo $sql_dramas_table_fetch['dramas_name'] ?></td>
          <td><?php echo $sql_dramas_table_fetch['dramas_director'] ?></td>
          <td><?php echo $sql_dramas_table_fetch['dramas_date'] ?></td>
          <td>⭐ <?php echo $dramas_row['finished_dramas_rating'] ?>/10</td>
          <td><?php echo $dramas_row['finished_dramas_opinion'] ?></td>
          <td>
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dramas-<?php echo $dramas_row['finished_dramas_dramas_id'] ?>">
  Szerkesztés
</button>

<!-- Modal -->
<div class="modal fade" id="dramas-<?php echo $dramas_row['finished_dramas_dramas_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Szerkesztés</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table background">
                            <thead>
                                <th>Adat</th>
                                <th>Eredeti</th>
                                <th>Új</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Értékelés:</td>
                                    <td>⭐ <?php echo $dramas_row['finished_dramas_rating'];?>/10</td>
                                    <td>
                                      <select class="form-select" id="inputGroupSelect01" name="dramas-new-rating-<?php echo $dramas_row['finished_dramas_dramas_id'] ?>">
                                        <option selected value="0">Válassz...</option>
                                        <option value="1">⭐ 1/10</option>
                                        <option value="2">⭐ 2/10</option>
                                        <option value="3">⭐ 3/10</option>
                                        <option value="4">⭐ 4/10</option>
                                        <option value="5">⭐ 5/10</option>
                                        <option value="6">⭐ 6/10</option>
                                        <option value="7">⭐ 7/10</option>
                                        <option value="8">⭐ 8/10</option>
                                        <option value="9">⭐ 9/10</option>
                                        <option value="10">⭐ 10/10</option>
                                      </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vélemény:</td>
                                    <td><?php echo $dramas_row['finished_dramas_opinion']; ?></td>
                                    <td><input type="text" name="dramas-new-opinion-<?php echo $dramas_row['finished_dramas_dramas_id']; ?>" class="form-control CustomInput3" placeholder="Új vélemény..."></td>
                                </tr>
                            </tbody>
                        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
        <button type="submit" class="btn btn-warning" name="dramas-new-add" value="<?php echo $dramas_row['finished_dramas_rating'];?>¤¤<?php echo $dramas_row['finished_dramas_opinion'];?>¤¤<?php echo $dramas_row['finished_dramas_dramas_id'];?>">Adatok módosítása</button>
      </div>
    </div>
  </div>
</div>
          </td>
          <td><button type="submit" name="dramas-btn-delete" value="<?php echo $dramas_row['finished_dramas_dramas_id']; ?>" class="btn btn-danger ">Törlés</button></td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    </div>

    <?php

if(isset($_POST['dramas-new-add']))
{
  $dramas_old_values = $_POST['dramas-new-add'];
  $dramas_old_values = explode("¤¤",$dramas_old_values);

  $dramas_id = $dramas_old_values[2];
  $dramas_new_values = array($_POST["dramas-new-rating-".$dramas_id],$_POST["dramas-new-opinion-".$dramas_id]);

  for ($i=0; $i < 2; $i++) { 
    if(empty($dramas_new_values[$i]))
    {
        $dramas_new_values[$i] = $dramas_old_values[$i]; 
    }
}

if($dramas_new_values[0]==0)
    {
      $dramas_new_values[0]=$dramas_old_values[0];
    }

$dramas_sql_update = "UPDATE finished_dramas SET finished_dramas_rating = '".$dramas_new_values[0]."', finished_dramas_opinion = '".$dramas_new_values[1]."' WHERE finished_dramas_dramas_id = '".$dramas_id."'";
mysqli_query($con,$dramas_sql_update);

?>
<script>
  redirectToPage();
</script>
<?php
}

      if(isset($_POST['dramas-btn-delete'])) {
        $dramas_delete_id = $_POST['dramas-btn-delete'];
        // Törlési műveletek végrehajtása
        
        $dramas_sql_delete = "DELETE FROM finished_dramas WHERE finished_dramas_dramas_id = '$dramas_delete_id'";
        mysqli_query($con,$dramas_sql_delete);
        ?>
      <script>
        redirectToPage();
      </script>
      <?php
      }
?>
  </form>

  <p class="biggerBr"></p>
  <!-- movies -->
<?php
if(empty($_POST['movies-search']))
{
  $sql_movies_result = "SELECT * FROM finished_movies WHERE finished_movies_user_id = ".$current_id;
}

elseif(isset($_POST['movies-search']) && !empty($_POST['movies-search']))
{
  $movies_search = $_POST['movies-search'];
  $sql_movies = "SELECT * FROM movies WHERE movies_name LIKE '%$movies_search%' OR movies_director LIKE '%$movies_search%' OR movies_date LIKE '%$movies_search%'";
  $sql_movies_id = mysqli_query($con,$sql_movies);
  $sql_movies_id_row = mysqli_fetch_assoc($sql_movies_id);
  $sql_movies_help_value = $sql_movies_id_row['movies_id'];
  $sql_movies_result = "SELECT * FROM finished_movies WHERE finished_movies_movies_id = '$sql_movies_help_value' AND finished_movies_user_id = ".$current_id;

}

$movies_result = mysqli_query($con,$sql_movies_result);
?>
  <form method="POST">
    <div class="col-sm-4 container">
    <input type="text" name="movies-search" class="form-control" placeholder="Keresés a filmeid között...">
    </div>
    <br>
  </form>
  <form method="POST">
  <div class="table-responsive">
    <table class="table background">
      <thead>
        <tr>
        <th scope="col">Borító</th>
        <th scope="col">Cím</th>
          <th scope="col">Rendező</th>
          <th scope="col">Megjelenés</th>
          <th scope="col">Értékelés</th>
          <th scope="col">Vélemény</th>
          <th scope="col">Szerkesztés</th>
          <th scope="col">Törlés</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          while ($movies_row = mysqli_fetch_array($movies_result)) {
            $sql_movies_id_table = $movies_row['finished_movies_movies_id'];
            $sql_movies_table = "SELECT * FROM `movies` WHERE `movies_id` = '".$sql_movies_id_table."'";
            $sql_movies_table_result = mysqli_query($con,$sql_movies_table);
            $sql_movies_table_fetch = mysqli_fetch_array($sql_movies_table_result);
          ?>
          <td><img src="./img/movies.png" alt="movies.png"></td>
          <td><?php echo $sql_movies_table_fetch['movies_name'] ?></td>
          <td><?php echo $sql_movies_table_fetch['movies_director'] ?></td>
          <td><?php echo $sql_movies_table_fetch['movies_date'] ?></td>
          <td>⭐ <?php echo $movies_row['finished_movies_rating'] ?>/10</td>
          <td><?php echo $movies_row['finished_movies_opinion'] ?></td>
          <td>
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#movies-<?php echo $movies_row['finished_movies_movies_id'] ?>">
  Szerkesztés
</button>

<!-- Modal -->
<div class="modal fade" id="movies-<?php echo $movies_row['finished_movies_movies_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Szerkesztés</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table background">
                            <thead>
                                <th>Adat</th>
                                <th>Eredeti</th>
                                <th>Új</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Értékelés:</td>
                                    <td>⭐ <?php echo $movies_row['finished_movies_rating'];?>/10</td>
                                    <td>
                                      <select class="form-select" id="inputGroupSelect01" name="movies-new-rating-<?php echo $movies_row['finished_movies_movies_id'] ?>">
                                        <option selected value="0">Válassz...</option>
                                        <option value="1">⭐ 1/10</option>
                                        <option value="2">⭐ 2/10</option>
                                        <option value="3">⭐ 3/10</option>
                                        <option value="4">⭐ 4/10</option>
                                        <option value="5">⭐ 5/10</option>
                                        <option value="6">⭐ 6/10</option>
                                        <option value="7">⭐ 7/10</option>
                                        <option value="8">⭐ 8/10</option>
                                        <option value="9">⭐ 9/10</option>
                                        <option value="10">⭐ 10/10</option>
                                      </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vélemény:</td>
                                    <td><?php echo $movies_row['finished_movies_opinion']; ?></td>
                                    <td><input type="text" name="movies-new-opinion-<?php echo $movies_row['finished_movies_movies_id']; ?>" class="form-control CustomInput3" placeholder="Új vélemény..."></td>
                                </tr>
                            </tbody>
                        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
        <button type="submit" class="btn btn-warning" name="movies-new-add" value="<?php echo $movies_row['finished_movies_rating'];?>¤¤<?php echo $movies_row['finished_movies_opinion'];?>¤¤<?php echo $movies_row['finished_movies_movies_id'];?>">Adatok módosítása</button>
      </div>
    </div>
  </div>
</div>
          </td>
          <td><button type="submit" name="movies-btn-delete" value="<?php echo $movies_row['finished_movies_movies_id']; ?>" class="btn btn-danger ">Törlés</button></td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    </div>

    <?php

if(isset($_POST['movies-new-add']))
{
  $movies_old_values = $_POST['movies-new-add'];
  $movies_old_values = explode("¤¤",$movies_old_values);

  $movies_id = $movies_old_values[2];
  $movies_new_values = array($_POST["movies-new-rating-".$movies_id],$_POST["movies-new-opinion-".$movies_id]);

  for ($i=0; $i < 2; $i++) { 
    if(empty($movies_new_values[$i]))
    {
        $movies_new_values[$i] = $movies_old_values[$i]; 
    }
}

if($movies_new_values[0]==0)
    {
      $movies_new_values[0]=$movies_old_values[0];
    }

$movies_sql_update = "UPDATE finished_movies SET finished_movies_rating = '".$movies_new_values[0]."', finished_movies_opinion = '".$movies_new_values[1]."' WHERE finished_movies_movies_id = '".$movies_id."'";
mysqli_query($con,$movies_sql_update);

?>
<script>
  redirectToPage();
</script>
<?php
}

      if(isset($_POST['movies-btn-delete'])) {
        $movies_delete_id = $_POST['movies-btn-delete'];
        // Törlési műveletek végrehajtása
        
        $movies_sql_delete = "DELETE FROM finished_movies WHERE finished_movies_movies_id = '$movies_delete_id'";
        mysqli_query($con,$movies_sql_delete);
        ?>
      <script>
        redirectToPage();
      </script>
      <?php
      }
?>
  </form>

  <p class="biggerBr"></p>
  <!-- books -->
<?php
if(empty($_POST['books-search']))
{
  $sql_books_result = "SELECT * FROM finished_books WHERE finished_books_user_id = ".$current_id;
}

elseif(isset($_POST['books-search']) && !empty($_POST['books-search']))
{
  $books_search = $_POST['books-search'];
  $sql_books = "SELECT * FROM books WHERE books_name LIKE '%$books_search%' OR books_author LIKE '%$books_search%' OR books_date LIKE '%$books_search%'";
  $sql_books_id = mysqli_query($con,$sql_books);
  $sql_books_id_row = mysqli_fetch_assoc($sql_books_id);
  $sql_books_help_value = $sql_books_id_row['books_id'];
  $sql_books_result = "SELECT * FROM finished_books WHERE finished_books_books_id = '$sql_books_help_value' AND finished_books_user_id = ".$current_id;

}

$books_result = mysqli_query($con,$sql_books_result);
?>
  <form method="POST">
    <div class="col-sm-4 container">
    <input type="text" name="books-search" class="form-control" placeholder="Keresés a könyveid között...">
    </div>
    <br>
  </form>
  <form method="POST">
  <div class="table-responsive">
    <table class="table background">
      <thead>
        <tr>
        <th scope="col">Borító</th>
        <th scope="col">Cím</th>
          <th scope="col">Rendező</th>
          <th scope="col">Megjelenés</th>
          <th scope="col">Értékelés</th>
          <th scope="col">Vélemény</th>
          <th scope="col">Szerkesztés</th>
          <th scope="col">Törlés</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          while ($books_row = mysqli_fetch_array($books_result)) {
            $sql_books_id_table = $books_row['finished_books_books_id'];
            $sql_books_table = "SELECT * FROM `books` WHERE `books_id` = '".$sql_books_id_table."'";
            $sql_books_table_result = mysqli_query($con,$sql_books_table);
            $sql_books_table_fetch = mysqli_fetch_array($sql_books_table_result);
          ?>
          <td><img src="./img/books.png" alt="books.png"></td>
          <td><?php echo $sql_books_table_fetch['books_name'] ?></td>
          <td><?php echo $sql_books_table_fetch['books_author'] ?></td>
          <td><?php echo $sql_books_table_fetch['books_date'] ?></td>
          <td>⭐ <?php echo $books_row['finished_books_rating'] ?>/10</td>
          <td><?php echo $books_row['finished_books_opinion'] ?></td>
          <td>
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#books-<?php echo $books_row['finished_books_books_id'] ?>">
  Szerkesztés
</button>

<!-- Modal -->
<div class="modal fade" id="books-<?php echo $books_row['finished_books_books_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Szerkesztés</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table background">
                            <thead>
                                <th>Adat</th>
                                <th>Eredeti</th>
                                <th>Új</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Értékelés:</td>
                                    <td>⭐ <?php echo $books_row['finished_books_rating'];?>/10</td>
                                    <td>
                                      <select class="form-select" id="inputGroupSelect01" name="books-new-rating-<?php echo $books_row['finished_books_books_id'] ?>">
                                        <option selected value="0">Válassz...</option>
                                        <option value="1">⭐ 1/10</option>
                                        <option value="2">⭐ 2/10</option>
                                        <option value="3">⭐ 3/10</option>
                                        <option value="4">⭐ 4/10</option>
                                        <option value="5">⭐ 5/10</option>
                                        <option value="6">⭐ 6/10</option>
                                        <option value="7">⭐ 7/10</option>
                                        <option value="8">⭐ 8/10</option>
                                        <option value="9">⭐ 9/10</option>
                                        <option value="10">⭐ 10/10</option>
                                      </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vélemény:</td>
                                    <td><?php echo $books_row['finished_books_opinion']; ?></td>
                                    <td><input type="text" name="books-new-opinion-<?php echo $books_row['finished_books_books_id']; ?>" class="form-control CustomInput3" placeholder="Új vélemény..."></td>
                                </tr>
                            </tbody>
                        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
        <button type="submit" class="btn btn-warning" name="books-new-add" value="<?php echo $books_row['finished_books_rating'];?>¤¤<?php echo $books_row['finished_books_opinion'];?>¤¤<?php echo $books_row['finished_books_books_id'];?>">Adatok módosítása</button>
      </div>
    </div>
  </div>
</div>
          </td>
          <td><button type="submit" name="books-btn-delete" value="<?php echo $books_row['finished_books_books_id']; ?>" class="btn btn-danger ">Törlés</button></td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    </div>

    <?php

if(isset($_POST['books-new-add']))
{
  $books_old_values = $_POST['books-new-add'];
  $books_old_values = explode("¤¤",$books_old_values);

  $books_id = $books_old_values[2];
  $books_new_values = array($_POST["books-new-rating-".$books_id],$_POST["books-new-opinion-".$books_id]);

  for ($i=0; $i < 2; $i++) { 
    if(empty($books_new_values[$i]))
    {
        $books_new_values[$i] = $books_old_values[$i]; 
    }
}

if($books_new_values[0]==0)
    {
      $books_new_values[0]=$books_old_values[0];
    }

$books_sql_update = "UPDATE finished_books SET finished_books_rating = '".$books_new_values[0]."', finished_books_opinion = '".$books_new_values[1]."' WHERE finished_books_books_id = '".$books_id."'";
mysqli_query($con,$books_sql_update);

?>
<script>
  redirectToPage();
</script>
<?php
}

      if(isset($_POST['books-btn-delete'])) {
        $books_delete_id = $_POST['books-btn-delete'];
        // Törlési műveletek végrehajtása
        
        $books_sql_delete = "DELETE FROM finished_books WHERE finished_books_books_id = '$books_delete_id'";
        mysqli_query($con,$books_sql_delete);
        ?>
      <script>
        redirectToPage();
      </script>
      <?php
      }
?>
  </form>
<!-- containert záró div -->

<p class="biggerBr"></p>
  <!-- tvshows -->
<?php
if(empty($_POST['tvshows-search']))
{
  $sql_tvshows_result = "SELECT * FROM finished_tvshows WHERE finished_tvshows_user_id = ".$current_id;
}

elseif(isset($_POST['tvshows-search']) && !empty($_POST['tvshows-search']))
{
  $tvshows_search = $_POST['tvshows-search'];
  $sql_tvshows = "SELECT * FROM tvshows WHERE tvshows_name LIKE '%$tvshows_search%' OR tvshows_director LIKE '%$tvshows_search%' OR tvshows_date LIKE '%$tvshows_search%'";
  $sql_tvshows_id = mysqli_query($con,$sql_tvshows);
  $sql_tvshows_id_row = mysqli_fetch_assoc($sql_tvshows_id);
  $sql_tvshows_help_value = $sql_tvshows_id_row['tvshows_id'];
  $sql_tvshows_result = "SELECT * FROM finished_tvshows WHERE finished_tvshows_tvshows_id = '$sql_tvshows_help_value' AND finished_tvshows_user_id = ".$current_id;

}

$tvshows_result = mysqli_query($con,$sql_tvshows_result);
?>
  <form method="POST">

    <div class="col-sm-4 container">
    <input type="text" name="tvshows-search" class="form-control" placeholder="Keresés a sorozataid között...">
    </div>
    <br>
  </form>
  <form method="POST">
  <div class="table-responsive">
    <table class="table background">
      <thead>
        <tr>
        <th scope="col">Borító</th>
        <th scope="col">Cím</th>
          <th scope="col">Rendező</th>
          <th scope="col">Megjelenés</th>
          <th scope="col">Értékelés</th>
          <th scope="col">Vélemény</th>
          <th scope="col">Szerkesztés</th>
          <th scope="col">Törlés</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          while ($tvshows_row = mysqli_fetch_array($tvshows_result)) {
            $sql_tvshows_id_table = $tvshows_row['finished_tvshows_tvshows_id'];
            $sql_tvshows_table = "SELECT * FROM `tvshows` WHERE `tvshows_id` = '".$sql_tvshows_id_table."'";
            $sql_tvshows_table_result = mysqli_query($con,$sql_tvshows_table);
            $sql_tvshows_table_fetch = mysqli_fetch_array($sql_tvshows_table_result);
          ?>
          <td><img src="./img/tvshows.png" alt="tvshows.png"></td>
          <td><?php echo $sql_tvshows_table_fetch['tvshows_name'] ?></td>
          <td><?php echo $sql_tvshows_table_fetch['tvshows_director'] ?></td>
          <td><?php echo $sql_tvshows_table_fetch['tvshows_date'] ?></td>
          <td>⭐ <?php echo $tvshows_row['finished_tvshows_rating'] ?>/10</td>
          <td><?php echo $tvshows_row['finished_tvshows_opinion'] ?></td>
          <td>
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#tvshows-<?php echo $tvshows_row['finished_tvshows_tvshows_id'] ?>">
  Szerkesztés
</button>

<!-- Modal -->
<div class="modal fade" id="tvshows-<?php echo $tvshows_row['finished_tvshows_tvshows_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Szerkesztés</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table background">
                            <thead>
                                <th>Adat</th>
                                <th>Eredeti</th>
                                <th>Új</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Értékelés:</td>
                                    <td>⭐ <?php echo $tvshows_row['finished_tvshows_rating'];?>/10</td>
                                    <td>
                                      <select class="form-select" id="inputGroupSelect01" name="tvshows-new-rating-<?php echo $tvshows_row['finished_tvshows_tvshows_id'] ?>">
                                        <option selected value="0">Válassz...</option>
                                        <option value="1">⭐ 1/10</option>
                                        <option value="2">⭐ 2/10</option>
                                        <option value="3">⭐ 3/10</option>
                                        <option value="4">⭐ 4/10</option>
                                        <option value="5">⭐ 5/10</option>
                                        <option value="6">⭐ 6/10</option>
                                        <option value="7">⭐ 7/10</option>
                                        <option value="8">⭐ 8/10</option>
                                        <option value="9">⭐ 9/10</option>
                                        <option value="10">⭐ 10/10</option>
                                      </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vélemény:</td>
                                    <td><?php echo $tvshows_row['finished_tvshows_opinion']; ?></td>
                                    <td><input type="text" name="tvshows-new-opinion-<?php echo $tvshows_row['finished_tvshows_tvshows_id']; ?>" class="form-control CustomInput3" placeholder="Új vélemény..."></td>
                                </tr>
                            </tbody>
                        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
        <button type="submit" class="btn btn-warning" name="tvshows-new-add" value="<?php echo $tvshows_row['finished_tvshows_rating'];?>¤¤<?php echo $tvshows_row['finished_tvshows_opinion'];?>¤¤<?php echo $tvshows_row['finished_tvshows_tvshows_id'];?>">Adatok módosítása</button>
      </div>
    </div>
  </div>
</div>
          </td>
          <td><button type="submit" name="tvshows-btn-delete" value="<?php echo $tvshows_row['finished_tvshows_tvshows_id']; ?>" class="btn btn-danger ">Törlés</button></td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    </div>

    <?php

if(isset($_POST['tvshows-new-add']))
{
  $tvshows_old_values = $_POST['tvshows-new-add'];
  $tvshows_old_values = explode("¤¤",$tvshows_old_values);

  $tvshows_id = $tvshows_old_values[2];
  $tvshows_new_values = array($_POST["tvshows-new-rating-".$tvshows_id],$_POST["tvshows-new-opinion-".$tvshows_id]);

  for ($i=0; $i < 2; $i++) { 
    if(empty($tvshows_new_values[$i]))
    {
        $tvshows_new_values[$i] = $tvshows_old_values[$i]; 
    }
}

if($tvshows_new_values[0]==0)
    {
      $tvshows_new_values[0]=$tvshows_old_values[0];
    }

$tvshows_sql_update = "UPDATE finished_tvshows SET finished_tvshows_rating = '".$tvshows_new_values[0]."', finished_tvshows_opinion = '".$tvshows_new_values[1]."' WHERE finished_tvshows_tvshows_id = '".$tvshows_id."'";
mysqli_query($con,$tvshows_sql_update);

?>
<script>
  redirectToPage();
</script>
<?php
}

      if(isset($_POST['tvshows-btn-delete'])) {
        $tvshows_delete_id = $_POST['tvshows-btn-delete'];
        // Törlési műveletek végrehajtása
        
        $tvshows_sql_delete = "DELETE FROM finished_tvshows WHERE finished_tvshows_tvshows_id = '$tvshows_delete_id'";
        mysqli_query($con,$tvshows_sql_delete);
        ?>
      <script>
        redirectToPage();
      </script>
      <?php
      }
?>
  </form>
</div>