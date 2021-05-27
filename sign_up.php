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
    <link href="assets/css/dropzone.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/dropzone.min.js" ></script>
</head>
<body>
    <main class="container mt-5">
        <div class="row d-flex align-items-center">
            <div class="col-xl-2"></div>
            <div class="col-xl-6 col-sm-12">
                <img src="assets/images/logo.png" class="w-50 ml-5 mb-5" alt="logo">   
                <p>*(Tous les champs sont requis)</p>
                <form id="formSignUp">
                    <fieldset>
                        <div class="form-group">               
                            <input type="email" class="form-control w-75" placeholder="Email" name="email" required>                
                        </div>
                        <div class="form-group">             
                            <input type="password" class="form-control w-75" placeholder="Password" name="password" required>                    
                        </div>
                        <div class="form-group">               
                            <input type="text" class="form-control w-75" placeholder="Name" name="name" required>                
                        </div>
                        <div class="form-group">               
                            <input type="text" class="form-control w-75" placeholder="LastName" name="lastname" required>                
                        </div>
                        <div class="form-group">               
                            <input type="text" class="form-control w-75" placeholder="City" name="city" required>                
                        </div>
                        <div class="form-group">               
                            <input type="text" class="form-control w-75" placeholder="Country" name="country" required>                
                        </div>
                        <div class="form-group">
                            <label for="birth" >Date de Naissance</label>               
                            <input type="date" class="form-control w-75"  id="birth" name="birth" required>                
                        </div>
                                       
                        <input type="hidden"   name="avatar" value="default.png">                        
                        <input type="hidden"   name="banner" value="defaultbanner.png">                
                        <input type="hidden" name="creation" value="<?php echo date('Y-m-d'); ?>">
    
                    <div id="resultat"></div>
                        <button type="submit" class="btn btn-primary w-75">Inscription</button>
                    </fieldset>
                </form>
                
            </div>
            
          
            <div class="col-xl-4 col-sm-12 mt-5">
                <figure class="figure">
                    <img src="assets/images/phone.png"  alt="mobile">
                </figure>  
            </div>
            
        </div>   
    </main>
    <footer id="footer">
          <div class="col-lg-12"> 
          </div>
      </footer>
    <script src="signup.js"></script>   
    <script src="assets/js/bootstrap.bundle.min.js"></script> 
</body>
</html>

