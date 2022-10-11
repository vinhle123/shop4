function deleteitemcart(id,idname)
{	
	
	$.post(full_url + "carts/deleteitemcart",{"id":id},function(data){
		var json = $.parseJSON(data);
		if ( json.result == 1 )
		{	
			$('#num_cart').html(json.num_cart);
			$('#total_price').html(json.totol_price);
			$('#i_cart_'+id).remove();
			if(json.totol_price_default == 0){
				
				$('#name_price_cart').html('');
				$('#tbody_cart').html('<tr><td id="no_cart_item">Giỏ hàng chưa có sản phẩm nào</td></tr>');
				
			}

		}
		else
		{
			Swal.fire({
			  icon: 'error',
			  text: json.message,
			  confirmButtonColor: '#3085d6',
			  confirmButtonText: 'Đóng'
			})
		}
	});
}


function quatityminus(id,idname)
{	
	$('#'+idname+id).html(function(i, current){
		if(current==null){
			current=1;
		} 
		current=current*1-1;
		if(current<=0) current=1;
		return current;
	});	
	totoalupdate(id,idname);
}

function quatityplus(id,idname)
{	
	$('#'+idname+id).html(function(i, current){
		if(current==null){
			current=1;
		} 
		current=current*1+1;
		if(current>=100) current=100;
		return current;
	});	

	totoalupdate(id,idname);
	
}

function totoalupdate(id,idname){

	var quality=document.getElementById(idname+id).innerHTML;
	$('#quantity'+id).html(quality);


	$.post(full_url + "carts/updatequality",{"id":id,"quality":quality},function(data){
		var json = $.parseJSON(data);
		if ( json.result == 1 )
		{	
			$('#num_cart').html(json.num_cart);
			$('#total_price').html(json.totol_price);
			

		}
		else
		{
			Swal.fire({
			  icon: 'error',
			  text: json.message,
			  confirmButtonColor: '#3085d6',
			  confirmButtonText: 'Đóng'
			})
		}
	});

}


function byproduct(id,price,name,name_key,img)
{	
	var quality = 1;
	$.post(full_url + "carts/addproductcart",{"id":id,"price":price,"name":name,"name_key":name_key,"img":img,"quality":quality},function(data){
		var json = $.parseJSON(data);
		if ( json.result == 1 )
		{	
			$('#all_cart').click();
			$('#num_cart').html(json.num_cart);
			

		}
		else
		{
			//button.removeClass('disabled');
			Swal.fire({
			  icon: 'error',
			  text: json.message,
			  confirmButtonColor: '#3085d6',
			  confirmButtonText: 'Đóng'
			})
		}
	});

}

function checkout()
{

	var txtname = $('#txtname').val();
	var txtemail = $('#txtemail').val();
	var txtphone = $('#txtphone').val();
	var txtaddress = $('#txtaddress').val();
	var txtnote = $('#txtnote').val();
	var code = $('#code').val();
	var method = $('input[name="method"]:checked').val();
	$('#btn_order').addClass('disabled');
	$('#btn_order').attr('disabled','disabled');
	$('#btn_order').attr('disabled',false);
	$.post(full_url + "carts/checkout",{"txtname":txtname,"txtemail":txtemail,"txtphone":txtphone,"txtaddress":txtaddress,"txtnote":txtnote,"code":code,"method":method},function(data){
		var json = $.parseJSON(data);
		if ( json.result == 1 )
		{	
			
			$('#btn_order').attr('disabled',false);
			$('#btn_order').removeClass('disabled');
			Swal.fire({
			  icon: 'success',
			  title: 'Đặt hàng thành công',
			  text: 'Cảm ơn quý khách hàng đã tin tưởng và sử dụng sản phẩm của Lộc Thiên Thảo',
			  showCancelButton: false,
			  confirmButtonColor: '#3085d6',
			  confirmButtonText: 'Đóng'
			}).then((result) => {
			  if (result.isConfirmed) {
			    window.location.href = full_url;
			  }
			})
			
			 window.setTimeout(function(){
		        window.location.href = full_url;
		    }, 5000);
			

		}
		else
		{

			Swal.fire({
			  icon: 'warning',
			  text: json.message,
			  confirmButtonColor: '#3085d6',
			  confirmButtonText: 'Đóng'
			});
			$('#btn_order').attr('disabled',false);
			$('#btn_order').removeClass('disabled');
		}
	});
	
	

}

$(document).ready(function(){
	$('#all_cart').click(function(){
		$.post(full_url + "carts",function(data){
			$('#content-cart').html(data);
			$('#frameModalCart').modal('show');
		});
		
	});

	$('#method1').click(function(){
		$('#bank_method').hide();
		$('#momo_method').hide();
	});
	$('#method2').click(function(){
		$('#bank_method').show();
		$('#momo_method').hide();
	});
	$('#method3').click(function(){
		$('#bank_method').hide();
		$('#momo_method').show();
	});
	
})