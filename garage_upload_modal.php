<script>
 // close all modal
 $(document).on('click','.modal .close',function () {
        $(".modal, .modal-backdrop").removeClass("open");
    });

   Dropzone.autoDiscover = false;
                   
   $(".dropzone").dropzone({
   addRemoveLinks: true,
   uploadMultiple: false,
   maxFilesize:1, //MB
   acceptedFiles: ".png, .jpeg, .jpg, .gif",
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

<style>

.modal,
.modal-backdrop {
	display: none;
}

.modal.open,
.modal-backdrop.open {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
}

.modal {
	display: none; /* Hidden by default */
	padding-top: 100px; /* Location of the box */
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.modal-dialog{margin:auto;}
.modal-content {
	position: relative;
	margin: auto;
	animation-name: animatetop;
	animation-duration: 0.4s
}

@keyframes animatetop {
	from {top:-300px; opacity:0}
	to {top:0; opacity:1}
}



</style>

<div class="modal-backdrop" aria-hidden="true"></div>

<!--Modal Create Folder -->
<div class="modal">
    <div class="modal-dialog" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="modal-header">
                <a aria-label="Close" class="close">
                    <clr-icon aria-hidden="true" shape="close"></clr-icon>
                </a>
                <h3 class="modal-title">Ajouter votre image de profil</h3>
                <h4 class="modal-title"> (.jpg, .png, .gif inférieur à 1MB)</h4>
                <h5><i>Optionnel mais conseillé...</i></h5>
            </div>
            <div class="modal-body">
                <div class='content'>
                    <form action="upload.php" class="dropzone" id="dropzonewidget">
                
                    </form> 
                </div>
            </div> 
        </div>
    </div>    
</div>        