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
            <div class="col-xl-7 col-sm-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eventModal">
                Add event
                </button>

                <!-- Modal -->
                <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ajouter un event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="dropzone-form"  enctype="multipart/form-data" method="POST">
                                    <fieldset>
                                        <div class="form-group">               
                                            <input type="text" id="title_event" class="form-control w-75" placeholder="Titre" name="title_event" required />                
                                        </div>
                                        <div class="form-group">             
                                            <textarea class="form-control w-75" id="text_event" placeholder="Description" rows="" name="text_event" required></textarea>                    
                                        </div>
                                        <div class="form-group">             
                                            <input type="datetime-local" class="form-control w-75" id="date_event" placeholder="Date"  name="date_event" required />                
                                        </div>
                                        <div class="form-group">             
                                            <input type="text" class="form-control w-75" id="city_event" placeholder="Ville"  name="city_event" required />                
                                        </div>
                                        <div class="form-group">             
                                            <input type="text" class="form-control w-75" id="public_event" placeholder="public: oui ou non"  name="public_event" required />                
                                        </div>
                                        <div class="form-group" id="validForm"><div>    
                                        <input type="hidden" name="signalized" id="signalized" value="non"/>
                                        <input type="hidden" name="blocked" id="blocked" value="non"/>
                                        <div class="form-group">
                                            <div class="dropzone" id="dropzone"></div>     
                                        </div> 
                                                                                     
                                        <div class="form-group">
                                            <input type="submit" name="submitDropzone" value="Ajouter" id="submit-dropzone" class="btn btn-primary w-75" />
                                        </div>
                                          
                                    </fieldset>
                                </form>
                            </div>
                            <div class="modal-footer" id="footer"> 
                                
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <div id="listeEvents"></div>    
                </section>             
            </div>            
          
            <div class="col-xl-3 col-sm-12 mt-5">                
            </div>            
        </div>   
    </main>
    <footer id="footer">
          <div class="col-lg-12"> 
          </div>
      </footer>
    <script src="events.js"></script>   
    <script src="assets/js/bootstrap.bundle.min.js"></script> 
</body>
</html>