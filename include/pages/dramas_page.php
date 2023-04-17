<?php
$con = Connect();

// $_SERVER[PHP_SELF]
$id = $_GET['id'];
$sql = "SELECT * FROM dramas WHERE dramas_id = '$id'";
$result = mysqli_fetch_array(mysqli_query($con,$sql));
?>
<script>
        function redirectToPage() {
            setTimeout(function() {
              location.href = "./?p=dramas_page&id=<?php echo $id ?>";
            }, 2000);
            }
    </script>
<div class="container">
<?php
if(isset($_POST['own-list-button']))
{
  $own_value = array($_POST['rating'],$_POST['opinion'],$_SESSION['user_id'],$id);

  $sql_add = "INSERT INTO finished_dramas (finished_dramas_user_id, finished_dramas_dramas_id, finished_dramas_rating, finished_dramas_opinion) VALUES (".$own_value[2].", ".$own_value[3].", ".$own_value[0].", '".$own_value[1]."')";
  mysqli_query($con,$sql_add);
  ?>
  <br>
  <br>
<div class="alert alert-success">
  <?php echo "Sikeresen hozzá lett adva a saját listádhoz ez a dráma!"; ?>
</div>
<script>
        redirectToPage();
      </script>
  <?php
}

?>
<!--<img class="picture_page" src="<?php// echo $pic['books_picture']; ?>"/>-->
<br>
<div class="text-center display-5">
<h1>📊 Adatok</h1>
<br>
<div class="d-flex justify-content-center">
<div class="table-responsive">
<table class="table p-5">
<tr>
    <th scope="col">Cím:</th>
    <th scope="col">Rendező:</th>
    <th scope="col">Megjelenés:</th>
</tr>
<tr>
    <td>

<?php
echo $result['dramas_name'];
?>
    </td>
    <td>
    <?php
echo $result['dramas_director'];
?>
    </td>
    <td>
    <?php
echo $result['dramas_date'];
?>
    </td>
</tr>
</table>
</div>
<br>
<p class="biggerBr"></p>
</div>
</div>
<button class="btn btn-danger mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#reminder" aria-expanded="false" aria-controls="collapseExample">
    Emlékeztető (SPOILER)
  </button>

  <div class="collapse" id="reminder">
  <div class="card card-body">
    <?php
    echo $result['dramas_spoiler'];
    ?>
</div>
</div>
<p class="biggerBr"></p>
<form method="POST">
<div class="text-center display-5">
<h1>Megnézted?</h1>
<br>
<div class="input-group mb-3">
  <div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupSelect01">Értékelés ⭐</label>
  <select class="form-select" id="inputGroupSelect01" name="rating">
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