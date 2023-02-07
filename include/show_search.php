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
            </tr>
         </thead>
         <tbody>
            <?php
            $result = mysqli_query($con = Connect(), "SELECT * FROM books");
            while ($row = mysqli_fetch_array($result)) {
            ?>
               <tr>
                <td>
                    <img class="picture" src="<?php echo $row['books_picture']; ?>"/>
                  </td>
                  <td>
                     <?php echo $row['books_name']; ?><br>
                  </td>
                  <td>
                     <?php echo $row['books_author']; ?><br>
                  </td>
                  <td>
                     <?php echo $row['books_date']; ?><br>
                  </td>
               </tr>
            <?php
            }
            ?>
         </tbody>
      </table>
</div>