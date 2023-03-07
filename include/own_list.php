<div class="container">
      <div class="d-flex justify-content-center">
          <input class="search_input" type="text" name="search" placeholder="Keresés...">
    </div>
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
            ?>
               
                     <?php
                     $books_id = $row['finished_books_books_id'];
             
                     $sql_own = "SELECT * FROM books WHERE books_id ='$books_id'";
                     $result = mysqli_query($con, $sql_own);
                     $sql_own_result = mysqli_fetch_array($result);
                     ?>
                     <tr>
                  <td>
                     <?php
                     echo $sql_own_result['books_name'];
                     ?><br>
                  </td>
                  <td>
                     <?php
                     echo $sql_own_result['books_author'];
                     ?><br>
                  </td>
                  <td>
                     <?php echo $sql_own_result['books_date']; ?><br>
                  </td>
                  <td>
                     <?php echo "⭐".$row['finished_books_rating']."/10"; ?><br>
                  </td>
                  <td>
                     <?php echo $row['finished_books_opinion']; ?><br>
                  </td>
                  <td>
                     <a href="https://hvg.hu"> <?php echo '❌'; ?></a>
                  </td>
            <?php
            }
            ?>
         </tbody>
      </table>
</div>