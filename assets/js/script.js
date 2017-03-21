 $('document').ready(function(){
     //Info box and session messages
     $('.info-box').delay(3000).slideUp(1000);

     //Form for image name editing
     $('.image-edit-name').hide();
     $('.image-edit-icon').click(function(){
         $('.image-edit-name').toggle(700);
     });
 });
