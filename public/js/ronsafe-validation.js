//local
var hostname = $(location).attr('origin')+"/ronsafe";
//Server
//var hostname = $(location).attr('origin');


//This function is for phone number validation
//onKeyUp="validatephone(this);" 
function validatephone(ph) {
	var maintainplus = '';
 	var numval = ph.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curphonevar = numval.replace(/[\\A-Za-z!"£$%^&*+_={};:'@#~,.¦\/<>?|`¬\]\[]/g,'');
 	ph.value = maintainplus + curphonevar;
 	var maintainplus = '';
 	ph.focus;
}

//onKeyPress="return numbersonly(event);"
function numbersonly(e){
	var unicode=e.charCode? e.charCode : e.keyCode
	if (unicode<48||unicode>57){ //if not a number
		return false //disable key press
	}
}


function validatePrice(e) {
	var val = e.value;
	var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
	var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
	
	val = re1.exec(val);
	if (val) {
		e.value = val[0];
	} else {
		e.value = "";
	}
}

//This function is for username  validation.space special character not allowed
//onKeyUp="checkUserName(this);"
function checkUserName(evt) {
	var maintainplus = '';
 	var numval = evt.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curuservar = numval.replace(/[^a-zA-Z0-9]/g,'');
 	evt.value = maintainplus + curuservar;
 	var maintainplus = '';
 	evt.focus;
}

//This function is for password  validation.space some special character are not allowed
//onKeyUp="checkPassword(this);"
function checkPassword(evt) {
	var maintainplus = '';
 	var numval = evt.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curuservar = numval.replace(/[^a-zA-Z0-9!@#$]/g,'');
 	evt.value = maintainplus + curuservar;
 	var maintainplus = '';
 	evt.focus;
}

function chk_xss(xss){
	var maintainplus = '';
	var numval = xss.value
	curphonevar = numval.replace(/[\\!"£$%^&*+_={};:'#~,.¦\/<>?|`¬\]\[]/g,'');
	xss.value = maintainplus + curphonevar;
	var maintainplus = '';
	xss.focus;
}


function showUserLoginPopup(){
	var url = hostname + "/user-login-popup";
	$.ajax({
	  type: "GET",
	  cache: false,
	  url: url,
	  data: {'choice':'login'},
	 /* beforeSend: function () {
		  $("#continue_su").html('Please Wait...');
	  },*/
	  success: function (data) {
		  $.fancybox(data);
	  }
   });
}

function validatefancyLogin(){
	if($('#login_email').val()==''){
		$("#login_email").addClass('error_cls');
		$('#login_email').focus();
		return false;
	}else {
		$("#login_email").removeClass('error_cls');
	}
	
	if($('#login_psw').val()==''){
		$("#login_psw").addClass('error_cls');
		$('#login_psw').focus();
		return false;
	}else {
		$("#login_psw").removeClass('error_cls');
		return true;
	}
}

function submitLoginForm(){
	var validate=validatefancyLogin();
	if(validate){
	  $.ajax({
		  url: hostname + "/user-login-popup",
		  type: "POST",
		  data:  $("#frm_login").serialize(),
		  dataType: 'json',
		  cache: false,
		  beforeSend: function () {
		  $("#login_btn").html('Please Wait...');
	  },
	  success: function (data) {
		/*console.log(data.response);
		return false;*/
		
		if(data.response == 'success'){
			$.fancybox.close();
			parent.location.reload(true);
		}
		else{
		  $('#msg_div_login').html(data.msg);
		  $("#login_btn").html('Sign in');
		}
	}
	});
	}else{
		return false;
	}
}


function addToBasket(price_id){
  $('#price_id').val(price_id);
  $('#frm_cart').submit();
}

function addToBasketPrdDetails(){
	if($('#check_prd').val() == 1){
		if ($('input[name=prd_price_id]:checked').length == '0'){
			$('.error-msg').html('select size & color');
			$('.error-msg').css('visibility','visible');
			return false;
		}
	$('#price_id').val($('input[name=prd_price_id]:checked').val());
	}
	$('#qty').val($('#quantity').val());
	$('#frm_cart').submit();
}

$('.qty-inc').click(function(){
	var cart__ = $(this).attr('data-id');
	var cat_qty = $('#quantity'+cart__).val();
	if(cart__ != '' && cat_qty >= 1){
		$.ajax({
		  url: hostname + "/qty-inc",
		  type: "POST",
		  data:  {cart_id : cart__},
		  dataType: 'json',
		  beforeSend: function () {
		  	$(".waiting_cart").css('display', 'block');
		  },
		  success: function (data) {
			if(data.response == 'success'){
			  $(".waiting_cart").css('display', 'none');
			  $('#quantity'+cart__).val(data.qty);
			  $('.prdtot'+cart__).html('<span class="f-size17">$</span> '+ data.total_price+'<span>');
			  $('.total_price').html('$ '+ data.tot_price);
			  $('#disp_gt').html('$ '+ data.grand_total);
			  $('#disp_ship').html('$ '+data.shipping_cost);
			  $('#disp_tot_items').html(data.tot_qty+' item(s)');
			}
			else{
			  $(".waiting_cart").css('display', 'none');
			  return false;
			}
		}
		});
	}else{
		return false;
	}
})

$('.qty-dec').click(function(){
	var cart__ = $(this).attr('data-id');
	var cat_qty = $('#quantity'+cart__).val();
	if(cart__ != '' && cat_qty > 1){
		$.ajax({
		  url: hostname + "/qty-dec",
		  type: "POST",
		  data:  {cart_id : cart__},
		  dataType: 'json',
		  beforeSend: function () {
		  	$(".waiting_cart").css('display', 'block');
		  },
		  success: function (data) {
			if(data.response == 'success'){
			  $(".waiting_cart").css('display', 'none');
			  $('#quantity'+cart__).val(data.qty);
			  $('.prdtot'+cart__).html('<span class="f-size17">$</span> '+ data.total_price+'<span>');
			  $('.total_price').html('$ '+ data.tot_price);
			  $('#disp_gt').html('$ '+ data.grand_total);
			  $('#disp_ship').html('$ '+data.shipping_cost);
			  $('#disp_tot_items').html(data.tot_qty+' item(s)');
			}
			else{
			  $(".waiting_cart").css('display', 'none');
			  return false;
			}
		}
		});
	}else{
		return false;
	}
})

function deleteCartItem(id){
	if(id != ''){
		$.ajax({
		  url: hostname + "/delete-item",
		  type: "POST",
		  data:  {cart_id : id},
		  dataType: 'json',
		  beforeSend: function () {
		  	$(".waiting_cart").css('display', 'block');
		  },
		  success: function (data) {
			if(data.response == 'success'){
			  $(".waiting_cart").css('display', 'none');
			  $('#cart-'+id).remove();
			  $('.total_price').html('$ '+ data.tot_price);
			  $('#disp_gt').html('$ '+ data.grand_total);
			  $('#disp_ship').html('$ '+data.shipping_cost);
			  $('#disp_tot_items').html(data.tot_qty+' item(s)');
			  
			  if(data.tot_qty==0){
				  $('#cart_sec').hide();
				  $('#cart_emp_sec').show();
				  
			  }
			}
			else{
			  $(".waiting_cart").css('display', 'none');
			  return false;
			}
		}
		});
	}else{
		return false;
	}
}

function submitForm() {
    var x = $("#checkout-form").valid();
    if (x) {
        var form_data = $('#checkout-form').serialize();
        $(".ajax_loader").show();
        $.ajax({
            url: "place-order-process",
            type: "POST",
            data: form_data,
            beforeSend: function () {
		  	$(".waiting_cart").css('display', 'block');
		  },
            success: function (response) {
                $(".ajax_loader").hide();
                if (response.status == "blank") {
                	$('#err_msg').css('visibility', 'visible');
                    $('#err_msg').html(response.msg);
                }
                if (response.status == "pass_blank") {
                	$('#err_msg').css('visibility', 'visible');
                    $('#err_msg').html(response.msg);
                }
                if (response.status == "email_exists") {
                	$('#err_msg').css('visibility', 'visible');
                    $('#err_msg').html(response.msg);
                }
                if (response.status == "success") {
                    window.location.href = "paypal";
                }

            }
        });
    } else {
        return false;
    }
}