$(document).ready(function(){
    
    //EDITOR CKEDITOR
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );

    $('#selectAllBoxes').click(function(event){
        if(this.checked) {
            $('.checkBox').each(function() {
                this.checked = true;
            });
        } else {
            $('.checkBox').each(function() {
                this.checked = false;
            });
        }
    });
    
});