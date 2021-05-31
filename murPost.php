<?php
session_start();
$_SESSION['user']['id'] = 1;
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
        <section class="showPost">
            <section class="header-showPost">
                <section class="user-showPost">
                
                </section>
                <section class="modify-showPost">
                </section>
            </section>
            <section class="text-showPost">
            
            </section>
            <section class="media-showPost">
            
            </section>
            <section class="stat-showPost">
                <section class="like-stat-showPost">
                </section>
                <section class="comment-stat-showPost">
                </section>
            </section>
            <section class="action-showPost">
                <section class="like-action-showPost">
                </section>
                <section class="comment-action-showPost">
                </section>
            </section>
            <section class="comment-showPost">
                <section class="add-comment-showPost">
                </section>
                <section class="view-comment-showPost">
                    <section class="user-photo-comment-showPost">
                    </section>
                    <section class="user-name-text-showPost">
                        <section class="user-name-showPost">
                        </section>
                        <section class="text-comment-showPost">
                        </section>
                    </section>
                </section>
            </section>

        </section>

    </main>
    <input type="hidden" id="idUser" value=<?= $_SESSION['user']['id'] ?>>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="murPost.js"></script>

</body>

</html>