<?php require("../includes/header.php") ?>

    <main class="container-fluid mt-1" id="mainCrudAdmin">
        <div class="row d-flex">
            <section class="tabs-admin">
                <ul class="list">
                    <li class="tab active" data-target="#user">
                        Membres
                    </li>
                    <li class="tab" data-target="#listPosts">
                        Posts
                    </li>
                    <li class="tab" data-target="#listComments">
                        Commentaires Posts
                    </li>
                </ul>
            </section>
            <div class="col-xl-12 col-sm-12">
                <section class="user content" id="user">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-active">
                                <th scope="col">ID</th>
                                <th scope="col">Lastname</th>
                                <th scope="col">Firstname</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Change</th>
                                <th scope="col">Blocked</th>
                                <th scope="col">Until Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="listUsers">
                        </tbody>
                    </table>
                </section>
            </div>
            <section id="listPosts" class="listPosts content hidden col-xl-12 col-sm-12 "></section>
            <section id="listComments" class="listComments content hidden col-xl-12 col-sm-12 "></section>
        </div>
    </main>
    <footer id="footer">
        <div class="col-lg-12">
        </div>
    </footer>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/search.js"></script>
    <script src="../assets/js/admUsers.js"></script>
    <script src="../assets/js/admPosts.js"></script>
    <script src="../assets/js/admCommentsPosts.js"></script>
    <script src="../assets/js/adm.js"></script>
</body>

</html>