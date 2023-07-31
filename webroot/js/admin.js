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

function deleteBlog(id) {
  let text = "Bạn có chắc muốn xóa bài viết này";
  if (confirm(text) == true) {
     window.location = full_url + "blogs/delete/" + id;
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

if($('#mytextareablog').length > 0){
	tinymce.init({
        selector: '#mytextareablog',
        images_upload_url: full_url + "blogs/upload",
        relative_urls : false,
remove_script_host : false,
convert_urls : true,
			  height: 800,
			  plugins: [
			    'advlist autolink link image lists charmap print preview hr anchor pagebreak',
			    'searchreplace wordcount visualblocks code fullscreen insertdatetime media nonbreaking',
			    'table emoticons template paste help'
			  ],
			  toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
			    'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
			    'forecolor backcolor emoticons | help',
			  menu: {
			    favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
			  },
			  menubar: 'favs file edit view insert format tools table help',
			  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
      });
	}

	$('#btn_save_blogs').click(function(){
		button = $(this);
	    button.addClass('disabled');
	    $('#mytextareablog').val(tinyMCE.activeEditor.getContent());
		var thisBtn = $(this);
    	var thisForm = thisBtn.closest("form");
		var formData = new FormData(thisForm[0]);
	    $.ajax({
	        type: "POST",
	        url: full_url + "blogs/save",
	        data: formData,
	        processData: false,
	        contentType: false,
	        success:function(data){
	           var json = $.parseJSON(data);
		        if ( json.result == 1 )
		        {
					window.location = full_url + "blogs/admin";
		        	
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


