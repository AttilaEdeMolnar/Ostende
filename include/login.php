<?php
// Változók
$con = Connect();
$error = false;
$succes_login=false;

// Adatok ellenőrzése
if(isset($_POST["btn-login"]))
{
  $username = $_POST["login-user"];
  $password = $_POST["login-pass"];

  if(empty($username) or empty($password))
  {
    $msg = "Hibás adatok. Ellenőrizd, hogy megfelelő jelszót adtál meg!";
    $error = true;
  }

  // Ha nincs hiba akkor az adatbázisból lekérjük a felhasználó adatait
  if(!$error)
  {
    $password = md5($password);
    $db = "SELECT * from user where user_name='$username' and user_password='$password'";
    if (mysqli_query($con,$db)) 
    {
      $sucess_login = true;
      
      $result = mysqli_query($con, "SELECT user_id from user WHERE user_name = '$username' and user_password='$password'");
      $current_user_id = $result;
      while($row = mysqli_fetch_array($result)) 
        {
          $_SESSION['user_id'] = $row['user_id'];
          $msg_success_login = "Sikeres bejelentkezés!";
          header('Refresh: 1; url= ./?p=show_search');
        }

    }
    else 
    {
      $error=true;
      $msg = "Hibás adatok. Ellenőrizd, hogy megfelelő jelszót adtál meg!";
    }
  }
}
?>

<div class="container">
  <div class="row ">

  <?php
  if (isset($msg)) { ?>

    <div class="alert alert-danger">
      <?php
      echo $msg;
      ?>
    </div>
  <?php

  }
  ?>

<?php
  if (isset($msg_success_login)) { ?>

    <div class="alert alert-success">
      <?php
      echo $msg_success_login;
      ?>
    </div>
  <?php

  }
  ?>



  
<?php
$register_error = false;
if(isset($_POST['btn-register'])){

    $register_username = $_POST['register_username'];
    $register_username = strip_tags($register_username);
    $register_username = htmlspecialchars($register_username);

    $register_email = $_POST['register_email'];
    $register_email = strip_tags($register_email);
    $register_email = htmlspecialchars($register_email);

    $register_password = $_POST['register_password'];
    $register_password = strip_tags($register_password);
    $register_password = htmlspecialchars($register_password);

    $aszf_checkbox = isset($_POST['aszf_checkbox']);


    if(empty($register_username)){
        $register_error = true;
        $register_msg_username = 'Kérlek add meg a felhasználóneved!';
    }

    if(!filter_var($register_email, FILTER_VALIDATE_EMAIL)){
        $register_error = true;
        $register_msg_email = 'Kérlek add meg a működő email címed!';
    }

    if(empty($register_password)){
        $register_error = true;
        $register_msg_password = 'Kérlek add meg a jelszavad!';
    }elseif(strlen($register_password) < 8){
        $register_error = true;
        $register_msg_password = 'A jelszó minimum 8 karakteres.';
    }

    if(empty($aszf_checkbox))
    {
      $register_error = true;
      $register_msg_aszf_checkbox = 'Kérjük fogadja el az Általános Szerződési Feltételeket!';
    }


    $register_password = md5($register_password);

    if(!$register_error){
        $sql = "INSERT INTO user(user_name, user_email, user_password,user_type)
                values('$register_username', '$register_email', '$register_password',0)";
        if(mysqli_query($con, $sql)){
            $msg_success_register = 'Sikeres regisztráció.';
        }else{
            echo 'Error '.mysqli_error($con);
        }
    }

}
?>




    <div class="col">
    <h2 class="text-center">Bejelentkezés</h1>
  <p class="BiggerBr"></p>
<form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Felhasználónév</label>
    <input type="text" name="login-user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="login-pass" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" name="btn-login" class="btn btn-primary">Bejelentkezés</button>
</form>
    </div>

    
    <p class="BiggerBr"></p>
    <p class="BiggerBr"></p>
    <p class="BiggerBr"></p>
    <h1 class="text-center">Nincs fiókod?</h1>



    
    </div>
    <div class="row">
    <div class="col">
    <h2 class="text-center">Regisztráció</h1>

    <?php
  if (isset($msg_success_register)) { ?>

    <div class="alert alert-success">
      <?php
      echo $msg_success_register;
      ?>
    </div>
  <?php

  }
  ?>

<?php
  if (isset($register_msg_username)) { ?>

    <div class="alert alert-danger">
      <?php
      echo $register_msg_username;
      ?>
    </div>
  <?php

  }
  ?>

<?php
  if (isset($register_msg_email)) { ?>

    <div class="alert alert-danger">
      <?php
      echo $register_msg_email;
      ?>
    </div>
  <?php

  }
  ?>

<?php
  if (isset($register_msg_password)) { ?>

    <div class="alert alert-danger">
      <?php
      echo $register_msg_password;
      ?>
    </div>
  <?php

  }
  ?>

<?php
  if (isset($register_msg_aszf_checkbox)) { ?>

    <div class="alert alert-danger">
      <?php
      echo $register_msg_aszf_checkbox;
      ?>
    </div>
  <?php

  }
  ?>


  <p class="BiggerBr"></p>
<form method="POST">
<div class="mb-3">
    <label class="form-label">Felhasználónév</label>
    <input type="text" class="form-control" name="register_username">
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" name="register_email">
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" name="register_password">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="aszf_checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" name="aszf_check" for="exampleCheck1">ÁSZF</label>
  </div>
  <button type="submit" class="btn btn-primary" name="btn-register">Regisztráció</button>
</form>
</div>
</div>
</div>
</div>

<p class="biggerBr"></p>
<p class="biggerBr"></p>

<?php
$con=null;
?>