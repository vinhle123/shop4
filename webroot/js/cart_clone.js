function checkForm()
{
var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
var numformat = /^\d+$/;
if(document.getElementById("customCheck").checked == true)
{	
	if(email_validate(document.formcmdorder.email.value)==false)
	{
	alertify.error('Khi bạn đăng ký là thành viên thì không được bó trống phần email');
	document.formcmdorder.email.focus();
	return false;
	}
}	
if(document.formcmdorder.name.value == '')
{
alertify.error('Vui lòng cung cấp tên của bạn');
document.formcmdorder.name.focus();
return false;
}
if(document.formcmdorder.address.value == '')
{
alertify.error('Vui lòng cung cấp địa chỉ của bạn');
document.formcmdorder.address.focus();
return false;
}
if(document.formcmdorder.phone.value=='')
{
alertify.error('Vui lòng cung cấp số điện thoại của bạn');
document.formcmdorder.phone.focus();
return false;
}
if(document.formcmdorder.phone.value.length<9)
{
alertify.error("Số điện thoại phải lớn hơn 9 số");
document.formcmdorder.phone.focus();
return false;
}
if(document.formcmdorder.phone.value.match(numformat)== null)
{
alertify.error("Điện thoại phải là số");
document.formcmdorder.phone.focus();
return false;
}
return true;
}
function email_validate(x) {
        var atposition = x.indexOf("@");
        var dotposition = x.lastIndexOf(".");
        if (atposition < 1 || dotposition < (atposition + 2)
                || (dotposition + 2) >= x.length) {
            return false;
        }
		else
			return true
}
function phone_validate(x) {
	var numformat = /^\d+$/;
	if(x=='')
	return false;
	if(x.length<9)
	return false;
	if(x.match(numformat)== null)
	return false;
	return true;
}
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
function coupon_validate(total)
{
var couponvalue=document.getElementById('coupon').value;
var totalhaschange=document.getElementById('totalmoneycheckout').innerHTML.replace(",","");
if(totalhaschange>total)total=totalhaschange;
if(couponvalue=='')
return false;
if(couponvalue.length>6)
return false;
var datajson={coupon:couponvalue,totalorder:total};
$.ajax({
url:'check',
type: 'POST',
data: datajson,
dataType: 'json',
success: function(data) {
$("#totalmoneycheckout").html(formatNumber(parseInt(total) - parseInt(data.value)));
$("#valuediscount").html(formatNumber(parseInt(total)));
document.getElementById('couponvalue').value=data.token;
$("#btncoupon").removeClass("btn-warning");
$("#btncoupon").addClass("btn-success");
$("#btncoupon").html('<i class="fa fa-check"></i> Thành công');
$("#btncoupon").attr("disabled", true);
$("#truecouponvalue").html(formatNumber(parseInt(data.value)));
},
error: function(data) {console.log(data);}
});
}
function del(pid){
	alertify.confirm("B\u1EA1n mu\u1ED1n x\u00F3a s\u1EA3n ph\u1EA9m n\u00E0y ?", function (e) {
	if (e) 
	{
		$.ajax({
			url:'../cart',
			type: 'POST',
			dataType: 'JSON',
			data: {id:pid,cmd:'deletecart'},
			cache: false	        
		}).done(function(data) {
			if(data['status']==1)
			{
			$('#totalitem,#totaliteminbag').html(data['totalitem']);
			$('#totalmoney,#totalmoneycheckout').html(data['totalmoney']);
			$('#valuediscount,#changeafterdelorupdateitem').html('');
			$("#displaychangeafterdelorupdateitem").removeClass("d-none");
			$('#itemcart_'+pid+',#itemcartcheckout_'+pid).css("display", "none");
			document.getElementById('coupon').value='';
			document.getElementById('couponvalue').value='';
			if(data['totalitem']==0) document.location='../';
			}
			return false;
		}).fail(function(data){
			alertify.error('Có lỗi xảy ra.');
		});	
		
	}
	}).set('labels', {ok:'Xóa', cancel:'Không xóa'});
}
function buyproductnow(ids,prices,discounts,names,imgs)
{ 
var qty=$('#qty').html();
if(typeof qty === 'undefined')
qty=1;
$.ajax({
		url:'../cart',
		type: 'POST',
		dataType: 'JSON',
		data: {id:ids,price:prices,discount:discounts,name:names,img:imgs,quality:qty,cmd:'addcart'},
		async: false,
		cache: false,	        
	}).done(function(data) {
		if(data['status']==1)
		{
		$('#update_cart_after_click_buy').append(data['content']);
		$('#totalmoney').html(data['totalmoney']);
		$('#mdlshopping').modal('show');
		$('#totalitem,#totaliteminbag_m,#totaliteminbag_d').html(data['totalitem']);
		}
		else
		{
		alertify.error(html(data['msg']));
		}
		return false;
	}).fail(function(data){console.log(data);
		alertify.error('có lổi trong quá trình đặt hàng.');
		$('#update_cart_after_click_buy').append(data['content']);
		$('#totalmoney').html(data['totalmoney']);
		$('#mdlshopping').modal('show');
		$('#totalitem,#totaliteminbag_m,#totaliteminbag_d').html(data['totalitem']);
	});
}
function buyandcheckout(ids,prices,discounts,names,imgs)
{ 
var qty=$('#qty').html();
if(typeof qty === 'undefined')
qty=1;
$.ajax({
		url:'../cart',
		type: 'POST',
		dataType: 'JSON',
		data: {id:ids,price:prices,discount:discounts,name:names,img:imgs,quality:qty,cmd:'addcart'},
		async: false,
		cache: false,	        
	}).done(function(data) {
		if(data['status']==1)
		document.location='../dat-hang';
		else
		alertify.error(html(data['msg']));
		return false;
	}).fail(function(data){console.log(data);
		alertify.error('có lổi trong quá trình đặt hàng.');
		$('#update_cart_after_click_buy').append(data['content']);
		$('#totalmoney').html(data['totalmoney']);
		$('#mdlshopping').modal('show');
		$('#totalitem,#totaliteminbag_m,#totaliteminbag_d').html(data['totalitem']);
	});
}
function updateplus(id,prices,idname)
{	
	$('#'+idname+id).html(function(i, val){
	if(val==null) val=1;
	val=val*1+1;
	if(val>100) val=100;
	return val;
	});	
	var qty=document.getElementById(idname+id).innerHTML;
	$('#quantity'+id).html(qty);
	$.ajax({
		url:'./cart',
		type: 'POST',
		dataType: 'JSON',
		data: {ids:id,quality:qty,price:prices,cmd:'updatecart'},
		cache: false	        
	}).done(function(data) {
		if(data['status']==1)
		{
		$('#totalitem,#totaliteminbag').html(data['totalitem']);
		$('#totalmoney,#totalmoneycheckout').html(data['totalmoney']);
		$('#valuediscount,#changeafterdelorupdateitem').html('');
		$("#displaychangeafterdelorupdateitem").removeClass("d-none");
		$('#amount').val(data['totalmoney'].replace(/[\,]/g,''));
		$('#boxcartsmall').attr('data-content','Hiện có: ' + data['totalitem']+' sản phẩm, tổng tiền là: ' + data['totalmoney']+'đ');
		$('#shopping_item_total'+id).html(data['price']);
		document.getElementById('coupon').value='';
		document.getElementById('couponvalue').value='';
		}
		if(data['status']!=1)
		{
		alertify.error(html(data['msg']));
		}
		return false;
	});
}

function updateminus(id,prices,idname)
{	
	$('#'+idname+id).html(function(i, val){
	if(val==null) val=1;
	val=val*1-1;
	if(val<1) val=1;
	return val;
	});	
	
	var qty=document.getElementById(idname+id).innerHTML;
	$('#quantity'+id).html(qty);
	
	$.ajax({
		url:'./cart',
		type: 'POST',
		dataType: 'JSON',
		data: {ids:id,quality:qty,price:prices,cmd:'updatecart'},
		cache: false	        
	}).done(function(data) {
		if(data['status']==1)
		{
		$('#totalitem,#totaliteminbag').html(data['totalitem']);
		$('#totalmoney,#totalmoneycheckout').html(data['totalmoney']);
		$('#valuediscount,#changeafterdelorupdateitem').html('');
		$("#displaychangeafterdelorupdateitem").removeClass("d-none");
		$('#amount').val(data['totalmoney'].replace(/[\,]/g,''));
		$('#boxcartsmall').attr('data-content','Hiện có: ' + data['totalitem']+' sản phẩm, tổng tiền là: ' + data['totalmoney']+'đ');
		$('#shopping_item_total'+id).html(data['price']);
		document.getElementById('coupon').value='';
		document.getElementById('couponvalue').value='';
		}
		if(data['status']!=1)
		{
		alertify.error(html(data['msg']));
		}
		return false;
	});
}
$(document).ready(function () {
	$("#qtyplus").click(function() {
    $('#qty').html(function(i, val) { val=val*1+1;if(val>100) return 100;else return val});
	document.frmcmd.txtquality.value=document.getElementById("qty").innerHTML;
	});
	$("#qtyminus").click(function() {
	$('#qty').html(function(i, val) { val=val*1-1;if(val<1) return 1;else return val});
	document.frmcmd.txtquality.value=document.getElementById("qty").innerHTML;
	});
});