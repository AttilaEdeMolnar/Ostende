<div class="container">

<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

$error=false;

if(isset($_POST['btn-add-show']))
{
  $show_name = $_POST['show-name'];
  $author_name = $_POST['add-author'];
  $release = $_POST['add-release-date'];

  $c_book = $_POST['book'];
  $c_movie = $_POST['movie'];
  $c_tv_show = $_POST['tv-show'];
  $c_anime = $_POST['anime'];
  $c_drama = $_POST['drama'];

  echo $c_anime;
  $checkbox = array($c_book,$c_movie,$c_tv_show,$c_anime,$c_drama);
  if (empty($show_name)) { ?>

    <div class="alert alert-danger">
      <?php
      $error=true;
      echo "Hiányzik a műsor neve!";
      ?>
    </div>
  <?php
  }

  // Checkboxok ellenőrzése

  $isItempty = false;
  $isItMore = false;
  $nullCount = 0;
  $fullCount = 0;
  $type;
for ($i=0; $i <5 ; $i++) {
  if (isset($checkbox[$i])==null) {
    $nullCount++;
  }

  if (isset($checkbox[$i])=="on") {
    $fullCount++;
    $type = $i;
  }

  }

  if ($nullCount==5) {
    $isItempty = true;
  }

  elseif ($fullCount>1) {
    $isItMore = true;
  }

 // Üres vagy teli?
  if ($isItempty) { ?>
    <div class="alert alert-danger">
      <?php
      $error=true;
      echo "Hiányzik a műsor típusa!";
      ?>
    </div>
  <?php
  }

  elseif ($isItMore) { ?>
    <div class="alert alert-danger">
      <?php
      $error=true;
      echo "Csak 1 típust választhatsz ki!";
      ?>
    </div>
  <?php
  }

  if($type==0)
  {
    //$type = "Könyv";
    mysqli_query(Connect(), "INSERT INTO books(books_name, books_author, books_date)
    values('$show_name', '$author_name', '$release')");
    header('Refresh: 1;');
  }

  elseif($type==1)
  {
    //$type = "Film";
  }

  elseif($type==2)
  {
    //$type = "Sorozat";
  }

  elseif($type==3)
  {
    //$type = "Anime";
  }

  elseif($type==4)
  {
    //$type = "Dráma";
  }
 
  
  if ($error==false) { ?>

    <div class="alert alert-success">
      <?php
      echo "Sikeresen hozzá lett adva az új műsor!";
      ?>
    </div>
  <?php

    $fileCreate = fopen('./include/database/'.$show_name.'.php','w+');
    
    $fileContents = file_get_contents("./src/template.txt");
    $fileHandle = fopen('./include/database/'.$show_name.'.php', "r+");
    fputs($fileHandle, $fileContents);
    fclose($fileHandle);
    fclose($fileCreate);


    }
    
}
  
?>


<form method="POST">
  <div class="mb-3">
    <label for="add-show-name" class="form-label">Műsor neve:</label>
    <input type="text" name="show-name" class="form-control" id="add-show-name" aria-describedby="emailHelp">
  </div>
<br>
  <div class="mb-3">
  <label for="add-show-name" class="form-label">Típusa:</label>
  <div class="d-flex justify-content">
    <span class="pe-3 ps-5">Könyv</span><input type="checkbox" name="book">
    <span class="pe-3 ps-5">Film</span><input type="checkbox" name="movie">
    <span class="pe-3 ps-5">Sorozat</span><input type="checkbox" name="tv-show">
    <span class="pe-3 ps-5">Anime</span><input type="checkbox" name="anime">
    <span class="pe-3 ps-5">Dráma</span><input type="checkbox" name="drama">
    </div>
  </div>
<br>
  <div class="mb-3 row">
    <div class="col">
  <label for="add-author" class="form-label">Szerző:</label>
    <input type="text" name="add-author" class="form-control" id="add-author" aria-describedby="emailHelp">
    </div>
    <div class="col">
    <label for="add-release-date" class="form-label">Megjelenés:</label>
    
    <input type="text" name="add-release-date" class="form-control" id="add-release-date" aria-describedby="emailHelp">
    </div>
  </div>
  <button type="submit" name="btn-add-show" class="btn btn-primary">Új műsor hozzáadása</button>
</form>
</div>