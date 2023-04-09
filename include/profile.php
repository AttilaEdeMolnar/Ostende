<script>
function redirectToPageProfile() {

    setTimeout(function() {
        location.href = './?p=profile';
    }, 2000);
    }
</script>

<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
$con = Connect();
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM user WHERE user_id = ".$user_id;
    $sql_result = mysqli_query($con,$sql);
    $user_old_datas = mysqli_fetch_array($sql_result);

if(isset($_POST['btn-edit']))
{
    $name_edit = $_POST['name-edit'];
    $name_edit_error = false;
    if($name_edit == $user_old_datas['user_name'])
    {
        ?>

            <div class="alert alert-danger container">
              <?php
              echo "Az új felhasználóneved nem egyezhet meg a régivel!";
              ?>
            </div>
          <?php
    }

    elseif(isset($name_edit))
    {
        $user_name_check = "SELECT * FROM user";
        $user_name_check_result = mysqli_query($con,$user_name_check);

        while ($user_name_check_array = mysqli_fetch_array($user_name_check_result) ) {
            
            if($user_name_check_array['user_name'] == $name_edit)
            {
                $name_edit_error = true;
            }
        }

        if($name_edit_error)
        {
            ?>

            <div class="alert alert-danger container">
              <?php
              echo "Ilyen felhasználónév már létezik!";
              ?>
              <script>
                redirectToPageProfile();
            </script>
            </div>
          <?php
        }

        else
        {

            if(empty($name_edit))
            {
                $name_edit = $user_old_datas['user_name'];
            }
            $new_name_change = true;
        }
        
    }


    $email_edit = $_POST['email-edit'];
    $email_edit = strip_tags($email_edit);
    $email_edit = htmlspecialchars($email_edit);

    if($email_edit == $user_old_datas['user_email'])
    {
        ?>

            <div class="alert alert-danger container">
              <?php
              echo "Az új emailed nem egyezhet meg a régivel!";
              ?>
              <script>
                redirectToPageProfile();
            </script>
            </div>
          <?php
    }

    else
    {
        $new_email_change = true;

        if(empty($email_edit))
        {
            $email_edit = $user_old_datas['user_email'];
        }
    }
    

    $new_password_submit = $_POST['submit-new-password'];
    $new_password_submit_again = $_POST['submit-new-password-again'];
    $new_password_error = false;
    $password_change = false;
    $new_password_change = false;

    if($new_password_submit_again != $new_password_submit)
    {
        $new_password_error = true;
        ?>

            <div class="alert alert-danger container">
              <?php
              echo "Az új jelszavak nem egyeznek meg!";
              ?>
              <script>
                redirectToPageProfile();
            </script>
            </div>
          <?php
    }

    elseif(strlen($new_password_submit_again)<8 && strlen($new_password_submit_again)>0)
    {
        ?>

            <div class="alert alert-danger container">
              <?php
              echo "Az új jelszónak minimum 8 karakter hosszúnak kell lennie!";
              ?>
              <script>
                redirectToPageProfile();
            </script>
            </div>
          <?php
    }

    else
    {
        $password_change = true;
    }

    $old_password_submit = $_POST['submit-old-password'];
    $old_password_error = false;

    if(empty($old_password_submit))
    {
        $old_password_error = true;

        ?>

            <div class="alert alert-danger container">
              <?php
              echo "A jelenlegi jelszavad üresen hagytad!";
              ?>
              <script>
                redirectToPageProfile();
            </script>
            </div>
          <?php
    }

    if($old_password_error == false)
    {
        $old_password = md5($old_password_submit);

        if($old_password != $user_old_datas['user_password'])
        {

            ?>

            <div class="alert alert-danger container">
              <?php
              echo "Hibás jelenlegi jelszó!";
              ?>
              <script>
                redirectToPageProfile();
            </script>
            </div>
          <?php
        }

        elseif($password_change)
        {
            $new_password = md5($new_password_submit);

            if($new_password==$user_old_datas['user_password'])
            {
                ?>

            <div class="alert alert-danger container">
              <?php
              echo "Az új jelszavad nem egyezhet meg a régivel!";
              ?>
              <script>
                redirectToPageProfile();
            </script>
            </div>
          <?php
            }

            else
            {
                $new_password_change = true;
                if(empty($new_password_submit))
                {
                    $new_password = $user_old_datas['user_password'];
                    
                }
            }
        }


        
    }


    if($new_password_change && $new_email_change && $new_name_change)
        {
            $sql_new = "UPDATE user SET user_email = '$email_edit', user_password = '$new_password', user_name = '$name_edit' WHERE user_id = '$user_id' ";
            mysqli_query($con,$sql_new);

            ?>
            <script>
                redirectToPageProfile();
            </script>

            <div class="alert alert-success container">
              <?php
              echo "Az adatok sikeresen módosultak!";
              ?>
            </div>
            <?php

        }
    
}
?>


<div class="container">
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Figyelem!</strong> Csak abba a mezőbe kell adatot beírnod amit módosítani szeretnél (kivéve a jelenlegi jelszó megadásánál, mert az kötelező).
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<br>
    <div class="col-sm-5 container">
        <img src="./img/user.png" alt="user.png" class="UserProfile">
        <br>
        <p class="text-center fw-bold fs-1"><?php echo $user_old_datas['user_name']; ?></p>
        <br>
        <br>
        <form method="POST">
        <input type="text" name="name-edit" class="form-control" placeholder="Név módosítása...">
        <br>
        <input type="email" name="email-edit" class="form-control" placeholder="Email cím módosítása...">
        <p class="bigBr"></p>
        <input type="password" name="submit-new-password" class="form-control" placeholder="Jelszó módosítása...">
        <br>
        <input type="password" name="submit-new-password-again" class="form-control" placeholder="Jelszó módosítása újra...">
        <p class="biggerBr"></p>
        <input type="password" name="submit-old-password" class="form-control" placeholder="Jelenlegi jelszó...">
        <br>
        <br>
            <div class="text-center">
                <button type="submit" name="btn-edit" value="" class="btn btn-warning btn-md">Adatok módosítása</button>
            </div>
            </form>
    </div>
</div>