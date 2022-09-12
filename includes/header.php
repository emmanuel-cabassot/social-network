<?php
session_start();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>La Plateforme_ Network</title>
  <meta name="description" content="Reseau Social pour La Plateforme_." />
  <meta name="keywords" content="stories, posts, social network, followers, réseau social, La Plateforme_, plateformeurs" />
  <meta name="author" content="Denis Farkas Emmanuel Cabassot Thuc-nhi Wiedenhofer" />
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
  <link href="../assets/css/dropzone.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../assets/css/sendPost.css">
  <link rel="stylesheet" href="../assets/css/showPostsMur.css">
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/dropzone.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class=" min-vh-100">
  <!DOCTYPE html>
  <html lang="fr">

  <header class="headerScreen">
    <nav class="navbar navbar-expand-xl navbar-light bg-light">
      <a class="navbar-brand" href="#"><img src="../assets/images/logo.png" alt="logo" class="logo-img-thumb"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor01">
        <input class="form-control mr-sm-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-9" type="text" name="main-search" id="main-search" placeholder="Nom du contact">
        <div id="search-show">
          <div class="nav nav-pills navbar-light flex-column">
            <div class="search-result"></div>
          </div>
        </div>
        <ul class="navbar-nav ml-auto display-5">
          <?php
          if ($_SESSION['role'] == "admin") {
          ?>
            <li class="nav-item active">
              <a class="nav-link" href="crudAdm.php"><i class="bi bi-award-fill mr-2"></i><span>Admin</span></a>
            </li>
          <?php
          }
          ?>
          <li class="nav-item active">
            <a class="nav-link" href="home.php"><i class="bi bi-house mr-3 blue"></i><span>Home</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="filActualite.php"><i class="bi bi-bricks mr-2"></i><span>Fil d'acutalité</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-camera-video mr-3 blue"></i><span>Story</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profil.php"><i class="bi bi-person-circle mr-3 blue"></i><span>Profil</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right mr-2"></i><span>Déconnexion</span></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>