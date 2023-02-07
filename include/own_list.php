<div class="container">
      <div class="d-flex justify-content-center">
          <input class="search_input" type="text" name="search" placeholder="Keresés...">
    </div>
    <table class="table background">
         <thead>
            <tr>
                <th scope="col">Borító</th>
               <th scope="col">Cím</th>
               <th scope="col">Szerző</th>
               <th scope="col">Megjelenés</th>
               <th scope="col">Értékelés</th>
               <th scope="col">Vélemény</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $current_id = $_SESSION['user_id'];
            $result = mysqli_query($con = Connect(), "SELECT * FROM finished_books WHERE finished_books_user_id = $current_id");
            while ($row = mysqli_fetch_array($result)) {
            ?>
               <tr>
                <td>
                     <?php echo "ÜRES" ?><br>
                  </td>
                  <td>
                     <?php echo "ÜRES"; ?><br>
                  </td>
                  <td>
                     <?php echo "ÜRES"; ?><br>
                  </td>
                  <td>
                     <?php echo $row['finished_books_books_id']; ?><br>
                  </td>
                  <td>
                     <?php echo $row['finished_books_rating']; ?><br>
                  </td>
                  <td>
                     <?php echo $row['finished_books_opinion']; ?><br>
                  </td>
            <?php
            }
            ?>
         </tbody>
      </table>
</div>