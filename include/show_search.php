<?php
   $con = Connect();
   
   function User_ID()
   {
      $user_id = $_SESSION['user_id'];
   }
   
?>

<div class="container">
      <div class="d-flex justify-content-center">
          <input class="search_input form-control" type="text" name="search" placeholder="Keresés...">
          
    </div>
    <br>
    <div class="d-flex justify-content-center">
    <span class="pe-3">Összes</span><input type="checkbox" checked>
    <span class="pe-3 ps-5">Könyvek</span><input type="checkbox">
    <span class="pe-3 ps-5">Filmek</span><input type="checkbox">
    <span class="pe-3 ps-5">Sorozatok</span><input type="checkbox">
    <span class="pe-3 ps-5">Animék</span><input type="checkbox">
    <span class="pe-3 ps-5">Drámák</span><input type="checkbox">
    </div>
    <br>
    <table class="table background">
         <thead>
            <tr>
               <th scope="col">Cím</th>
               <th scope="col">Szerző</th>
               <th scope="col">Megjelenés</th>
               <th scope="col">Saját oldaluk</th>
            </tr>
         </thead>
         <tbody>
            <form method="POST">
            <?php
            $show_name; 

            $result = mysqli_query($con, "SELECT * FROM books ORDER BY books_name ASC");
            while ($row = mysqli_fetch_array($result)) {
            ?>
               <tr>
                  <td>
                     <?php 
                     $show_name = $row['books_name'];
                     echo $row['books_name']; ?><br>
                  </td>
                  <td>
                     <?php echo $row['books_author']; ?><br>
                  </td>
                  <td>
                     <?php echo $row['books_date']; ?><br>
                  </td>
                  <td>
                     <a type="submit" name="btn-finished" class="btn btn-primary btn-sm" href="./?p=<?php echo $show_name; ?>">
                       Megnyitás
                     </a>
                  </td>
               </tr>
            <?php
            }
            ?>
            </form>
         </tbody>
      </table>
</div>