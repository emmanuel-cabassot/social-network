<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Plateforme_ Network</title>
	<meta name="description" content="Reseau Social pour La Plateforme_." />
	<meta name="keywords" content="stories, posts, social network, followers, réseau social, La Plateforme_, plateformeurs" />
	<meta name="author" content="Denis Farkas Emmanuel Cabassot Thuc-nhi Wiedenhofer" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
    <main class="container mt-5">
        <div class="row d-flex align-items-center">
            <div class="col-xl-2"></div>
            <div class="col-xl-4 col-sm-12">
                <img src="assets/images/phone.png"  alt="mobile">
            </div>
            <div class="col-xl-6 col-sm-12">
                <img src="assets/images/logo.png" class="w-50 ml-5 mb-5" alt="logo">   
            <form id="formSignUp" class="form">
                <fieldset>         
                        <input type="email" class="form-control w-75" placeholder="Email"  name="email" required>                  
                        <input type="password" class="form-control w-75" placeholder="Password" name="password" required>                    
                   <div id="resultat"></div>
                    <button type="submit" class="btn btn-primary w-75">Connexion</button>
                </fieldset>
            </form>
            <fieldset>
                <p class="mt-3">Vous n'avez pas de compte? <a href="signUp.php">Inscrivez-vous</a></p>
            </fieldset> 
        </div>   
    </main>
    <footer id="footer">
          <div class="col-lg-12"> 
          </div>
      </footer>
    <script src="login.js"></script>   
    <script src="assets/js/bootstrap.bundle.min.js"></script> 
</body>
</html>

