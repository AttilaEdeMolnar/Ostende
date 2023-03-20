<?php
$con = Connect();

// $_SERVER[PHP_SELF]
?>
<div class="container">
<!--<img class="picture_page" src="<?php// echo $pic['books_picture']; ?>"/>-->
<br>
<div class="text-center display-5">
<h1>📊 Adatok</h1>
<br>
<div class="d-flex justify-content-center">
<table class="table p-5">
<tr>
    <th scope="col">Cím:</th>
    <th scope="col">Szerző:</th>
    <th scope="col">Megjelenés:</th>
</tr>
<tr>
    <td>

<?php
$db_books_name = $_GET['t'];

echo $db_books_name;
?>
    </td>
    <td>
    <?php
        echo $_GET['a'];
        ?>
    </td>
    <td>
    <?php
        echo $_GET['d'];
        ?>
    </td>
</tr>
</table>
<br>
<p class="biggerBr"></p>
</div>
</div>
<button class="btn btn-danger mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#reminder" aria-expanded="false" aria-controls="collapseExample">
    Emlékeztető (SPOILER)
  </button>

  <div class="collapse" id="reminder">
  <div class="card card-body">
A Tót család és az őrnagy kalandos történetük.
</div>
</div>
<p class="biggerBr"></p>
<?php
if(isset($_POST['own-list-button']))
{
 $userid = $_SESSION['user_id'];
 $rating = $_POST['rating'];
 $opinion = $_POST['opinion'];

 echo $userid;
 echo $rating;
 echo $books_id;
 echo $opinion;


 $sql = "INSERT INTO finished_books(finished_books_user_id, finished_books_books_id, finished_books_rating, finished_books_opinion)
                values('$userid', '$books_id', '$rating','$opinion')";
  mysqli_query($con, $sql);

?>
  <div class="alert alert-success">
      <?php
      echo $msg_success_register;
      ?>
    </div>
    <?php
  }

  ?>
<form method="POST">
<div class="text-center display-5">
<h1>Elolvastad?</h1>
<br>
<div class="input-group mb-3">
  <div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupSelect01">Értékelés</label>
  <select class="form-select" id="inputGroupSelect01" name="rating">
    <option selected>Válassz...</option>
    <option value="1">⭐1/10</option>
    <option value="2">⭐2/10</option>
    <option value="3">⭐3/10</option>
    <option value="4">⭐4/10</option>
    <option value="5">⭐5/10</option>
    <option value="6">⭐6/10</option>
    <option value="7">⭐7/10</option>
    <option value="8">⭐8/10</option>
    <option value="9">⭐9/10</option>
    <option value="10">⭐10/10</option>
  </select>
</div>
</div>
<div class="input-group mb-3">
  <span class="input-group-text" id="inputGroup-sizing-default" name="opinion">Vélemény</span>
  <input type="text" class="form-control" name="opinion" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
</div>

<button type="submit" class="btn btn-warning" name="own-list-button">Hozzáadás a saját listához</button>
</form>


</div>
</div>