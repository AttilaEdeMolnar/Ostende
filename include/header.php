<!DOCTYPE html>
<html lang="hu" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ostende</title>

  <!--Bootstrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!--Bootstrap Javascript-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!--myStyle (CSS)-->
  <link rel="stylesheet" href="./css/myStyle.css">
</head>

<body class="background">
  <header class="sticky-top">
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="#">
    <img src="./img/eye.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
      Ostende</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarDown">
      <ul class="navbar-nav container">
      <?php
      if(!isset($_SESSION['user_id']))
      {
      ?>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./">Főoldal</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./?p=login">Bejelentkezés</a>
      </li>
      <?php
      }
      ?>
      <?php
      if(isset($_SESSION['user_id']))
      {
      ?>

      <?php
      $sessionUserID =$_SESSION['user_id'];
      $result = mysqli_query(Connect(), "SELECT user_type FROM user WHERE ".$sessionUserID."=user_id");
      $fetch = mysqli_fetch_array($result);
      if($fetch[0]==1)
      {
      ?>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./?p=admin">Admin</a>
      </li>
      <?php
      }
      ?>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle nav-link active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tartalmak
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./?p=animes">Animék</a></li>
            <li><a class="dropdown-item" href="./?p=dramas">Drámák</a></li>
            <li><a class="dropdown-item" href="./?p=movies">Filmek</a></li>
            <li><a class="dropdown-item" href="./?p=books">Könyvek</a></li>
            <li><a class="dropdown-item" href="./?p=tvshows">Sorozatok</a></li>
          </ul>
        </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./?p=own_list">Saját lista</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./?p=profile">Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./?p=logout">Kijelentkezés</a>
      </li>
      <?php
      }
      ?>
      </ul>
    </div>
  </div>
</nav>
  </header>
  <p class="bigBr"></p>