<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

$con = Connect();
if(empty($_POST['search']))
{
    $sql_main = "SELECT * FROM movies";
}

elseif(isset($_POST['search']) && !empty($_POST['search']))
{
    $search = $_POST['search'];
    $sql_main = "SELECT * FROM movies WHERE movies_name LIKE '%$search%' OR movies_director LIKE '%$search%' OR movies_date LIKE '%$search%'";
}

$result = mysqli_query($con,$sql_main);

$sql_user_id = "SELECT * FROM user WHERE user_id = ".$_SESSION['user_id'];
$sql_user_id_result = mysqli_query($con,$sql_user_id);
$sql_user_id_array = mysqli_fetch_array($sql_user_id_result);

?>
<script>
        function redirectToPage() {
            location.href = './?p=movies';
            }
    </script>
<div class="container">
    <form method="POST">
    <div class="col-sm-4 container">
    <input type="text" name="search" class="form-control" placeholder="Keresés...">
    </div>
    <br>
    </form>
    <form method="POST">
    <div class="table-responsive">
    <table class="table background">
        <thead>
            <?php
            if($sql_user_id_array['user_type']==1)
            {
            ?>
            <th scope="col">ID</th>
            <?php
            }
            ?>
            <th scope="col">Borító</th>
            <th scope="col">Cím</th>
            <th scope="col">Rendező</th>
            <th scope="col">Megjelenés</th>
            <th scope="col">Saját oldal</th>
            <?php
            if($sql_user_id_array['user_type']==1)
            {
            ?>
            <th scope="col">Szerkesztés</th>
            <?php
            }
            ?>
            <?php
            if($sql_user_id_array['user_type']==1)
            {
            ?>
            <th scope="col">Törlés</th>
            <?php
            }
            ?>
        </thead>
        <tbody>
            <?php
            while($row = mysqli_fetch_array($result))
            {
            ?>
            <tr>
            <?php
            if($sql_user_id_array['user_type']==1)
            {
            ?>
                <td><?php echo $row['movies_id']; ?></td>
                <?php
            }
            ?>
                <td><?php $movies_pic =
                    '<img src="./img/movies.png" alt="movies">';
                    echo $movies_pic; ?></td>
                <td><?php echo $row['movies_name']; ?></td>
                <td><?php echo $row['movies_director']; ?></td>
                <td><?php echo $row['movies_date']; ?></td>
                <td><a type="submit" name="btn-finished" class="btn btn-primary btn-sm" href="./?p=movies_page&id=<?php echo $row['movies_id'];?>">Megnyitás</a></td>
                <?php
            if($sql_user_id_array['user_type']==1)
            {
            ?>
                <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#<?php echo $row['movies_id']; ?>">Szerkesztés</button>
                
              
                <div class="modal fade" id="<?php echo $row['movies_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    <td>Cím:</td>
                                    <td><?php echo $row['movies_name'];?></td>
                                    <td><input type="text" name="new-name-<?php echo $row['movies_id']?>" class="form-control" placeholder="Új cím..."></td>
                                </tr>
                                <tr>
                                    <td>Rendező:</td>
                                    <td><?php echo $row['movies_director']; ?></td>
                                    <td><input type="text" name="new-director-<?php echo $row['movies_id']?>" class="form-control" placeholder="Új rendező..."></td>
                                </tr>
                                <tr>
                                    <td>Megjelenés:</td>
                                    <td><?php echo $row['movies_date']; ?></td>
                                    <td><input type="text" name="new-date-<?php echo $row['movies_id']?>" class="form-control" placeholder="Új megjelenés..."></td>
                                </tr>
                                <tr>
                                    <td>Spoiler:</td>
                                    <td><?php echo $row['movies_spoiler']; ?></td>
                                    <td>
                                        <input class="form-control CustomInput3" name="new-spoiler-<?php echo $row['movies_id']?>" placeholder="Új spoiler..."></input>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                        <button type="submit" class="btn btn-warning" name="new-submit" value="<?php echo $row['movies_name'];?>¤¤<?php echo $row['movies_director'];?>¤¤<?php echo $row['movies_date'];?>¤¤<?php echo $row['movies_spoiler'];?>¤¤<?php echo $row['movies_id'];?>">Adatok felvitele</button>
                        
                        </div>
                        </div>
                    </div>
                </div>
                
                </td>
                <?php
            }
            ?>

                <?php
            if($sql_user_id_array['user_type']==1)
            {
            ?>
                <td>
                    <button type="submit" class="btn btn-danger" name="delete" value="<?php echo $row['movies_id'] ?>">Törlés</button>
                </td>
            </tr>
            <?php
            }
            ?>
            
            <?php
            }
            ?>

            <?php

if(isset($_POST['new-submit']))
{
    $old_values = $_POST['new-submit'];
    $old_values = explode("¤¤",$old_values);
    $id = $old_values[4];
    
    $new_values = array($_POST["new-name-".$id],$_POST["new-director-".$id],$_POST["new-date-".$id],$_POST["new-spoiler-".$id]);
    
    for ($i=0; $i < 4; $i++) { 
        if(empty($new_values[$i]))
        {
            $new_values[$i] = $old_values[$i]; 
        }
    }

    $sql = "UPDATE movies SET movies_name = '".$new_values[0]."', movies_director = '".$new_values[1]."', movies_date = '".$new_values[2]."', movies_spoiler = '".$new_values[3]."' WHERE movies_id = ".$old_values[4];
    mysqli_query($con,$sql);

    ?>
    <script>
        redirectToPage();
    </script>
    </form>
    <?php
}

if(isset($_POST['delete']))
{

    $sql_delete = "DELETE FROM movies WHERE movies_id = ".$_POST['delete'];
    mysqli_query($con,$sql_delete);
    ?>
    <script>
        redirectToPage();
    </script>
    <?php
}
?>
            
        </tbody>
    </table>
    </div>
</div>