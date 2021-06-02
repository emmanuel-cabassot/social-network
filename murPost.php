<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/showPost.css">
    <script src="assets/js/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <main>
        <section class="murPost">
           
        </section>

    </main>
    <input type="hidden" id="idUser" value=<?= $_SESSION['id_user'] ?>>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="murPost.js"></script>

</body>

</html>