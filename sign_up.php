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
                        <div class="form-group">               
                            <input type="text" class="form-control w-75" placeholder="Image avatar name" name="avatar" required>                
                        </div>
                        <div class="form-group">               
                            <input type="text" class="form-control w-75" placeholder="Banner name" name="banner" required>                
                        </div>
                        <input type="hidden" name="creation" value="<?php echo date('Y-m-d'); ?>">
    
                    <div id="resultat"></div>
                        <button type="submit" class="btn btn-primary w-75">Inscription</button>
                    </fieldset>
                </form>
                
            </div>
            <div class="col-xl-4 col-sm-12">
            <div class='content'>
                <form action="upload.php" class="dropzone" id="dropzonewidget">
            
                </form> 
            </div> 
               <script type="text/javascript">
                    Dropzone.autoDiscover = false;
                   
                    $(".dropzone").dropzone({
                    addRemoveLinks: true,
                    removedfile: function(file) {
                    var name = file.name; 
   
                    $.ajax({
                        type: 'POST',
                        url: 'upload.php',
                        data: {name: name,request: 2},
                        sucess: function(data){
                            console.log('success: ' + data);
                        }
                    });
                    var _ref;
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                    }
                    });
               </script>
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

