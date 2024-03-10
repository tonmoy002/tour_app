$(document).ready(function() {
     $('.js-example-basic-multiple').select2();
    // $(".file-upload").on("click",function(){
    //     $(this).closest('.form-group').find('.file-upload-default').trigger('click');
    // });
    $('.delete-btn').on("click",function(e){
    	var r = confirm('Are u sure?');
    	if(r){
    		return true;
    	}
    	return false;

    });
    $('.date-pick').datepicker({
      format: 'yyyy-mm-dd',
      autoHide: true,
    });
});