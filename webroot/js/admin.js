$(document).ready(function(){

	$('.name_sp').change(function(){
		var value = $(this).val();
		$.get( full_url +"products/replacename/" + value, function(data){
	    	$('.name_key').val(data);
	  	});
	});	


	if($('#mytextarea').length > 0){
	tinymce.init({
        selector: '#mytextarea',
        paste_data_images: true,
        plugins: [
          'advlist','autolink',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'fullscreen','insertdatetime','media','table','help','wordcount','paste'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
      });
	}

	$('#btn_save').click(function(){
		button = $(this);
	    button.addClass('disabled');
	    $('#mytextarea').val(tinyMCE.activeEditor.getContent());
		var thisBtn = $(this);
    	var thisForm = thisBtn.closest("form");
		var formData = new FormData(thisForm[0]);
	    $.ajax({
	        type: "POST",
	        url: full_url + "products/save",
	        data: formData,
	        processData: false,
	        contentType: false,
	        success:function(data){
	           var json = $.parseJSON(data);
		        if ( json.result == 1 )
		        {
					window.location = full_url + "admin";
		        	
		        }
		        else
		        {
		            button.removeClass('disabled');
		            $(".error-message").show();
		            $(".error-message").html(json.message);
		        }
	        }
	    });
	});

	$('.remove_img_old').click(function(){
		    	var id = $(this).data('id');
		    	var value = $(this).data('value');
		    	var ol_ids = $('#images_remove').val();
	            if(ol_ids == ''){
	                	$('#images_remove').val(value);
	            }else{
	                	$('#images_remove').val(ol_ids + ',' + value);
	            }

	            $('.remove_img_old_'+id).remove();

	            
	});

$('#btn_save_cate').click(function(){
		button = $(this);
	    button.addClass('disabled');
		var thisBtn = $(this);
    var thisForm = thisBtn.closest("form");
		var formData = new FormData(thisForm[0]);
	    $.ajax({
	        type: "POST",
	        url: full_url + "categories/save",
	        data: formData,
	        processData: false,
	        contentType: false,
	        success:function(data){
	           var json = $.parseJSON(data);
		        if ( json.result == 1 )
		        {
					window.location = full_url + "categories/admin";
		        	
		        }
		        else
		        {
		            button.removeClass('disabled');
		            $(".error-message").show();
		            $(".error-message").html(json.message);
		        }
	        }
	    });
	});


	$('.order_select').on('change', function(){
			let text = "Bạn có chắc muốn thay đổi trạng thái đơn hàng";
		  if (confirm(text) == true) {
		  		var status = this.value;
		  		var id = $(this).data('id');

		  		$.post(full_url + "carts/status",{"id":id,"status":status},function(data){
						var json = $.parseJSON(data);
						if ( json.result == 1 )
						{	
						
							alert('Cập nhật thành công');

						}
						else
						{
							alert(json.message);
						}
					});
		  }
	});


	$('.btn_login').click(function(){
		button = $(this);
	    button.addClass('disabled');
		var thisBtn = $(this);
    var thisForm = thisBtn.closest("form");
		var formData = new FormData(thisForm[0]);
	    $.ajax({
	        type: "POST",
	        url: full_url + "users/checklogin",
	        data: formData,
	        processData: false,
	        contentType: false,
	        success:function(data){
	           var json = $.parseJSON(data);
		        if ( json.result == 1 )
		        {
							window.location = full_url + "admin";
		        }
		        else
		        {
		            button.removeClass('disabled');
		            $(".error-message").show();
		            $(".error-message").html(json.message);
		        }
	        }
	    });
	});



});


function deleteProduct(id) {
  let text = "Bạn có chắc muốn xóa sản phẩm này";
  if (confirm(text) == true) {
     window.location = full_url + "products/delete/" + id;
  }
}




// category




	function deleteCategory(id) {
  let text = "Bạn có chắc muốn xóa";
  console.log(id);
  if (confirm(text) == true) {
     window.location = full_url + "categories/delete/" + id;
  }
}

function deleteContact(id) {
  let text = "Bạn có chắc muốn xóa liên hệ này ?";
  if (confirm(text) == true) {
     window.location = full_url + "contact/delete/" + id;
  }
}

