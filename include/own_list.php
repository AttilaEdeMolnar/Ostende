<div class="container">
  <div class="d-flex justify-content-center">
    <input class="search_input" type="text" name="search" placeholder="Keresés...">
  </div>
  <form method="POST">
    <table class="table background">
      <thead>
        <tr>
          <th scope="col">Cím</th>
          <th scope="col">Szerző</th>
          <th scope="col">Megjelenés</th>
          <th scope="col">Értékelés</th>
          <th scope="col">Vélemény</th>
          <th scope="col">Törlés</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $current_id = $_SESSION['user_id'];
        $result = mysqli_query($con = Connect(), "SELECT * FROM finished_books WHERE finished_books_user_id = $current_id");
        while ($row = mysqli_fetch_array($result)) {
          $books_id = $row['finished_books_books_id'];
          $sql_own = "SELECT * FROM books WHERE books_id ='$books_id'";
          $result_own = mysqli_query($con, $sql_own);
          $sql_own_result = mysqli_fetch_array($result_own);
        ?>
          <tr>
            <td><?php echo $sql_own_result['books_name']; ?><br></td>
            <td><?php echo $sql_own_result['books_author']; ?><br></td>
            <td><?php echo $sql_own_result['books_date']; ?><br></td>
            <td><?php echo "⭐".$row['finished_books_rating']."/10"; ?><br></td>
            <td><?php echo $row['finished_books_opinion']; ?><br></td>
            <td>
              <button type="submit" name="btn-delete" value="<?php echo $books_id; ?>" class="btn btn-danger btn-sm">Törlés</button>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <?php
      if(isset($_POST['btn-delete'])) {
        $delete_id = $_POST['btn-delete'];
        // Törlési műveletek végrehajtása
        
        $sql_delete = "DELETE FROM finished_books WHERE finished_books_books_id = '$delete_id'";
        mysqli_query($con,$sql_delete);
        header('Refresh: 1;');
      }
    ?>
  </form>
</div>
