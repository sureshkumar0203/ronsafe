var hostname = $(location).attr('origin') + "/ronsafe/";

function addProductPrice(){
	var row = $('#prd_price_row_count').val();
	if(row==10){
		alert("You can't add more than 3 rows");
	}else{
		if($('#color_id'+row).val() == ''){
			$('#color_id'+row).focus();
			return false;
		}
		if($('#size_id'+row).val() == ''){
			$('#size_id'+row).focus();
			return false;
		}
		if($('#prd_price'+row).val() == ''){
			$('#prd_price'+row).focus();
			return false;
		}
		
		if ($('#color_id' + row).val() != '' && $('#size_id' + row).val() != '' && $('#prd_price' + row).val() != '') {
			var nextrow = parseInt(row)+1;
			$("#row_to_clone"+nextrow).show();
			$('#prd_price_row_count').val(nextrow);
		}
		
	}
}

/*function delProductPrice(){
	var row = $('#prd_price_row_count').val();
	if(row==1){
		alert("You can't delete default row");
	}else{
	  var nextrow = parseInt(row)-1;
	  $("#row_to_clone"+row).hide();
	  
	  $('#color_id'+row).val('');
	  $('#size_id'+row).val('');
	  $('#prd_price'+row).val('');
	  
	  $('#prd_price_row_count').val(nextrow);
	}	
}*/

function delProductPrice(){
	var row = $('#prd_price_row_count').val();
	if(row==1){
		alert("You can't delete default row");
	}else{
	 var url = hostname + "delete-ppd-record";
	  $.ajax({
		  type: "POST",
		  cache: false,
		  url: url, // success.php
		  data : {'ppd_id':$('#db_record'+row).val()},
		  success: function (data) {
			  $('#db_record'+row).remove();
		  }
	  });
	  //console.log(data);
	  
	  var nextrow = parseInt(row)-1;
	  $("#row_to_clone"+row).hide();
	  
	  $('#color_id'+row).val('');
	  $('#size_id'+row).val('');
	  $('#prd_price'+row).val('');
	  
	  $('#prd_price_row_count').val(nextrow);
	}	
}

function delOptImages(img_id){
  	var del=confirm("Are you sure you want to delete this image?");
	if (del==true){
		$.ajax({
			type:'POST',
			url: hostname + "opt-img-delete",
			data: {'id': img_id},
			dataType:'JSON',
			success:function(response){                        
			  if(response.status == 'success'){
				  $("#prod_mul_image_"+img_id).remove();
			  }
			 }
			  
		});
	}
	return del;
}

$(document).ready(function () {
	if (window.File && window.FileList && window.FileReader) {
	  $("#opt_images").on("change", function (e) {
		  var files = e.target.files,filesLength = files.length;
		  for (var i = 0; i < filesLength; i++) {
			  var f = files[i]
			  var fileReader = new FileReader();
			  fileReader.onload = (function (e) {
				  var file = e.target;
				  $('#opt_images_div').prepend(
				  $('<div class="img_">' + 
				  '<img class="imageThumb" src="'+ e.target.result +'" title="" />' +
				  '<br/><span class="remove"><i class="fa fa-trash red"></i></span>' +
				  "</div>"));
				  
				  $(".remove").click(function () {
					  $(this).parent(".img_").remove();
				  });
			  });
			  fileReader.readAsDataURL(f);
		  }
	  });
	} else {
		alert("Your browser doesn't support to File API")
	}
});

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

function dispSizeColor(sc){
	if(sc==0){
		$('#color_id1').attr('disabled', true);
		//$("#AssignTPM").attr( disabled, disabled );
		$('#size_id1').attr('disabled', true);
		$('#disp_pm').hide();
	}
	if(sc==1){
		$('#color_id1').attr('disabled', false);
		$('#size_id1').attr('disabled', false);
		$('#disp_pm').show();
	}
}