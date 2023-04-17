<div class="container">
<script>
function redirectToPage() {
  setTimeout(function() {
        location.href = './?p=admin';
    }, 2000);
    }
</script>
<?php
ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);

$error = false;

if (isset($_POST["btn-add-show"]))
{
    $show_name = $_POST["show-name"];
    $author_name = $_POST["add-author"];
    $release = $_POST["add-release-date"];
    $spoiler = $_POST["show-spoiler"];

    $c_book = $_POST["book"];
    $c_movie = $_POST["movie"];
    $c_tv_show = $_POST["tvshow"];
    $c_anime = $_POST["anime"];
    $c_drama = $_POST["drama"];


    if(empty($author_name))
    {
      ?>

    <div class="alert alert-danger">
      <?php
        $error = true;
        echo "Hiányzik a szerzője/rendezője!";
      ?>
    </div>
    <script>
      redirectToPage();
    </script>
  <?php

    }

    if(empty($release))
    {
      ?>

    <div class="alert alert-danger">
      <?php
        $error = true;
        echo "Hiányzik a tartalom megjelenési dátuma!";
      ?>
    </div>
    <script>
      redirectToPage();
    </script>
  <?php

    }

    $checkbox = [$c_book, $c_movie, $c_tv_show, $c_anime, $c_drama];
    if (empty($show_name))
    { ?>

    <div class="alert alert-danger">
      <?php
        $error = true;
        echo "Hiányzik a műsor neve!";
?>
    <script>
      redirectToPage();
    </script>
    </div>
  <?php
    }

    // Checkboxok ellenőrzése
    $isItempty = false;
    $isItMore = false;
    $nullCount = 0;
    $fullCount = 0;
    $type;
    for ($i = 0;$i < 5;$i++)
    {
        if (isset($checkbox[$i]) == null)
        {
            $nullCount++;
        }

        if (isset($checkbox[$i]) == "on")
        {
            $fullCount++;
            $type = $i;
        }
    }

    if ($nullCount == 5)
    {
        $isItempty = true;
    }
    elseif ($fullCount > 1)
    {
        $isItMore = true;
    }

    // Üres vagy teli?
    if ($isItempty)
    { ?>
    <div class="alert alert-danger">
      <?php
        $error = true;
        echo "Hiányzik a műsor típusa!";
        
?>
  <script>
      redirectToPage();
    </script>
    </div>
  <?php
    }
    elseif ($isItMore)
    { ?>
    <div class="alert alert-danger">
      <?php
        $error = true;
        echo "Csak 1 típust választhatsz ki!";
?>
    </div>
    <script>
      redirectToPage();
    </script>
  <?php
    }
    if ($error == false)
    {
        if ($type == 0)
        {
            //$type = "Könyv";
            mysqli_query(Connect() , "INSERT INTO books(books_name, books_author, books_date, books_spoiler)
    values('$show_name', '$author_name', '$release','$spoiler')"); ?>

<div class="alert alert-success">
  <?php echo "Sikeresen hozzá lett adva az új műsor!"; ?>
</div>
<?php

            header("Refresh: 1;");

        }
        elseif ($type == 1)
        {
            //$type = "Film";
            mysqli_query(Connect() , "INSERT INTO movies(movies_name, movies_director, movies_date, movies_spoiler)
    values('$show_name', '$author_name', '$release', '$spoiler')"); ?>

<div class="alert alert-success">
  <?php echo "Sikeresen hozzá lett adva az új műsor!"; ?>
</div>
<?php

            header("Refresh: 1;");

        }
        elseif ($type == 2)
        {
            //$type = "Sorozat";

            mysqli_query(Connect() , "INSERT INTO tvshows(tvshows_name, tvshows_director, tvshows_date, tvshows_spoiler)
    values('$show_name', '$author_name', '$release', '$spoiler')"); ?>

<div class="alert alert-success">
  <?php echo "Sikeresen hozzá lett adva az új műsor!"; ?>
</div>
<?php

            header("Refresh: 1;");
            
        }
        elseif ($type == 3)
        {
            //$type = "Anime";

            mysqli_query(Connect() , "INSERT INTO animes(animes_name, animes_author, animes_date, animes_spoiler)
    values('$show_name', '$author_name', '$release', '$spoiler')"); ?>

<div class="alert alert-success">
  <?php echo "Sikeresen hozzá lett adva az új műsor!"; ?>
</div>
<?php
            header("Refresh: 1;");
            
        }
        elseif ($type == 4)
        {
            //$type = "Dráma";

            mysqli_query(Connect() , "INSERT INTO dramas(dramas_name, dramas_director, dramas_date, dramas_spoiler)
    values('$show_name', '$author_name', '$release', '$spoiler')"); ?>

<div class="alert alert-success">
  <?php echo "Sikeresen hozzá lett adva az új műsor!"; ?>
</div>
<?php
            header("Refresh: 1;");
            
        }
    }

    if ($error == false)
    {
    }
}
?>


<form method="POST">
  <div class="form-floating mb-3 row">
    
    <div class="col">
    <div class="col-sm-4 container">
    <input type="text" name="show-name" class="form-control" id="add-show-name" aria-describedby="emailHelp" placeholder="Műsor neve...">
</div>
  </div>

  
  </div>
  
<br>
  <div class="row">
  <label for="add-show-name" class="form-label AdminLabel">Típusa:</label>
  <div class="table-responsive">
  <table class="table background">
    <thead>
    <th scope="col"><span class="pe-2">Könyv</span><input type="checkbox" name="book"></th>
    <th scope="col"><span class="pe-2">Film</span><input type="checkbox" name="movie"></th>
    <th scope="col"><span class="pe-2">Sorozat</span><input type="checkbox" name="tvshow"></th>
    <th scope="col"><span class="pe-2">Anime</span><input type="checkbox" name="anime"></th>
    <th scope="col"><span class="pe-2">Dráma</span><input type="checkbox" name="drama"></th>
    </thead>
    </table>
  </div>
  </div>
<br>
  <div class="mb-3 row">
    <div class="col">
    <input type="text" name="add-author" class="form-control" id="add-author" aria-describedby="emailHelp" placeholder="Szerző/rendező...">
    </div>
    <div class="col">
    
    <input type="number" name="add-release-date" class="form-control" id="add-release-date" aria-describedby="emailHelp" placeholder="Megjelenés...">
    </div>
  </div>
  <p class="bigBr"></p>
  <div class="row">
  <div class="col">
  <div class="mb-3">
    <input type="text" name="show-spoiler" class="form-control" id="add-show-name" aria-describedby="emailHelp" placeholder="Spoiler...">
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col">
  <button type="submit" name="btn-add-show" class="btn btn-primary Custombutton">Új műsor hozzáadása</button>
  </div>
  </div>
</form>
</div>
